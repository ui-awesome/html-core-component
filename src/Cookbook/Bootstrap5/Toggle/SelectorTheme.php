<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;
use UIAwesome\Html\Svg\Svg;

/**
 * Bootstrap5 toggle defaults for a light/dark theme switcher with sun and moon icons.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Toggle::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\SelectorTheme::class)
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
            'class' => ['btn ms-2 me-2'],
            'content' => [
                Svg::icon('Bootstrap5:moon')
                    ->class('d-none')
                    ->fill('currentColor')
                    ->height(32)
                    ->id('theme-dark-icon')
                    ->width(32),
                "\n",
                Svg::icon('Bootstrap5:sun')
                    ->class('d-none')
                    ->fill('currentColor')
                    ->height(32)
                    ->id('theme-light-icon')
                    ->width(32),
            ],
            'title' => ['Switch light/dark mode'],
        ];
    }
}
