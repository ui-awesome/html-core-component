<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use BackedEnum;
use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Helper\{AttributeBag, CSSClass};
use UIAwesome\Html\Interop\{Block, Inline};
use UnitEnum;

use function is_string;

/**
 * Provides an immutable API for wrapping a menu-item label in a configurable element.
 *
 * Stores the wrapper tag and its HTML attributes. Consumed by {@see \UIAwesome\Html\Core\Component\Item} to wrap the
 * label text in an optional element (for example a `<span>` or `<div>`). When {@see $labelTag} is `false`, the label
 * renders as plain text.
 */
trait HasLabelCollection
{
    /**
     * @var mixed[] HTML attributes applied to the label element.
     */
    protected array $labelAttributes = [];
    /**
     * Label wrapper tag enum, or `false` to render the label as plain text.
     */
    protected BackedEnum|false $labelTag = false;

    /**
     * Returns the value of a single label attribute, or the default when missing.
     *
     * Usage example:
     * ```php
     * $component->getLabelAttribute('title', 'Menu item');
     * $component->getLabelAttribute('hidden', null, 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name.
     * @param mixed $default Default value when the attribute is missing.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return mixed Attribute value or default.
     */
    public function getLabelAttribute(string|UnitEnum $key, mixed $default = null, string $prefix = ''): mixed
    {
        return AttributeBag::get($this->labelAttributes, $key, $default, $prefix);
    }

    /**
     * Returns the label attributes.
     *
     * Usage example:
     * ```php
     * $component->getLabelAttributes();
     * ```
     *
     * @return mixed[] Current label attributes.
     */
    public function getLabelAttributes(): array
    {
        return $this->labelAttributes;
    }

    /**
     * Sets the label attributes (merged with previous values).
     *
     * Usage example:
     * ```php
     * $component->labelAttributes(['title' => 'Menu item']);
     * ```
     *
     * @param mixed[] $values Attribute map merged into existing label attributes.
     *
     * @return static New instance with the updated `labelAttributes`.
     */
    public function labelAttributes(array $values): static
    {
        $new = clone $this;

        $new->labelAttributes = [...$this->labelAttributes, ...$values];

        return $new;
    }

    /**
     * Adds a CSS class to the label attributes.
     *
     * Usage example:
     * ```php
     * $component->labelClass('nav-label');
     * $component->labelClass(['nav-label', 'truncate']);
     * $component->labelClass(Theme::PRIMARY);
     * $component->labelClass('nav-label', true);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class (or class list) to add.
     * @param bool $override Whether to replace existing classes (`true`) or merge (`false`).
     *
     * @return static New instance with the updated label `class` attribute.
     */
    public function labelClass(array|string|Stringable|UnitEnum $value, bool $override = false): static
    {
        $new = clone $this;

        CSSClass::add($new->labelAttributes, $value, $override);

        return $new;
    }

    /**
     * Removes a single label attribute.
     *
     * Usage example:
     * ```php
     * $component->labelRemoveAttribute('title');
     * $component->labelRemoveAttribute('hidden', 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name to remove.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return static New instance without the specified label attribute.
     */
    public function labelRemoveAttribute(string|UnitEnum $key, string $prefix = ''): static
    {
        $new = clone $this;

        AttributeBag::remove($new->labelAttributes, $key, $prefix);

        return $new;
    }

    /**
     * Sets a single label attribute.
     *
     * Usage example:
     * ```php
     * $component->labelSetAttribute('title', 'Menu item');
     * $component->labelSetAttribute('hidden', 'true', 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name.
     * @param mixed $value Attribute value.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return static New instance with the updated label attribute.
     */
    public function labelSetAttribute(string|UnitEnum $key, mixed $value, string $prefix = ''): static
    {
        $new = clone $this;

        AttributeBag::set($new->labelAttributes, $key, $value, $prefix);

        return $new;
    }

    /**
     * Sets the label wrapper tag, or `false` to render the label as plain text.
     *
     * Usage example:
     * ```php
     * $component->labelTag();
     * $component->labelTag(\UIAwesome\Html\Interop\Inline::SPAN);
     * $component->labelTag('div');
     * $component->labelTag(false);
     * ```
     *
     * @param BackedEnum|false|string $value Inline/Block enum case (recommended) or its tag name, or `false` to render
     * the label as plain text.
     *
     * @throws InvalidArgumentException When the string value does not resolve to an {@see Inline} or {@see Block}
     * enum case.
     *
     * @return static New instance with the updated `labelTag`.
     */
    public function labelTag(BackedEnum|false|string $value = Inline::SPAN): static
    {
        if (is_string($value)) {
            $value = self::resolveLabelTag($value);
        }

        $new = clone $this;

        $new->labelTag = $value;

        return $new;
    }

    /**
     * Renders the label, wrapping it with the configured tag, or returns it as plain text when {@see $labelTag} is
     * `false` or the label is empty.
     *
     * @param string $label Label text to render.
     *
     * @return string Wrapped label when a tag is set and the label is not empty, or the plain label otherwise.
     */
    protected function renderLabel(string $label): string
    {
        if ($this->labelTag === false || $label === '') {
            return $label;
        }

        return Html::element($this->labelTag, $label, $this->labelAttributes);
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
    private static function resolveLabelTag(string $name): BackedEnum
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
            "Label tag '{$name}' must resolve to an `Inline` or `Block` enum case.",
        );
    }
}
