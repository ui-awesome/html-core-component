<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

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
use UIAwesome\Html\Core\Component\Base\BaseDropdown;
use UIAwesome\Html\Core\Component\Mixin\{
    CanBeActivateItems,
    CanBeLinkAreaCurrent,
    CanBeListItemAreaCurrent,
    HasCurrentPath,
    HasLinkActiveTag,
    HasPrefixItems,
    HasSuffixItems,
    HasTemplateLinkItem,
    HasToggle,
};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Helper\Template;
use UIAwesome\Html\Interop\{Block, Inline, Lists};
use UIAwesome\Html\Mixin\{HasPrefixCollection, HasSuffixCollection, HasTemplate};

use function array_values;
use function count;
use function implode;
use function is_string;

/**
 * Represents a collection of menu items rendered as a list of links.
 *
 * Drives breadcrumb, dropdown, and navigation menu rendering with active-path matching, dividers, prefix/suffix items,
 * and link wrappers.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Menu::tag()
 *     ->items(
 *         \UIAwesome\Html\Core\Component\Item::tag()->label('Home')->link('/'),
 *         \UIAwesome\Html\Core\Component\Item::tag()->label('Reports')->link('/reports'),
 *     )
 *     ->currentPath('/reports')
 *     ->render();
 * ```
 */
class Menu extends BaseBlock implements RenderableInterface
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
    use HasTemplate;
    use HasTemplateLinkItem;
    use HasToggle;

    /**
     * Value of the `aria-current` attribute applied to the active item.
     */
    protected string $ariaCurrent = 'page';
    /**
     * @var array<string, mixed> Default configuration applied to nested {@see BaseDropdown} items via
     * {@see SimpleFactory::configure()}.
     */
    protected array $dropdownDefaultDefinitions = [];
    /**
     * @var list<BaseDropdown|Item|RenderableInterface> Items rendered in order inside the menu.
     */
    protected array $items = [];
    /**
     * CSS class assigned to the list item that wraps a nested dropdown menu.
     */
    protected string $listDropdownItemClass = '';
    /**
     * Content rendered between consecutive items when {@see $type} is `breadcrumb`.
     */
    protected string $separator = '';
    /**
     * Template composing `{prefixItems}/{items}/{suffixItems}` inside the rendered menu body.
     */
    protected string $templateItem = '';
    /**
     * Menu type controlling the wrapper tag (`menu`, `breadcrumb`, `dropdown`, `nav`, ...).
     */
    protected string $type = '';

    /**
     * Sets the `aria-current` attribute applied to the active item.
     *
     * Usage example:
     * ```php
     * \UIAwesome\Html\Core\Component\Menu::tag()->ariaCurrent('page');
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
     * Sets the default definitions applied to nested {@see BaseDropdown} items via {@see SimpleFactory::configure()}.
     *
     * Usage example:
     * ```php
     * \UIAwesome\Html\Core\Component\Menu::tag()->dropdownDefaultDefinitions(['class' => ['dropdown']]);
     * ```
     *
     * @param array<string, mixed> $values Cookbook-style associative array of method names and arguments.
     *
     * @return static New instance with the updated `dropdownDefaultDefinitions` value.
     */
    public function dropdownDefaultDefinitions(array $values): static
    {
        $new = clone $this;

        $new->dropdownDefaultDefinitions = $values;

        return $new;
    }

    /**
     * Sets the menu items.
     *
     * Usage example:
     * ```php
     * \UIAwesome\Html\Core\Component\Menu::tag()->items(
     *     \UIAwesome\Html\Core\Component\Item::tag()->label('Home')->link('/'),
     *     \UIAwesome\Html\Core\Component\Item::tag()->label('About')->link('/about'),
     * );
     * ```
     *
     * @param Item|RenderableInterface ...$values Items to render in order inside the menu.
     *
     * @return static New instance with the updated `items` value.
     */
    public function items(Item|RenderableInterface ...$values): static
    {
        $new = clone $this;

        $new->items = array_values($values);

        return $new;
    }

    /**
     * Sets the CSS class assigned to the list item that wraps a nested dropdown menu.
     *
     * Usage example:
     * ```php
     * \UIAwesome\Html\Core\Component\Menu::tag()->listDropdownItemClass('nav-item dropdown');
     * ```
     *
     * @param string $value CSS class for the dropdown list item wrapper.
     *
     * @return static New instance with the updated `listDropdownItemClass` value.
     */
    public function listDropdownItemClass(string $value): static
    {
        $new = clone $this;

        $new->listDropdownItemClass = $value;

        return $new;
    }

    /**
     * Sets the separator rendered between consecutive items when {@see $type} is `breadcrumb`.
     *
     * Usage example:
     * ```php
     * \UIAwesome\Html\Core\Component\Menu::tag()->type('breadcrumb')->separator('/');
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
     * Sets the template composing the rendered items block (`{prefixItems}/{items}/{suffixItems}`).
     *
     * Usage example:
     * ```php
     * \UIAwesome\Html\Core\Component\Menu::tag()->templateItem('{prefixItems}{items}{suffixItems}');
     * ```
     *
     * @param string $value Template for the items block.
     *
     * @return static New instance with the updated `templateItem` value.
     */
    public function templateItem(string $value): static
    {
        $new = clone $this;

        $new->templateItem = $value;

        return $new;
    }

    /**
     * Sets the menu type controlling the wrapper tag.
     *
     * Usage example:
     * ```php
     * \UIAwesome\Html\Core\Component\Menu::tag()->type('breadcrumb');
     * ```
     *
     * @param string $value Menu type, for example `menu`, `breadcrumb`, `dropdown`, `nav`.
     *
     * @return static New instance with the updated `type` value.
     */
    public function type(string $value): static
    {
        $new = clone $this;

        $new->type = $value;

        return $new;
    }

    /**
     * Returns the tag instance representing the menu wrapper.
     *
     * @return Block Tag `<nav>` for the `breadcrumb` type and `<div>` otherwise. Subclasses can override to provide a
     * different wrapper.
     */
    protected function getTag(): BackedEnum
    {
        return match ($this->type) {
            'breadcrumb', 'nav', 'navigation' => Block::NAV,
            default => Block::DIV,
        };
    }

    /**
     * Loads the default definitions for the menu component.
     *
     * @return array<string, mixed> Default attribute values for the menu component.
     */
    protected function loadDefault(): array
    {
        return [
            'linkActiveTag' => 'a',
            'linkContainerTag' => false,
            'linkTag' => 'a',
            'template' => '{toggle}\n{prefix}\n{menu}\n{suffix}',
            'templateItem' => '{prefixItems}\n{items}\n{suffixItems}',
            'templateLinkItem' => '{icon}\n{label}\n{content}',
            'type' => 'menu',
        ];
    }

    /**
     * Renders the menu.
     *
     * @return string Rendered HTML for the menu, or an empty string if the menu has no items.
     */
    protected function run(): string
    {
        if ($this->items === []) {
            return '';
        }

        return $this->renderMenu();
    }

    /**
     * Returns the tag wrapping the rendered list, or `false` when the caller supplies the wrapper itself.
     *
     * The `dropdown` type renders no wrapper: {@see \UIAwesome\Html\Core\Component\Base\BaseDropdown} already encloses
     * the toggle and the list in its own container, and the list must stay a direct child of it.
     *
     * @return BackedEnum|false Tag wrapping the list, or `false` to emit the list unwrapped.
     */
    private function menuTag(): BackedEnum|false
    {
        return $this->type === 'dropdown' ? false : $this->getTag();
    }

    /**
     * Renders each item in {@see $items}, applying active/disabled/separator/first-last decoration, then wraps the
     * resulting lines with the configured list tag.
     *
     * @return string Rendered HTML for the items block, or an empty string if there are no items to render.
     */
    private function renderItems(): string
    {
        $lines = [];

        $n = count($this->items);

        foreach ($this->items as $i => $item) {
            if ($item instanceof BaseDropdown) {
                $item = SimpleFactory::configure($item, $this->dropdownDefaultDefinitions);

                $lines[] = $this->renderTag(
                    ['class' => $this->listDropdownItemClass],
                    $item->render(),
                    $this->listItemTag,
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

                if ($this->type === 'breadcrumb' && $i > 0) {
                    $item = $item->separator($this->separator);
                }

                $isDisabledd = $item->isDisabled();
                $isActive = $isDisabledd === false && $item->isActive();

                $item = $this->setActiveAndDisableClass($item, $isActive, $isDisabledd);
                $item = $this->setAriaCurrent($item, $isActive);
                $item = $this->setFirstAndLastClass($item, $i, $n);
                $item = $this->setLinkContainerTag($item);

                $lines[] = $item->render();
            }
        }

        $content = implode("\n", $lines);

        return $this->renderTag($this->listAttributes, $content, $this->listType);
    }

    /**
     * Renders the menu body by composing prefix/items/suffix through {@see $templateItem}, wrapping the result with the
     * menu tag returned by {@see getTag()}, then applying the outer {@see $template} that includes the toggle and
     * prefix/suffix sections.
     *
     * @return string Rendered HTML for the menu body, or an empty string if there are no items to render.
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

        $containerTag = $this->renderTag($this->getAttributes(), $items, $this->menuTag());

        return Template::render(
            $this->template,
            [
                '{toggle}' => $this->renderToggle(),
                '{prefix}' => $this->renderTag(
                    $this->prefixAttributes,
                    $this->prefix,
                    $this->prefixTag,
                ),
                '{menu}' => $containerTag,
                '{suffix}' => $this->renderTag(
                    $this->suffixAttributes,
                    $this->suffix,
                    $this->suffixTag,
                ),
            ],
        );
    }

    /**
     * Wraps content with the resolved tag, or returns it unwrapped when the tag is `false` or the content is empty.
     * String tags are resolved against {@see Lists}, {@see Inline}, and {@see Block} enums, falling back to
     * {@see Block::DIV}.
     *
     * @param mixed[] $attributes HTML attributes for the wrapping tag.
     * @param string $content Content to wrap.
     * @param BackedEnum|false|string $tag Tag enum, tag name, or `false` to skip wrapping.
     *
     * @return string Wrapped content when a tag is provided and content is not empty, or the original content
     * otherwise.
     */
    private function renderTag(array $attributes, string $content, BackedEnum|false|string $tag): string
    {
        if ($content === '' || $tag === false) {
            return $content;
        }

        if (is_string($tag)) {
            $tag = self::resolveTag($tag);
        }

        return Html::element($tag, $content, $attributes);
    }

    /**
     * Resolves a string tag name against {@see Lists}, {@see Inline}, and {@see Block} enums in order, falling back to
     * {@see Block::DIV} when no enum recognizes the value.
     *
     * @param string $name Tag name to resolve.
     *
     * @return BackedEnum Resolved enum case, or {@see Block::DIV} as a fallback.
     */
    private static function resolveTag(string $name): BackedEnum
    {
        $tag = Lists::tryFrom($name);

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

        return Block::DIV;
    }

    /**
     * Returns the item decorated with the active or disabled CSS classes based on its state, or unchanged when
     * neither flag applies.
     *
     * @param Item $item Item to decorate.
     * @param bool $isActive Whether the item is active.
     * @param bool $isDisabledd Whether the item is disabled.
     *
     * @return Item Decorated item with the active or disabled classes when applicable.
     */
    private function setActiveAndDisableClass(Item $item, bool $isActive, bool $isDisabledd): Item
    {
        if ($isDisabledd) {
            return $item
                ->linkClass($this->linkDisabledClass, true)
                ->listItemClass($this->listItemDisabledClass, true);
        }

        if ($isActive) {
            return $item
                ->active()
                ->linkClass($this->linkActiveClass, true)
                ->linkTag($this->linkActiveTag)
                ->listItemClass($this->listItemActiveClass, true);
        }

        return $item;
    }

    /**
     * Returns the item with the `aria-current` attribute applied to its link or list item when active and the
     * corresponding aria-current flag is enabled.
     *
     * @param Item $item Item to decorate.
     * @param bool $isActive Whether the item is active.
     *
     * @return Item Decorated item with the `aria-current` attribute when applicable.
     */
    private function setAriaCurrent(Item $item, bool $isActive): Item
    {
        if ($isActive === false) {
            return $item;
        }

        if ($this->isLinkAriaCurrent()) {
            return $item->linkAttributes(['aria-current' => $this->ariaCurrent]);
        }

        if ($this->isListItemAriaCurrent()) {
            return $item->listItemAttributes(['aria-current' => $this->ariaCurrent]);
        }

        return $item;
    }

    /**
     * Returns the item decorated with the first or last CSS classes when its index matches the boundary of the items
     * collection.
     *
     * @param Item $item Item to decorate.
     * @param int $i Index of the current item (zero-based).
     * @param int $n Total number of items.
     *
     * @return Item Decorated item with the first or last classes when applicable.
     */
    private function setFirstAndLastClass(Item $item, int $i, int $n): Item
    {
        if ($i === 0) {
            return $item
                ->linkClass($this->firstLinkClass, true)
                ->listItemClass($this->firstItemClass, true);
        }

        if ($i === $n - 1) {
            return $item
                ->linkClass($this->lastLinkClass, true)
                ->listItemClass($this->lastItemClass, true);
        }

        return $item;
    }

    /**
     * Returns the item with the configured link container tag applied when the item does not already declare one.
     *
     * @param Item $item Item to decorate.
     *
     * @return Item Decorated item with the link container tag applied when it does not already declare one.
     */
    private function setLinkContainerTag(Item $item): Item
    {
        if ($item->isLinkContainer() === false) {
            return $item->linkContainerTag($this->linkContainerTag);
        }

        return $item;
    }
}
