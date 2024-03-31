<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use PHPForge\Widget\Element;
use UIAwesome\Html\{
    Attribute\Aria\HasAriaControls,
    Attribute\Aria\HasAriaExpanded,
    Attribute\Aria\HasAriaLabel,
    Attribute\Aria\HasRole,
    Attribute\Data\HasDataBsAutoClose,
    Attribute\Data\HasDataBsDismiss,
    Attribute\Data\HasDataBsTarget,
    Attribute\Data\HasDataBsToggle,
    Attribute\Data\HasDataCollapseToggle,
    Attribute\Data\HasDataDismissTarget,
    Attribute\Data\HasDataDrawerTarget,
    Attribute\Data\HasDataDropdownToggle,
    Attribute\Data\HasDataToggle,
    Attribute\Data\HasDataValue,
    Attribute\HasClass,
    Attribute\HasData,
    Attribute\HasId,
    Attribute\HasName,
    Attribute\HasStyle,
    Attribute\HasTabindex,
    Attribute\HasTitle,
    Concern\HasAttributes,
    Concern\HasContent,
    Concern\HasTemplate,
    Core\Component\Concern\HasIconCollection,
    Core\Component\Concern\HasToggleCollection,
    Core\Component\Interop\ToggleInterface,
    Core\HTMLBuilder,
    Graphic\Svg,
    Helper\Template
};

/**
 * This class serves as a base for implementing various types of toggle components.
 */
abstract class AbstractToggle extends Element implements ToggleInterface
{
    use HasAriaControls;
    use HasAriaExpanded;
    use HasAriaLabel;
    use HasAttributes;
    use HasClass;
    use HasContent;
    use HasData;
    use HasDataBsAutoClose;
    use HasDataBsDismiss;
    use HasDataBsTarget;
    use HasDataBsToggle;
    use HasDataCollapseToggle;
    use HasDataDismissTarget;
    use HasDataDrawerTarget;
    use HasDataDropdownToggle;
    use HasDataToggle;
    use HasDataValue;
    use HasIconCollection;
    use HasId;
    use HasName;
    use HasRole;
    use HasStyle;
    use HasTabindex;
    use HasTemplate;
    use HasTitle;
    use HasToggleCollection;

    protected array $attributes = [];
    protected string $tagName = 'button';

    /**
     * Set tag name to `a` for the toggle.
     *
     * @return self A new instance of the current class with the specified tag name.
     */
    public function link(): self
    {
        $new = clone $this;
        $new->tagName = 'a';

        return $new;
    }

    /**
     * Loads the default definitions for the toggle component.
     *
     * @return array The default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        return [
            'template()' => ['{toggle}\n{icon}\n{content}'],
        ];
    }

    /**
     * Run the toggle widget.
     *
     * It generates the toggle button with the specified content and attributes.
     *
     * @return string The HTML representation of the element.
     */
    protected function run(): string
    {
        $attributes = $this->attributes;
        $attributes['type'] = 'button';

        if ($this->ariaControls === true) {
            $attributes['aria-controls'] = $this->dataValue;
        }

        if ($this->dataBsAutoClose === true) {
            $attributes['data-bs-auto-close'] = $this->dataValue;
        }

        if ($this->dataBsDismiss === true) {
            $attributes['data-bs-dismiss'] = $this->dataValue;
        }

        if ($this->dataBsTarget === true) {
            $attributes['data-bs-target'] = "#$this->dataValue";
        }

        if ($this->dataBsToggle === true) {
            $attributes['data-bs-toggle'] = $this->dataValue;
        }

        if ($this->dataCollapseToggle === true) {
            $attributes['data-collapse-toggle'] = $this->dataValue;
        }

        if ($this->dataDismissTarget === true) {
            $attributes['data-dismiss-target'] = "#$this->dataValue";
        }

        if ($this->dataDrawerTarget === true) {
            $attributes['data-drawer-target'] = $this->dataValue;
        }

        if ($this->dataDropdownToggle === true) {
            $attributes['data-dropdown-toggle'] = $this->dataValue;
        }

        if ($this->dataToggle === true) {
            $attributes['data-toggle'] = $this->dataValue;
        }

        if ($this->tagName === 'a' && $this->role === true) {
            $attributes['role'] = 'role';
        }

        $icon = match ($this->iconTag) {
            'i' => HTMLBuilder::createTag('i', $this->iconContent, $this->iconAttributes),
            'svg' => Svg::widget()
                ->attributes($this->iconAttributes)
                ->content($this->iconContent)
                ->filePath($this->iconFilePath)
                ->render(),
            default => '',
        };

        $tokenValues = [
            '{toggle}' => $this->renderTag($this->toggleAttributes, $this->toggleContent, $this->toggleTag),
            '{icon}' => $icon,
            '{content}' => $this->content,
        ];

        $content = Template::render($this->template, $tokenValues);
        $content = $content !== '' ? PHP_EOL . $content . PHP_EOL : '';

        return HTMLBuilder::createTag($this->tagName, $content, $attributes);
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
        if (($attributes === [] && $content === '') || $tag === false) {
            return $content;
        }

        return HTMLBuilder::createTag($tag, $content, $attributes);
    }
}
