# Upgrade Guide

## 0.3.0

### Dependency line

The package now requires `ui-awesome/html-core:^0.7` and `ui-awesome/html-svg:^0.5`, together with the matching
`html-attribute:^0.7`, `html-contracts:^0.3`, `html-interop:^0.5`, and `html-mixin:^0.7` releases.

### Provider API removal

`ui-awesome/html-core:^0.7` removed the provider API. `DefaultsProviderInterface`, `ThemeProviderInterface`,
`BaseTag::addDefaultProvider()`, and `BaseTag::addThemeProvider()` no longer exist. Application-scoped configuration now
flows through `Config`, `ThemeInterface`, `ComponentContext`, `ConfigApplier`, and `BaseTag::config()`.

See the `ui-awesome/html-core` upgrade guide (`UPGRADE.md`, section `0.7.0`) for the full contract, including how
recipes are resolved and how `strict` mode reports unavailable calls.

Per-instance defaults that do not belong to a theme keep working through the factory arguments of `tag()`:

```php
use UIAwesome\Html\Core\Component\Alert;

echo Alert::tag(['class' => 'alert alert-danger'])->content('Watch out!')->render();
```

### Configuration precedence

`config()` applies the resolved recipes immediately, so any fluent call made afterwards stays a local override:

```php
use UIAwesome\Html\Core\Component\Alert;
use UIAwesome\Html\Core\Config\ComponentContext;

echo Alert::tag()
    ->config($config, new ComponentContext('alert', variant: 'danger'))
    ->id('checkout-alert')
    ->content('Watch out!')
    ->render();
```

The recipe supplies the derived defaults, `id()` wins because it runs after `config()`.

### Cookbook removal

The `UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\*` and `UIAwesome\Html\Core\Component\Cookbook\Flowbite\*`
classes were removed. Flowbite is discontinued; the Bootstrap 5 presets are being republished as standalone theme
packages. Until those ship, express the preset as a local `ThemeInterface` implementation.

Before:

```php
use UIAwesome\Html\Core\Component\Alert;
use UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Alert\Defaults;

echo Alert::tag()
    ->addThemeProvider('danger', Defaults::class)
    ->content('Watch out!')
    ->render();
```

After:

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

Mapping rules:

- A cookbook implementing `DefaultsProviderInterface` becomes a `Recipe` yielded for the matching `component`
  identifier.
- A cookbook implementing `ThemeProviderInterface` becomes a `Recipe` selected from `ComponentContext::$variant`; the
  variant name replaces the former `$theme` argument.
- The cookbook array keys map one to one to `Call` entries: `'class' => ['btn']` becomes `new Call('class', 'btn')`.
- Nested toggles keep working: pass the configured `Toggle` instance as a `Call` argument, for example
  `new Call('toggle', Toggle::tag()->class('btn-close'))`.

### Dropdown markup

`Dropdown` no longer emits the `<div>` that used to sit between the container and the list, so the list is now a direct
child of the container and `.dropdown > .dropdown-menu` style contracts match.

The component's own attributes moved from that removed wrapper to the container element. They win over the container
attributes on a key collision, and `class` values coming from both sides are kept.

Before:

```html
<div class="dropdown">
<button class="dropdown-toggle" type="button">Menu</button>
<div id="user-menu">
<ul class="dropdown-menu">…</ul>
</div>
</div>
```

After:

```html
<div class="dropdown" id="user-menu">
<button class="dropdown-toggle" type="button">Menu</button>
<ul class="dropdown-menu">…</ul>
</div>
```

Two consequences follow.

- `containerTag` now defaults to `Block::DIV` instead of `false`. The default markup is unchanged, since the removed
  wrapper was a `<div>` too, but `prefix()`, `suffix()`, and `toggle()` now render inside that element rather than as
  siblings next to it. Pass `containerTag(false)` to render the toggle, prefix, list, and suffix with no wrapper at all,
  which is what a `Dropdown` nested in a `Menu` wants: the surrounding `<li>` is the styling hook.
- With `containerTag(false)` there is no element left to carry the component's own attributes, so `id()`, `class()`, and
  `attributes()` are dropped on that path. Move them to the enclosing element.

Adjust any selector or test that targeted the removed wrapper, and any CSS that assumed the list was a grandchild of the
container.

### Item link tag

An item link renders `href` only when the link tag is `<a>`. Swapping the tag, as `Menu::linkActiveTag('span')` does for
the active item, previously produced `<span href="…">`, which is invalid. Attributes supplied through `linkAttributes()`
are untouched; only the `href` derived from `link()` is withheld.

### Menu decorations

The second `bool $override` argument was removed from `firstItemClass()`, `firstLinkClass()`, `lastItemClass()`,
`lastLinkClass()`, `linkActiveClass()`, `linkDisabledClass()`, `listItemActiveClass()`, and `listItemDisabledClass()`.

One rule now governs all eight: **a decoration is the definitive class list for its slot**. The value replaces whatever
`linkClass()` or `listItemClass()` had put on the decorated item; it never merges into it.

Drop the second argument, and name every class the decorated element must end up with.

Before:

```php
use UIAwesome\Html\Core\Component\Menu;

echo Menu::tag()
    ->linkClass('nav-link')
    ->linkActiveClass('active')
    ->items(...)
    ->render();
```

After:

```php
use UIAwesome\Html\Core\Component\Menu;

echo Menu::tag()
    ->linkClass('nav-link')
    ->linkActiveClass('nav-link active')
    ->items(...)
    ->render();
```

Replace is the universal mode because merge is expressible under it and the reverse is not: to keep the base classes,
list them in the decoration value, as `'nav-link active'` does above. Under a merge mode there is no way to *drop* a
base class, which is what a breadcrumb whose active crumb must lose its link styling needs.

Audit every call to the eight setters:

- A decoration that relied on the merge, such as `linkActiveClass('active')` next to `linkClass('nav-link')`, now needs
  the full list: `linkActiveClass('nav-link active')`.
- A decoration that already replaced needs no change.
- Any second argument still present is dead. PHP ignores extra arguments to a user-defined method silently, so these do
  not raise an error and must be found by inspection.

The immediate setters keep their flag: `brandClass()`, `brandLinkClass()`, `containerMenuClass()`, `iconClass()`,
`labelClass()`, `linkClass()`, `linkContainerClass()`, `listClass()`, `listItemClass()`, and `toggleClass()` are
unchanged.

## 0.2.0

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
