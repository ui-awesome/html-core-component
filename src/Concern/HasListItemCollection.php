<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

use UIAwesome\Html\{Helper\CssClass, Helper\Validator};

use function array_merge;

/**
 * Is used by widgets that implement list item collection.
 */
trait HasListItemCollection
{
    protected array $listItemAttributes = [];
    protected false|string $listItemTag = 'li';

    /**
     * Get the `HTML` attributes for tag `<li>`.
     *
     * @return array Attribute values indexed by attribute names.
     */
    public function getListItemAttributes(): array
    {
        return $this->listItemAttributes;
    }

    /**
     * Set the `HTML` attributes for tag `<li>`.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static A new instance of the current class with the specified attributes for tag `<li>`.
     */
    public function listItemAttributes(array $values): static
    {
        $new = clone $this;
        $new->listItemAttributes = array_merge($new->listItemAttributes, $values);

        return $new;
    }

    /**
     * Sets the `CSS` class that will be assigned to the list item.
     *
     * @param array|string $value The CSS class name.
     * @param bool $override If `true` the value will be overridden.
     *
     * @return static A new instance of the current class with the specified class for tag `<li>`.
     *
     * @psalm-param string|string[] $value The `CSS` class for the first link tag.
     */
    public function listItemClass(array|string $value, bool $override = false): static
    {
        $new = clone $this;
        CssClass::add($new->listItemAttributes, $value, $override);

        return $new;
    }

    /**
     * Set the list item tag name.
     *
     * @param false|string $value The list item tag name for the list item element.
     * If `false` the list item tag will be disabled.
     *
     * @throws \InvalidArgumentException If the list item tag is an empty string.
     *
     * @return static A new instance of the current class with the specified list item tag.
     * If `false` the list item tag will be disabled.
     */
    public function listItemTag(false|string $value = 'li'): static
    {
        if ($value !== false) {
            Validator::inList($value, 'Invalid value "%s". The list item tag must be one of: "li".', 'li');
        }

        $new = clone $this;
        $new->listItemTag = $value;

        return $new;
    }
}
