<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\File;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $compiledPath = storage_path('framework/views-test/'.str_replace('\\', '_', static::class).'_'.md5($this->name()));
        File::ensureDirectoryExists($compiledPath);
        config(['view.compiled' => $compiledPath]);
    }
}
