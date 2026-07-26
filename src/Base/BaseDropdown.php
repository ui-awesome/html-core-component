<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Base;

use BackedEnum;
use UIAwesome\Html\Attribute\HasType;
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
    HasListItemCollection,
};
use UIAwesome\Html\Core\Component\{Item, Menu};
use UIAwesome\Html\Core\Component\Mixin\{
    CanBeActivateItems,
    CanBeLinkAreaCurrent,
    HasPrefixItems,
    HasSuffixItems,
    HasTemplateLinkItem,
    HasToggle,
};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Helper\Naming;
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Mixin\{HasContainerCollection, HasPrefixCollection, HasSuffixCollection, HasTemplate};

/**
 * Provides the base implementation for dropdown components.
 *
 * Extend this class to render dropdown menus with toggles, dividers, and active-link wiring. The wrapper tag defaults
 * to `<div>` and can be customized by overriding {@see getTag()}.
 */
abstract class BaseDropdown extends BaseBlock implements RenderableInterface
{
    use CanBeActivateItems;
    use CanBeLinkAreaCurrent;
    use HasContainerCollection;
    use HasFirstItemClass;
    use HasFirstLinkClass;
    use HasLastItemClass;
    use HasLastLinkClass;
    use HasLinkActiveClass;
    use HasLinkCollection;
    use HasLinkContainerCollection;
    use HasLinkDisabledClass;
    use HasListCollection;
    use HasListItemCollection;
    use HasPrefixCollection;
    use HasPrefixItems;
    use HasSuffixCollection;
    use HasSuffixItems;
    use HasTemplate;
    use HasTemplateLinkItem;
    use HasToggle;
    use HasType;

    /**
     * Value of the `aria-current` attribute applied to the active item.
     */
    protected string $ariaCurrent = 'true';
    /**
     * @var array<Item|RenderableInterface> Items rendered in order inside the dropdown menu.
     */
    protected array $items = [];

    /**
     * Sets the `aria-current` attribute applied to the active item.
     *
     * Usage example:
     * ```php
     * \UIAwesome\Html\Core\Component\Dropdown::tag()->ariaCurrent('true');
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
     * Sets the dropdown items.
     *
     * Usage example:
     * ```php
     * \UIAwesome\Html\Core\Component\Dropdown::tag()->items(
     *     \UIAwesome\Html\Core\Component\Item::tag()->label('Profile')->link('/profile'),
     *     \UIAwesome\Html\Core\Component\Item::tag()->label('Sign out')->link('/logout'),
     * );
     * ```
     *
     * @param Item|RenderableInterface ...$values Items to render in order inside the dropdown menu.
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
     * Returns the tag instance representing the dropdown wrapper.
     *
     * @return BackedEnum Tag instance for the dropdown wrapper, typically `Block::DIV`.
     */
    protected function getTag(): BackedEnum
    {
        return Block::DIV;
    }

    /**
     * Loads the default definitions for the dropdown component.
     *
     * @return array<string, mixed> Default attribute values for the dropdown component.
     */
    protected function loadDefault(): array
    {
        return [
            'id' => Naming::generateId('dropdown-'),
            'linkAriaCurrent' => true,
            'linkContainerTag' => false,
            'linkTag' => 'a',
            'template' => '{toggle}\n{prefix}\n{menu}\n{suffix}',
            'templateLinkItem' => '{icon}\n{label}\n{content}',
        ];
    }

    /**
     * Renders the dropdown.
     *
     * @return string Rendered HTML for the dropdown, or an empty string when the inner menu produces no content.
     */
    protected function run(): string
    {
        $contentMenu = Menu::tag()
            ->activateItems($this->activateItems)
            ->ariaCurrent($this->ariaCurrent)
            ->attributes($this->getAttributes())
            ->firstItemClass($this->firstItemClass)
            ->firstLinkClass($this->firstLinkClass)
            ->items(...$this->items)
            ->lastItemClass($this->lastItemClass)
            ->lastLinkClass($this->lastLinkClass)
            ->linkActiveClass($this->linkActiveClass)
            ->linkAriaCurrent($this->linkAriaCurrent)
            ->linkAttributes($this->linkAttributes)
            ->linkContainerAttributes($this->linkContainerAttributes)
            ->linkContainerTag($this->linkContainerTag)
            ->linkDisabledClass($this->linkDisabledClass)
            ->linkTag($this->linkTag)
            ->listAttributes($this->listAttributes)
            ->listItemAttributes($this->listItemAttributes)
            ->listItemTag($this->listItemTag)
            ->listType($this->listType)
            ->prefix($this->prefix)
            ->prefixAttributes($this->prefixAttributes)
            ->prefixItems($this->prefixItems)
            ->prefixTag($this->prefixTag)
            ->suffix($this->suffix)
            ->suffixAttributes($this->suffixAttributes)
            ->suffixItems($this->suffixItems)
            ->suffixTag($this->suffixTag)
            ->template($this->template)
            ->templateLinkItem($this->templateLinkItem)
            ->toggle($this->renderToggle())
            ->render();

        if ($contentMenu === '') {
            return '';
        }

        if ($this->containerTag === false || $this->containerTag instanceof BackedEnum === false) {
            return $contentMenu;
        }

        return Html::element($this->containerTag, $contentMenu, $this->containerAttributes);
    }
}
