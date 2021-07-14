<?php

namespace App\Jobs;

use App\Models\Contest;
use App\Models\ContestResult;
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
        if ($this->dangerouslyDisableConstraints) DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->importTable('lab_works', 'works');
        $this->importTable('lab_awards', 'awards');
        $this->importTable('lab_award_work', 'award_work');
        $this->importTable('lab_publications', 'citation_publications');
        $this->importTable('lab_publication_work', 'citation_publication_work');
        $this->importTable('lab_contests', 'contests');
        $this->importTable('lab_rewards', 'rewards');
        $this->importTable('lab_contestresults', 'contestresults');
        $this->importTable('lab_jurors', 'jurors');
        $this->importTable('lab_proposals', 'proposals');
        $this->importTable('lab_architects', 'architects');
        $this->importTable('lab_addresses', 'addresses');
        $this->importTable('lab_business_numbers', 'business_numbers');
        $this->importTable('lab_numbers', 'numbers');
        $this->importTable('lab_architect_contest', 'architect_contest');
        $this->importTable('lab_architect_contestresult', 'architect_contestresult');
        $this->importTable('lab_architect_work', 'architect_work');

        if ($this->dangerouslyDisableConstraints) DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $sourceDb = $this->getSourceDb();

        // Remove entities no longer present in source DB
        DB::table('architect_work')->whereNotIn('id', $sourceDb->table('lab_architect_work')->pluck('id'))->delete();
        DB::table('architect_contestresult')->whereNotIn('id', $sourceDb->table('lab_architect_contestresult')->pluck('id'))->delete();
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
            $this->importModelMedia('App\Models\Work', $work, ['work_pictures']);
            $this->importModelTags('App\Models\Work', $work);
        }

        foreach (Contest::cursor() as $contest) {
            $this->importModelMedia('App\Models\Contest', $contest, ['contest_pictures', 'contest_attachments']);
            $this->importModelTags('App\Models\Contest', $contest);
        }

        foreach (ContestResult::cursor() as $contestResult) {
            $this->importModelMedia('App\Models\Contestresult', $contestResult, ['contestresult_pictures']);
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

    private function importModelMedia(string $sourceDbModelClassname, Model $entity, array $collectionNames)
    {
        if ($this->skipMediaImports) return;

        $sourceUradIds =  $this->getSourceDb()->table('lab_media')
            ->where('model_type', $sourceDbModelClassname)
            ->where('model_id', $entity->id) // Model IDs between us and Urad are identical
            ->whereIn('collection_name', $collectionNames)
            ->pluck('id');

        $importedUradIds = $entity->media()
            ->whereNotNull('custom_properties->urad_id')
            ->select('custom_properties->urad_id as urad_id')
            ->pluck('urad_id');

        // Import Media not yet present in our database
        $this->getSourceDb()->table('lab_media')
            ->whereIn('id', $sourceUradIds->diff($importedUradIds)->values())
            ->lazyById()
            ->each(function ($sourceMedium) use ($entity) {
                $entity
                    ->addMediaFromDisk("lab_sng/{$sourceMedium->id}/{$sourceMedium->file_name}", 'urad')
                    ->preservingOriginal()
                    ->withCustomProperties([
                        'urad_id' => $sourceMedium->id,
                    ])
                    ->toMediaCollection($sourceMedium->collection_name);
            });

        // Remove Media no longer present in the source
        $entity->media()
            ->whereIn('custom_properties->urad_id', $importedUradIds->diff($sourceUradIds)->values())
            ->lazyById()
            ->each(function ($medium) {
                $medium->delete();
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
            ->each(function ($tags) use ($entity) {
                // NULL types get grouped as empty strings
                $type = $tags[0]->type;
                $entity->syncTagsWithType($tags->pluck('name'), $type);
            });
    }
}
