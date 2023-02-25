<?php

namespace Elsayed85\Untouchable;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Elsayed85\Untouchable\Commands\UntouchableCommand;

class UntouchableServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('untouchable')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_untouchable_table')
            ->hasCommand(UntouchableCommand::class);
    }
}
