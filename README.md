<!-- markdownlint-disable MD041 -->
<p align="center">
    <picture>
        <img src="https://raw.githubusercontent.com/ui-awesome/.github/refs/heads/main/logo/ui_awesome.png" alt="UI Awesome" width="25%">
    </picture>
    <h1 align="center">Html Core Component</h1>
    <br>
</p>
<!-- markdownlint-enable MD041 -->

<p align="center">
    <a href="https://github.com/ui-awesome/html-core-component/actions/workflows/build.yml" target="_blank">
        <img src="https://img.shields.io/github/actions/workflow/status/ui-awesome/html-core-component/build.yml?style=for-the-badge&label=PHPUnit&logo=github" alt="PHPUnit">
    </a>
    <a href="https://dashboard.stryker-mutator.io/reports/github.com/ui-awesome/html-core-component/main" target="_blank">
        <img src="https://img.shields.io/endpoint?style=for-the-badge&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fui-awesome%2Fhtml-core-component%2Fmain" alt="Mutation Testing">
    </a>
    <a href="https://github.com/ui-awesome/html-core-component/actions/workflows/static.yml" target="_blank">
        <img src="https://img.shields.io/github/actions/workflow/status/ui-awesome/html-core-component/static.yml?style=for-the-badge&label=PHPStan&logo=github" alt="PHPStan">
    </a>
    <a href="https://github.com/ui-awesome/html-core-component/actions/workflows/security.yml" target="_blank">
        <img src="https://img.shields.io/github/actions/workflow/status/ui-awesome/html-core-component/security.yml?style=for-the-badge&label=Security&logo=github" alt="Security">
    </a>
</p>

<p align="center">
    <strong>Composable, immutable PHP primitives for building UI components: alerts, breadcrumbs, dropdowns, navbars, toggles, and menu items.</strong><br>
    <em>Accessible by default, fluent API, framework-friendly data hooks, and rendering powered by html-core.</em>
</p>

## Features

<picture>
    <source media="(max-width: 767px)" srcset="./docs/svgs/features-mobile.svg">
    <img src="./docs/svgs/features.svg" alt="Feature Overview" style="width: 100%;">
</picture>

### Installation

```bash
composer require ui-awesome/html-core-component:^0.3
```

### Quick start

This package ships both abstract base classes (for subclassing) and ready-to-use concrete classes (`Alert`, `Breadcrumb`, `Dropdown`, `NavBar`, `Toggle`, `Item`, `Menu`). The concrete classes can be used directly via `::tag()` without any subclassing.

The exposed abstractions are:

- `BaseAlert` / `Alert` dismissible alerts with prefix/suffix containers and an optional toggle.
- `BaseBreadcrumb` / `Breadcrumb` accessible breadcrumb navigation with active-path detection.
- `BaseDropdown` / `Dropdown` dropdown menus with toggles, dividers, and active-link wiring.
- `BaseNavBar` / `NavBar` navigation bars with brand, menu, and collapsible toggle.
- `BaseToggle` / `Toggle` button or link toggles with full data-attribute coverage (Bootstrap, Flowbite, Tailwind UI).

#### Custom breadcrumb

```php
use UIAwesome\Html\Core\Component\{BaseBreadcrumb, Item};

final class Breadcrumb extends BaseBreadcrumb {}

echo Breadcrumb::tag()
    ->items(
        Item::tag()->label('Home')->link('/'),
        Item::tag()->label('Library')->link('/library'),
        Item::tag()->label('Data')->active(true),
    )
    ->currentPath('/library')
    ->render();
```

#### Custom dropdown

```php
use UIAwesome\Html\Core\Component\{BaseDropdown, Item};

final class Dropdown extends BaseDropdown {}

echo Dropdown::tag()
    ->items(
        Item::tag()->label('Profile')->link('/profile'),
        Item::tag()->label('Settings')->link('/settings'),
        Item::tag()->divider('<hr>'),
        Item::tag()->label('Sign out')->link('/logout'),
    )
    ->render();
```

#### Custom navbar with toggle

```php
use UIAwesome\Html\Core\Component\{BaseNavBar, BaseToggle, Item};

final class NavBar extends BaseNavBar {}
final class Toggle extends BaseToggle {}

echo NavBar::tag()
    ->brandText('My App')
    ->brandLink('/')
    ->menu(
        Item::tag()->label('Home')->link('/'),
        Item::tag()->label('About')->link('/about'),
    )
    ->render();
```

#### Menu with wrapped labels

Each item label can be wrapped in its own element (for styling or truncation) via `labelTag`/`labelClass`. Without `labelTag`, the label renders as plain text.

```php
use UIAwesome\Html\Core\Component\{Item, Menu};
use UIAwesome\Html\Interop\Inline;

echo Menu::tag()
    ->type('nav')
    ->linkClass('nav-link')
    ->linkActiveClass('is-active')
    ->items(
        Item::tag()
            ->label('Request')
            ->link('/request')
            ->active()
            ->labelTag(Inline::SPAN)
            ->labelClass('nav-link-label'),
        Item::tag()
            ->label('Logs')
            ->link('/logs')
            ->labelTag(Inline::SPAN)
            ->labelClass('nav-link-label'),
    )
    ->render();
```

### Application-scoped styling

Framework styling is supplied by a `ThemeInterface` implementation resolved through `Config` and applied with `BaseTag::config()`. The theme reads the `ComponentContext` to pick the recipe, so variants (`danger`, `info`, `warning`, ...) travel with the context instead of being hard-coded on the component.

```php
use UIAwesome\Html\Core\Component\Alert;
use UIAwesome\Html\Core\Config\{Call, ComponentContext, Config, Cookbook, Recipe};
use UIAwesome\Html\Core\Theme\ThemeInterface;

final class AppTheme implements ThemeInterface
{
    public function getName(): string
    {
        return 'app';
    }

    public function getRecipes(ComponentContext $context): iterable
    {
        if ($context->component !== 'alert' || $context->variant === null) {
            return;
        }

        yield new Recipe(
            'app.alert',
            new Cookbook(new Call('class', "alert alert-{$context->variant}")),
        );
    }
}

$config = new Config(new AppTheme());

echo Alert::tag()
    ->config($config, new ComponentContext('alert', variant: 'danger'))
    ->content('Watch out!')
    ->render();
```

Configuration composes by precedence, not by call order: `config()` applies the resolved recipes immediately, so every fluent call made afterwards stays a local override.

For per-instance defaults that do not belong to a theme, pass them to the factory:

```php
use UIAwesome\Html\Core\Component\Alert;

echo Alert::tag(['class' => 'alert alert-danger'])->content('Watch out!')->render();
```

> [!NOTE]
> The `Bootstrap5` and `Flowbite` cookbooks were removed in `0.3.0`. Flowbite is discontinued, and the Bootstrap 5
> presets are being republished as standalone theme packages. See the [Upgrade Guide](UPGRADE.md) for the migration.

## Documentation

For detailed configuration options and advanced usage.

- 🧪 [Testing Guide](docs/testing.md)
- ⬆️ [Upgrade Guide](UPGRADE.md)

## Package information

[![PHP](https://img.shields.io/badge/%3E%3D8.3-777BB4.svg?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/releases/8.3/en.php)
[![Latest Stable Version](https://img.shields.io/packagist/v/ui-awesome/html-core-component.svg?style=for-the-badge&logo=packagist&logoColor=white&label=Stable)](https://packagist.org/packages/ui-awesome/html-core-component)
[![Total Downloads](https://img.shields.io/packagist/dt/ui-awesome/html-core-component.svg?style=for-the-badge&logo=composer&logoColor=white&label=Downloads)](https://packagist.org/packages/ui-awesome/html-core-component)

## Quality code

[![Codecov](https://img.shields.io/codecov/c/github/ui-awesome/html-core-component.svg?style=for-the-badge&logo=codecov&logoColor=white&label=Coverage)](https://codecov.io/github/ui-awesome/html-core-component)
[![PHPStan Level Max](https://img.shields.io/badge/PHPStan-Level%20Max-4F5D95.svg?style=for-the-badge&logo=github&logoColor=white)](https://github.com/ui-awesome/html-core-component/actions/workflows/static.yml)
[![Super-Linter](https://img.shields.io/github/actions/workflow/status/ui-awesome/html-core-component/linter.yml?style=for-the-badge&label=Super-Linter&logo=github)](https://github.com/ui-awesome/html-core-component/actions/workflows/linter.yml)
[![StyleCI](https://img.shields.io/badge/StyleCI-Passed-44CC11.svg?style=for-the-badge&logo=github&logoColor=white)](https://github.styleci.io/repos/776381948?branch=main)

## Our social networks

[![Follow on X](https://img.shields.io/badge/-Follow%20on%20X-1DA1F2.svg?style=for-the-badge&logo=x&logoColor=white&labelColor=000000)](https://x.com/Terabytesoftw)

## License

[![License](https://img.shields.io/badge/License-MIT-brightgreen.svg?style=for-the-badge&logo=opensourceinitiative&logoColor=white&labelColor=555555)](LICENSE)
