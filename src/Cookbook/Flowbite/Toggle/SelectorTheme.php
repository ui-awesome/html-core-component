<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Flowbite\Toggle;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;
use UIAwesome\Html\Svg\Svg;

/**
 * Flowbite toggle defaults for a light/dark theme switcher with sun and moon icons.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Toggle::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Flowbite\Toggle\SelectorTheme::class)
 *     ->render();
 * ```
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class SelectorTheme implements DefaultsProviderInterface
{
    public function getDefaults(BaseTag $tag): array
    {
        return [
            'class' => ['text-gray-700 hover:text-gray-900 dark:hover:text-white dark:text-gray-400'],
            'content' => [
                Svg::icon('Flowbite:moon')
                    ->class('hidden')
                    ->fill('currentColor')
                    ->height(32)
                    ->id('theme-toggle-dark-icon')
                    ->width(32),
                "\n",
                Svg::icon('Flowbite:sun')
                    ->class('hidden')
                    ->fill('currentColor')
                    ->height(32)
                    ->id('theme-toggle-light-icon')
                    ->width(32),
            ],
            'title' => ['Switch light/dark mode'],
        ];
    }
}
