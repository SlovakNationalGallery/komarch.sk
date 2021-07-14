<?php
declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateWorksIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::createIfNotExists('works', function (Mapping $mapping, Settings $settings) {
            $mapping->text('name', ['boost' => 2, 'analyzer' => 'standard_asciifolded']);

            $settings->analysis([
                'analyzer' => [
                    'standard_asciifolded' => [
                        'type' => 'custom',
                        'tokenizer' => 'standard',
                        'filter' => [
                            'lowercase',
                            'asciifolding',
                        ],
                    ]
                ],
            ]);
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::drop('works');
    }
}
