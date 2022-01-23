<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction(); // a hack to avoid DB changes. Should be done in some other way
    }

    public function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }
}
