<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Flowbite\Breadcrumb;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;
use UIAwesome\Html\Svg\Svg;

/**
 * Flowbite breadcrumb defaults providing the default styling.
 *
 * Indicates the current page location within a navigational hierarchy with a chevron separator.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Breadcrumb::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Flowbite\Breadcrumb\Defaults::class)
 *     ->items($home, $reports)->render();
 * ```
 *
 * @see https://flowbite.com/docs/components/breadcrumb/
 */
final class Defaults implements DefaultsProviderInterface
{
    /**
     * Returns the Flowbite `breadcrumb` default method-call definitions for the tag.
     *
     * @param BaseTag $tag Tag the provider is decorating.
     *
     * @return array<string, mixed> Method-call definitions merged into the tag at render time.
     */
    public function getDefaults(BaseTag $tag): array
    {
        return [
            'class' => ['flex'],
            'firstLinkClass' => [
                'inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 '
                . 'dark:text-gray-400 dark:hover:text-white',
            ],
            'linkActiveClass' => [
                'ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400',
                true,
            ],
            'linkActiveTag' => ['span'],
            'linkClass' => [
                'ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 '
                . 'dark:hover:text-white',
            ],
            'linkContainerClass' => ['flex items-center'],
            'linkContainerTag' => [],
            'listClass' => ['inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse'],
            'listItemAriaCurrent' => [],
            'separator' => [Svg::icon('Flowbite:chevron-right')->render()],
        ];
    }
}
