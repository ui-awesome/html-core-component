<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

/**
 * Is used by widgets that implement the last link class method.
 */
trait HasLastLinkClass
{
    /**
     * @psalm-var string|string[]
     */
    protected array|string $lastLinkClass = '';
    protected bool $overrideLastLinkClass = true;

    /**
     * Sets the `CSS` class that will be assigned to the active link.
     *
     * @param array|string $value The `CSS` class that will be assigned to the last link.
     * @param bool $override Whether to override the current last link class or not.
     *
     * @return static A new instance of the current class with the specified last link class.
     *
     * @psalm-param string|string[] $value The `CSS` class for the last link tag.
     */
    public function lastLinkClass(array|string $value, bool $override = true): static
    {
        $new = clone $this;
        $new->lastLinkClass = $value;
        $new->overrideLastLinkClass = $override;

        return $new;
    }
}
