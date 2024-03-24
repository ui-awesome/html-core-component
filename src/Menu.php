<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use PHPForge\Widget\Element;
use PHPForge\Widget\Factory\SimpleFactory;
use UIAwesome\Html\{
    Attribute\HasClass,
    Attribute\HasId,
    Attribute\HasStyle,
    Concern\HasAttributes,
    Concern\HasPrefixCollection,
    Concern\HasSeparator,
    Concern\HasSuffixCollection,
    Concern\HasTag,
    Concern\HasTemplate,
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
    Core\Component\Concern\HasTemplateItem,
    Core\Component\Concern\HasTemplateLinkItem,
    Core\Component\Concern\HasToggle,
    Helper\HTMLBuilder,
    Helper\Template,
    Interop\RenderInterface
};

use function count;
use function implode;

class Menu extends Element implements RenderInterface
{
    use CanBeActivateItems;
    use CanBeLinkAreaCurrent;
    use CanBeListItemAreaCurrent;
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
    use HasTemplate;
    use HasTemplateItem;
    use HasTemplateLinkItem;
    use HasToggle;

    protected string $ariaCurrent = 'page';
    protected array $attributes = [];
    /**
     * @psalm-var array<string, mixed>
     */
    protected array $dropdownDefaultDefinitions = [];
    protected array $items = [];
    protected string $listDropdownItemClass = '';
    protected string $type = '';

    /**
     * Set the aria-current attribute of the menu item.
     *
     * @param string $value The aria-current attribute of the menu item.
     *
     * @return static A new instance of the current class with the specified aria-current attribute of the menu item.
     */
    public function ariaCurrent(string $value): static
    {
        $new = clone $this;
        $new->ariaCurrent = $value;

        return $new;
    }

    /**
     * Set the default definitions for the dropdown menu.
     *
     * @param array $values The default definitions for the dropdown menu.
     *
     * @return static A new instance of the current class with the specified default definitions for the dropdown menu.
     *
     * @psalm-param array<string, mixed> $values
     */
    public function dropdownDefaultDefinitions(array $values): static
    {
        $new = clone $this;
        $new->dropdownDefaultDefinitions = $values;

        return $new;
    }

    /**
     * Set the menu items.
     *
     * @param Item|RenderInterface ...$values The list of menu items to be rendered. The items can be of type
     * `Item` or `RenderInterface`.
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
     * Set the class of the list item of the dropdown menu.
     *
     * @param string $value The class of the list item of the dropdown menu.
     *
     * @return static A new instance of the current class with the specified class of the list item of the dropdown
     * menu.
     */
    public function listDropdownItemClass(string $value): static
    {
        $new = clone $this;
        $new->listDropdownItemClass = $value;

        return $new;
    }

    /**
     * Set the type of the menu.
     *
     * @param string $value The type of the menu.
     *
     * @return static A new instance of the current class with the specified type of the menu.
     */
    public function type(string $value): static
    {
        $new = clone $this;
        $new->type = $value;

        return $new;
    }

    /**
     * This method is used to configure the widget with the provided default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        return [
            'linkActiveTag()' => ['a'],
            'linkContainerTag()' => [false],
            'linkTag()' => [],
            'tag()' => ['div'],
            'template()' => ['{toggle}\n{prefix}\n{menu}\n{suffix}'],
            'templateItem()' => ['{prefixItems}\n{items}\n{suffixItems}'],
            'templateLinkItem()' => ['{icon}\n{label}\n{content}'],
            'type()' => ['menu'],
        ];
    }

    /**
     * Run the menu widget.
     *
     * It generates the menu with the specified items and attributes.
     *
     * @return string The rendered menu widget.
     */
    protected function run(): string
    {
        if ($this->items === []) {
            return '';
        }

        return $this->renderMenu();
    }

    /**
     * Render the menu items.
     *
     * @return string The rendered menu items as a string.
     */
    private function renderItems(): string
    {
        /** @psalm-var list<AbstractDropdown>|list<Item>|list<string> $items */
        $items = $this->items;
        $lines = [];
        $n = count($items);

        foreach ($items as $i => $item) {
            if ($item instanceof AbstractDropdown) {
                /** @var AbstractDropdown $item */
                $item = SimpleFactory::configure($item, $this->dropdownDefaultDefinitions);
                $lines[] = $this->renderTag(
                    ['class' => $this->listDropdownItemClass],
                    $item->render(),
                    $this->listItemTag
                );
            } elseif ($item instanceof Item) {
                $item = $item
                    ->activateItems($this->activateItems)
                    ->currentPath($this->currentPath)
                    ->linkAttributes($this->linkAttributes)
                    ->linkContainerAttributes($this->linkContainerAttributes)
                    ->linkTag($this->linkTag)
                    ->listItemAttributes($this->listItemAttributes)
                    ->listItemTag($this->listItemTag)
                    ->templateLinkItem($this->templateLinkItem);

                if ($this->type === 'breadcrumb') {
                    $item = $i > 0 ? $item->separator($this->separator) : $item;
                }

                $item = $this->setActiveAndDisableClass($item);
                $item = $this->setAriaCurrent($item);
                $item = $this->setFirstAndLastClass($item, $i, $n);
                $item = $this->setLinkContainerTag($item);


                $lines[] = $item->render();
            }
        }

        $content = implode(PHP_EOL, $lines);

        return $this->renderTag($this->listAttributes, $content, $this->listType);
    }

    /**
     * Render the menu.
     *
     * @return string The rendered menu as a string.
     */
    private function renderMenu(): string
    {
        $items = Template::render(
            $this->templateItem,
            [
                '{prefixItems}' => $this->prefixItems,
                '{items}' => $this->renderItems(),
                '{suffixItems}' => $this->suffixItems,
            ],
        );

        $containerTag = $this->renderTag($this->attributes, $items, $this->tag);

        return Template::render(
            $this->template,
            [
                '{toggle}' => $this->renderToggle(),
                '{prefix}' => $this->renderTag($this->prefixAttributes, $this->prefix, $this->prefixTag),
                '{menu}' => $containerTag,
                '{suffix}' => $this->renderTag($this->suffixAttributes, $this->suffix, $this->suffixTag),
            ],
        );
    }

    private function renderTag(array $attributes, string $content, false|string $tag): string
    {
        if ($content === '' || $tag === false) {
            return $content;
        }

        return HTMLBuilder::createTag($tag, $content, $attributes);
    }

    private function setAriaCurrent(Item $item): Item
    {
        if ($item->isActive() && $this->isLinkAriaCurrent()) {
            return $item->linkAttributes(['aria-current' => $this->ariaCurrent]);
        }

        if ($item->isActive() && $this->isListItemAriaCurrent()) {
            return $item->listItemAttributes(['aria-current' => $this->ariaCurrent]);
        }

        return $item;
    }

    private function setActiveAndDisableClass(Item $item): Item
    {
        if ($item->isDisable()) {
            return $item
                ->linkClass($this->linkDisableClass, $this->overrideLinkDisableClass)
                ->listItemClass($this->listItemDisableClass, $this->overrideListItemDisableClass);
        }

        if ($item->isActive()) {
            return $item
                ->active()
                ->linkClass($this->linkActiveClass, $this->overrideLinkActiveClass)
                ->linkTag($this->linkActiveTag)
                ->listItemClass($this->listItemActiveClass, $this->overrideListItemActiveClass);
        }

        return $item;
    }

    /**
     * Set the first and last class of the menu item.
     *
     * @param Item $item The menu item to be rendered.
     * @param int $i The index of the menu item.
     * @param int $n The total number of menu items.
     *
     * @return Item The menu item with the first and last class set.
     */
    private function setFirstAndLastClass(Item $item, int $i, int $n): Item
    {
        if ($i === 0) {
            return $item
                ->linkClass($this->firstLinkClass, $this->overrideFirstLinkClass)
                ->listItemClass($this->firstItemClass, $this->overrideFirstItemClass);
        }

        if ($i === $n - 1) {
            return $item
                ->linkClass($this->lastLinkClass, $this->overrideLastLinkClass)
                ->listItemClass($this->lastItemClass, $this->overrideLastItemClass);
        }

        return $item;
    }

    private function setLinkContainerTag(Item $item): Item
    {
        if ($item->isLinkContainerTag() === false) {
            return $item->linkContainerTag($this->linkContainerTag);
        }

        return $item;
    }

    private function renderToggle(): string
    {
        if (is_string($this->toggle)) {
            return $this->toggle;
        }

        $id = $this->getId() ?? '';

        return $this->toggle->dataValue($id)->render();
    }
}
