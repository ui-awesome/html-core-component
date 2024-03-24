<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Interop;

use UIAwesome\Html\Interop\RenderInterface;

/**
 * Provide methods for handling Item elements in a list.
 */
interface ItemInterface extends RenderInterface
{
    /**
     * Enable or disable the activation of menu items when their route is the currently requested one.
     *
     * @param bool $value Whether to activate menu items when their route is the currently requested one.
     *
     * @return static A new instance of the current class with the specified activated items value.
     */
    public function activateItems(bool $value = true): static;

    /**
     * Set the active state.
     *
     * @param bool $value The active state.
     *
     * @return static A new instance of the current class with the specified active state.
     */
    public function active(bool $value = true): static;

    /**
     * Set the current path.
     *
     * @param string $value The current path.
     *
     * @return static A new instance of the current class with the specified current path.
     */
    public function currentPath(string $value): static;

    /**
     * Checks whether a menu item is active.
     *
     * @return bool `true` if the menu item is active, `false` otherwise.
     */
    public function isActive(): bool;

    /**
     * @return bool Whether the menu item is disable.
     */
    public function isDisable(): bool;

    /**
     * Checks whether the link container tag is enabled.
     *
     * @return bool `true` if the link container tag is enabled, `false` otherwise.
     */
    public function isLinkContainerTag(): bool;

    /**
     * Set the `HTML` attributes for the link tag.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static A new instance of the current class with the specified link attributes.
     */
    public function linkAttributes(array $values): static;

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
    public function linkClass(array|string $value, bool $override = false): static;

    /**
     * Set the `HTML` attributes for the link container tag.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static A new instance of the current class with the specified link container attributes.
     */
    public function linkContainerAttributes(array $values): static;

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
    public function linkContainerTag(false|string $value = 'div'): static;

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
    public function linkTag(false|string $value = 'a'): static;

    /**
     * Set the `HTML` attributes for tag `<li>`.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static A new instance of the current class with the specified attributes for tag `<li>`.
     */
    public function listItemAttributes(array $values): static;

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
    public function listItemClass(array|string $value, bool $override = false): static;

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
    public function listItemTag(false|string $value = 'li'): static;

    /**
     * Set the separator.
     *
     * @param string $value The separator of the widget.
     *
     * @return static A new instance of the current class with the specified separator.
     */
    public function separator(string $value): self;

    /**
     * Set the template for the menu link item.
     *
     * @param string $value The template for the menu link item.
     *
     * @return static A new instance of the current class with the specified template for the menu link item.
     */
    public function templateLinkItem(string $value): self;
}
