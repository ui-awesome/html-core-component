<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Support;

use Override;
use UIAwesome\Html\Core\Component\Item;

/**
 * Subclass that overrides {@see \UIAwesome\Html\Core\Component\Attribute\HasIconCollection::renderIcon()} with PHP's
 * `#[Override]` attribute.
 *
 * Loading the class fails fatally when the parent method is not inheritable (for example, when a mutation flips the
 * trait method visibility from `protected` to `private`), which makes any test instantiating it detect the
 * {@see https://infection.github.io/guide/mutators.html#ProtectedVisibility} mutator.
 */
final class RenderIconOverride extends Item
{
    #[Override]
    protected function renderIcon(): string
    {
        return parent::renderIcon();
    }
}
