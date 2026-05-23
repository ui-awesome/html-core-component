<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Base;

use BackedEnum;
use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\HasName;
use UIAwesome\Html\Contracts\RenderableInterface;
use UIAwesome\Html\Core\Component\Attribute\HasIconCollection;
use UIAwesome\Html\Core\Component\ToggleInterface;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Helper\{CSSClass, Template};
use UIAwesome\Html\Interop\{Block, Inline};
use UIAwesome\Html\Mixin\HasTemplate;

use function implode;
use function is_string;

/**
 * Provides the base implementation for toggle components.
 *
 * Extend this class to render button or link toggles. Toggles render as `<button type="button">` by default and can be
 * switched to `<a>` via {@see link()}. Use {@see BaseBlock::addDataAttribute()} for Bootstrap, Flowbite, and Tailwind
 * UI data hooks (`data-bs-toggle`, `data-collapse-toggle`, `data-drawer-target`, and friends).
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
abstract class BaseToggle extends BaseBlock implements ToggleInterface
{
    use HasIconCollection;
    use HasName;
    use HasTemplate;

    /**
     * Identifier propagated from the parent component via {@see ToggleInterface::dataValue()}.
     *
     * Subclasses can read `$this->dataValue` to compose explicit data hooks (for example,
     * `addDataAttribute('bs-target', '#'.$this->dataValue)`); the value is never auto-emitted as a `data-value`
     * attribute.
     */
    protected string $dataValue = '';
    /**
     * Whether the toggle should render as `<a>` instead of `<button>`.
     */
    protected bool $isLink = false;
    /**
     * @var mixed[] HTML attributes for the toggle decoration tag.
     */
    protected array $toggleAttributes = [];
    /**
     * Markup rendered inside the toggle decoration tag.
     */
    protected string $toggleContent = '';
    /**
     * Tag enum for the toggle decoration wrapper, or `false` to skip wrapping.
     */
    protected BackedEnum|false $toggleTag = Inline::SPAN;

    /**
     * Stores the parent component's identifier for use by toggle subclasses.
     *
     * @param string $value Identifier propagated from the parent component.
     *
     * @return static New instance with the updated `dataValue` value.
     */
    public function dataValue(string $value): static
    {
        $new = clone $this;

        $new->dataValue = $value;

        return $new;
    }

    /**
     * Returns the toggle decoration attributes.
     *
     * @return mixed[] HTML attributes for the toggle decoration tag.
     */
    public function getToggleAttributes(): array
    {
        return $this->toggleAttributes;
    }

    /**
     * Switches the toggle to render as `<a>` instead of `<button>`.
     *
     * @return static New instance with the updated `isLink` value.
     */
    public function link(): static
    {
        $new = clone $this;

        $new->isLink = true;

        return $new;
    }

    /**
     * Sets the toggle decoration attributes, merging them with the existing values.
     *
     * @param mixed[] $values HTML attributes to merge into the toggle decoration attributes.
     *
     * @return static New instance with the updated `toggleAttributes` value.
     */
    public function toggleAttributes(array $values): static
    {
        $new = clone $this;

        $new->toggleAttributes = [...$new->toggleAttributes, ...$values];

        return $new;
    }

    /**
     * Adds a CSS class to the toggle decoration attributes.
     *
     * @param array<string>|string $value CSS class or list of classes for the toggle decoration.
     * @param bool $override Whether to override the existing classes (defaults to `false`).
     *
     * @return static New instance with the updated toggle decoration class attribute.
     */
    public function toggleClass(array|string $value, bool $override = false): static
    {
        $new = clone $this;

        CSSClass::add($new->toggleAttributes, $value, $override);

        return $new;
    }

    /**
     * Sets the markup rendered inside the toggle decoration tag.
     *
     * @param RenderableInterface|string|Stringable ...$values Content joined to form the toggle decoration markup.
     *
     * @return static New instance with the updated `toggleContent` value.
     */
    public function toggleContent(string|Stringable|RenderableInterface ...$values): static
    {
        $new = clone $this;

        $new->toggleContent = implode('', $values);

        return $new;
    }

    /**
     * Sets the tag for the toggle decoration wrapper, or `false` to skip wrapping.
     *
     * @param BackedEnum|false|string $value Inline/Block enum case (recommended) or its tag name, or `false` to skip
     * wrapping.
     *
     * @throws InvalidArgumentException When the string value does not resolve to an {@see Inline} or {@see Block}
     * enum case.
     *
     * @return static New instance with the updated `toggleTag` value.
     */
    public function toggleTag(BackedEnum|false|string $value = Block::DIV): static
    {
        if (is_string($value)) {
            $value = self::resolveToggleTag($value);
        }

        $new = clone $this;

        $new->toggleTag = $value;

        return $new;
    }

    /**
     * Returns the tag instance representing the toggle wrapper.
     *
     * @return BackedEnum Tag instance for the toggle wrapper: `Inline::A` when {@see $isLink} is `true`, otherwise
     * `Inline::BUTTON`.
     */
    protected function getTag(): BackedEnum
    {
        return $this->isLink ? Inline::A : Inline::BUTTON;
    }

    /**
     * Loads the default definitions for the toggle component.
     *
     * @return array<string, mixed> Default attribute values for the toggle component.
     */
    protected function loadDefault(): array
    {
        return [
            'template' => ['{toggle}\n{icon}\n{content}'],
        ];
    }

    /**
     * Renders the toggle.
     *
     * @return string Rendered HTML for the toggle.
     */
    protected function run(): string
    {
        $attributes = $this->getAttributes();

        if ($this->isLink === false && isset($attributes['type']) === false) {
            $attributes['type'] = 'button';
        }

        $content = Template::render(
            $this->template,
            [
                '{toggle}' => $this->renderToggleTag(),
                '{icon}' => $this->renderIcon(),
                '{content}' => $this->getContent(),
            ],
        );

        $content = $content !== '' ? "\n{$content}\n" : '';

        return Html::element($this->getTag(), $content, $attributes);
    }

    /**
     * Wraps {@see $toggleContent} with the resolved toggle decoration tag, or returns the content unwrapped when the
     * tag is `false`, both attributes and content are empty, or the tag does not resolve to a known enum.
     *
     * @return string Wrapped toggle decoration markup when the tag is valid, or the raw toggle content otherwise.
     */
    private function renderToggleTag(): string
    {
        if (($this->toggleAttributes === [] && $this->toggleContent === '') || $this->toggleTag === false) {
            return $this->toggleContent;
        }

        return Html::element($this->toggleTag, $this->toggleContent, $this->toggleAttributes);
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
    private static function resolveToggleTag(string $name): BackedEnum
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
            "Toggle tag '{$name}' must resolve to an `Inline` or `Block` enum case.",
        );
    }
}
