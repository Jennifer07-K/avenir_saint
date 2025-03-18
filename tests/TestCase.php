<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Http\Middleware\CheckSubscription;


abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
{
    parent::setUp();
    $this->withoutMiddleware(CheckSubscription::class); 
}
}
