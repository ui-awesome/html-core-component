<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Dropdown;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\SelectorLanguage;
use UIAwesome\Html\Core\Component\Toggle;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;
use UIAwesome\Html\Interop\Block;

/**
 * Bootstrap5 dropdown defaults tailored for a language selection menu.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Dropdown::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Dropdown\Language::class)
 *     ->items($item1, $item2)
 *     ->render();
 * ```
 *
 * @link https://getbootstrap.com/docs/5.3/components/dropdowns/
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Language implements DefaultsProviderInterface
{
    public function getDefaults(BaseTag $tag): array
    {
        return [
            'containerClass' => ['btn-group dropup ms-3'],
            'containerTag' => [Block::DIV],
            'linkActiveClass' => ['active'],
            'linkClass' => ['dropdown-item d-flex align-items-center'],
            'listClass' => ['dropdown-menu dropdown-menu-end shadow'],
            'toggle' => [Toggle::tag()->addDefaultProvider(SelectorLanguage::class)],
        ];
    }
}
