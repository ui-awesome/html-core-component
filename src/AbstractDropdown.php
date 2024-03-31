<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use PHPForge\Widget\Element;
use UIAwesome\Html\{
    Attribute\Data\HasDataBsToggle,
    Attribute\HasClass,
    Attribute\HasData,
    Attribute\HasId,
    Attribute\HasStyle,
    Attribute\HasType,
    Concern\HasAttributes,
    Concern\HasContainerCollection,
    Concern\HasPrefixCollection,
    Concern\HasSuffixCollection,
    Concern\HasTag,
    Concern\HasTemplate,
    Core\Component\Concern\CanBeActivateItems,
    Core\Component\Concern\CanBeLinkAreaCurrent,
    Core\Component\Concern\HasFirstItemClass,
    Core\Component\Concern\HasFirstLinkClass,
    Core\Component\Concern\HasLastItemClass,
    Core\Component\Concern\HasLastLinkClass,
    Core\Component\Concern\HasLinkActiveClass,
    Core\Component\Concern\HasLinkCollection,
    Core\Component\Concern\HasLinkContainerCollection,
    Core\Component\Concern\HasLinkDisableClass,
    Core\Component\Concern\HasListCollection,
    Core\Component\Concern\HasListItemCollection,
    Core\Component\Concern\HasPrefixItems,
    Core\Component\Concern\HasSuffixItems,
    Core\Component\Concern\HasTemplateLinkItem,
    Core\Component\Concern\HasToggle,
    Core\HTMLBuilder,
    Helper\Utils,
    Interop\RenderInterface
};

/**
 * This class serves as a base for implementing various types of dropdown components.
 */
abstract class AbstractDropdown extends Element implements RenderInterface
{
    use CanBeActivateItems;
    use CanBeLinkAreaCurrent;
    use HasAttributes;
    use HasClass;
    use HasContainerCollection;
    use HasData;
    use HasDataBsToggle;
    use HasFirstItemClass;
    use HasFirstLinkClass;
    use HasId;
    use HasLastItemClass;
    use HasLastLinkClass;
    use HasLinkActiveClass;
    use HasLinkCollection;
    use HasLinkContainerCollection;
    use HasLinkDisableClass;
    use HasListCollection;
    use HasListItemCollection;
    use HasPrefixCollection;
    use HasPrefixItems;
    use HasStyle;
    use HasSuffixCollection;
    use HasSuffixItems;
    use HasTag;
    use HasTemplate;
    use HasTemplateLinkItem;
    use HasToggle;
    use HasType;

    protected string $ariaCurrent = 'true';
    protected array $attributes = [];
    /**
     * @psalm-var Item[]|RenderInterface[]
     */
    protected array $items = [];

    /**
     * Set the ARIA current attribute value for the link.
     *
     * @param string $value The ARIA current attribute value for the link.
     *
     * @return static A new instance of the current class with the specified ARIA current attribute value.
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
     * Loads the default definitions for the dropdown component.
     *
     * @return array The default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        return [
            'containerTag()' => [],
            'id()' => [Utils::generateId('dropdown-')],
            'linkAriaCurrent()' => [],
            'linkContainerTag()' => [false],
            'linkTag()' => [],
            'tag()' => ['div'],
            'template()' => ['{toggle}\n{prefix}\n{menu}\n{suffix}'],
            'templateLinkItem()' => ['{icon}\n{label}\n{content}'],
        ];
    }

    /**
     * Renders the dropdown component.
     *
     * This method generates the HTML representation of the dropdown component with the specified content and
     * attributes.
     *
     * @return string The rendered dropdown component.
     */
    protected function run(): string
    {
        $contentMenu = Menu::widget()
            ->activateItems($this->activateItems)
            ->ariaCurrent($this->ariaCurrent)
            ->attributes($this->attributes)
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
            ->linkDisableClass($this->linkDisableClass)
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
            ->tag($this->tag)
            ->template($this->template)
            ->templateLinkItem($this->templateLinkItem)
            ->toggle($this->renderToggle())
            ->render();

        if ($contentMenu === '') {
            return '';
        }

        return match ($this->containerTag) {
            false => $contentMenu,
            default => HTMLBuilder::createTag($this->containerTag, $contentMenu, $this->containerAttributes),
        };
    }

    /**
     * Renders the toggle component.
     *
     * @return string The rendered toggle component.
     */
    private function renderToggle(): string
    {
        if (is_string($this->toggle)) {
            return $this->toggle;
        }

        $id = $this->getId() ?? '';

        return $this->toggle->dataValue($id)->render();
    }
}
