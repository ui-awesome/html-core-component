<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Flowbite\Toggle;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;
use UIAwesome\Html\Svg\Svg;

/**
 * Flowbite toggle defaults for the navbar collapse button (hamburger).
 *
 * The `data-collapse-toggle` attribute must be supplied by the caller to reference the target navbar id.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Toggle::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Flowbite\Toggle\Menu::class)
 *     ->render();
 * ```
 *
 * @see https://flowbite.com/docs/components/navbar/
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Menu implements DefaultsProviderInterface
{
    /**
     * Returns the Flowbite navbar-collapse `toggle` default method-call definitions for the tag.
     *
     * @param BaseTag $tag Tag the provider is decorating.
     *
     * @return array<string, mixed> Method-call definitions merged into the tag at render time.
     */
    public function getDefaults(BaseTag $tag): array
    {
        return [
            'ariaAttributes' => [['expanded' => 'false']],
            'class' => [
                'inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden '
                . 'hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 '
                . 'dark:hover:bg-gray-700 dark:focus:ring-gray-600',
            ],
            'iconFilePath' => [Svg::iconPath('Flowbite:toggle')],
            'iconTag' => ['svg'],
            'toggleClass' => ['sr-only'],
            'toggleContent' => ['Open main menu'],
        ];
    }
}
