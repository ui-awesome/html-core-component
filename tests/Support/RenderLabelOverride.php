<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Support;

use Override;
use UIAwesome\Html\Core\Component\Item;

/**
 * Subclass that overrides {@see \UIAwesome\Html\Core\Component\Attribute\HasLabelCollection::renderLabel()} with PHP's
 * `#[Override]` attribute.
 *
 * Loading the class fails fatally when the parent method is not inheritable (for example, when a mutation flips the
 * trait method visibility from `protected` to `private`), which makes any test instantiating it detect the
 * {@see https://infection.github.io/guide/mutators.html#ProtectedVisibility} mutator.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class RenderLabelOverride extends Item
{
    #[Override]
    protected function renderLabel(string $label): string
    {
        return parent::renderLabel($label);
    }
}
