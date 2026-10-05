# Presets

The four scaffolding presets this package registers, and how each resolves its stubs.

Installing the package registers all four. Nothing is generated until `license-verifier-ui` scaffolds
with one.

## The presets

| Key | Stack needed | Ships |
|---|---|---|
| `blade` | none beyond Laravel | a controller base, a scaffold stub set |
| `vue` | none beyond Laravel | a controller base, a scaffold stub set, `package.json` |
| `livewire` | `livewire/livewire ^3.5` | activation form and status widget bases |
| `filament` | `filament/filament ^4.0 \|\| ^3.2` | a page, a widget and a plugin base |

`livewire/livewire` and `filament/filament` are **suggested**, not required. A consumer scaffolding
with the Blade preset does not install Filament.

## How a preset is found

Each preset registers a `PresetDefinition` into the `PresetRegistry` from
`laranail/license-verifier-ui`:

```php
app(PresetRegistry::class)->keys();   // ['blade', 'filament', 'livewire', 'vue']
app(PresetRegistry::class)->get('blade')->stubsPath;
```

## How stubs resolve

Every preset's stubs live under `stubs/<key>/`, and the provider resolves them from its own location:

```php
BladePresetDefinition::make(dirname(__DIR__, 3).'/stubs/blade');
```

The `3` is load-bearing. The provider sits at `src/Blade/Providers/`, so three levels up is the
package root. It was `2` when each preset was its own package and the provider sat at `src/Providers/`
— see [architecture](../architecture.md#what-the-merge-had-to-get-right) for why that failure is
invisible until somebody scaffolds.

## Route names

The `blade` and `vue` stubs name their routes with the `$ROUTE_NAME_PREFIX$` token, which
`laranail/license-verifier-ui`'s generator fills in. A newly generated package gets
`laranail-license-verifier-ui.` (Blade) or `laranail-license-verifier-ui-vue.` (Vue), written into
its own `routes.name` config and views.

A package generated before 2026-10 carries `license-verifier.` or `license-verifier-vue.` instead.
The base providers fall back to those prefixes when `routes.name` is unset, so such a package keeps
its route names until it is regenerated.

## Adding a preset

1. Add `src/<Stack>/Presets/<Stack>PresetDefinition.php` returning a `PresetDefinition`, with
   `composerRequire: 'laranail/license-verifier-ui-preset'`.
2. Add `src/<Stack>/Providers/<Stack>ServiceProvider.php` registering it, resolving stubs with
   `dirname(__DIR__, 3).'/stubs/<key>'`.
3. Put the stubs under `stubs/<key>/`.
4. Register the provider in `composer.json` under `extra.laravel.providers`, and add the PSR-4
   prefix for `src/<Stack>/`.

The suite covers the new preset automatically — it iterates the registry rather than naming presets.

---

[← Docs index](../../README.md#documentation)
