# Contributing

Thanks for helping improve `laranail/license-verifier-ui-preset`.

## Getting set up

```bash
composer install
composer lint
```

Requires PHP `^8.4.1 || ^8.5`.

## What must pass

- **Style**: `composer pint-fix` applies the Laravel Pint preset; `composer lint` checks it.

## About this package

Scaffolding only: four presets (`Blade`, `Filament`, `Livewire`, `Vue`), each with its own
service provider, all four registered through `extra.laravel.providers`. A change to one preset
should not require touching the other three; if it does, the shared part belongs upstream in
`laranail/license-verifier-ui`.

There is no `composer test` script and one test file. `composer lint` is the gate that exists.

## Pull requests

Changes reach `main` through a pull request. CI runs on the pull request, not on a push to a
branch, so a green tick means the change was gated rather than reported on after the fact.

- Tests added or updated for new behaviour, where the package has a suite
- `composer lint` clean
- `CHANGELOG.md` updated under `## Unreleased` for anything user-facing
- Commits follow [Conventional Commits](https://www.conventionalcommits.org/)
- No AI attribution anywhere: not in commits, PR titles or bodies, code comments or docs

## Security

See [`SECURITY.md`](SECURITY.md). Do not open a public issue for a vulnerability.
