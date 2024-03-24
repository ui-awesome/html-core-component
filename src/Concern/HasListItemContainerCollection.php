<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

use UIAwesome\Html\Helper\CssClass;

use function array_merge;

/**
 * Is used by widgets that implement container for list items collection class.
 */
trait HasListItemContainerCollection
{
    protected array $listItemContainerAttributes = [];
    protected false|string $listItemContainerTag = false;

    /**
     * Get the `HTML` attributes for the container for list items.
     *
     * @return array Attribute values indexed by attribute names.
     */
    public function getListItemContainerAttributes(): array
    {
        return $this->listItemContainerAttributes;
    }

    /**
     * Set the `HTML` attributes for the container for list items.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static A new instance of the current class with the specified container attributes for list items.
     */
    public function listItemContainerAttributes(array $values = []): static
    {
        $new = clone $this;
        $new->listItemContainerAttributes = array_merge($new->listItemContainerAttributes, $values);

        return $new;
    }

    /**
     * Sets the `CSS` class that will be assigned to the container for list items.
     *
     * @param string $value The CSS class name.
     * @param bool $override If `true` the value will be overridden.
     *
     * @return static A new instance of the current class with the specified container class for list items.
     */
    public function listItemContainerClass(string $value, bool $override = false): static
    {
        $new = clone $this;
        CssClass::add($new->listItemContainerAttributes, $value, $override);

        return $new;
    }

    /**
     * Set the list item container tag name.
     *
     * @param false|string $value The tag name for the list item container element.
     * If `false` the list item container tag will be disabled.
     *
     * @throws \InvalidArgumentException If the list item container tag is an empty string.
     *
     * @return static A new instance of the current class with the specified list item container tag.
     * If `false` the list item container tag will be disabled.
     */
    public function listItemContainerTag(false|string $value = 'div'): static
    {
        if ($value === '') {
            throw new \InvalidArgumentException('The list item container tag must be a non-empty string.');
        }

        $new = clone $this;
        $new->listItemContainerTag = $value;

        return $new;
    }
}
