<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

use UIAwesome\Html\{Helper\CssClass, Helper\Validator};

use function array_merge;

/**
 * Is used by widgets that implement list collection.
 */
trait HasListCollection
{
    protected array $listAttributes = [];
    protected string|false $listType = 'ul';

    /**
     * @return array The `HTML` attributes for the `<ul>` or `<ol>` tag.
     */
    public function getListAttributes(): array
    {
        return $this->listAttributes;
    }

    /**
     * Set the `HTML` attributes for the `<ul>` or `<ol>` tag.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static A new instance of the current class with the specified `<ul>` or `<ol>` attributes.
     */
    public function listAttributes(array $values): static
    {
        $new = clone $this;
        $new->listAttributes = array_merge($this->listAttributes, $values);

        return $new;
    }

    /**
     * Sets the `CSS` class that will be assigned to the `<ul>` or `<ol>` tag.
     *
     * @param string $value The CSS class name.
     * @param bool $override If `true` the value will be overridden.
     *
     * @return static A new instance of the current class with the specified `<ul>` or `<ol>` class.
     */
    public function listClass(string $value, bool $override = false): static
    {
        $new = clone $this;
        CssClass::add($new->listAttributes, $value, $override);

        return $new;
    }

    /**
     * Set list type for tag `<ul>` or `<ol>`.
     *
     * @param false|string $value The list type. `ul` for an unordered list, `ol` for an ordered list, `false` to
     * disable.
     *
     * @throws \InvalidArgumentException If the value is not one of: "ul", "ol".
     *
     * @return static A new instance of the current class with the specified list type for tag `<ul>` or `<ol>`.
     */
    public function listType(string|false $value): static
    {
        if ($value !== false) {
            Validator::inList(
                $value,
                'Invalid value "%s" for the list type method. Allowed values are: "%s".',
                'ol',
                'ul',
            );
        }

        $new = clone $this;
        $new->listType = $value;

        return $new;
    }
}
