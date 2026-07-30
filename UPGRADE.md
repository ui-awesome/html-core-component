# Upgrade Guide

## 0.3.0

### Application-scoped configuration

`DefaultsProviderInterface`, `ThemeProviderInterface`, `BaseTag::addDefaultProvider()`, and
`BaseTag::addThemeProvider()` were removed. Use `Config`, `ThemeInterface`, `ComponentContext`, and
`BaseTag::config()` instead.

`config()` applies recipes immediately. Call it before fluent setters that must remain local overrides:

```php
echo Alert::tag()
    ->config($config, new ComponentContext('alert', variant: 'danger'))
    ->id('checkout-alert')
    ->content('Watch out!')
    ->render();
```

The bundled `Bootstrap5` and `Flowbite` cookbooks were also removed. Framework presets belong in standalone theme
packages or an application `ThemeInterface` implementation.

### Dropdown markup

`Dropdown` no longer renders an intermediate `<div>` between its container and list. The list is now a direct child,
and the component attributes move to the container.

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

`containerTag` defaults to `Block::DIV`. With `containerTag(false)`, no element remains to carry the component's
`id`, classes, or other attributes; move them to the enclosing element.

### Item link tag

An item emits the `href` derived from `link()` only when its link tag is `<a>`. Alternative active tags such as
`Menu::linkActiveTag('span')` no longer render invalid `href` attributes. Explicit values supplied through
`linkAttributes()` remain unchanged.

### Menu decoration classes

The `$override` argument was removed from:

- `firstItemClass()`
- `firstLinkClass()`
- `lastItemClass()`
- `lastLinkClass()`
- `linkActiveClass()`
- `linkDisabledClass()`
- `listItemActiveClass()`
- `listItemDisabledClass()`

Each value now replaces the base class list for its decorated item. Include every class that must remain:

```php
Menu::tag()
    ->linkClass('nav-link')
    ->linkActiveClass('nav-link active');
```

## 0.2.0

### Core component API

- Abstract components now extend `UIAwesome\Html\Core\Element\BaseBlock`.
- `loadDefaultDefinitions()` was renamed to `loadDefault()`.
- `Menu::widget()` and `Svg::widget()` were renamed to `Menu::tag()` and `Svg::tag()`.
- Cookbook keys no longer include parentheses: use `'role'`, not `'role()'`.
- Tag setters use backed enum cases such as `Block::NAV` and `Inline::SPAN` instead of string tag names.
- `UIAwesome\Html\Interop\RenderInterface` was replaced by
  `UIAwesome\Html\Contracts\RenderableInterface`.

The old `Concern` namespace was split:

- HTML attribute managers moved to `UIAwesome\Html\Core\Component\Attribute\*`.
- Component behavior traits moved to `UIAwesome\Html\Core\Component\Mixin\*`.
- Generic content, attribute, template, prefix, and suffix traits remain in `UIAwesome\Html\Mixin\*`.

### Framework component namespaces

The former Bootstrap 5 and Flowbite wrapper packages were consolidated into framework-neutral components under
`UIAwesome\Html\Core\Component`. Replace `::widget()` with `::tag()` and remove the framework name from component
imports.
