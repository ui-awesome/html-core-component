<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

use UIAwesome\Html\{Helper\CssClass, Helper\Sanitize, Interop\RenderInterface};

use function array_merge;

/**
 * Is used by widgets that implement the toggle collection method.
 */
trait HasToggleCollection
{
    protected array $toggleAttributes = [];
    protected string $toggleContent = '';
    protected false|string $toggleTag = 'span';

    /**
     * @return array The `HTML` attributes for the toggle.
     */
    public function getToggleAttributes(): array
    {
        return $this->toggleAttributes;
    }

    /**
     * Set the `HTML` attributes for the toggle.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static A new instance of the current class with the specified toggle attributes.
     */
    public function toggleAttributes(array $values): static
    {
        $new = clone $this;
        $new->toggleAttributes = array_merge($new->toggleAttributes, $values);

        return $new;
    }

    /**
     * Sets the `CSS` class that will be assigned to the toggle.
     *
     * @param array|string $value The CSS class name.
     * @param bool $override If `true` the value will be overridden.
     *
     * @return static A new instance of the current class with the specified class for the toggle.
     *
     * @psalm-param string|string[] $value The `CSS` class for the toggle.
     */
    public function toggleClass(array|string $value, bool $override = false): static
    {
        $new = clone $this;
        CssClass::add($new->toggleAttributes, $value, $override);

        return $new;
    }

    /**
     * Set the `HTML` content for the toggle.
     *
     * @param RenderInterface|string ...$values The `HTML` toggle content element.
     *
     * @return static A new instance of the current class with the specified toggle content.
     */
    public function toggleContent(string|RenderInterface ...$values): static
    {
        $new = clone $this;
        $new->toggleContent = Sanitize::html(...$values);

        return $new;
    }

    /**
     * Set the toggle tag name.
     *
     * @param false|string $value The tag name for the toggle element.
     * If `false` the toggle tag will be disabled.
     *
     * @throws \InvalidArgumentException If the tag name is an empty string.
     *
     * @return static A new instance of the current class with the specified toggle tag name.
     * If `false` the toggle tag will be disabled.
     */
    public function toggleTag(false|string $value = 'div'): static
    {
        if ($value === '') {
            throw new \InvalidArgumentException('The toggle tag must be a non-empty string.');
        }

        $new = clone $this;
        $new->toggleTag = $value;

        return $new;
    }
}
