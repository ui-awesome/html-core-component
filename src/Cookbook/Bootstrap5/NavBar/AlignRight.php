<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\NavBar;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\MenuDropdown;
use UIAwesome\Html\Core\Component\Toggle;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;
use UIAwesome\Html\Interop\Block;

/**
 * Bootstrap5 navbar defaults aligning menu items to the right.
 *
 * The cookbook does not provide a collapse toggle.
 *
 * See {@see \UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\Menu} for the explicit wiring required to make
 * Bootstrap collapse plugin locate the target.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\NavBar::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\NavBar\AlignRight::class)
 *     ->menu($menu)
 *     ->render();
 * ```
 *
 * @see https://getbootstrap.com/docs/5.3/components/navbar/#placement
 */
final class AlignRight implements DefaultsProviderInterface
{
    /**
     * Returns the Bootstrap5 right-aligned `navbar` default method-call definitions for the tag.
     *
     * @param BaseTag $tag Tag the provider is decorating.
     *
     * @return array<string, mixed> Method-call definitions merged into the tag at render time.
     */
    public function getDefaults(BaseTag $tag): array
    {
        return [
            'brandLinkClass' => 'navbar-brand',
            'class' => 'navbar navbar-expand-lg bg-body-tertiary',
            'containerMenuClass' => 'container',
            'containerMenuTag' => Block::DIV,
            'menuDefaultDefinitions' => [
                [
                    'class' => 'collapse justify-content-end navbar-collapse',
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
                    'listClass' => 'navbar-nav',
                    'listDropdownItemClass' => 'nav-item dropdown',
                    'listItemClass' => 'nav-item',
                ],
            ],
        ];
    }
}
