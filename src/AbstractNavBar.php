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
    Concern\HasContainerCollection,
    Concern\HasPrefixCollection,
    Concern\HasSuffixCollection,
    Concern\HasTag,
    Concern\HasTemplate,
    Helper\CssClass,
    Helper\HTMLBuilder,
    Helper\Sanitize,
    Helper\Template,
    Interop\RenderInterface
};

/**
 * This class serves as a base for implementing various types of navbar components.
 */
abstract class AbstractNavBar extends Element implements RenderInterface
{
    use HasAttributes;
    use HasClass;
    use HasContainerCollection;
    use HasId;
    use HasPrefixCollection;
    use HasStyle;
    use HasSuffixCollection;
    use HasTag;
    use HasTemplate;

    protected array $attributes = [];
    protected array $brandAttributes = [];
    protected string $brandImage = '';
    protected string $brandLink = '';
    protected array $brandLinkAttributes = [];
    protected string $brandLinkTemplate = '';
    protected false|string $brandTag = false;
    protected string $brandTemplate = '';
    protected string $brandText = '';
    protected string $brandToggle = '';
    protected array $containerMenuAttributes = [];
    protected false|string $containerMenuTag = '';
    protected string $menu = '';
    /**
     * @psalm-var array<string, mixed>
     */
    protected array $menuDefaultDefinitions = [];

    /**
     * Set the `HTML` attributes for the brand container.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static A new instance of the current class with the specified brand container attributes.
     */
    public function brandAttributes(array $values): static
    {
        $new = clone $this;
        $new->brandAttributes = $values;

        return $new;
    }

    /**
     * Set the `CSS` class for the brand container.
     *
     * @param string $value The `CSS` class for the brand container.
     * @param bool $override If `true` the value will be overridden.
     *
     * @return static A new instance of the current class with the specified brand container class.
     */
    public function brandClass(string $value, bool $override = false): static
    {
        $new = clone $this;
        CssClass::add($new->brandAttributes, $value, $override);

        return $new;
    }

    /**
     * Set the brand image.
     *
     * @param RenderInterface|string $value The brand image.
     *
     * @return static A new instance of the current class with the specified brand image.
     */
    public function brandImage(string|RenderInterface ...$value): static
    {
        $new = clone $this;
        $new->brandImage = Sanitize::html(...$value);

        return $new;
    }

    /**
     * Set the brand link.
     *
     * @param string $value The brand link.
     *
     * @return static A new instance of the current class with the specified brand link.
     */
    public function brandLink(string $value): static
    {
        $new = clone $this;
        $new->brandLink = $value;

        return $new;
    }

    /**
     * Set the `HTML` attributes for the brand link.
     *
     * @return static A new instance of the current class with the specified brand link attributes.
     */
    public function brandLinkAttributes(array $value): static
    {
        $new = clone $this;
        $new->brandLinkAttributes = $value;

        return $new;
    }

    /**
     * Set the `CSS` class for the brand link.
     *
     * @param string $value The `CSS` class for the brand link.
     * @param bool $override If `true` the value will be overridden.
     *
     * @return static A new instance of the current class with the specified brand link class.
     */
    public function brandLinkClass(string $value, bool $override = false): static
    {
        $new = clone $this;
        CssClass::add($new->brandLinkAttributes, $value, $override);

        return $new;
    }

    /**
     * Set the brand link template.
     *
     * @param string $value The brand link template.
     *
     * @return static A new instance of the current class with the specified brand link template.
     */
    public function brandLinkTemplate(string $value): static
    {
        $new = clone $this;
        $new->brandLinkTemplate = $value;

        return $new;
    }

    /**
     * Set the brand tag.
     *
     * @param false|string $value The tag name for the brand element.
     * If `false` the brand tag will be disabled.
     *
     * @throws \InvalidArgumentException If the tag name is an empty string.
     *
     * @return static A new instance of the current class with the specified brand tag.
     * If `false` the brand tag will be disabled.
     */
    public function brandTag(false|string $value = 'div'): static
    {
        $new = clone $this;
        $new->brandTag = $value;

        return $new;
    }

    /**
     * Set the brand template.
     * The following tokens are recognized: `{image}` and `{text}`.
     *
     * @param string $value The brand template.
     *
     * @return static A new instance of the current class with the specified brand template.
     */
    public function brandTemplate(string $value): static
    {
        $new = clone $this;
        $new->brandTemplate = $value;

        return $new;
    }

    /**
     * Set the brand text.
     *
     * @param RenderInterface|string $value The brand text.
     *
     * @return static A new instance of the current class with the specified brand text.
     */
    public function brandText(string|RenderInterface ...$value): static
    {
        $new = clone $this;
        $new->brandText = Sanitize::html(...$value);

        return $new;
    }

    /**
     * Set the brand toggle.
     *
     * @param RenderInterface|string $value The brand toggle.
     *
     * @return static A new instance of the current class with the specified brand toggle.
     */
    public function brandToggle(string|RenderInterface ...$value): static
    {
        $new = clone $this;
        $new->brandToggle = Sanitize::html(...$value);

        return $new;
    }

    /**
     * Set the `HTML` attributes for the container menu.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static A new instance of the current class with the specified container menu attributes.
     */
    public function containerMenuAttributes(array $values = []): static
    {
        $new = clone $this;
        $new->containerMenuAttributes = $values;

        return $new;
    }

    /**
     * Set the `CSS` class for the container menu.
     *
     * @param string $value The CSS class name.
     * @param bool $override If `true` the value will be overridden.
     *
     * @return static A new instance of the current class with the specified container menu class.
     */
    public function containerMenuClass(string $value, bool $override = false): static
    {
        $new = clone $this;
        CssClass::add($new->containerMenuAttributes, $value, $override);

        return $new;
    }

    /**
     * Set the container menu tag.
     *
     * @param false|string $value The tag name for the container menu element.
     * If `false` the container menu tag will be disabled.
     *
     * @throws \InvalidArgumentException If the tag name is an empty string.
     *
     * @return static A new instance of the current class with the specified container menu tag.
     * If `false` the container menu tag will be disabled.
     */
    public function containerMenuTag(false|string $value = 'div'): static
    {
        if ($value === '') {
            throw new \InvalidArgumentException('The container menu tag must be a non-empty string.');
        }

        $new = clone $this;
        $new->containerMenuTag = $value;

        return $new;
    }

    /**
     * Set the menu items.
     *
     * @param Menu $value The menu items.
     *
     * @return static A new instance of the current class with the specified menu items.
     */
    public function menu(Menu $value): static
    {
        /** @var Menu $value */
        $value = SimpleFactory::configure($value, $this->menuDefaultDefinitions);

        $new = clone $this;
        $new->menu = Sanitize::html($value);

        return $new;
    }

    /**
     * Set the default definitions for the menu.
     *
     * @param array $values The default definitions for the menu.
     *
     * @return static A new instance of the current class with the specified default definitions for the menu.
     *
     * @psalm-param array<string, mixed> $values
     */
    public function menuDefaultDefinitions(array $values): static
    {
        $new = clone $this;
        $new->menuDefaultDefinitions = $values;

        return $new;
    }

    /**
     * Loads the default definitions for the navbar component.
     *
     * @return array The default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        return [
            'brandLinkTemplate()' => ['{image}\n{text}'],
            'brandTemplate()' => ['{link}\n{toggle}'],
            'containerMenuTag()' => [],
            'tag()' => ['nav'],
            'template()' => ['{brand}\n{prefix}\n{menu}\n{suffix}'],
        ];
    }

    /**
     * Renders the navbar component.
     *
     * This method generates the HTML representation of the navbar component with the specified content and attributes.
     *
     * @return string The rendered navbar component.
     */
    protected function run(): string
    {
        return $this->renderTag(
            $this->containerAttributes,
            $this->renderTag($this->attributes, $this->renderNavBar(), $this->tag),
            $this->containerTag
        );
    }

    /**
     * Renders the brand part of the navigation bar.
     *
     * @return string The rendered brand.
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
            $brandLink = HTMLBuilder::createTag('a', PHP_EOL . $brandLink . PHP_EOL, $brandAttributes);
        }

        $brand = Template::render(
            $this->brandTemplate,
            [
                '{link}' => $brandLink,
                '{toggle}' => $this->brandToggle,
            ],
        );

        return $this->renderTag($this->brandAttributes, $brand, $this->brandTag);
    }

    /**
     * Renders the menu part of the navigation bar.
     *
     * @return string The rendered menu.
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
                '{prefix}' => $this->renderTag($this->prefixAttributes, $this->prefix, $this->prefixTag),
                '{suffix}' => $this->renderTag($this->suffixAttributes, $this->suffix, $this->suffixTag),
            ],
        );

        return $this->renderTag($this->containerMenuAttributes, $content, $this->containerMenuTag);
    }

    /**
     * Renders a HTML tag with the provided attributes and content.
     *
     * @param array $attributes The attributes for the tag.
     * @param string $content The content of the tag.
     * @param false|string $tag The tag name. If false, the content will be returned as is.
     *
     * @return string The rendered HTML tag.
     */
    private function renderTag(array $attributes, string $content, false|string $tag): string
    {
        if ($content === '' || $tag === false) {
            return $content;
        }

        return HTMLBuilder::createTag($tag, $content, $attributes);
    }
}
