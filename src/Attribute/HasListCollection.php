<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use BackedEnum;
use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Helper\{AttributeBag, CSSClass, Validator};
use UnitEnum;

/**
 * Provides an immutable API for the `<ul>`/`<ol>` list element of a menu.
 *
 * Stores the list attributes and the chosen list type (`ul` or `ol`). Consumed by {@see \UIAwesome\Html\Core\Component\Menu}
 * when rendering the list wrapper around the items.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/ul
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/ol
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasListCollection
{
    /**
     * @var mixed[] HTML attributes applied to the list element.
     */
    protected array $listAttributes = [];
    /**
     * List type (`ul` or `ol`), or `false` to skip the list wrapper.
     */
    protected BackedEnum|false|string $listType = 'ul';

    /**
     * Returns the value of a single list attribute, or the default when missing.
     *
     * Usage example:
     * ```php
     * $component->getListAttribute('role', 'menu');
     * $component->getListAttribute('label', null, 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name.
     * @param mixed $default Default value when the attribute is missing.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return mixed Attribute value or default.
     */
    public function getListAttribute(string|UnitEnum $key, mixed $default = null, string $prefix = ''): mixed
    {
        return AttributeBag::get($this->listAttributes, $key, $default, $prefix);
    }

    /**
     * Returns the list element attributes.
     *
     * Usage example:
     * ```php
     * $component->getListAttributes();
     * ```
     *
     * @return mixed[] Current list element attributes.
     */
    public function getListAttributes(): array
    {
        return $this->listAttributes;
    }

    /**
     * Sets the list element attributes (merged with previous values).
     *
     * Usage example:
     * ```php
     * $component->listAttributes(['role' => 'menu']);
     * ```
     *
     * @param mixed[] $values Attribute map merged into existing list attributes.
     *
     * @return static New instance with the updated `listAttributes`.
     */
    public function listAttributes(array $values): static
    {
        $new = clone $this;

        $new->listAttributes = [...$this->listAttributes, ...$values];

        return $new;
    }

    /**
     * Adds a CSS class to the list element attributes.
     *
     * Usage example:
     * ```php
     * $component->listClass('menu');
     * $component->listClass(Theme::PRIMARY);
     * $component->listClass('menu', true);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class (or class list) to add.
     * @param bool $override Whether to replace existing classes (`true`) or merge (`false`).
     *
     * @return static New instance with the updated list `class` attribute.
     */
    public function listClass(array|string|Stringable|UnitEnum $value, bool $override = false): static
    {
        $new = clone $this;

        CSSClass::add($new->listAttributes, $value, $override);

        return $new;
    }

    /**
     * Removes a single list attribute.
     *
     * Usage example:
     * ```php
     * $component->listRemoveAttribute('role');
     * $component->listRemoveAttribute('label', 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name to remove.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return static New instance without the specified list attribute.
     */
    public function listRemoveAttribute(string|UnitEnum $key, string $prefix = ''): static
    {
        $new = clone $this;

        AttributeBag::remove($new->listAttributes, $key, $prefix);

        return $new;
    }

    /**
     * Sets a single list attribute.
     *
     * Usage example:
     * ```php
     * $component->listSetAttribute('role', 'menu');
     * $component->listSetAttribute('label', 'Main', 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name.
     * @param mixed $value Attribute value.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return static New instance with the updated list attribute.
     */
    public function listSetAttribute(string|UnitEnum $key, mixed $value, string $prefix = ''): static
    {
        $new = clone $this;

        AttributeBag::set($new->listAttributes, $key, $value, $prefix);

        return $new;
    }

    /**
     * Sets the list type (`ul` or `ol`), or `false` to disable.
     *
     * Usage example:
     * ```php
     * $component->listType('ul');
     * $component->listType(\UIAwesome\Html\Interop\Lists::OL);
     * $component->listType(false);
     * ```
     *
     * @param BackedEnum|false|string $value `ul`, `ol`, or `false` to skip the list wrapper.
     *
     * @throws InvalidArgumentException When the value is neither `ul`, `ol`, nor `false`.
     *
     * @return static New instance with the updated `listType`.
     */
    public function listType(string|false|BackedEnum $value): static
    {
        if ($value !== false) {
            Validator::oneOf($value, ['ol', 'ul'], 'listType');
        }

        $new = clone $this;

        $new->listType = $value;

        return $new;
    }
}
