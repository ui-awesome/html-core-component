<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use PHPForge\Widget\Element;
use UIAwesome\Html\{
    Attribute\Aria\HasRole,
    Attribute\HasClass,
    Attribute\HasId,
    Attribute\HasStyle,
    Concern\HasAttributes,
    Concern\HasContainerCollection,
    Concern\HasContent,
    Concern\HasPrefixCollection,
    Concern\HasSuffixCollection,
    Concern\HasTemplate,
    Core\Component\Concern\HasToggle,
    Core\HTMLBuilder,
    Helper\Template,
    Helper\Utils,
    Interop\RenderInterface
};

use function is_string;

/**
 * This class serves as a base for implementing various types of alert components.
 */
abstract class AbstractAlert extends Element implements RenderInterface
{
    use HasAttributes;
    use HasClass;
    use HasContainerCollection;
    use HasContent;
    use HasId;
    use HasPrefixCollection;
    use HasRole;
    use HasStyle;
    use HasSuffixCollection;
    use HasTemplate;
    use HasToggle;

    protected array $attributes = [];

    /**
     * Loads the default definitions for the alert component.
     *
     * @return array The default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        return [
            'id()' => [Utils::generateId('alert-')],
            'role()' => ['alert'],
            'template()' => ['{prefix}\n{content}\n{suffix}\n{toggle}'],
        ];
    }

    /**
     * Renders the alert component.
     *
     * This method generates the HTML representation of the alert component with the specified content and attributes.
     *
     * @return string The rendered alert component.
     */
    protected function run(): string
    {
        if ($this->content === '') {
            return '';
        }

        $content = Template::render(
            $this->template,
            [
                '{prefix}' => $this->renderTag($this->prefixAttributes, $this->prefix, $this->prefixTag),
                '{content}' => $this->renderTag($this->containerAttributes, $this->content, $this->containerTag),
                '{suffix}' => $this->renderTag($this->suffixAttributes, $this->suffix, $this->suffixTag),
                '{toggle}' => $this->renderToggle(),
            ],
        );

        return HTMLBuilder::createTag('div', $content, $this->attributes);
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
