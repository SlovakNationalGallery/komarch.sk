<?php

namespace App\Jobs;

use App\Models\Contest;
use App\Models\Work;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImportFromUrad implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private bool $dangerouslyDisableConstraints;
    private bool $skipMediaImports;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($dangerouslyDisableConstraints = false, $skipMediaImports = false)
    {
        $this->dangerouslyDisableConstraints = $dangerouslyDisableConstraints;
        $this->skipMediaImports = $skipMediaImports;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->importTable('lab_works', 'works');
        $this->importTable('lab_awards', 'awards');
        $this->importTable('lab_award_work', 'award_work');
        $this->importTable('lab_publications', 'citation_publications');
        $this->importTable('lab_publication_work', 'citation_publication_work');
        $this->importTable('lab_contests', 'contests');
        $this->importTable('lab_jurors', 'jurors');
        $this->importTable('lab_proposals', 'proposals');
        $this->importTable('lab_architects', 'architects');
        $this->importTable('lab_addresses', 'addresses');
        $this->importTable('lab_business_numbers', 'business_numbers');
        if ($this->dangerouslyDisableConstraints) DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->importTable('lab_numbers', 'numbers');
        $this->importTable('lab_architect_contest', 'architect_contest');
        $this->importTable('lab_architect_work', 'architect_work');
        if ($this->dangerouslyDisableConstraints) DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $sourceDb = $this->getSourceDb();

        // Remove entities no longer present in source DB
        DB::table('architect_work')->whereNotIn('id', $sourceDb->table('lab_architect_work')->pluck('id'))->delete();
        DB::table('architect_contest')->whereNotIn('id', $sourceDb->table('lab_architect_contest')->pluck('id'))->delete();
        DB::table('numbers')->whereNotIn('id', $sourceDb->table('lab_numbers')->pluck('id'))->delete();
        DB::table('business_numbers')->whereNotIn('id', $sourceDb->table('lab_business_numbers')->pluck('id'))->delete();
        DB::table('addresses')->whereNotIn('id', $sourceDb->table('lab_addresses')->pluck('id'))->delete();
        DB::table('architects')->whereNotIn('id', $sourceDb->table('lab_architects')->pluck('id'))->delete();
        DB::table('proposals')->whereNotIn('id', $sourceDb->table('lab_proposals')->pluck('id'))->delete();
        DB::table('jurors')->whereNotIn('id', $sourceDb->table('lab_jurors')->pluck('id'))->delete();
        DB::table('contests')->whereNotIn('id', $sourceDb->table('lab_contests')->pluck('id'))->delete();
        DB::table('citation_publication_work')->whereNotIn('id', $sourceDb->table('lab_publication_work')->pluck('id'))->delete();
        DB::table('citation_publications')->whereNotIn('id', $sourceDb->table('lab_publications')->pluck('id'))->delete();
        DB::table('award_work')->whereNotIn('id', $sourceDb->table('lab_award_work')->pluck('id'))->delete();
        DB::table('awards')->whereNotIn('id', $sourceDb->table('lab_awards')->pluck('id'))->delete();

        Media::whereNotNull('custom_properties->urad_id')
            ->whereNotIn('custom_properties->urad_id', $sourceDb->table('lab_media')->pluck('id'))->delete();
        DB::table('works')->whereNotIn('id', $sourceDb->table('lab_works')->pluck('id'))->delete();

        // Synchronize tags & media
        foreach (Work::cursor() as $work) {
            $this->importMedia($work);
            $this->importModelTags('App\Models\Work', $work);
        }

        foreach (Contest::cursor() as $contest) {
            $this->importModelTags('App\Models\Contest', $contest);
        }
    }

    private function getSourceDb(): ConnectionInterface
    {
        return DB::connection('urad');
    }

    private function importTable(string $sourceTableName, string $targetTableName)
    {
        $this->getSourceDb()->table($sourceTableName)
            ->orderBy('id')
            ->chunk(100, function ($rows) use ($targetTableName) {
                $upserts = $rows
                    ->map(fn ($row) => (array) $row)
                    ->toArray();

                DB::table($targetTableName)->upsert($upserts, ['id']);
            });
    }

    private function importMedia(Work $work)
    {
        if ($this->skipMediaImports) return;

        $existingUradIds = $work->getMedia('images')->map->getCustomProperty('urad_id');

        $this->getSourceDb()->table('lab_media')
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

    private function importModelTags(string $sourceDbModelClassname, Model $entity)
    {
        $this->getSourceDb()
            ->table('lab_tags')
            ->select('name->sk as name', 'type')
            ->join('lab_taggables', 'lab_taggables.tag_id', '=', 'lab_tags.id')
            ->where('taggable_type', $sourceDbModelClassname)
            ->where('taggable_id', $entity->id)
            ->get()

            ->groupBy('type')
            ->each(function ($tags, $type) use ($entity) {
                $entity->syncTagsWithType($tags->pluck('name'), $type);
            });
    }
}
