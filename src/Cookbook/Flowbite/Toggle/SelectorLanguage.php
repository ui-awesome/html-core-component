<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Flowbite\Toggle;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\ThemeProviderInterface;
use UIAwesome\Html\Helper\CSSClass;
use UIAwesome\Html\Svg\Svg;

use function array_values;

/**
 * Flowbite toggle defaults for a language selector button with a globe icon.
 *
 * Supports the five Flowbite contextual types (`danger`, `dark`, `info`, `success`, `warning`) mapped to color
 * palettes. The `data-dropdown-toggle` attribute must be supplied by the caller to reference the target dropdown id.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Toggle::tag()
 *     ->addThemeProvider('danger', \UIAwesome\Html\Core\Component\Cookbook\Flowbite\Toggle\SelectorLanguage::class)
 *     ->render();
 * ```
 *
 * @see https://flowbite.com/docs/components/dropdowns/
 */
final class SelectorLanguage implements ThemeProviderInterface
{
    /**
     * `printf` template for the wrapper class with `%1$s` placeholder for the Tailwind color name.
     */
    private const string BASE_CLASS = 'text-white bg-%1$s-700 hover:bg-%1$s-800 focus:ring-4 focus:outline-none '
        . 'focus:ring-%1$s-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center '
        . 'dark:bg-%1$s-600 dark:hover:bg-%1$s-700 dark:focus:ring-%1$s-800';

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
     * Returns the Flowbite language-selector `toggle` attribute set for the given contextual `$theme`.
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
            'class' => [CSSClass::render($color, self::BASE_CLASS, array_values(self::TYPES))],
            'iconAttributes' => [['height' => '32', 'width' => '32']],
            'iconFilePath' => [Svg::iconPath('Flowbite:globe')],
            'iconTag' => ['svg'],
            'title' => ['Select language'],
        ];
    }
}
