<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

/**
 * Is used by widgets that implement the template item method.
 */
trait HasTemplateItem
{
    protected string $templateItem = '';

    /**
     * Set the template for the menu item.
     *
     * @param string $value The template for the menu item.
     *
     * @return static A new instance of the current class with the specified template for the menu item.
     */
    public function templateItem(string $value): static
    {
        $new = clone $this;
        $new->templateItem = $value;

        return $new;
    }
}
