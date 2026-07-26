<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Flowbite\Toggle;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\ThemeProviderInterface;
use UIAwesome\Html\Helper\CSSClass;
use UIAwesome\Html\Svg\Svg;

use function array_values;

/**
 * Flowbite toggle defaults for the close button used inside dismissible alerts.
 *
 * Supports the five Flowbite contextual types: `danger`, `dark`, `info`, `success`, `warning`. The `data-dismiss-target`
 * data attribute must be supplied by the caller to point at the surrounding alert id.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Toggle::tag()
 *     ->addThemeProvider('danger', \UIAwesome\Html\Core\Component\Cookbook\Flowbite\Toggle\Alert::class)
 *     ->render();
 * ```
 *
 * @see https://flowbite.com/docs/components/alerts/
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Alert implements ThemeProviderInterface
{
    /**
     * `printf` template for the wrapper class with `%1$s` placeholder for the Tailwind color name.
     */
    private const string BASE_CLASS = 'ml-auto -mx-1.5 -my-1.5 bg-%1$s-50 text-%1$s-500 rounded-lg focus:ring-2 '
        . 'focus:ring-%1$s-400 p-1.5 hover:bg-%1$s-200 inline-flex items-center justify-center h-8 w-8 '
        . 'dark:bg-gray-800 dark:text-%1$s-400 dark:hover:bg-gray-700';

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

    /**
     * Returns the Flowbite alert close `toggle` attribute set for the given contextual `$theme`.
     *
     * @param BaseTag $tag Tag the provider is decorating.
     * @param string $theme Contextual theme key matched against {@see self::TYPES}.
     *
     * @return array<string, mixed> Method-call definitions merged into the tag at render time.
     */
    public function apply(BaseTag $tag, string $theme): array
    {
        $color = self::TYPES[$theme] ?? 'gray';

        return [
            'ariaAttributes' => [['label' => 'Close']],
            'class' => [CSSClass::render($color, self::BASE_CLASS, array_values(self::TYPES))],
            'iconFilePath' => [Svg::iconPath('Flowbite:circle-close')],
            'iconTag' => ['svg'],
            'toggleClass' => ['sr-only'],
            'toggleContent' => ['Close'],
        ];
    }
}
