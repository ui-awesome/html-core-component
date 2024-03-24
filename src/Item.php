<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use PHPForge\Widget\Element;
use UIAwesome\Html\{
    Concern\HasContent,
    Concern\HasSeparator,
    Concern\HasTemplate,
    Core\Component\Concern\CanBeActivateItems,
    Core\Component\Concern\CanBeActive,
    Core\Component\Concern\CanBeDisable,
    Core\Component\Concern\CanBeVisible,
    Core\Component\Concern\HasCurrentPath,
    Core\Component\Concern\HasDivider,
    Core\Component\Concern\HasIconCollection,
    Core\Component\Concern\HasLink,
    Core\Component\Concern\HasLinkCollection,
    Core\Component\Concern\HasLinkContainerCollection,
    Core\Component\Concern\HasListItemCollection,
    Core\Component\Concern\HasTemplateLinkItem,
    Graphic\Svg,
    Helper\Encode,
    Helper\HTMLBuilder,
    Helper\Template,
    Interop\RenderInterface
};

class Item extends Element implements RenderInterface
{
    use CanBeActivateItems;
    use CanBeActive;
    use CanBeDisable;
    use CanBeVisible;
    use HasContent;
    use HasCurrentPath;
    use HasDivider;
    use HasIconCollection;
    use HasLink;
    use HasLinkCollection;
    use HasLinkContainerCollection;
    use HasListItemCollection;
    use HasSeparator;
    use HasTemplate;
    use HasTemplateLinkItem;

    protected array $items = [];
    protected string $label = '';
    protected string $separator = '';

    /**
     * Checks whether a menu item is active.
     *
     * @return bool `true` if the menu item is active, `false` otherwise.
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
     * Create a new instance specifying the items of the menu item.
     *
     * @param self ...$values The items of the menu item.
     *
     * @return static A new instance of the class with the specified items.
     */
    public function items(self ...$values): static
    {
        $new = clone $this;
        $new->items = $values;

        return $new;
    }

    /**
     * Create a new instance with the specified label content value.
     *
     * @param string $value The label content value.
     * @param bool $encode Whether to encode the label content value.
     *
     * @return static A new instance of the class with the specified label content value.
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
     * This method is used to configure the widget with the provided default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        return [
            'iconTag()' => [],
            'linkContainerTag()' => [false],
            'linkTag()' => [],
            'template()' => ['{separator}\n{link}'],
            'templateLinkItem()' => ['{icon}\n{label}\n{content}'],
        ];
    }

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
            ]
        );

        if ($content === '') {
            return '';
        }

        $linkContent = $this->renderTag($this->linkContainerAttributes, $content, $this->linkContainerTag);

        return match ($this->listItemTag) {
            false => $content,
            default => HTMLBuilder::createTag($this->listItemTag, $linkContent, $this->listItemAttributes),
        };
    }

    private function renderIcon(): string
    {
        return match ($this->iconTag) {
            'i' => $this->renderIconITag(),
            'svg' => $this->renderIconSvgTag(),
            default => '',
        };
    }

    private function renderIconITag(): string
    {
        if (isset($this->iconAttributes['class']) === false && $this->iconContent === '') {
            return '';
        }

        return HTMLBuilder::createTag('i', $this->iconContent, $this->iconAttributes);
    }

    private function renderIconSvgTag(): string
    {
        return PHP_EOL .
            Svg::widget()
                ->attributes($this->iconAttributes)
                ->content($this->iconContent)
                ->filePath($this->iconFilePath)
                ->render();
    }

    private function renderLabel(): string
    {
        return $this->label;
    }

    private function renderLink(): string
    {
        $linkAttributes = $this->linkAttributes;

        $contentLink = Template::render(
            $this->templateLinkItem,
            [
                '{content}' => $this->content,
                '{icon}' => $this->renderIcon(),
                '{label}' => $this->renderLabel(),
            ]
        );

        if ($this->link === '') {
            return $contentLink;
        }

        if ($this->iconTag === 'svg') {
            $contentLink .= PHP_EOL;
        }

        $linkAttributes['href'] = $this->link;

        return match ($this->linkTag) {
            'a' => HTMLBuilder::createTag('a', $contentLink, $linkAttributes),
            default => $this->renderTag($this->linkAttributes, $contentLink, $this->linkTag),
        };
    }

    private function renderTag(array $attributes, string $content, false|string $tag): string
    {
        if ($tag === false) {
            return $content;
        }

        return HTMLBuilder::createTag($tag, $content, $attributes);
    }
}
