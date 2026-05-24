<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Base;

use BackedEnum;
use Stringable;
use UIAwesome\Html\Contracts\RenderableInterface;
use UIAwesome\Html\Core\Component\Attribute\{
    HasFirstItemClass,
    HasFirstLinkClass,
    HasLastItemClass,
    HasLastLinkClass,
    HasLinkActiveClass,
    HasLinkCollection,
    HasLinkContainerCollection,
    HasLinkDisabledClass,
    HasListCollection,
    HasListItemActiveClass,
    HasListItemCollection,
    HasListItemDisabledClass,
};
use UIAwesome\Html\Core\Component\{Item, Menu};
use UIAwesome\Html\Core\Component\Mixin\{
    CanBeActivateItems,
    CanBeLinkAreaCurrent,
    CanBeListItemAreaCurrent,
    HasCurrentPath,
    HasLinkActiveTag,
    HasPrefixItems,
    HasSuffixItems,
    HasTemplateLinkItem,
};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Helper\Naming;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Mixin\{HasPrefixCollection, HasSuffixCollection};

/**
 * Provides the base implementation for breadcrumb components.
 *
 * Extend this class to render accessible breadcrumb navigation with active-path detection. The wrapper defaults to
 * `<nav>` and the inner list to `<ol>`.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
abstract class BaseBreadcrumb extends BaseBlock implements RenderableInterface
{
    use CanBeActivateItems;
    use CanBeLinkAreaCurrent;
    use CanBeListItemAreaCurrent;
    use HasCurrentPath;
    use HasFirstItemClass;
    use HasFirstLinkClass;
    use HasLastItemClass;
    use HasLastLinkClass;
    use HasLinkActiveClass;
    use HasLinkActiveTag;
    use HasLinkCollection;
    use HasLinkContainerCollection;
    use HasLinkDisabledClass;
    use HasListCollection;
    use HasListItemActiveClass;
    use HasListItemCollection;
    use HasListItemDisabledClass;
    use HasPrefixCollection;
    use HasPrefixItems;
    use HasSuffixCollection;
    use HasSuffixItems;
    use HasTemplateLinkItem;

    /**
     * Value of the `aria-current` attribute applied to the active item.
     */
    protected string $ariaCurrent = 'page';
    /**
     * @var array<Item|RenderableInterface> Items rendered in order inside the breadcrumb.
     */
    protected array $items = [];
    /**
     * Content rendered between consecutive breadcrumb items.
     */
    protected string $separator = '';

    /**
     * Sets the `aria-current` attribute applied to the active item.
     *
     * Usage example:
     * ```php
     * \UIAwesome\Html\Core\Component\Breadcrumb::tag()->ariaCurrent('page');
     * ```
     *
     * @param string $value Value for the `aria-current` attribute.
     *
     * @return static New instance with the updated `ariaCurrent` value.
     */
    public function ariaCurrent(string $value): static
    {
        $new = clone $this;

        $new->ariaCurrent = $value;

        return $new;
    }

    /**
     * Sets the `aria-label` attribute applied to the breadcrumb wrapper.
     *
     * Usage example:
     * ```php
     * \UIAwesome\Html\Core\Component\Breadcrumb::tag()->ariaLabel('breadcrumb');
     * ```
     *
     * @param string $value Value for the `aria-label` attribute, or empty string to remove the attribute.
     *
     * @return static New instance with the updated `aria-label` attribute.
     */
    public function ariaLabel(string $value): static
    {
        return $this->addAriaAttribute('label', $value === '' ? null : $value);
    }

    /**
     * Sets the breadcrumb items.
     *
     * Usage example:
     * ```php
     * \UIAwesome\Html\Core\Component\Breadcrumb::tag()->items(
     *     \UIAwesome\Html\Core\Component\Item::tag()->label('Home')->link('/'),
     *     \UIAwesome\Html\Core\Component\Item::tag()->label('Library')->link('/library'),
     * );
     * ```
     *
     * @param Item|RenderableInterface ...$values Items to render in order inside the breadcrumb.
     *
     * @return static New instance with the updated `items` value.
     */
    public function items(Item|RenderableInterface ...$values): static
    {
        $new = clone $this;

        $new->items = $values;

        return $new;
    }

    /**
     * Sets the separator rendered between consecutive breadcrumb items.
     *
     * Usage example:
     * ```php
     * \UIAwesome\Html\Core\Component\Breadcrumb::tag()->separator('/');
     * ```
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
     * Returns the tag instance representing the breadcrumb wrapper.
     *
     * @return BackedEnum Tag instance for the breadcrumb wrapper, typically `Block::NAV`.
     */
    protected function getTag(): BackedEnum
    {
        return Block::NAV;
    }

    /**
     * Loads the default definitions for the breadcrumb component.
     *
     * @return array<string, mixed> Default attribute values for the breadcrumb component.
     */
    protected function loadDefault(): array
    {
        return [
            'ariaLabel' => 'breadcrumb',
            'id' => Naming::generateId('breadcrumb-'),
            'linkContainerTag' => false,
            'linkTag' => 'a',
            'listType' => 'ol',
            'templateLinkItem' => '{icon}\n{label}\n{content}',
        ];
    }

    /**
     * Renders the breadcrumb.
     *
     * @return string Rendered HTML for the breadcrumb, or an empty string when no items are configured.
     */
    protected function run(): string
    {
        return Menu::tag()
            ->activateItems($this->activateItems)
            ->ariaCurrent($this->ariaCurrent)
            ->attributes($this->getAttributes())
            ->currentPath($this->currentPath)
            ->firstItemClass($this->firstItemClass, $this->overrideFirstItemClass)
            ->firstLinkClass($this->firstLinkClass, $this->overrideFirstLinkClass)
            ->items(...$this->items)
            ->lastItemClass($this->lastItemClass, $this->overrideLastItemClass)
            ->lastLinkClass($this->lastLinkClass, $this->overrideLastLinkClass)
            ->linkActiveClass($this->linkActiveClass, $this->overrideLinkActiveClass)
            ->linkActiveTag($this->linkActiveTag)
            ->linkAriaCurrent($this->linkAriaCurrent)
            ->linkAttributes($this->linkAttributes)
            ->linkContainerAttributes($this->linkContainerAttributes)
            ->linkContainerTag($this->linkContainerTag)
            ->linkDisabledClass($this->linkDisabledClass, $this->overrideLinkDisabledClass)
            ->linkTag($this->linkTag)
            ->listAttributes($this->listAttributes)
            ->listItemActiveClass($this->listItemActiveClass, $this->overrideListItemActiveClass)
            ->listItemAriaCurrent($this->listItemAriaCurrent)
            ->listItemAttributes($this->listItemAttributes)
            ->listItemDisabledClass($this->listItemDisabledClass, $this->overrideListItemDisabledClass)
            ->listItemTag($this->listItemTag)
            ->listType($this->listType)
            ->prefix($this->prefix)
            ->prefixAttributes($this->prefixAttributes)
            ->prefixItems($this->prefixItems)
            ->prefixTag($this->prefixTag)
            ->separator($this->separator)
            ->suffix($this->suffix)
            ->suffixAttributes($this->suffixAttributes)
            ->suffixItems($this->suffixItems)
            ->suffixTag($this->suffixTag)
            ->templateLinkItem($this->templateLinkItem)
            ->type('breadcrumb')
            ->render();
    }
}
