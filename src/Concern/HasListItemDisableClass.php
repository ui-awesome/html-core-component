<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

/**
 * Is used by widgets which implement the list item disable class method.
 */
trait HasListItemDisableClass
{
    /**
     * @psalm-var string|string[]
     */
    protected array|string $listItemDisableClass = '';
    protected bool $overrideListItemDisableClass = false;

    /**
     * Set the `CSS` class to be appended to the list item disable class.
     *
     * @param array|string $value The `CSS` class to be appended to the list item disable class.
     * @param bool $override Whether to override the current list item disable class or not.
     *
     * @return static A new instance of the current class with the specified list item disable class and override flag.
     *
     * @psalm-param string|string[] $value
     */
    public function listItemDisableClass(array|string $value, bool $override = false): static
    {
        $new = clone $this;
        $new->listItemDisableClass = $value;
        $new->overrideListItemDisableClass = $override;

        return $new;
    }
}
