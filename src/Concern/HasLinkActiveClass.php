<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

/**
 * Is used by widgets which implement the link active class method.
 */
trait HasLinkActiveClass
{
    /**
     * @psalm-var string|string[]
     */
    protected array|string $linkActiveClass = '';
    protected bool $overrideLinkActiveClass = false;

    /**
     * Set the `CSS` class to be appended to the link active class.
     *
     * @param array|string $value The `CSS` class to be appended to the link active class.
     * @param bool $override Whether to override the current link active class or not.
     *
     * @return static A new instance of the current class with the specified link active class and override flag.
     *
     * @psalm-param string|string[] $value
     */
    public function linkActiveClass(array|string $value, bool $override = false): static
    {
        $new = clone $this;
        $new->linkActiveClass = $value;
        $new->overrideLinkActiveClass = $override;

        return $new;
    }
}
