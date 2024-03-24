<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

use UIAwesome\Html\Helper\CssClass;

use function array_merge;

/**
 * Is used by widgets that implement list collection class.
 */
trait HasListContainerCollection
{
    protected array $listContainerAttributes = [];
    protected false|string $listContainerTag = false;

    /**
     * @return array The `HTML` attributes for the container for tag `<ul>` or `<ol>`.
     */
    public function getListContainerAttributes(): array
    {
        return $this->listContainerAttributes;
    }

    /**
     * Set the `HTML` attributes for the container for tag `<ul>` or `<ol>`.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static A new instance of the current class with the specified container attributes for tag `<ul>` or `<ol>`.
     */
    public function listContainerAttributes(array $values): static
    {
        $new = clone $this;
        $new->listContainerAttributes = array_merge($new->listContainerAttributes, $values);

        return $new;
    }

    /**
     * Sets the `CSS` class that will be assigned to the container for tag `<ul>` or `<ol>`.
     *
     * @param string $value The CSS class name.
     * @param bool $override If `true` the value will be overridden.
     *
     * @return static A new instance of the current class with the specified container class for tag `<ul>` or `<ol>`.
     */
    public function listContainerClass(string $value, bool $override = false): static
    {
        $new = clone $this;
        CssClass::add($new->listContainerAttributes, $value, $override);

        return $new;
    }

    /**
     * Set the list container tag name.
     *
     * @param false|string $value The tag name for the list container element.
     * If `false` the list container tag will be disabled.
     *
     * @throws \InvalidArgumentException If the list container tag is an empty string.
     *
     * @return static A new instance of the current class with the specified list container tag.
     * If `false` the list container tag will be disabled.
     */
    public function listContainerTag(false|string $value = 'div'): static
    {
        if ($value === '') {
            throw new \InvalidArgumentException('The list container tag must be a non-empty string.');
        }

        $new = clone $this;
        $new->listContainerTag = $value;

        return $new;
    }
}
