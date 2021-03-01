<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Tests\RefreshSearchIndex;

trait CreatesApplication
{

    /**
     * Boot the testing helper traits.
     *
     * @return array
     */
    protected function setUpTraits()
    {
        $uses = parent::setUpTraits();
        if (isset($uses[RefreshSearchIndex::class])) {
            $this->refreshSearchIndex();
        }
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
