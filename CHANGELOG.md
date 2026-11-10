# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 0.4.2 Under development

- chore: remove obsolete scaffold tooling and align package maintenance checks with PHP Forge conventions.
- fix(menu): preserve generic renderable items in menus, breadcrumbs, and dropdowns.
- fix(item): render nested children inside their parent while preserving each child's configuration.
- fix(components): close streaming tags without replaying complete rendering and preserve toggle opening defaults.
- docs: align `README.md` base imports, navbar menu and toggle composition, and divider usage with the current API.

## 0.4.1 September 14, 2026

- refactor: remove prettier and stylelint templates now provided by `php-forge/baseline`.
- feat(menu): let each `Item` configure link/list tags and wrap non-anchor links without targets.

## 0.4.0 July 31, 2026

- docs: simplify upgrade guidance and correct configuration examples.
- chore!: update dependencies in `composer.json`.

## 0.3.0 July 30, 2026

- feat!: Adopt the `ui-awesome/html-core` theming system, move the cookbooks to theme packages, and clean up the rendered markup.

## 0.2.1 May 25, 2026

- feat: Add label wrapper API to `Item` (`labelTag`, `labelClass`, `labelAttributes`, `labelSetAttribute`, `labelRemoveAttribute`) to wrap the menu-item label in a configurable element; defaults to plain text for backward compatibility.

## 0.2.0 May 24, 2026

- refactor!: PHP 8.3 baseline, components and cookbooks migrated to `DefaultsProviderInterface`/`ThemeProviderInterface`, full PHPDoc across `src/`.
- docs: Standardize PHPDoc across and add missing documentation.

## 0.1.0 March 31, 2024

- Enh #1: Initial release (@terabytesoftw)
- Enh #2: Add `ui-awesome/html-core` package (@terabytesoftw)
