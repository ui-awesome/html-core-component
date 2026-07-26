<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Flowbite\Toggle;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;
use UIAwesome\Html\Svg\Svg;

/**
 * Flowbite toggle defaults for a navbar link that opens a nested dropdown.
 *
 * The `data-dropdown-toggle` attribute must be supplied by the caller to reference the target dropdown id.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Toggle::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Flowbite\Toggle\MenuDropdown::class)
 *     ->render();
 * ```
 *
 * @see https://flowbite.com/docs/components/navbar/
 */
final class MenuDropdown implements DefaultsProviderInterface
{
    /**
     * Returns the Flowbite nested-dropdown `toggle` default method-call definitions for the tag.
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
                'flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 '
                . 'md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white '
                . 'md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 '
                . 'md:dark:hover:bg-transparent',
            ],
            'content' => ['Dropdown'],
            'iconFilePath' => [Svg::iconPath('Flowbite:dropdown-down')],
            'iconTag' => ['svg'],
            'template' => ['{toggle}\n{content}\n{icon}'],
        ];
    }
}
