<?php

declare(strict_types=1);

namespace Simtabi\Laranail\Licence\Verifier\Presets\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Simtabi\Laranail\Licence\Verifier\Presets\Blade\Providers\BladeServiceProvider;
use Simtabi\Laranail\Licence\Verifier\Presets\Filament\Providers\FilamentServiceProvider;
use Simtabi\Laranail\Licence\Verifier\Presets\Livewire\Providers\LivewireServiceProvider;
use Simtabi\Laranail\Licence\Verifier\Presets\Providers\LicenseVerifierUiServiceProvider;
use Simtabi\Laranail\Licence\Verifier\Presets\Vue\Providers\VueServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LicenseVerifierUiServiceProvider::class,
            BladeServiceProvider::class,
            FilamentServiceProvider::class,
            LivewireServiceProvider::class,
            VueServiceProvider::class,
        ];
    }
}
