<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;

/**
 * Bootstrap5 toggle defaults for the button that opens a dropdown menu.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Toggle::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\Dropdown::class)
 *     ->render();
 * ```
 *
 * @link https://getbootstrap.com/docs/5.3/components/dropdowns/
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Dropdown implements DefaultsProviderInterface
{
    public function getDefaults(BaseTag $tag): array
    {
        return [
            'ariaAttributes' => [['expanded' => 'false']],
            'class' => ['btn btn-secondary dropdown-toggle'],
            'content' => ['Dropdown button'],
            'dataAttributes' => [['bs-toggle' => 'dropdown']],
        ];
    }
}
