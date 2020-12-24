<?php
declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreatePostsIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::create('posts', function (Mapping $mapping, Settings $settings) {
            // XXX(reviewer): How do we define localized fields in elastic? Can
            // it deal with JSON well enough for us to not care?

            $mapping->text('title');
            $mapping->text('text');
            $mapping->date('published_at');

            $settings->analysis([
                'filter' => [
                    'lemmagen_filter' => [
                        'type' => 'lemmagen',
                        'lexicon' => 'sk',
                    ],
                    'synonyms_filter' => [
                        'type' => 'synonym',
                        'synonyms_path' => 'synonyms/sk_SK.txt',
                    ],
                    'stopwords_filter' => [
                        'type' => 'stop',
                        'stopwords_path' => 'stop-words/stop-words-slovak.txt',
                    ],
                ],
                'analyzer' => [
                    'asciifolding_analyzer' => [
                        'type' => 'custom',
                        'tokenizer' => 'standard',
                        'filter' => [
                            'lowercase',
                            'asciifolding',
                        ],
                    ],
                    'default_analyzer' => [
                        'type' => 'custom',
                        'tokenizer' => 'standard',
                        'filter' => [
                            'lemmagen_filter',
                            'lowercase',
                            'stopwords_filter',
                            'asciifolding',
                        ],
                    ],
                ],
                'normalizer' => [
                    'asciifolding_normalizer' => [
                        'type' => 'custom',
                        'filter' => [
                            'lowercase',
                            'asciifolding'
                        ]
                    ]
                ]
            ]);
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::drop('posts');
    }
}
