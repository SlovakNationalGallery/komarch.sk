<?php

namespace App\Jobs;

use App\Models\Work;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImportWorks implements ShouldQueue
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
            ->lazyById()
            ->each(function ($sourceWork) use ($sourceDb) {
                $work = Work::unguarded(function() use ($sourceWork) {
                    return Work::updateOrCreate(
                        ['id' => $sourceWork->id],
                        (array) $sourceWork
                    );
                });

                $this->importMedia($work, $sourceDb);
                $this->importTags($work, $sourceDb);
            });

        $sourceDb->table('lab_awards')
            ->orderBy('id')
            ->chunk(100, function ($sourceAwards) {
              $upserts = $sourceAwards
                ->map(fn ($aw) => (array) $aw)
                ->toArray();

              DB::table('awards')->upsert($upserts, ['id']);
            });

        $sourceDb->table('lab_award_work')
            ->orderBy('id')
            ->chunk(100, function ($sourceAwardWorks) {
              $upserts = $sourceAwardWorks
                ->map(fn ($aw) => (array) $aw)
                ->toArray();

              DB::table('award_work')->upsert($upserts, ['id']);
            });

        // Remove Works no longer present in source DB
        DB::table('award_work')->whereNotIn('id', $sourceDb->table('lab_award_work')->pluck('id'))->delete();

        // Remove Works no longer present in source DB
        DB::table('awards')->whereNotIn('id', $sourceDb->table('lab_awards')->pluck('id'))->delete();

        // Remove Media no longer present in source DB
        Media::whereNotNull('custom_properties->urad_id')
            ->whereNotIn('custom_properties->urad_id', $sourceDb->table('lab_media')->pluck('id'))->delete();

        // Remove Works no longer present in source DB
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

    private function importTags(Work $work, ConnectionInterface $sourceDb) {
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
}
