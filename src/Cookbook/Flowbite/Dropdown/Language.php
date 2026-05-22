<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Flowbite\Dropdown;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Component\Cookbook\Flowbite\Toggle\SelectorLanguage;
use UIAwesome\Html\Core\Component\Toggle;
use UIAwesome\Html\Core\Provider\ThemeProviderInterface;
use UIAwesome\Html\Interop\Block;

/**
 * Flowbite dropdown defaults tailored for a language selection menu.
 *
 * Supports the five Flowbite contextual types (`danger`, `dark`, `info`, `success`, `warning`) propagated to the
 * embedded selector toggle.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Dropdown::tag()
 *     ->addThemeProvider('danger', \UIAwesome\Html\Core\Component\Cookbook\Flowbite\Dropdown\Language::class)
 *     ->items($item1, $item2)
 *     ->render();
 * ```
 *
 * @link https://flowbite.com/docs/components/dropdowns/
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Language implements ThemeProviderInterface
{
    public function apply(BaseTag $tag, string $theme): array
    {
        return [
            'class' => 'z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700',
            'containerTag' => Block::DIV,
            'linkActiveClass' => 'bg-blue-500 text-white',
            'linkClass' => 'block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white',
            'listClass' => 'py-2 text-sm text-gray-700 dark:text-gray-200',
            'toggle' => Toggle::tag()->addThemeProvider($theme, SelectorLanguage::class),
        ];
    }
}
