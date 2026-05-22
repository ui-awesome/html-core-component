<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Base;

use BackedEnum;
use Stringable;
use UIAwesome\Html\Contracts\RenderableInterface;
use UIAwesome\Html\Core\Component\Menu;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Core\Factory\SimpleFactory;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Helper\{CSSClass, Template};
use UIAwesome\Html\Interop\{Block, Inline};
use UIAwesome\Html\Mixin\{HasContainerCollection, HasPrefixCollection, HasSuffixCollection, HasTemplate};

use function implode;

/**
 * Provides the base implementation for navigation bar components.
 *
 * Extend this class to render navigation bars with brand, menu, and collapsible toggle elements. The wrapper tag
 * defaults to `<nav>` and supports brand, container, prefix, and suffix sections.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
abstract class BaseNavBar extends BaseBlock implements RenderableInterface
{
    use HasContainerCollection;
    use HasPrefixCollection;
    use HasSuffixCollection;
    use HasTemplate;

    /**
     * @var mixed[] HTML attributes for the brand container.
     */
    protected array $brandAttributes = [];
    /**
     * Brand image markup rendered inside the brand link template.
     */
    protected string $brandImage = '';
    /**
     * Target href applied to the brand link.
     */
    protected string $brandLink = '';
    /**
     * @var mixed[] HTML attributes for the brand link.
     */
    protected array $brandLinkAttributes = [];
    /**
     * Template composing the brand link content (`{image}/{text}`).
     */
    protected string $brandLinkTemplate = '';
    /**
     * Tag wrapping the brand block, or `false` to skip wrapping.
     */
    protected false|BackedEnum $brandTag = false;
    /**
     * Template composing the brand block (`{link}/{toggle}`).
     */
    protected string $brandTemplate = '';
    /**
     * Brand text content rendered inside the brand link template.
     */
    protected string $brandText = '';
    /**
     * Markup of the brand-side toggle rendered alongside the brand link.
     */
    protected string $brandToggle = '';
    /**
     * @var mixed[] HTML attributes for the container wrapping the menu block.
     */
    protected array $containerMenuAttributes = [];
    /**
     * Tag wrapping the menu block, or `false` to skip wrapping.
     */
    protected false|BackedEnum $containerMenuTag = false;
    /**
     * Pre-rendered menu markup composed by {@see menu()}.
     */
    protected string $menu = '';
    /**
     * @var mixed[] Default configuration applied to the nested {@see Menu} via {@see SimpleFactory::configure()}.
     */
    protected array $menuDefaultDefinitions = [];

    /**
     * Sets the HTML attributes for the brand container.
     *
     * @param mixed[] $values HTML attributes for the brand container.
     *
     * @return static New instance with the updated `brandAttributes` value.
     */
    public function brandAttributes(array $values): static
    {
        $new = clone $this;

        $new->brandAttributes = $values;

        return $new;
    }

    /**
     * Adds a CSS class to the brand container attributes.
     *
     * @param string $value CSS class for the brand container.
     * @param bool $override Whether to override the existing classes (defaults to `false`).
     *
     * @return static New instance with the updated brand container class attribute.
     */
    public function brandClass(string $value, bool $override = false): static
    {
        $new = clone $this;

        CSSClass::add($new->brandAttributes, $value, $override);

        return $new;
    }

    /**
     * Sets the brand image markup.
     *
     * @param RenderableInterface|string|Stringable ...$value Content joined to form the brand image markup.
     *
     * @return static New instance with the updated `brandImage` value.
     */
    public function brandImage(string|Stringable|RenderableInterface ...$value): static
    {
        $new = clone $this;

        $new->brandImage = implode('', $value);

        return $new;
    }

    /**
     * Sets the brand link href.
     *
     * @param string $value URL for the brand link.
     *
     * @return static New instance with the updated `brandLink` value.
     */
    public function brandLink(string $value): static
    {
        $new = clone $this;

        $new->brandLink = $value;

        return $new;
    }

    /**
     * Sets the HTML attributes for the brand link.
     *
     * @param mixed[] $value HTML attributes for the brand link.
     *
     * @return static New instance with the updated `brandLinkAttributes` value.
     */
    public function brandLinkAttributes(array $value): static
    {
        $new = clone $this;

        $new->brandLinkAttributes = $value;

        return $new;
    }

    /**
     * Adds a CSS class to the brand link attributes.
     *
     * @param string $value CSS class for the brand link.
     * @param bool $override Whether to override the existing classes (defaults to `false`).
     *
     * @return static New instance with the updated brand link class attribute.
     */
    public function brandLinkClass(string $value, bool $override = false): static
    {
        $new = clone $this;

        CSSClass::add($new->brandLinkAttributes, $value, $override);

        return $new;
    }

    /**
     * Sets the template composing the brand link content.
     *
     * @param string $value Template for the brand link (typically `{image}/{text}`).
     *
     * @return static New instance with the updated `brandLinkTemplate` value.
     */
    public function brandLinkTemplate(string $value): static
    {
        $new = clone $this;

        $new->brandLinkTemplate = $value;

        return $new;
    }

    /**
     * Sets the tag wrapping the brand block, or `false` to skip wrapping.
     *
     * @param BackedEnum|false $value Tag enum, or `false` to skip wrapping (defaults to `Block::DIV`).
     *
     * @return static New instance with the updated `brandTag` value.
     */
    public function brandTag(false|BackedEnum $value = Block::DIV): static
    {
        $new = clone $this;

        $new->brandTag = $value;

        return $new;
    }

    /**
     * Sets the template composing the brand block.
     *
     * @param string $value Template for the brand block (typically `{link}/{toggle}`).
     *
     * @return static New instance with the updated `brandTemplate` value.
     */
    public function brandTemplate(string $value): static
    {
        $new = clone $this;

        $new->brandTemplate = $value;

        return $new;
    }

    /**
     * Sets the brand text content.
     *
     * @param RenderableInterface|string|Stringable ...$value Content joined to form the brand text.
     *
     * @return static New instance with the updated `brandText` value.
     */
    public function brandText(string|Stringable|RenderableInterface ...$value): static
    {
        $new = clone $this;

        $new->brandText = implode('', $value);

        return $new;
    }

    /**
     * Sets the markup of the brand-side toggle rendered alongside the brand link.
     *
     * @param RenderableInterface|string|Stringable ...$value Content joined to form the brand toggle markup.
     *
     * @return static New instance with the updated `brandToggle` value.
     */
    public function brandToggle(string|Stringable|RenderableInterface ...$value): static
    {
        $new = clone $this;

        $new->brandToggle = implode('', $value);

        return $new;
    }

    /**
     * Sets the HTML attributes for the container wrapping the menu block.
     *
     * @param mixed[] $values HTML attributes for the container menu.
     *
     * @return static New instance with the updated `containerMenuAttributes` value.
     */
    public function containerMenuAttributes(array $values = []): static
    {
        $new = clone $this;

        $new->containerMenuAttributes = $values;

        return $new;
    }

    /**
     * Adds a CSS class to the container menu attributes.
     *
     * @param string $value CSS class for the container menu.
     * @param bool $override Whether to override the existing classes (defaults to `false`).
     *
     * @return static New instance with the updated container menu class attribute.
     */
    public function containerMenuClass(string $value, bool $override = false): static
    {
        $new = clone $this;

        CSSClass::add($new->containerMenuAttributes, $value, $override);

        return $new;
    }

    /**
     * Sets the tag wrapping the menu block, or `false` to skip wrapping.
     *
     * @param BackedEnum|false $value Tag enum, or `false` to skip wrapping (defaults to `Block::DIV`).
     *
     * @return static New instance with the updated `containerMenuTag` value.
     */
    public function containerMenuTag(false|BackedEnum $value = Block::DIV): static
    {
        $new = clone $this;

        $new->containerMenuTag = $value;

        return $new;
    }

    /**
     * Sets the menu instance rendered inside the navbar body.
     *
     * The instance is configured with {@see $menuDefaultDefinitions} via {@see SimpleFactory::configure()} before being
     * cast to its rendered string form.
     *
     * @param Menu $value Menu instance to render inside the navbar body.
     *
     * @return static New instance with the updated `menu` value.
     */
    public function menu(Menu $value): static
    {
        $value = SimpleFactory::configure($value, $this->menuDefaultDefinitions);

        $new = clone $this;

        $new->menu = (string) $value;

        return $new;
    }

    /**
     * Sets the default definitions applied to the nested {@see Menu} via {@see SimpleFactory::configure()}.
     *
     * @param mixed[] $values Cookbook-style associative array of method names and arguments.
     *
     * @return static New instance with the updated `menuDefaultDefinitions` value.
     */
    public function menuDefaultDefinitions(array $values): static
    {
        $new = clone $this;

        $new->menuDefaultDefinitions = $values;

        return $new;
    }

    /**
     * Returns the tag instance representing the navbar wrapper.
     *
     * @return BackedEnum Tag instance for the navbar wrapper, typically `Block::NAV`.
     */
    protected function getTag(): BackedEnum
    {
        return Block::NAV;
    }

    /**
     * Loads the default definitions for the navbar component.
     *
     * @return array<string, mixed> Default attribute values for the navbar component.
     */
    protected function loadDefault(): array
    {
        return [
            'brandLinkTemplate' => ['{image}\n{text}'],
            'brandTemplate' => ['{link}\n{toggle}'],
            'template' => ['{brand}\n{prefix}\n{menu}\n{suffix}'],
        ];
    }

    /**
     * Renders the navbar.
     *
     * @return string Rendered HTML for the navbar, or an empty string when no menu is configured.
     */
    protected function run(): string
    {
        return $this->renderTag(
            $this->containerAttributes,
            $this->renderTag(
                $this->getAttributes(),
                $this->renderNavBar(),
                $this->getTag(),
            ),
            $this->containerTag,
        );
    }

    /**
     * Renders the brand block by composing the brand image and text through the brand link template, wrapping the
     * result in an `<a>` tag when {@see $brandLink} is set, then applying the brand template that includes the
     * brand-side toggle.
     *
     * @return string Rendered HTML for the brand block, or an empty string when the brand tag is `false` and the brand
     * template produces no content.
     */
    private function renderBrand(): string
    {
        $brandLink = Template::render(
            $this->brandLinkTemplate,
            [
                '{image}' => $this->brandImage,
                '{text}' => $this->brandText,
            ],
        );

        if ($this->brandLink !== '') {
            $brandAttributes = $this->brandLinkAttributes;
            $brandAttributes['href'] = $this->brandLink;
            $brandLink = Html::element(Inline::A, PHP_EOL . $brandLink . PHP_EOL, $brandAttributes);
        }

        $brand = Template::render(
            $this->brandTemplate,
            [
                '{link}' => $brandLink,
                '{toggle}' => $this->brandToggle,
            ],
        );

        return $this->renderTag(
            $this->brandAttributes,
            $brand,
            $this->brandTag,
        );
    }

    /**
     * Renders the navbar body by composing brand, prefix, menu, and suffix through {@see $template}, then wraps the
     * result with the container menu tag.
     *
     * @return string Rendered HTML for the navbar body, or an empty string when no menu is configured.
     */
    private function renderNavBar(): string
    {
        if ($this->menu === '') {
            return '';
        }

        $content = Template::render(
            $this->template,
            [
                '{brand}' => $this->renderBrand(),
                '{menu}' => $this->menu,
                '{prefix}' => $this->renderTag(
                    $this->prefixAttributes,
                    $this->prefix,
                    $this->prefixTag,
                ),
                '{suffix}' => $this->renderTag(
                    $this->suffixAttributes,
                    $this->suffix,
                    $this->suffixTag,
                ),
            ],
        );

        return $this->renderTag(
            $this->containerMenuAttributes,
            $content,
            $this->containerMenuTag,
        );
    }

    /**
     * Wraps content with the resolved tag, or returns it unwrapped when the tag is `false` or the content is empty.
     *
     * @param mixed[] $attributes HTML attributes for the wrapping tag.
     * @param string $content Content to wrap.
     * @param BackedEnum|false $tag Tag enum, or `false` to skip wrapping.
     *
     * @return string Wrapped content when a tag is provided and content is not empty, or the original content
     * otherwise.
     */
    private function renderTag(array $attributes, string $content, false|BackedEnum $tag): string
    {
        if ($content === '' || $tag === false) {
            return $content;
        }

        return Html::element($tag, $content, $attributes);
    }
}
