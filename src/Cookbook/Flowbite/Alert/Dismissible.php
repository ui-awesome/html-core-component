<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Flowbite\Alert;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Component\Cookbook\Flowbite\Toggle\Alert;
use UIAwesome\Html\Core\Component\Toggle;
use UIAwesome\Html\Core\Provider\ThemeProviderInterface;
use UIAwesome\Html\Helper\CSSClass;
use UIAwesome\Html\Interop\Block;

use function array_values;

/**
 * Flowbite alert defaults providing dismissible colored variants with a close toggle.
 *
 * Supports the five Flowbite contextual types: `danger`, `dark`, `info`, `success`, `warning`. The dismiss toggle
 * requires a `data-dismiss-target` data attribute pointing at the surrounding alert id; supply it via
 * {@see \UIAwesome\Html\Core\Component\Toggle::addDataAttribute()} on the toggle or set it through the consumer.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Alert::tag()
 *     ->addThemeProvider('danger', \UIAwesome\Html\Core\Component\Cookbook\Flowbite\Alert\Dismissible::class)
 *     ->content('Watch out!')
 *     ->render();
 * ```
 *
 * @see https://flowbite.com/docs/components/alerts/
 */
final class Dismissible implements ThemeProviderInterface
{
    /**
     * `printf` template for the wrapper class with `%1$s` placeholder for the Tailwind color name.
     */
    private const string BASE_CLASS = 'flex items-center justify-center p-4 mb-4 text-%1$s-800 rounded-lg bg-%1$s-50 '
        . 'dark:bg-gray-800 dark:text-%1$s-400';

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
     * Returns the Flowbite dismissible `alert` attribute set for the given contextual `$theme`.
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
            'containerClass' => ['ml-3 text-sm font-medium'],
            'containerTag' => [Block::DIV],
            'toggle' => [Toggle::tag()->addThemeProvider($theme, Alert::class)],
        ];
    }
}
