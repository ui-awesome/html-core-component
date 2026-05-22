# Upgrade Guide

## 0.2.0

### PHP and package requirements

- The minimum PHP version is now `^8.3`.
- Runtime dependencies were updated to the current UI Awesome package line:
  - `ui-awesome/html-attribute:^0.6`
  - `ui-awesome/html-contracts:^0.1`
  - `ui-awesome/html-core:^0.6`
  - `ui-awesome/html-helper:^0.7`
  - `ui-awesome/html-interop:^0.4`
  - `ui-awesome/html-mixin:^0.6`
  - `ui-awesome/html-svg:^0.5`
- Removed legacy runtime dependencies:
  - `php-forge/awesome-widget`
  - `ui-awesome/html-concern`

### Base class migration

Abstract components migrated from `PHPForge\Widget\Element` to `UIAwesome\Html\Core\Element\BaseBlock`. Concrete
subclasses must implement `protected function getTag(): \BackedEnum` to declare their wrapper tag.

Before:

```php
use PHPForge\Widget\Element;
use UIAwesome\Html\Interop\RenderInterface;

abstract class BaseAlert extends Element implements RenderInterface
{
    protected function loadDefaultDefinitions(): array
    {
        return ['role()' => ['alert']];
    }
}
```

After:

```php
use BackedEnum;
use UIAwesome\Html\Contracts\RenderableInterface;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

abstract class BaseAlert extends BaseBlock implements RenderableInterface
{
    protected function getTag(): BackedEnum
    {
        return Block::DIV;
    }

    protected function loadDefault(): array
    {
        return ['role' => ['alert']];
    }
}
```

Cookbook keys no longer carry trailing parentheses: `'role()'` becomes `'role'`. `SimpleFactory::configure` resolves the
key against `method_exists($tag, $key)` directly.

### Render contract

The `UIAwesome\Html\Interop\RenderInterface` reference was removed in favor of `UIAwesome\Html\Contracts\RenderableInterface`.
The contract is otherwise identical (`render(): string` plus `Stringable`).

### Method renames

- `loadDefaultDefinitions()` → `loadDefault()`.
- `Menu::widget()` / `Svg::widget()` → `Menu::tag()` / `Svg::tag()`.

### Tag references

Tag values switched from strings to `BackedEnum` cases from `ui-awesome/html-interop`.

Before:

```php
$component->tag('nav');
$component->prefixTag('span');
```

After:

```php
use UIAwesome\Html\Interop\{Block, Inline};

$component->containerTag(Block::NAV);
$component->prefixTag(Inline::SPAN);
```

### Concerns split into attributes and mixins

The `UIAwesome\Html\Core\Component\Concern\*` namespace is removed. Its contents were reorganized into two purpose-specific
namespaces:

- `UIAwesome\Html\Core\Component\Attribute\*` for HTML-attribute managers (`HasFirstItemClass`, `HasLinkCollection`,
  `HasIconCollection`, …).
- `UIAwesome\Html\Core\Component\Mixin\*` for behavior traits (`CanBeActivateItems`, `HasCurrentPath`, `HasToggle`,
  `HasTemplateLinkItem`, …).

Generic concerns (attributes, content, container, prefix/suffix, template) remain in `UIAwesome\Html\Mixin\*` (the
`html-mixin` package).

### Migrating from `ui-awesome/html-component-bootstrap5` and `html-component-flowbite`

Both packages are archived as of `0.2.0`. Their cookbooks now ship in the core under `src/Cookbook/{Bootstrap5,Flowbite}/`,
and the SVG assets they bundled moved to `ui-awesome/html-svg:^0.5` under `assets/icons/{Bootstrap5,Flowbite}/`.

Replace `composer require ui-awesome/html-component-bootstrap5` and `composer require ui-awesome/html-component-flowbite`
with a single `composer require "ui-awesome/html-core-component:^0.2"`.

Migrate call sites from the old wrapper-and-cookbook API to the new provider-based cookbook API.

Before (Bootstrap 5):

```php
use UIAwesome\Html\Component\Bootstrap5\Alert;

echo Alert::widget()->cookbook('default', 'danger')->content('Watch out!')->render();
```

After (Bootstrap 5):

```php
use UIAwesome\Html\Core\Component\Alert;
use UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Alert\Defaults;

echo Alert::tag()
    ->addThemeProvider('danger', Defaults::class)
    ->content('Watch out!')
    ->render();
```

Mapping rules:

- Drop the framework namespace (`UIAwesome\Html\Component\{Bootstrap5,Flowbite}`) in favor of `UIAwesome\Html\Core\Component`.
  The base components are the same regardless of framework.
- Replace `::widget()` with `::tag()`.
- Replace `cookbook(string $name, ?string $type)`:
  - For multi-variant cookbooks (Bootstrap 5 / Flowbite `Alert\Defaults`, `Alert\Dismissible`, Flowbite `Dropdown\*` and
    `Toggle\{Alert, Dropdown, SelectorLanguage}`):
    use `->addThemeProvider('<variant>', <ProviderClass>::class)` where `<variant>` is the type name (`danger`, `info`,
    `warning`, ...). The cookbook class implements `ThemeProviderInterface`.
  - For single-variant cookbooks (`Breadcrumb\Defaults`, Bootstrap 5
    `Dropdown\Defaults`, `NavBar\Defaults`, `Toggle\*` for Bootstrap 5):
    use `->addDefaultProvider(<ProviderClass>::class)`. The cookbook class implements `DefaultsProviderInterface`.

`HasRecipe::recipe(array $recipe)` and the trait itself were removed. The provider methods on `BaseTag` (already shipped
by `ui-awesome/html-core`) cover the same use cases with strong typing and zero runtime reflection in this package.

SVG migration:

- The 3 Bootstrap 5 SVG assets (`globe`, `moon`, `sun`) and the 11 Flowbite SVG assets are now referenced through
  `\UIAwesome\Html\Svg\Svg::iconPath('Bootstrap5:globe')` (returns the absolute path) or
  `\UIAwesome\Html\Svg\Svg::icon('Bootstrap5:globe')` (returns a preconfigured `Svg` instance).

Data-binding limitations:

- Flowbite toggles that previously auto-bound `data-dismiss-target`, `data-collapse-toggle`, or `data-dropdown-toggle`
  to the parent component ID (via the now-removed `HasData*` toggle traits) **no longer auto-bind**.
  Apply the binding explicitly on the toggle, for example:

  ```php
  use UIAwesome\Html\Core\Component\Cookbook\Flowbite\Toggle\Alert as AlertToggle;

  Toggle::tag()
      ->addThemeProvider('danger', AlertToggle::class)
      ->addDataAttribute('dismiss-target', '#' . $alertId);
  ```
