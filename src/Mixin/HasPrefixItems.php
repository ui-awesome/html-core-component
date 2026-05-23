<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Mixin;

use Stringable;
use UIAwesome\Html\Contracts\RenderableInterface;

use function implode;

/**
 * Provides an immutable API for prefix content rendered before the main item list of a component.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasPrefixItems
{
    /**
     * Prefix content rendered before the main item list.
     */
    protected string $prefixItems = '';

    /**
     * Sets the prefix content rendered before the main item list.
     *
     * Usage example:
     * ```php
     * $menu->prefixItems('Latest');
     * $menu->prefixItems('<span class="badge">New</span>');
     * ```
     *
     * @param RenderableInterface|string|Stringable ...$values Content fragments concatenated into the prefix block.
     *
     * @return static New instance with the updated `prefixItems` value.
     */
    public function prefixItems(string|Stringable|RenderableInterface ...$values): static
    {
        $new = clone $this;

        $new->prefixItems = implode('', $values);

        return $new;
    }
}
