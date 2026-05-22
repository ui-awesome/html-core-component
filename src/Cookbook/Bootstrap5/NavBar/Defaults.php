<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\NavBar;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\{Menu, MenuDropdown};
use UIAwesome\Html\Core\Component\Toggle;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;
use UIAwesome\Html\Interop\Block;

/**
 * Bootstrap5 navbar defaults providing the default expand-on-large layout.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\NavBar::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\NavBar\Defaults::class)
 *     ->menu($menu)
 *     ->render();
 * ```
 *
 * @link https://getbootstrap.com/docs/5.3/components/navbar/
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Defaults implements DefaultsProviderInterface
{
    public function getDefaults(BaseTag $tag): array
    {
        return [
            'brandLinkClass' => 'navbar-brand',
            'class' => 'navbar navbar-expand-lg bg-body-tertiary',
            'containerMenuClass' => 'container-fluid',
            'containerMenuTag' => Block::DIV,
            'menuDefaultDefinitions' => [
                [
                    'class' => 'collapse navbar-collapse',
                    'dropdownDefaultDefinitions' => [
                        [
                            'linkClass' => 'dropdown-item',
                            'listClass' => 'dropdown-menu',
                            'toggle' => Toggle::tag()->addDefaultProvider(MenuDropdown::class),
                        ],
                    ],
                    'linkActiveClass' => 'active',
                    'linkAriaCurrent' => [],
                    'linkClass' => 'nav-link',
                    'linkDisabledClass' => 'disabled',
                    'listClass' => 'navbar-nav me-auto mb-2 mb-lg-0',
                    'listDropdownItemClass' => 'nav-item dropdown',
                    'listItemClass' => 'nav-item',
                    'toggle' => Toggle::tag()->addDefaultProvider(Menu::class),
                ],
            ],
        ];
    }
}
