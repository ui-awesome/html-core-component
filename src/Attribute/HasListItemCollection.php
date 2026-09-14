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
     * Whether {@see listItemTag()} was called, so a parent component keeps the chosen tag.
     */
    private bool $ownListItemTag = false;

    /**
     * Returns the value of a single list-item attribute, or the default when missing.
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
     * @return mixed[] Current list-item attributes.
     */
    public function getListItemAttributes(): array
    {
        return $this->listItemAttributes;
    }

    /**
     * Returns whether the component chose its own list-item tag.
     *
     * A parent component applies its own list-item tag only to children that did not, so one menu can mix wrapped
     * entries with unwrapped ones.
     *
     * @return bool `true` when {@see listItemTag()} was called; `false` otherwise.
     */
    public function hasOwnListItemTag(): bool
    {
        return $this->ownListItemTag;
    }

    /**
     * Sets the list-item attributes (merged with previous values).
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
        $new->ownListItemTag = true;

        return $new;
    }
}
