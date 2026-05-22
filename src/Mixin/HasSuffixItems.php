<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Mixin;

use Stringable;
use UIAwesome\Html\Contracts\RenderableInterface;

use function implode;

/**
 * Provides an immutable API for suffix content rendered after the main item list of a component.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasSuffixItems
{
    /**
     * Suffix content rendered after the main item list.
     */
    protected string $suffixItems = '';

    /**
     * Sets the suffix content rendered after the main item list.
     *
     * Usage example:
     * ```php
     * $menu->suffixItems('See more');
     * $menu->suffixItems('<a href="/all">View all</a>');
     * ```
     *
     * @param string|Stringable|RenderableInterface ...$values Content fragments concatenated into the suffix block.
     *
     * @return static New instance with the updated `suffixItems` value.
     */
    public function suffixItems(string|Stringable|RenderableInterface ...$values): static
    {
        $new = clone $this;

        $new->suffixItems = implode('', $values);

        return $new;
    }
}
