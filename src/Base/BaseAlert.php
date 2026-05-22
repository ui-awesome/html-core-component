<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Base;

use BackedEnum;
use UIAwesome\Html\Contracts\RenderableInterface;
use UIAwesome\Html\Core\Component\Mixin\HasToggle;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Helper\{Naming, Template};
use UIAwesome\Html\Interop\Block;
use UIAwesome\Html\Mixin\{HasContainerCollection, HasPrefixCollection, HasSuffixCollection, HasTemplate};
use UnitEnum;

/**
 * Provides the base implementation for alert components.
 *
 * Extend this class to render dismissible alerts with a prefix area, content area, suffix area, and an optional toggle
 * element. Subclasses inherit attribute, class, content, container, prefix, suffix, and template handling from
 * {@see BaseBlock} and the mixin traits.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
abstract class BaseAlert extends BaseBlock implements RenderableInterface
{
    use HasContainerCollection;
    use HasPrefixCollection;
    use HasSuffixCollection;
    use HasTemplate;
    use HasToggle;

    /**
     * Returns the tag instance representing the alert wrapper.
     *
     * @return BackedEnum Tag instance for the alert wrapper, typically `Block::DIV`.
     */
    protected function getTag(): BackedEnum
    {
        return Block::DIV;
    }

    /**
     * Loads the default definitions for the alert component.
     *
     * @return array<string, mixed> Default attribute values for the alert component.
     */
    protected function loadDefault(): array
    {
        return [
            'id' => [Naming::generateId('alert-')],
            'role' => ['alert'],
            'template' => ['{prefix}\n{content}\n{suffix}\n{toggle}'],
        ];
    }

    /**
     * Renders the alert.
     *
     * @return string Rendered HTML for the alert, or an empty string when no content is configured.
     */
    protected function run(): string
    {
        if ($this->getContent() === '') {
            return '';
        }

        $content = Template::render(
            $this->template,
            [
                '{prefix}' => $this->renderOptionalTag(
                    $this->prefixAttributes,
                    $this->prefix,
                    $this->prefixTag,
                ),
                '{content}' => $this->renderOptionalTag(
                    $this->containerAttributes,
                    $this->getContent(),
                    $this->containerTag,
                ),
                '{suffix}' => $this->renderOptionalTag(
                    $this->suffixAttributes,
                    $this->suffix,
                    $this->suffixTag,
                ),
                '{toggle}' => $this->renderToggle(),
            ],
        );

        return Html::element($this->getTag(), $content, $this->getAttributes());
    }

    /**
     * Wraps content with the optional tag, or returns it unwrapped when the tag is `false`, the content is empty, or
     * the tag does not resolve to a {@see BackedEnum}.
     *
     * @param mixed[] $attributes HTML attributes for the wrapping tag.
     * @param string $content Content to wrap.
     * @param false|UnitEnum $tag Tag enum or `false` to skip wrapping.
     *
     * @return string Wrapped content when the tag is valid and content is not empty, or the original content otherwise.
     */
    private function renderOptionalTag(array $attributes, string $content, false|UnitEnum $tag): string
    {
        if ($content === '' || $tag === false || $tag instanceof BackedEnum === false) {
            return $content;
        }

        return Html::element($tag, $content, $attributes);
    }
}
