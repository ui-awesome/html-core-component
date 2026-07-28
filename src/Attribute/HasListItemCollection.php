<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use BackedEnum;
use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Helper\{AttributeBag, CSSClass, Validator};
use UIAwesome\Html\Interop\Lists;
use UnitEnum;

/**
 * Provides an immutable API for the `<li>` list-item element of a menu.
 *
 * Stores the list-item attributes and the chosen tag name. Consumed by {@see \UIAwesome\Html\Core\Component\Item} when
 * rendering each entry.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/li
 */
trait HasListItemCollection
{
    /**
     * @var mixed[] HTML attributes applied to the list-item element.
     */
    protected array $listItemAttributes = [];
    /**
     * List-item tag name, or `false` to skip the wrapper.
     */
    protected false|string|BackedEnum $listItemTag = 'li';

    /**
     * Returns the value of a single list-item attribute, or the default when missing.
     *
     * Usage example:
     * ```php
     * $component->getListItemAttribute('role', 'menuitem');
     * $component->getListItemAttribute('label', null, 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name.
     * @param mixed $default Default value when the attribute is missing.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return mixed Attribute value or default.
     */
    public function getListItemAttribute(string|UnitEnum $key, mixed $default = null, string $prefix = ''): mixed
    {
        return AttributeBag::get($this->listItemAttributes, $key, $default, $prefix);
    }

    /**
     * Returns the list-item attributes.
     *
     * Usage example:
     * ```php
     * $component->getListItemAttributes();
     * ```
     *
     * @return mixed[] Current list-item attributes.
     */
    public function getListItemAttributes(): array
    {
        return $this->listItemAttributes;
    }

    /**
     * Sets the list-item attributes (merged with previous values).
     *
     * Usage example:
     * ```php
     * $component->listItemAttributes(['role' => 'menuitem']);
     * ```
     *
     * @param mixed[] $values Attribute map merged into existing list-item attributes.
     *
     * @return static New instance with the updated `listItemAttributes`.
     */
    public function listItemAttributes(array $values): static
    {
        $new = clone $this;
        $new->listItemAttributes = [...$new->listItemAttributes, ...$values];

        return $new;
    }

    /**
     * Adds a CSS class to the list-item attributes.
     *
     * Usage example:
     * ```php
     * $component->listItemClass('menu-item');
     * $component->listItemClass(['menu-item', 'is-active']);
     * $component->listItemClass(Theme::PRIMARY);
     * $component->listItemClass('menu-item', true);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class (or class list) to add.
     * @param bool $override Whether to replace existing classes (`true`) or merge (`false`).
     *
     * @return static New instance with the updated list-item `class` attribute.
     */
    public function listItemClass(array|string|Stringable|UnitEnum $value, bool $override = false): static
    {
        $new = clone $this;
        CSSClass::add($new->listItemAttributes, $value, $override);

        return $new;
    }

    /**
     * Removes a single list-item attribute.
     *
     * Usage example:
     * ```php
     * $component->listItemRemoveAttribute('role');
     * $component->listItemRemoveAttribute('label', 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name to remove.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return static New instance without the specified list-item attribute.
     */
    public function listItemRemoveAttribute(string|UnitEnum $key, string $prefix = ''): static
    {
        $new = clone $this;
        AttributeBag::remove($new->listItemAttributes, $key, $prefix);

        return $new;
    }

    /**
     * Sets a single list-item attribute.
     *
     * Usage example:
     * ```php
     * $component->listItemSetAttribute('role', 'menuitem');
     * $component->listItemSetAttribute('current', 'page', 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name.
     * @param mixed $value Attribute value.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return static New instance with the updated list-item attribute.
     */
    public function listItemSetAttribute(string|UnitEnum $key, mixed $value, string $prefix = ''): static
    {
        $new = clone $this;
        AttributeBag::set($new->listItemAttributes, $key, $value, $prefix);

        return $new;
    }

    /**
     * Sets the list-item tag, or `false` to disable.
     *
     * Usage example:
     * ```php
     * $component->listItemTag('li');
     * $component->listItemTag(\UIAwesome\Html\Interop\Lists::LI);
     * $component->listItemTag(false);
     * ```
     *
     * @param BackedEnum|false|string $value Currently must be `li`, or `false` to skip the wrapper.
     *
     * @throws InvalidArgumentException When the value is not `li` or `false`.
     *
     * @return static New instance with the updated `listItemTag`.
     */
    public function listItemTag(false|string|BackedEnum $value = 'li'): static
    {
        if ($value !== false) {
            Validator::oneOf($value, [Lists::LI], 'listItemTag');
        }

        $new = clone $this;
        $new->listItemTag = $value;

        return $new;
    }
}
