<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

/**
 * Is used by widgets that implement the first item class method.
 */
trait HasFirstItemClass
{
    /**
     * @psalm-var string|string[]
     */
    protected array|string $firstItemClass = '';
    protected bool $overrideFirstItemClass = true;

    /**
     * Sets the `CSS` class that will be assigned to the first item.
     *
     * @param array|string $value The `CSS` class that will be assigned to the first item.
     * @param bool $override Whether to override the current first item class or not.
     *
     * @return static A new instance of the current class with the specified first item class.
     *
     * @psalm-param string|string[] $value The `CSS` class for the first item tag.
     */
    public function firstItemClass(array|string $value, bool $override = true): static
    {
        $new = clone $this;
        $new->firstItemClass = $value;
        $new->overrideFirstItemClass = $override;

        return $new;
    }
}
