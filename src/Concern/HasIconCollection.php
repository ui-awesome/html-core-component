<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

use UIAwesome\Html\{Helper\Sanitize, Interop\RenderInterface};
use UIAwesome\Html\Helper\CssClass;
use UIAwesome\Html\Helper\Validator;

use function array_merge;

/**
 * Is used by widgets that implement the icon collection class.
 */
trait HasIconCollection
{
    protected array $iconAttributes = [];
    protected string $iconContent = '';
    protected string $iconFilePath = '';
    protected false|string $iconTag = false;

    /**
     * Get the `HTML` attributes for the icon.
     *
     * @return array The icon attributes indexed by attribute names.
     */
    public function getIconAttributes(): array
    {
        return $this->iconAttributes;
    }

    /**
     * Set the `HTML` attributes for the icon.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static A new instance of the current class with the specified icon attributes.
     */
    public function iconAttributes(array $values): static
    {
        $new = clone $this;
        $new->iconAttributes = array_merge($new->iconAttributes, $values);

        return $new;
    }

    /**
     * Sets the `CSS` class that will be assigned to the icon.
     *
     * @param string $value The CSS class name.
     * @param bool $override If `true` the value will be overridden.
     *
     * @return static A new instance of the current class with the specified icon class.
     */
    public function iconClass(string $value, bool $override = false): static
    {
        $new = clone $this;
        CssClass::add($new->iconAttributes, $value, $override);

        return $new;
    }

    /**
     * Set the `HTML` content for the icon.
     *
     * @param RenderInterface|string ...$values The `HTML` icon content.
     *
     * @return static A new instance of the current class with the specified icon content.
     */
    public function iconContent(string|RenderInterface ...$values): static
    {
        $new = clone $this;
        $new->iconContent = Sanitize::html(...$values);

        return $new;
    }

    /**
     * Set the icon file path.
     *
     * @param string $value The icon file path.
     *
     * @return static A new instance of the current class with the specified icon file path.
     */
    public function iconFilePath(string $value): static
    {
        $new = clone $this;
        $new->iconFilePath = $value;

        return $new;
    }

    /**
     * Set the icon tag name.
     *
     * @param false|string $value The tag name for the icon element.
     * If `false` the icon tag will be disabled.
     *
     * @throws \InvalidArgumentException If the icon tag is an empty string.
     *
     * @return static A new instance of the current class with the specified icon tag.
     * If `false` the icon tag will be disabled.
     */
    public function iconTag(false|string $value = 'i'): static
    {
        if ($value !== false) {
            Validator::inList(
                $value,
                'Invalid value "%s" for the icon tag method. Allowed values are: "i", "span", "svg".',
                'i',
                'span',
                'svg',
            );
        }

        $new = clone $this;
        $new->iconTag = $value;

        return $new;
    }
}
