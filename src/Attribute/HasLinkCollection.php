<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use BackedEnum;
use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Helper\{AttributeBag, CSSClass};
use UnitEnum;

/**
 * Provides an immutable API for the link element of a menu item.
 *
 * Stores the link `<a>` (or arbitrary tag) attributes and the rendering tag name. Consumed by {@see \UIAwesome\Html\Core\Component\Item}
 * when rendering each menu entry.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/a
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasLinkCollection
{
    /**
     * @var mixed[] HTML attributes applied to the link element.
     */
    protected array $linkAttributes = [];
    /**
     * Link tag name, or `false` to skip the wrapper.
     */
    protected false|string $linkTag = '';

    /**
     * Returns the value of a single link attribute, or the default when missing.
     *
     * Usage example:
     * ```php
     * $component->getLinkAttribute('rel', 'noopener');
     * $component->getLinkAttribute('label', null, 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name.
     * @param mixed $default Default value when the attribute is missing.
     * @param string $prefix Optional prefix to ensure on the key (`aria-`, `data-`, `on`).
     *
     * @return mixed Attribute value or default.
     */
    public function getLinkAttribute(string|UnitEnum $key, mixed $default = null, string $prefix = ''): mixed
    {
        return AttributeBag::get($this->linkAttributes, $key, $default, $prefix);
    }

    /**
     * Returns the link attributes.
     *
     * Usage example:
     * ```php
     * $component->getLinkAttributes();
     * ```
     *
     * @return mixed[] Current link attributes.
     */
    public function getLinkAttributes(): array
    {
        return $this->linkAttributes;
    }

    /**
     * Sets the link attributes (merged with previous values).
     *
     * Usage example:
     * ```php
     * $component->linkAttributes(['rel' => 'noopener', 'target' => '_blank']);
     * ```
     *
     * @param mixed[] $values Attribute map merged into existing link attributes.
     *
     * @return static New instance with the updated `linkAttributes`.
     */
    public function linkAttributes(array $values): static
    {
        $new = clone $this;

        $new->linkAttributes = [...$new->linkAttributes, ...$values];

        return $new;
    }

    /**
     * Adds a CSS class to the link attributes.
     *
     * Usage example:
     * ```php
     * $component->linkClass('nav-link');
     * $component->linkClass(['nav-link', 'is-active']);
     * $component->linkClass(Theme::PRIMARY);
     * $component->linkClass('nav-link', true);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class (or class list) to add.
     * @param bool $override Whether to replace existing classes (`true`) or merge (`false`).
     *
     * @return static New instance with the updated link `class` attribute.
     */
    public function linkClass(array|string|Stringable|UnitEnum $value, bool $override = false): static
    {
        $new = clone $this;

        CSSClass::add($new->linkAttributes, $value, $override);

        return $new;
    }

    /**
     * Removes a single link attribute.
     *
     * Usage example:
     * ```php
     * $component->linkRemoveAttribute('rel');
     * $component->linkRemoveAttribute('label', 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name to remove.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return static New instance without the specified link attribute.
     */
    public function linkRemoveAttribute(string|UnitEnum $key, string $prefix = ''): static
    {
        $new = clone $this;

        AttributeBag::remove($new->linkAttributes, $key, $prefix);

        return $new;
    }

    /**
     * Sets a single link attribute.
     *
     * Usage example:
     * ```php
     * $component->linkSetAttribute('rel', 'noopener');
     * $component->linkSetAttribute('label', 'Open', 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name.
     * @param mixed $value Attribute value.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return static New instance with the updated link attribute.
     */
    public function linkSetAttribute(string|UnitEnum $key, mixed $value, string $prefix = ''): static
    {
        $new = clone $this;

        AttributeBag::set($new->linkAttributes, $key, $value, $prefix);

        return $new;
    }

    /**
     * Sets the link tag, or `false` to disable.
     *
     * Usage example:
     * ```php
     * $component->linkTag('a');
     * $component->linkTag('button');
     * $component->linkTag(\UIAwesome\Html\Interop\Inline::A);
     * $component->linkTag(false);
     * ```
     *
     * @param BackedEnum|false|string $value Tag name (typically `a`, `button`, or `span`), or `false` to skip the
     * wrapper.
     *
     * @throws InvalidArgumentException When the value is the empty string.
     *
     * @return static New instance with the updated `linkTag`.
     */
    public function linkTag(BackedEnum|false|string $value = 'a'): static
    {
        if ($value instanceof BackedEnum) {
            $value = (string) $value->value;
        }

        if ($value === '') {
            throw new InvalidArgumentException(
                'The link tag must be a non-empty string.',
            );
        }

        $new = clone $this;

        $new->linkTag = $value;

        return $new;
    }
}
