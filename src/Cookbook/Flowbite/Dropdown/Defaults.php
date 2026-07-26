<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Flowbite\Dropdown;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Component\Cookbook\Flowbite\Toggle\Dropdown as DropdownToggle;
use UIAwesome\Html\Core\Component\Toggle;
use UIAwesome\Html\Core\Provider\ThemeProviderInterface;
use UIAwesome\Html\Interop\Block;

/**
 * Flowbite dropdown defaults providing the styling and colored toggle.
 *
 * Supports the five Flowbite contextual types (`danger`, `dark`, `info`, `success`, `warning`) propagated to the
 * embedded toggle.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Dropdown::tag()
 *     ->addThemeProvider('danger', \UIAwesome\Html\Core\Component\Cookbook\Flowbite\Dropdown\Defaults::class)
 *     ->items($item1, $item2)
 *     ->render();
 * ```
 *
 * @see https://flowbite.com/docs/components/dropdowns/
 */
final class Defaults implements ThemeProviderInterface
{
    /**
     * Returns the Flowbite `dropdown` attribute set for the given contextual `$theme`.
     *
     * @param BaseTag $tag Tag the provider is decorating.
     * @param string $theme Contextual theme key propagated to the embedded toggle.
     *
     * @return array<string, mixed> Method-call definitions merged into the tag at render time.
     */
    public function apply(BaseTag $tag, string $theme): array
    {
        return [
            'class' => [
                'z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700',
            ],
            'containerTag' => [Block::DIV],
            'linkClass' => ['block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'],
            'listClass' => ['py-2 text-sm text-gray-700 dark:text-gray-200'],
            'toggle' => [Toggle::tag()->addThemeProvider($theme, DropdownToggle::class)],
        ];
    }
}
