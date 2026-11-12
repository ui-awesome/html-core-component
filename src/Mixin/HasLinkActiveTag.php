<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Mixin;

use InvalidArgumentException;
use UIAwesome\Html\Core\Component\Exception\Message;

/**
 * Provides an immutable API for the HTML tag used to render the active link of a menu item.
 *
 * Consumed by {@see \UIAwesome\Html\Core\Component\Menu} to swap the default `<a>` tag with an alternative (commonly
 * `<span>`) when an item is rendered in the active state.
 */
trait HasLinkActiveTag
{
    /**
     * Tag name for the active link, or `false` to disable the link wrapper on active items.
     */
    protected string|false $linkActiveTag = false;

    /**
     * Sets the tag name for the active link, or `false` to disable the link wrapper on active items.
     *
     * @param false|string $value Tag name for the active link, or `false` to drop the link wrapper.
     *
     * @throws InvalidArgumentException When the value is the empty string.
     *
     * @return static New instance with the updated `linkActiveTag` value.
     */
    public function linkActiveTag(false|string $value): static
    {
        if ($value === '') {
            throw new InvalidArgumentException(
                Message::LINK_ACTIVE_TAG_CANNOT_BE_EMPTY->getMessage(),
            );
        }

        $new = clone $this;
        $new->linkActiveTag = $value;

        return $new;
    }
}
