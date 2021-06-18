<?php

namespace App\Jobs;

use App\Models\Contest;
use App\Models\Work;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImportFromUrad implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sourceDb = DB::connection('urad');

        $sourceDb->table('lab_works')
            ->orderBy('id')
            ->chunk(100, function ($works) {
                $upserts = $works
                    ->map(fn ($w) => (array) $w)
                    ->toArray();

                DB::table('works')->upsert($upserts, ['id']);
            });

        $sourceDb->table('lab_works')
            ->lazyById()
            ->each(function ($sourceWork) use ($sourceDb) {
                $work = Work::find($sourceWork->id);
                $this->importMedia($work, $sourceDb);
                $this->importWorkTags($work, $sourceDb);
            });

        $sourceDb->table('lab_awards')
            ->orderBy('id')
            ->chunk(100, function ($awards) {
                $upserts = $awards
                    ->map(fn ($a) => (array) $a)
                    ->toArray();

                DB::table('awards')->upsert($upserts, ['id']);
            });

        $sourceDb->table('lab_award_work')
            ->orderBy('id')
            ->chunk(100, function ($awardWorks) {
                $upserts = $awardWorks
                    ->map(fn ($aw) => (array) $aw)
                    ->toArray();

                DB::table('award_work')->upsert($upserts, ['id']);
            });

        $sourceDb->table('lab_publications')
            ->orderBy('id')
            ->chunk(100, function ($publications) {
                $upserts = $publications
                    ->map(fn ($p) => (array) $p)
                    ->toArray();

                DB::table('citation_publications')->upsert($upserts, ['id']);
            });

        $sourceDb->table('lab_publication_work')
            ->orderBy('id')
            ->chunk(100, function ($publicationWorks) {
                $upserts = $publicationWorks
                    ->map(fn ($pw) => (array) $pw)
                    ->toArray();

                DB::table('citation_publication_work')->upsert($upserts, ['id']);
            });

        $sourceDb->table('lab_contests')
            ->orderBy('id')
            ->chunk(100, function ($contests) {
                $upserts = $contests
                    ->map(fn ($c) => (array) $c)
                    ->toArray();

                DB::table('contests')->upsert($upserts, ['id']);
            });

        $sourceDb->table('lab_jurors')
            ->orderBy('id')
            ->chunk(100, function ($jurors) {
                $upserts = $jurors
                    ->map(fn ($j) => (array) $j)
                    ->toArray();

                DB::table('jurors')->upsert($upserts, ['id']);
            });

        $sourceDb->table('lab_proposals')
            ->orderBy('id')
            ->chunk(100, function ($proposals) {
                $upserts = $proposals
                    ->map(fn ($p) => (array) $p)
                    ->toArray();

                DB::table('proposals')->upsert($upserts, ['id']);
            });

        $sourceDb->table('lab_contests')
            ->lazyById()
            ->each(function ($sourceContest) use ($sourceDb) {
                $contest = Contest::find($sourceContest->id);
                $this->importContestTags($contest, $sourceDb);
            });

        // Remove entities no longer present in source DB
        DB::table('proposals')->whereNotIn('id', $sourceDb->table('lab_proposals')->pluck('id'))->delete();
        DB::table('jurors')->whereNotIn('id', $sourceDb->table('lab_jurors')->pluck('id'))->delete();
        DB::table('contests')->whereNotIn('id', $sourceDb->table('lab_contests')->pluck('id'))->delete();

        DB::table('citation_publication_work')->whereNotIn('id', $sourceDb->table('lab_publication_work')->pluck('id'))->delete();
        DB::table('citation_publications')->whereNotIn('id', $sourceDb->table('lab_publications')->pluck('id'))->delete();

        DB::table('award_work')->whereNotIn('id', $sourceDb->table('lab_award_work')->pluck('id'))->delete();
        DB::table('awards')->whereNotIn('id', $sourceDb->table('lab_awards')->pluck('id'))->delete();

        Media::whereNotNull('custom_properties->urad_id')
            ->whereNotIn('custom_properties->urad_id', $sourceDb->table('lab_media')->pluck('id'))->delete();
        Work::whereNotIn('id', $sourceDb->table('lab_works')->pluck('id'))->delete();
    }

    private function importMedia(Work $work, ConnectionInterface $sourceDb) {
        $existingUradIds = $work->getMedia('images')->map->getCustomProperty('urad_id');

        $sourceDb->table('lab_media')
            ->where('model_type', 'App\Models\Work')
            ->where('collection_name', 'work_pictures')
            ->where('model_id', $work->id) // Work ID from 'Urad' matches our Work ID
            ->whereNotIn('id', $existingUradIds)
            ->lazyById()
            ->each(function ($sourceMedium) use ($work) {
                $work
                    ->addMediaFromDisk("lab_sng/{$sourceMedium->id}/{$sourceMedium->file_name}", 'urad')
                    ->preservingOriginal()
                    ->withCustomProperties([
                        'urad_id' => $sourceMedium->id,
                    ])
                    ->toMediaCollection('images');
            });
    }

    private function importWorkTags(Work $work, ConnectionInterface $sourceDb) {
        $sourceDb
            ->table('lab_tags')
            ->select('name->sk as name', 'type')
            ->join('lab_taggables', 'lab_taggables.tag_id', '=', 'lab_tags.id')
            ->where('taggable_type', 'App\Models\Work')
            ->where('taggable_id', $work->id)
            ->get()

            ->groupBy('type')
            ->each(function ($tags, $type) use ($work) {
                $work->syncTagsWithType($tags->pluck('name'), $type);
            });
    }

    private function importContestTags(Contest $contest, ConnectionInterface $sourceDb) {
        $sourceDb
            ->table('lab_tags')
            ->select('name->sk as name', 'type')
            ->join('lab_taggables', 'lab_taggables.tag_id', '=', 'lab_tags.id')
            ->where('taggable_type', 'App\Models\Contest')
            ->where('taggable_id', $contest->id)
            ->get()

            ->groupBy('type')
            ->each(function ($tags, $type) use ($contest) {
                $contest->syncTagsWithType($tags->pluck('name'), $type);
            });
    }
}
