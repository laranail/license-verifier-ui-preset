<?php

declare(strict_types=1);

use Simtabi\Laranail\Licence\Verifier\Presets\Presets\PresetRegistry;

/**
 * The four presets shipped as four separate packages and are now one.
 *
 * Nothing here is a new capability -- it is the coverage the four never had. Each was a repository
 * with a src/ tree, a README and no test suite at all, so the only thing standing between a broken
 * preset and a release was somebody running the installer by hand.
 */
it('registers all four presets', function (): void {
    $keys = app(PresetRegistry::class)->keys();

    expect($keys)->toContain('blade', 'filament', 'livewire', 'vue');
});

/**
 * THE ONE THAT WOULD HAVE BROKEN SILENTLY.
 *
 * Each provider resolved its stubs with `dirname(__DIR__, 2).'/stubs'`, which was the package root
 * when the provider sat at `src/Providers/`. Nesting them under `src/<Stack>/Providers/` moves that
 * one level down, so the same expression now points at `src/stubs` -- a directory that does not
 * exist. Composer would install, the provider would boot, the registry would report four presets,
 * and the failure would surface only when somebody scaffolded.
 */
it('resolves a stubs directory that exists, for every preset', function (): void {
    foreach (app(PresetRegistry::class)->all() as $definition) {
        expect($definition->stubsPath)
            ->toBeDirectory("{$definition->key}: stubsPath does not exist")
            ->and(basename($definition->stubsPath))->toBe($definition->key);
    }
});

it('finds every stub named in a preset file map', function (): void {
    foreach (app(PresetRegistry::class)->all() as $definition) {
        foreach (array_keys($definition->fileMap) as $stub) {
            expect($definition->stubsPath.'/'.$stub)
                ->toBeFile("{$definition->key}: {$stub} is mapped but not shipped");
        }
    }
});

/**
 * A generated package requires the preset package by name. That name was
 * `laranail/license-verifier-ui-<stack>` -- four packages that this one replaces, and which will
 * not resolve once they are retired.
 */
it('points generated packages at the consolidated package', function (): void {
    foreach (app(PresetRegistry::class)->all() as $definition) {
        expect($definition->composerRequire)->toBe('laranail/license-verifier-ui-preset');
    }
});
