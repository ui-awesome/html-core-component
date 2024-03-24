<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

use UIAwesome\Html\Helper\CssClass;

use function array_merge;

/**
 * Is used by widgets that implement the link container collection methods.
 */
trait HasLinkContainerCollection
{
    protected array $linkContainerAttributes = [];
    protected false|string $linkContainerTag = 'div';

    /**
     * Checks whether the link container tag is enabled.
     *
     * @return bool `true` if the link container tag is enabled, `false` otherwise.
     */
    public function isLinkContainerTag(): bool
    {
        return $this->linkContainerTag !== false;
    }

    /**
     * Get the `HTML` attributes for the link container tag.
     *
     * @return array The link container attributes indexed by attribute names.
     */
    public function getLinkContainerAttributes(): array
    {
        return $this->linkContainerAttributes;
    }

    /**
     * Set the `HTML` attributes for the link container tag.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static A new instance of the current class with the specified link container attributes.
     */
    public function linkContainerAttributes(array $values): static
    {
        $new = clone $this;
        $new->linkContainerAttributes = array_merge($this->linkContainerAttributes, $values);

        return $new;
    }

    /**
     * Sets the `CSS` class that will be assigned to the link container.
     *
     * @param string $value The `CSS` class for the link container tag.
     * @param bool $override If `true` the value will be overridden.
     *
     * @return static A new instance of the current class with the specified link container class.
     */
    public function linkContainerClass(string $value, bool $override = false): static
    {
        $new = clone $this;
        CssClass::add($new->linkContainerAttributes, $value, $override);

        return $new;
    }

    /**
     * Set the tag name for the link container element.
     *
     * @param false|string $value The tag name for the link container element.
     * If `false` the link container will be disabled.
     *
     * @throws \InvalidArgumentException If the tag name is not a string or `false`.
     *
     * @return static A new instance of the current class with the specified link container tag.
     * If `false` the link container will be disabled.
     */
    public function linkContainerTag(false|string $value = 'div'): static
    {
        if ($value === '') {
            throw new \InvalidArgumentException('The link container tag must be a non-empty string.');
        }

        $new = clone $this;
        $new->linkContainerTag = $value;

        return $new;
    }
}
