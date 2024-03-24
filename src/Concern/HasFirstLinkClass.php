<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

/**
 * Is used by widgets that implement the first link class method.
 */
trait HasFirstLinkClass
{
    /**
     * @psalm-var string|string[]
     */
    protected array|string $firstLinkClass = '';
    protected bool $overrideFirstLinkClass = true;

    /**
     * Set the `CSS` class that will be assigned to the first link.
     *
     * @param array|string $value The `CSS` class that will be assigned to the first link.
     * @param bool $override Whether to override the current first link class or not.
     *
     * @return static A new instance of the current class with the specified first link class.
     *
     * @psalm-param string|string[] $value The `CSS` class for the first link tag.
     */
    public function firstLinkClass(array|string $value, bool $override = true): static
    {
        $new = clone $this;
        $new->firstLinkClass = $value;
        $new->overrideFirstLinkClass = $override;

        return $new;
    }
}
