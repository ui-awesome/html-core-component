<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use PHPForge\Widget\Element;
use UIAwesome\Html\{
    Attribute\Aria\HasAriaLabel,
    Attribute\HasClass,
    Attribute\HasId,
    Attribute\HasStyle,
    Concern\HasAttributes,
    Concern\HasPrefixCollection,
    Concern\HasSeparator,
    Concern\HasSuffixCollection,
    Concern\HasTag,
    Core\Component\Concern\CanBeActivateItems,
    Core\Component\Concern\CanBeLinkAreaCurrent,
    Core\Component\Concern\CanBeListItemAreaCurrent,
    Core\Component\Concern\HasCurrentPath,
    Core\Component\Concern\HasFirstItemClass,
    Core\Component\Concern\HasFirstLinkClass,
    Core\Component\Concern\HasLastItemClass,
    Core\Component\Concern\HasLastLinkClass,
    Core\Component\Concern\HasLinkActiveClass,
    Core\Component\Concern\HasLinkActiveTag,
    Core\Component\Concern\HasLinkCollection,
    Core\Component\Concern\HasLinkContainerCollection,
    Core\Component\Concern\HasLinkDisableClass,
    Core\Component\Concern\HasListCollection,
    Core\Component\Concern\HasListItemActiveClass,
    Core\Component\Concern\HasListItemCollection,
    Core\Component\Concern\HasListItemDisableClass,
    Core\Component\Concern\HasPrefixItems,
    Core\Component\Concern\HasSuffixItems,
    Core\Component\Concern\HasTemplateLinkItem,
    Helper\Utils,
    Interop\RenderInterface
};

/**
 * This class serves as a base for implementing various types of breadcrumb components.
 */
abstract class AbstractBreadcrumb extends Element implements RenderInterface
{
    use CanBeActivateItems;
    use CanBeLinkAreaCurrent;
    use CanBeListItemAreaCurrent;
    use HasAriaLabel;
    use HasAttributes;
    use HasClass;
    use HasCurrentPath;
    use HasFirstItemClass;
    use HasFirstLinkClass;
    use HasId;
    use HasLastItemClass;
    use HasLastLinkClass;
    use HasLinkActiveClass;
    use HasLinkActiveTag;
    use HasLinkCollection;
    use HasLinkContainerCollection;
    use HasLinkDisableClass;
    use HasListCollection;
    use HasListItemActiveClass;
    use HasListItemCollection;
    use HasListItemDisableClass;
    use HasPrefixCollection;
    use HasPrefixItems;
    use HasSeparator;
    use HasStyle;
    use HasSuffixCollection;
    use HasSuffixItems;
    use HasTag;
    use HasTemplateLinkItem;

    protected string $ariaCurrent = 'page';
    /**
     * @psalm-var Item[]|RenderInterface[]
     */
    protected array $items = [];

    /**
     * Set the aria-current attribute value.
     *
     * @param string $value The value of the aria-current attribute.
     *
     * @return static A new instance of the current class with the specified aria-current attribute value.
     */
    public function ariaCurrent(string $value): static
    {
        $new = clone $this;
        $new->ariaCurrent = $value;

        return $new;
    }

    /**
     * Set the menu items.
     *
     * @param Item|RenderInterface ...$values The list of menu items to be rendered.
     *
     * @return static A new instance of the current class with the specified items.
     */
    public function items(Item|RenderInterface ...$values): static
    {
        $new = clone $this;
        $new->items = $values;

        return $new;
    }

    /**
     * Loads the default definitions for the breadcrumb component.
     *
     * @return array The default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        return [
            'ariaLabel()' => ['breadcrumb'],
            'id()' => [Utils::generateId('breadcrumb-')],
            'linkContainerTag()' => [false],
            'linkTag()' => [],
            'listType()' => ['ol'],
            'tag()' => ['nav'],
            'templateLinkItem()' => ['{icon}\n{label}\n{content}'],
        ];
    }

    /**
     * Renders the breadcrumb component.
     *
     * This method generates the HTML representation of the breadcrumb component with the specified content and
     * attributes.
     *
     * @return string The rendered breadcrumb component.
     */
    protected function run(): string
    {
        if ($this->items === []) {
            return '';
        }

        return Menu::widget()
            ->activateItems($this->activateItems)
            ->ariaCurrent($this->ariaCurrent)
            ->attributes($this->attributes)
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
            ->linkDisableClass($this->linkDisableClass, $this->overrideLinkDisableClass)
            ->linkTag($this->linkTag)
            ->listAttributes($this->listAttributes)
            ->listItemActiveClass($this->listItemActiveClass, $this->overrideListItemActiveClass)
            ->listItemAriaCurrent($this->listItemAriaCurrent)
            ->listItemAttributes($this->listItemAttributes)
            ->listItemDisableClass($this->listItemDisableClass, $this->overrideListItemDisableClass)
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
            ->tag($this->tag)
            ->templateLinkItem($this->templateLinkItem)
            ->type('breadcrumb')
            ->render();
    }
}
