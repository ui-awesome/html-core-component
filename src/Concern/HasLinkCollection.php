<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

use UIAwesome\Html\Helper\CssClass;

use function array_merge;

/**
 * Is used by widgets that implement the link collection methods.
 */
trait HasLinkCollection
{
    protected array $linkAttributes = [];
    protected false|string $linkTag = '';

    /**
     * @return array The `HTML` attributes of the href of the menu item.
     */
    public function getLinkAttributes(): array
    {
        return $this->linkAttributes;
    }

    /**
     * Set the `HTML` attributes for the link tag.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static A new instance of the current class with the specified link attributes.
     */
    public function linkAttributes(array $values): static
    {
        $new = clone $this;
        $new->linkAttributes = array_merge($new->linkAttributes, $values);

        return $new;
    }

    /**
     * Sets the `CSS` class that will be assigned to the link.
     *
     * @param array|string $value The `CSS` class for the link tag.
     * @param bool $override If `true` the value will be overridden.
     *
     * @return static A new instance of the current class with the specified link class.
     *
     * @psalm-param string|string[] $value The `CSS` class for the first link tag.
     */
    public function linkClass(array|string $value, bool $override = false): static
    {
        $new = clone $this;
        CssClass::add($new->linkAttributes, $value, $override);

        return $new;
    }

    /**
     * Set the link tag name.
     *
     * @param false|string $value The tag name for the link element.
     * If `false` the link tag will be disabled.
     *
     * @throws \InvalidArgumentException If the link tag is an empty string.
     *
     * @return static A new instance of the current class with the specified link tag.
     * If `false` the link tag will be disabled.
     */
    public function linkTag(false|string $value = 'a'): static
    {
        if ($value === '') {
            throw new \InvalidArgumentException('The link tag must be a non-empty string.');
        }

        $new = clone $this;
        $new->linkTag = $value;

        return $new;
    }
}
