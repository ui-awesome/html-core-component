<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;

/**
 * Bootstrap5 toggle defaults for a navbar link that opens a nested dropdown.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Toggle::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\MenuDropdown::class)
 *     ->render();
 * ```
 *
 * @link https://getbootstrap.com/docs/5.3/components/navbar/#nav
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class MenuDropdown implements DefaultsProviderInterface
{
    public function getDefaults(BaseTag $tag): array
    {
        return [
            'ariaAttributes' => [['expanded' => 'false']],
            'class' => ['nav-link dropdown-toggle'],
            'content' => ['Dropdown'],
            'dataAttributes' => [['bs-toggle' => 'dropdown']],
            'link' => [],
            'role' => ['button'],
        ];
    }
}
