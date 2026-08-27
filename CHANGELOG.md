# Changelog

All notable changes to `laranail/license-verifier-ui-preset` are documented in this file.

The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/)
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

_Nothing yet._

## v0.1.0

### Added

- **The four preset packages, consolidated into one.** `laranail/license-verifier-ui-blade`,
  `-filament`, `-livewire` and `-vue` are replaced by this package. Every source file is carried
  over unchanged; the four were verified byte-identical to the copies in
  `license-verifier-ui/presets/` before the merge, so nothing was lost.

- **A test suite**, which none of the four had. The four shipped a `src/` tree, a README and no
  tests at all, so the only thing between a broken preset and a release was somebody running the
  installer by hand.

### Changed

- **Stub paths re-depthed.** Each provider resolved its stubs with `dirname(__DIR__, 2).'/stubs'`,
  correct when the provider sat at `src/Providers/`. Nesting under `src/<Stack>/Providers/` moves
  that a level down, so it now reads `dirname(__DIR__, 3).'/stubs/<stack>'`. This is the failure the
  suite exists to catch: the old expression resolves to a directory that does not exist, and
  Composer, boot and the preset registry are all still happy — it surfaces only when somebody
  scaffolds.

- **Generated packages require this package.** Each `PresetDefinition` named
  `laranail/license-verifier-ui-<stack>` as the base a scaffolded package requires. Those names are
  retired, so they now name this one.
