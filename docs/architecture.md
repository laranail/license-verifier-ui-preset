# Architecture

Why four packages became one, and the one thing the merge had to get right.

## The four packages

`license-verifier-ui` scaffolds a licensing UI into a consuming application. What it scaffolds
depends on the stack, so each stack shipped as its own package: `laranail/license-verifier-ui-blade`,
`-filament`, `-livewire` and `-vue`.

Each was small — a `PresetDefinition`, a service provider that registers it, a `stubs/scaffold`
directory, and for Filament and Livewire a couple of base classes an application extends. Each also
shipped a `LICENSE`, a `CHANGELOG.md` and a `README.md`, and **none of them shipped a single test or
a CI workflow**.

## Why one package instead of four

The four were not independent. They shared a namespace root, depended on the same parent package,
and were released together. What they did not share was any way to notice a break: with no test
suite in any of the four, the only thing standing between a broken preset and a release was somebody
running the installer by hand.

Four repositories also meant four `LICENSE` files, four changelogs and four sets of CI to add — for
code that a consumer installs together anyway.

Consolidating cost nothing in content. The copies inside `license-verifier-ui/presets/` were verified
byte-identical to the four standalone repositories before the merge, so this package carries all of
it.

## What the merge had to get right

Each provider resolved its stub directory relative to its own file:

```php
BladePresetDefinition::make(dirname(__DIR__, 2).'/stubs');
```

With the provider at `src/Providers/`, `dirname(__DIR__, 2)` is the package root. Nesting the four
under `src/<Stack>/Providers/` moves that one level down, so the same expression points at
`src/stubs` — which does not exist.

**Nothing would have reported it.** Composer installs, the provider boots, the preset registry
reports four presets, and the failure appears only when somebody actually scaffolds. It is the same
shape as the org's `Providers/` move: a path expression that is one level short fails at runtime, not
at parse time.

So the paths read `dirname(__DIR__, 3).'/stubs/<stack>'`, and the suite asserts that every preset's
`stubsPath` is a real directory *and* that every stub named in a `fileMap` is a real file. Both were
checked for teeth by restoring the old expression and watching them fail.

## Optional stacks

Filament and Livewire are `suggest`, not `require` — a consumer using the Blade preset should not
install Filament. That is safe because the four auto-discovered providers are stack-agnostic: they
register a `PresetDefinition` and touch nothing from the stack. The classes that *do* need a stack
(`BaseLicensePage`, `BaseActivationForm`, and the rest) are base classes an application extends from
a stub, so they load only in an application that has already installed the stack.

---

[← Docs index](../README.md#documentation)
