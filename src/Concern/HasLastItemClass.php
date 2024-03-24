<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

/**
 * Is used by widgets that implement the last item class method.
 */
trait HasLastItemClass
{
    /**
     * @psalm-var string|string[]
     */
    protected array|string $lastItemClass = '';
    protected bool $overrideLastItemClass = true;

    /**
     * Sets the `CSS` class that will be assigned to the last item.
     *
     * @param array|string $value The `CSS` class that will be assigned to the last item.
     * @param bool $override Whether to override the current last item class or not.
     *
     * @return static A new instance of the current class with the specified last item class.
     *
     * @psalm-param string|string[] $value The `CSS` class for the last item tag.
     */
    public function lastItemClass(array|string $value, bool $override = true): static
    {
        $new = clone $this;
        $new->lastItemClass = $value;
        $new->overrideLastItemClass = $override;

        return $new;
    }
}
