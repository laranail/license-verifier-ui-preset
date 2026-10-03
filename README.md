# laranail/license-verifier-ui-preset

[![Tests](https://github.com/laranail/license-verifier-ui-preset/actions/workflows/tests.yml/badge.svg)](https://github.com/laranail/license-verifier-ui-preset/actions/workflows/tests.yml)
[![Static analysis](https://github.com/laranail/license-verifier-ui-preset/actions/workflows/static-analysis.yml/badge.svg)](https://github.com/laranail/license-verifier-ui-preset/actions/workflows/static-analysis.yml)
[![License MIT](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

`laranail/license-verifier-ui-preset` is not published to Packagist, so there is no registry-version badge to show: see [Install](#install).

> Blade, Filament, Livewire and Vue scaffolding presets for `laranail/license-verifier-ui`.

Requires PHP `^8.4.1 || ^8.5` and Laravel `^13.0`. Filament and Livewire are needed only by their own
presets and are suggested, not required.

## Install

```bash
composer require laranail/license-verifier-ui-preset
```

All four presets register themselves. Nothing is enabled until you scaffold with one.

## Quick start guide and usage

### Getting started

1. The `blade` and `vue` presets need nothing beyond Laravel. The other two need their stack, which
   is suggested rather than required: `livewire/livewire ^3.5` for `livewire`, and
   `filament/filament ^4.0 || ^3.2` for `filament`.
2. Check the generator before scaffolding:

   ```bash
   php artisan laranail::license-verifier-ui.doctor
   ```

### Usage

```bash
php artisan laranail::license-verifier-ui.list
php artisan laranail::license-verifier-ui.install blade
```

```php
app(PresetRegistry::class)->keys();   // ['blade', 'filament', 'livewire', 'vue']
app(PresetRegistry::class)->get('blade')->stubsPath;
```

The full walkthrough is in [Presets](docs/tools/presets.md); everything else is in the [documentation index](#documentation).

## <a name="documentation"></a>Documentation

Full documentation is at
**[opensource.simtabi.com/documentation/laranail/license-verifier-ui-preset](https://opensource.simtabi.com/documentation/laranail/license-verifier-ui-preset/)**.

### Reference

- [Presets](docs/tools/presets.md) — the four presets, what each scaffolds, and how the stubs resolve.

### Project

- [Architecture](docs/architecture.md) — why the four packages became one.

## License

MIT. See [LICENSE](LICENSE).
