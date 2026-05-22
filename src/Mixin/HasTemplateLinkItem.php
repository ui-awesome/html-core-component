<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Mixin;

/**
 * Provides an immutable API for the template used to compose the link content of a menu item.
 *
 * The template supports the placeholders `{icon}`, `{label}`, and `{content}`, which are substituted with the
 * respective values of the consuming {@see \UIAwesome\Html\Core\Component\Item}.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasTemplateLinkItem
{
    /**
     * Template used to compose the link content of a menu item.
     */
    protected string $templateLinkItem = '';

    /**
     * Sets the template used to compose the link content of a menu item.
     *
     * Usage example:
     * ```php
     * $menu->templateLinkItem('{icon}\n{label}\n{content}');
     * ```
     *
     * @param string $value Template with `{icon}`, `{label}`, and `{content}` placeholders.
     *
     * @return static New instance with the updated `templateLinkItem` value.
     */
    public function templateLinkItem(string $value): static
    {
        $new = clone $this;

        $new->templateLinkItem = $value;

        return $new;
    }
}
