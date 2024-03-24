<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

/**
 * Is used by widgets that implement the link disable class method.
 */
trait HasLinkDisableClass
{
    /**
     * @psalm-var string|string[]
     */
    protected array|string $linkDisableClass = '';
    protected bool $overrideLinkDisableClass = false;

    /**
     * Sets the `CSS` class that will be assigned to the link when it is disabled.
     *
     * @param array|string $value The `CSS` class to be appended to the link disable class.
     * @param bool $override Whether to override the current link disable class or not.
     *
     * @return static A new instance of the current class with the specified link disable class and override flag.
     *
     * @psalm-param string|string[] $value
     */
    public function linkDisableClass(array|string $value, bool $override = false): static
    {
        $new = clone $this;
        $new->linkDisableClass = $value;
        $new->overrideLinkDisableClass = $override;

        return $new;
    }
}
