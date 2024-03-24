<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

/**
 * Is used by widgets that implement the link active tag for active links.
 */
trait HasLinkActiveTag
{
    protected string|false $linkActiveTag = false;

    /**
     * Set the tag name for the link container element for active links.
     *
     * @param false|string $value The tag name for the link container element for active links.
     * If `false` the link container will be disabled.
     *
     * @throws \InvalidArgumentException If the tag name is not a string or `false`.
     *
     * @return static A new instance of the current class with the specified link container tag.
     * If `false` the link container will be disabled.
     */
    public function linkActiveTag(false|string $value): static
    {
        if ($value === '') {
            throw new \InvalidArgumentException(
                'The tag name for the link container element for active links cannot be empty.'
            );
        }

        $new = clone $this;
        $new->linkActiveTag = $value;

        return $new;
    }
}
