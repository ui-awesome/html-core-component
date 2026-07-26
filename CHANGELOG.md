# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 0.2.2 Under development

- docs: Correct image source order in `README.md` for feature overview.
- ci: Replace Super-Linter with reusable `quality.yml` and `security.yml` workflows, pin reusable workflow references to a commit SHA, and group Dependabot updates.

## 0.2.1 May 25, 2026

- feat: Add label wrapper API to `Item` (`labelTag`, `labelClass`, `labelAttributes`, `labelSetAttribute`, `labelRemoveAttribute`) to wrap the menu-item label in a configurable element; defaults to plain text for backward compatibility.

## 0.2.0 May 24, 2026

- refactor!: PHP 8.3 baseline, components and cookbooks migrated to `DefaultsProviderInterface`/`ThemeProviderInterface`, full PHPDoc across `src/`.
- docs: Standardize PHPDoc across and add missing documentation.

## 0.1.0 March 31, 2024

- Enh #1: Initial release (@terabytesoftw)
- Enh #2: Add `ui-awesome/html-core` package (@terabytesoftw)
