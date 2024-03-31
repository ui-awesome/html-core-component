<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

use UIAwesome\Html\Core\HTMLBuilder;

/**
 * Is used by widgets that implement the divider method.
 */
trait HasDivider
{
    protected string $divider = '';

    /**
     * Set the divider of the menu item.
     *
     * @param string $tagname The tag name of the divider.
     * @param array $attributes The attributes of the divider.
     *
     * @return static A new instance of the current class with the specified divider.
     */
    public function divider(string $tagname = 'hr', array $attributes = []): static
    {
        $new = clone $this;
        $new->divider = HTMLBuilder::createTag($tagname, attributes: $attributes);

        return $new;
    }
}
