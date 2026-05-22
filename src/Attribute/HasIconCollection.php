<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use BackedEnum;
use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Contracts\RenderableInterface;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Helper\{AttributeBag, CSSClass, Validator};
use UIAwesome\Html\Interop\Inline;
use UIAwesome\Html\Svg\Svg;
use UnitEnum;

use function implode;

/**
 * Provides an immutable API for the icon decoration of a component.
 *
 * Supports `<i>`, `<span>`, and `<svg>` icon tags. SVG icons can carry inline content, attributes, or be loaded from
 * disk via {@see Svg::filePath()}.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/i
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/svg
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasIconCollection
{
    /**
     * @var mixed[] HTML attributes applied to the icon element.
     */
    protected array $iconAttributes = [];
    /**
     * Inline HTML content rendered inside the icon element.
     */
    protected string $iconContent = '';
    /**
     * Filesystem path of an SVG file injected when {@see $iconTag} is `'svg'`.
     */
    protected string $iconFilePath = '';
    /**
     * Icon tag name (`i`, `span`, `svg`), or `false` to disable the icon.
     */
    protected false|string $iconTag = false;

    /**
     * Returns the value of a single icon attribute, or the default when missing.
     *
     * Usage example:
     * ```php
     * $component->getIconAttribute('aria-hidden', 'false');
     * $component->getIconAttribute('hidden', null, 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name.
     * @param mixed $default Default value when the attribute is missing.
     * @param string $prefix Optional prefix to ensure on the key (`aria-`, `data-`, `on`).
     *
     * @return mixed Attribute value or default.
     */
    public function getIconAttribute(string|UnitEnum $key, mixed $default = null, string $prefix = ''): mixed
    {
        return AttributeBag::get($this->iconAttributes, $key, $default, $prefix);
    }

    /**
     * Returns the icon attributes.
     *
     * Usage example:
     * ```php
     * $component->getIconAttributes();
     * ```
     *
     * @return mixed[] Current icon attributes.
     */
    public function getIconAttributes(): array
    {
        return $this->iconAttributes;
    }

    /**
     * Sets the icon attributes (merged with previous values).
     *
     * Usage example:
     * ```php
     * $component->iconAttributes(['aria-hidden' => 'true']);
     * ```
     *
     * @param mixed[] $values Attribute map merged into existing icon attributes.
     *
     * @return static New instance with the updated `iconAttributes`.
     */
    public function iconAttributes(array $values): static
    {
        $new = clone $this;

        $new->iconAttributes = [...$new->iconAttributes, ...$values];

        return $new;
    }

    /**
     * Adds a CSS class to the icon attributes.
     *
     * Usage example:
     * ```php
     * $component->iconClass('icon-lg');
     * $component->iconClass(['icon-lg', 'icon-primary']);
     * $component->iconClass(Theme::PRIMARY);
     * $component->iconClass('icon-lg', true);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class (or class list) to add.
     * @param bool $override Whether to replace existing classes (`true`) or merge (`false`).
     *
     * @return static New instance with the updated icon `class` attribute.
     */
    public function iconClass(array|string|Stringable|UnitEnum $value, bool $override = false): static
    {
        $new = clone $this;

        CSSClass::add($new->iconAttributes, $value, $override);

        return $new;
    }

    /**
     * Sets the icon HTML content.
     *
     * Usage example:
     * ```php
     * $component->iconContent('★');
     * $component->iconContent('<path d="M0 0L10 10"/>');
     * ```
     *
     * @param RenderableInterface|string|Stringable ...$values Content fragments concatenated into the icon body.
     *
     * @return static New instance with the updated `iconContent`.
     */
    public function iconContent(string|Stringable|RenderableInterface ...$values): static
    {
        $new = clone $this;

        $new->iconContent = implode('', $values);

        return $new;
    }

    /**
     * Sets the filesystem path of the SVG file loaded as the icon body.
     *
     * Usage example:
     * ```php
     * $component->iconFilePath('/assets/icons/home.svg');
     * ```
     *
     * @param string $value Absolute or relative filesystem path to an SVG file.
     *
     * @return static New instance with the updated `iconFilePath`.
     */
    public function iconFilePath(string $value): static
    {
        $new = clone $this;

        $new->iconFilePath = $value;

        return $new;
    }

    /**
     * Removes a single icon attribute.
     *
     * Usage example:
     * ```php
     * $component->iconRemoveAttribute('aria-hidden');
     * $component->iconRemoveAttribute('hidden', 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name to remove.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return static New instance without the specified icon attribute.
     */
    public function iconRemoveAttribute(string|UnitEnum $key, string $prefix = ''): static
    {
        $new = clone $this;

        AttributeBag::remove($new->iconAttributes, $key, $prefix);

        return $new;
    }

    /**
     * Sets a single icon attribute.
     *
     * Usage example:
     * ```php
     * $component->iconSetAttribute('aria-hidden', 'true');
     * $component->iconSetAttribute('hidden', 'true', 'aria-');
     * ```
     *
     * @param string|UnitEnum $key Attribute name.
     * @param mixed $value Attribute value.
     * @param string $prefix Optional prefix to ensure on the key.
     *
     * @return static New instance with the updated icon attribute.
     */
    public function iconSetAttribute(string|UnitEnum $key, mixed $value, string $prefix = ''): static
    {
        $new = clone $this;

        AttributeBag::set($new->iconAttributes, $key, $value, $prefix);

        return $new;
    }

    /**
     * Sets the icon tag, or `false` to disable.
     *
     * Usage example:
     * ```php
     * $component->iconTag('i');
     * $component->iconTag('svg');
     * $component->iconTag(\UIAwesome\Html\Interop\Inline::SPAN);
     * $component->iconTag(false);
     * ```
     *
     * @param BackedEnum|false|string $value One of `i`, `span`, `svg`, or `false` to disable the icon.
     *
     * @throws InvalidArgumentException When the value is not a supported icon tag.
     *
     * @return static New instance with the updated `iconTag`.
     */
    public function iconTag(false|string|BackedEnum $value = 'i'): static
    {
        if ($value instanceof BackedEnum) {
            $value = (string) $value->value;
        }

        if ($value !== false) {
            Validator::oneOf($value, ['i', 'span', 'svg'], 'iconTag');
        }

        $new = clone $this;

        $new->iconTag = $value;

        return $new;
    }

    /**
     * Renders the configured icon, or returns an empty string when no icon tag is set.
     *
     * @return string Rendered HTML of the icon element, or an empty string if `iconTag` is `false`.
     */
    protected function renderIcon(): string
    {
        return match ($this->iconTag) {
            'i', 'span' => $this->renderInlineIcon($this->iconTag),
            'svg' => $this->renderSvgIcon(),
            default => '',
        };
    }

    /**
     * Renders an inline icon using the specified tag (`i` or `span`).
     *
     * @param string $tag HTML tag to use for the icon element.
     *
     * @return string Rendered HTML of the inline icon, or an empty string if no attributes or content are set.
     */
    private function renderInlineIcon(string $tag): string
    {
        if (isset($this->iconAttributes['class']) === false && $this->iconContent === '') {
            return '';
        }

        $enum = Inline::tryFrom($tag);

        if ($enum === null) {
            return '';
        }

        return Html::element($enum, $this->iconContent, $this->iconAttributes);
    }

    /**
     * Renders an SVG icon.
     *
     * @return string Rendered HTML of the SVG icon, or an empty string if no attributes, content, or file path are set.
     */
    private function renderSvgIcon(): string
    {
        $svg = Svg::tag();

        foreach ($this->iconAttributes as $key => $value) {
            $svg = $svg->addAttribute((string) $key, $value);
        }

        if ($this->iconContent !== '') {
            $svg = $svg->html($this->iconContent);
        }

        if ($this->iconFilePath !== '') {
            $svg = $svg->filePath($this->iconFilePath);
        }

        return $svg->render();
    }
}
