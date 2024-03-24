<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

/**
 * Is used by widgets that implement the template link item.
 */
trait HasTemplateLinkItem
{
    protected string $templateLinkItem = '';

    /**
     * Set the template for the menu link item.
     *
     * @param string $value The template for the menu link item.
     *
     * @return static A new instance of the current class with the specified template for the menu link item.
     */
    public function templateLinkItem(string $value): static
    {
        $new = clone $this;
        $new->templateLinkItem = $value;

        return $new;
    }
}
