<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use BackedEnum;
use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Helper\{AttributeBag, CSSClass};
use UIAwesome\Html\Interop\{Block, Inline};
use UnitEnum;

use function is_string;

/**
 * Provides an immutable API for the wrapper element around a menu-item link.
 *
 * Stores the wrapper tag and its HTML attributes. Consumed by {@see \UIAwesome\Html\Core\Component\Item} to render an
 * optional wrapping element around the link (for example a `<div>` or `<span>`).
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasLinkContainerCollection
{
    /**
     * @var mixed[] HTML attributes applied to the link container element.
     */
    protected array $linkContainerAttributes = [];
    /**
     * Link container tag enum, or `false` to skip the wrapper.
     */
    protected BackedEnum|false $linkContainerTag = Block::DIV;

    /**
     * Returns the value of a single link container attribute, or the default when missing.
     *
     * Usage example:
     * ```php
     * $component->getLinkContainerAttribute('role', 'group');
     * $component->getLinkContainerAttribute('label', null, 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name.
     * @param mixed $default Default value when the attribute is missing.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return mixed Attribute value or default.
     */
    public function getLinkContainerAttribute(string|UnitEnum $key, mixed $default = null, string $prefix = ''): mixed
    {
        return AttributeBag::get($this->linkContainerAttributes, $key, $default, $prefix);
    }

    /**
     * Returns the link container attributes.
     *
     * Usage example:
     * ```php
     * $component->getLinkContainerAttributes();
     * ```
     *
     * @return mixed[] Current link container attributes.
     */
    public function getLinkContainerAttributes(): array
    {
        return $this->linkContainerAttributes;
    }

    /**
     * Returns `true` when the link container wrapper is enabled.
     *
     * Usage example:
     * ```php
     * if ($component->isLinkContainer()) {
     *     // wrap the link in $component->linkContainerTag.
     * }
     * ```
     */
    public function isLinkContainer(): bool
    {
        return $this->linkContainerTag !== false;
    }

    /**
     * Sets the link container attributes (merged with previous values).
     *
     * Usage example:
     * ```php
     * $component->linkContainerAttributes(['role' => 'group']);
     * ```
     *
     * @param mixed[] $values Attribute map merged into existing container attributes.
     *
     * @return static New instance with the updated `linkContainerAttributes`.
     */
    public function linkContainerAttributes(array $values): static
    {
        $new = clone $this;

        $new->linkContainerAttributes = [...$this->linkContainerAttributes, ...$values];

        return $new;
    }

    /**
     * Adds a CSS class to the link container attributes.
     *
     * Usage example:
     * ```php
     * $component->linkContainerClass('wrapper');
     * $component->linkContainerClass(Theme::PRIMARY);
     * $component->linkContainerClass('wrapper', true);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class (or class list) to add.
     * @param bool $override Whether to replace existing classes (`true`) or merge (`false`).
     *
     * @return static New instance with the updated container `class` attribute.
     */
    public function linkContainerClass(array|string|Stringable|UnitEnum $value, bool $override = false): static
    {
        $new = clone $this;

        CSSClass::add($new->linkContainerAttributes, $value, $override);

        return $new;
    }

    /**
     * Removes a single link container attribute.
     *
     * Usage example:
     * ```php
     * $component->linkContainerRemoveAttribute('role');
     * $component->linkContainerRemoveAttribute('label', 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name to remove.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return static New instance without the specified link container attribute.
     */
    public function linkContainerRemoveAttribute(string|UnitEnum $key, string $prefix = ''): static
    {
        $new = clone $this;

        AttributeBag::remove($new->linkContainerAttributes, $key, $prefix);

        return $new;
    }

    /**
     * Sets a single link container attribute.
     *
     * Usage example:
     * ```php
     * $component->linkContainerSetAttribute('role', 'group');
     * $component->linkContainerSetAttribute('label', 'Menu', 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name.
     * @param mixed $value Attribute value.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return static New instance with the updated link container attribute.
     */
    public function linkContainerSetAttribute(string|UnitEnum $key, mixed $value, string $prefix = ''): static
    {
        $new = clone $this;

        AttributeBag::set($new->linkContainerAttributes, $key, $value, $prefix);

        return $new;
    }

    /**
     * Sets the link container tag, or `false` to disable.
     *
     * Usage example:
     * ```php
     * $component->linkContainerTag('div');
     * $component->linkContainerTag(\UIAwesome\Html\Interop\Block::DIV);
     * $component->linkContainerTag(false);
     * ```
     *
     * @param BackedEnum|false|string $value Inline/Block enum case (recommended) or its tag name, or `false` to skip
     * the wrapper.
     *
     * @throws InvalidArgumentException When the string value does not resolve to an {@see Inline} or {@see Block}
     * enum case.
     *
     * @return static New instance with the updated `linkContainerTag`.
     */
    public function linkContainerTag(BackedEnum|false|string $value = Block::DIV): static
    {
        if (is_string($value)) {
            $value = self::resolveLinkContainerTag($value);
        }

        $new = clone $this;

        $new->linkContainerTag = $value;

        return $new;
    }

    /**
     * Resolves a string tag name against {@see Inline} and {@see Block} enums in order, throwing when neither
     * recognizes the value.
     *
     * @param string $name Tag name to resolve.
     *
     * @throws InvalidArgumentException When the value does not match any {@see Inline} or {@see Block} case.
     *
     * @return BackedEnum Matching enum case.
     */
    private static function resolveLinkContainerTag(string $name): BackedEnum
    {
        $tag = Inline::tryFrom($name);

        if ($tag !== null) {
            return $tag;
        }

        $tag = Block::tryFrom($name);

        if ($tag !== null) {
            return $tag;
        }

        throw new InvalidArgumentException(
            "Link container tag '{$name}' must resolve to an `Inline` or `Block` enum case.",
        );
    }
}
