<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Flowbite\Alert;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\ThemeProviderInterface;
use UIAwesome\Html\Helper\CSSClass;

use function array_values;

/**
 * Flowbite alert defaults providing the colored variants.
 *
 * Supports the five Flowbite contextual types: `danger`, `dark`, `info`, `success`, `warning`. Each type maps to a
 * Tailwind color palette (red, gray, blue, green, yellow). Apply via {@see \UIAwesome\Html\Core\Base\BaseTag::addThemeProvider()}
 * with the contextual type as the theme name.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Alert::tag()
 *     ->addThemeProvider('danger', \UIAwesome\Html\Core\Component\Cookbook\Flowbite\Alert\Defaults::class)
 *     ->content('Watch out!')
 *     ->render();
 * ```
 *
 * @link https://flowbite.com/docs/components/alerts/
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Defaults implements ThemeProviderInterface
{
    /**
     * `printf` template for the wrapper class with `%1$s` placeholder for the Tailwind color name.
     */
    private const string BASE_CLASS = 'p-4 mb-4 text-sm text-%1$s-800 rounded-lg bg-%1$s-50 dark:bg-gray-800 '
        . 'dark:text-%1$s-400';

    /**
     * Mapping of contextual type names to Tailwind color palettes.
     */
    private const array TYPES = [
        'danger' => 'red',
        'dark' => 'gray',
        'info' => 'blue',
        'success' => 'green',
        'warning' => 'yellow',
    ];

    public function apply(BaseTag $tag, string $theme): array
    {
        $color = self::TYPES[$theme] ?? 'gray';

        return [
            'class' => [CSSClass::render($color, self::BASE_CLASS, array_values(self::TYPES))],
        ];
    }
}
