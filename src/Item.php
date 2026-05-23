<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use BackedEnum;
use Stringable;
use UIAwesome\Html\Contracts\RenderableInterface;
use UIAwesome\Html\Core\Component\Attribute\{
    HasIconCollection,
    HasLinkCollection,
    HasLinkContainerCollection,
    HasListItemCollection,
};
use UIAwesome\Html\Core\Component\Mixin\{CanBeActivateItems, HasCurrentPath, HasTemplateLinkItem};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Helper\{Encode, Template};
use UIAwesome\Html\Interop\{Block, Inline, Lists, Voids};
use UIAwesome\Html\Mixin\{HasContent, HasTemplate};

/**
 * Represents an individual menu item rendered inside a {@see Menu}.
 *
 * Items can carry a link, icon, label, divider, separator, child items, and active/disabled state. They are typically
 * composed via {@see Menu::items()} but can be rendered standalone.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Item::tag()
 *     ->label('Reports')
 *     ->link('/reports')
 *     ->active(true)
 *     ->render();
 * ```
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
class Item extends BaseBlock implements RenderableInterface
{
    use CanBeActivateItems;
    use HasContent;
    use HasCurrentPath;
    use HasIconCollection;
    use HasLinkCollection;
    use HasLinkContainerCollection;
    use HasListItemCollection;
    use HasTemplate;
    use HasTemplateLinkItem;

    /**
     * Whether the item is rendered in its active state.
     */
    protected bool $active = false;
    /**
     * Whether the item is rendered as disabled.
     */
    protected bool $disabled = false;
    /**
     * Pre-rendered HTML returned in place of the link when not empty.
     */
    protected string $divider = '';
    /**
     * @var array<self> Nested child items rendered below the current one.
     */
    protected array $items = [];
    /**
     * Text used as the visible label of the rendered link.
     */
    protected string $label = '';
    /**
     * Target href applied to the rendered link.
     */
    protected string $link = '';
    /**
     * Content prepended before the rendered link.
     */
    protected string $separator = '';
    /**
     * Whether the item is rendered at all.
     */
    protected bool $visible = true;

    /**
     * Sets the active state.
     *
     * @param bool $value Whether the item is active (defaults to `true`).
     *
     * @return static New instance with the updated `active` value.
     */
    public function active(bool $value = true): static
    {
        $new = clone $this;

        $new->active = $value;

        return $new;
    }

    /**
     * Sets the disabled state.
     *
     * @param bool $value Whether the item is disabled (defaults to `true`).
     *
     * @return static New instance with the updated `disabled` value.
     */
    public function disabled(bool $value = true): static
    {
        $new = clone $this;

        $new->disabled = $value;

        return $new;
    }

    /**
     * Sets the divider rendered in place of the item link.
     *
     * Accepts either a {@see BackedEnum} tag (recommended) or a string tag name resolved against `Voids`, `Inline`, and
     * `Block`. Void tags render as self-closing elements; other tags render as empty paired elements.
     *
     * @param BackedEnum|string $tag Tag for the divider element (defaults to {@see Voids::HR}).
     * @param array<string, mixed> $attributes HTML attributes for the divider element.
     *
     * @return static New instance with the updated `divider` value.
     */
    public function divider(BackedEnum|string $tag = Voids::HR, array $attributes = []): static
    {
        $resolved = $tag instanceof BackedEnum ? $tag : self::resolveDividerTag($tag);

        $new = clone $this;

        $new->divider = $resolved instanceof Voids
            ? Html::void($resolved, $attributes)
            : Html::element($resolved, '', $attributes);

        return $new;
    }

    /**
     * Returns `true` when the item should be rendered as active.
     *
     * @return bool `true` if the item is active; otherwise, `false`.
     */
    public function isActive(): bool
    {
        if ($this->link === '') {
            return false;
        }

        if ($this->active && $this->activateItems) {
            return true;
        }

        return ($this->link === $this->currentPath) && $this->activateItems;
    }

    /**
     * Returns `true` when the item is disabled.
     *
     * @return bool `true` if the item is disabled; otherwise, `false`.
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * Returns `true` when the item is visible.
     *
     * @return bool `true` if the item is visible; otherwise, `false`.
     */
    public function isVisible(): bool
    {
        return $this->visible;
    }

    /**
     * Sets the nested items.
     *
     * @param self ...$values Child items to render below the current one.
     *
     * @return static New instance with the updated `items` value.
     */
    public function items(self ...$values): static
    {
        $new = clone $this;

        $new->items = $values;

        return $new;
    }

    /**
     * Sets the label content.
     *
     * @param string $value Text for the item label.
     * @param bool $encode Whether to HTML-encode the label text (defaults to `true`).
     *
     * @return static New instance with the updated `label` value.
     */
    public function label(string $value, bool $encode = true): static
    {
        if ($encode === true) {
            $value = Encode::content($value);
        }

        $new = clone $this;

        $new->label = $value;

        return $new;
    }

    /**
     * Sets the link href for the item.
     *
     * @param string $value URL for the item link.
     *
     * @return static New instance with the updated `link` value.
     */
    public function link(string $value): static
    {
        $new = clone $this;

        $new->link = $value;

        return $new;
    }

    /**
     * Sets the separator prepended before the rendered link.
     *
     * @param string|Stringable $value Content for the separator.
     *
     * @return static New instance with the updated `separator` value.
     */
    public function separator(string|Stringable $value): static
    {
        $new = clone $this;

        $new->separator = (string) $value;

        return $new;
    }

    /**
     * Sets the visibility flag for the item.
     *
     * @param bool $value Whether the item is visible (defaults to `true`).
     *
     * @return static New instance with the updated `visible` value.
     */
    public function visible(bool $value = true): static
    {
        $new = clone $this;

        $new->visible = $value;

        return $new;
    }

    /**
     * Returns the tag instance representing the item wrapper.
     *
     * @return BackedEnum Tag instance for the item wrapper, typically `Lists::LI`.
     */
    protected function getTag(): BackedEnum
    {
        return Lists::LI;
    }

    /**
     * Loads the default definitions for the item component.
     *
     * @return array<string, mixed> Default attribute values for the item component.
     */
    protected function loadDefault(): array
    {
        return [
            'linkContainerTag' => false,
            'template' => '{separator}\n{link}',
            'templateLinkItem' => '{icon}\n{label}\n{content}',
        ];
    }

    /**
     * Renders the item.
     *
     * @return string Rendered HTML for the item, or an empty string if the item is not visible or has no content.
     */
    protected function run(): string
    {
        if ($this->visible === false) {
            return '';
        }

        if ($this->divider !== '') {
            return $this->divider;
        }

        $content = Template::render(
            $this->template,
            [
                '{separator}' => $this->separator,
                '{link}' => $this->renderLink(),
            ],
        );

        if ($content === '' || $this->listItemTag === false) {
            return $content;
        }

        return Html::element($this->getTag(), $this->renderLinkContainer($content), $this->listItemAttributes);
    }

    /**
     * Renders the link section of the item by composing the icon, label, and content through the link template, then
     * wrapping the result with the configured link tag when {@see $link} is set.
     *
     * @return string Rendered HTML for the item link, or the link content when no link is configured.
     */
    private function renderLink(): string
    {
        $contentLink = Template::render(
            $this->templateLinkItem,
            [
                '{content}' => $this->getContent(),
                '{icon}' => $this->renderIcon(),
                '{label}' => $this->label,
            ],
        );

        if ($this->link === '') {
            return $contentLink;
        }

        $linkAttributes = $this->linkAttributes;
        $linkAttributes['href'] = $this->link;

        if ($this->linkTag === false) {
            return $contentLink;
        }

        return Html::element($this->linkTag, $contentLink, $linkAttributes);
    }

    /**
     * Wraps the rendered link content with the configured link container tag, or returns the content unwrapped when
     * {@see $linkContainerTag} is `false` or resolves to an invalid tag.
     *
     * @param string $content Rendered link content to wrap.
     *
     * @return string Link content wrapped with the link container tag when valid, or the original content when not.
     */
    private function renderLinkContainer(string $content): string
    {
        if ($this->linkContainerTag === false) {
            return $content;
        }

        return Html::element($this->linkContainerTag, $content, $this->linkContainerAttributes);
    }

    /**
     * Resolves a string tag name against {@see Voids}, {@see Inline}, and {@see Block} enums in order, falling back to
     * {@see Voids::HR} when no enum recognizes the value.
     *
     * @param string $name Tag name to resolve.
     *
     * @return BackedEnum Resolved enum case, or {@see Voids::HR} as a fallback.
     */
    private static function resolveDividerTag(string $name): BackedEnum
    {
        $tag = Voids::tryFrom($name);

        if ($tag !== null) {
            return $tag;
        }

        $tag = Inline::tryFrom($name);

        if ($tag !== null) {
            return $tag;
        }

        $tag = Block::tryFrom($name);

        if ($tag !== null) {
            return $tag;
        }

        return Voids::HR;
    }
}
