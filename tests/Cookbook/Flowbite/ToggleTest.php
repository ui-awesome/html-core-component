<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Cookbook\Flowbite;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\Cookbook\Flowbite\Toggle\{
    Alert,
    Dropdown,
    Menu,
    MenuDropdown,
    SelectorLanguage,
    SelectorTheme,
};
use UIAwesome\Html\Core\Component\Toggle;

/**
 * Unit tests for the {@see Toggle} component with Flowbite providers.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('toggle')]
final class ToggleTest extends TestCase
{
    public function testApplyAlertRendersCloseSvgIcon(): void
    {
        self::assertSame(
            <<<HTML
            <button class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" id="toggle-alert" type="button" aria-label="Close">
            <span class="sr-only">
            Close
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
            </button>
            HTML,
            Toggle::tag()
                ->addThemeProvider('danger', Alert::class)
                ->id('toggle-alert')
                ->render(),
            'Theme provider must paint the close button in the danger palette.',
        );
    }

    public function testApplyDropdownRendersChevronDownIcon(): void
    {
        self::assertSame(
            <<<HTML
            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="toggle-dropdown" type="button">
            <span>
            Dropdown button
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 h-2.5 ms-3" aria-hidden="true" fill="none" viewBox="0 0 10 6"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/></svg>
            </button>
            HTML,
            Toggle::tag()
                ->addThemeProvider('info', Dropdown::class)
                ->id('toggle-dropdown')
                ->render(),
            'Theme provider must inline the chevron-down icon.',
        );
    }

    public function testApplyMenuDropdownRendersDropdownArrow(): void
    {
        self::assertSame(
            <<<HTML
            <button class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent" id="toggle-menu-dropdown" type="button" aria-expanded="false">
            Dropdown
            <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" fill="none" viewBox="0 0 10 6"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/></svg>
            </button>
            HTML,
            Toggle::tag()
                ->addDefaultProvider(MenuDropdown::class)
                ->id('toggle-menu-dropdown')
                ->render(),
            'Default provider must emit the dropdown arrow icon.',
        );
    }

    public function testApplyMenuRendersHamburgerIcon(): void
    {
        self::assertSame(
            <<<HTML
            <button class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" id="toggle-menu-hamburger" type="button" aria-expanded="false">
            <span class="sr-only">
            Open main menu
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" aria-hidden="true" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
            </button>
            HTML,
            Toggle::tag()
                ->addDefaultProvider(Menu::class)
                ->id('toggle-menu-hamburger')
                ->render(),
            'Default provider must emit the hamburger icon.',
        );
    }

    public function testApplySelectorLanguageRendersGlobeIcon(): void
    {
        self::assertSame(
            <<<HTML
            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="toggle-selector-language" type="button" title="Select language">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" aria-hidden="true" width="32" height="32" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M8.64 4.737A7.97 7.97 0 0 1 12 4a7.997 7.997 0 0 1 6.933 4.006h-.738c-.65 0-1.177.25-1.177.9 0 .33 0 2.04-2.026 2.008-1.972 0-1.972-1.732-1.972-2.008 0-1.429-.787-1.65-1.752-1.923-.374-.105-.774-.218-1.166-.411-1.004-.497-1.347-1.183-1.461-1.835ZM6 4a10.06 10.06 0 0 0-2.812 3.27A9.956 9.956 0 0 0 2 12c0 5.289 4.106 9.619 9.304 9.976l.054.004a10.12 10.12 0 0 0 1.155.007h.002a10.024 10.024 0 0 0 1.5-.19 9.925 9.925 0 0 0 2.259-.754 10.041 10.041 0 0 0 4.987-5.263A9.917 9.917 0 0 0 22 12a10.025 10.025 0 0 0-.315-2.5A10.001 10.001 0 0 0 12 2a9.964 9.964 0 0 0-6 2Zm13.372 11.113a2.575 2.575 0 0 0-.75-.112h-.217A3.405 3.405 0 0 0 15 18.405v1.014a8.027 8.027 0 0 0 4.372-4.307ZM12.114 20H12A8 8 0 0 1 5.1 7.95c.95.541 1.421 1.537 1.835 2.415.209.441.403.853.637 1.162.54.712 1.063 1.019 1.591 1.328.52.305 1.047.613 1.6 1.316 1.44 1.825 1.419 4.366 1.35 5.828Z" clip-rule="evenodd"/></svg>
            </button>
            HTML,
            Toggle::tag()
                ->addThemeProvider('info', SelectorLanguage::class)
                ->id('toggle-selector-language')
                ->render(),
            'Theme provider must inline the globe icon.',
        );
    }

    public function testApplySelectorThemeRendersSunAndMoon(): void
    {
        self::assertSame(
            <<<HTML
            <button class="text-gray-700 hover:text-gray-900 dark:hover:text-white dark:text-gray-400" id="toggle-selector-theme" type="button" title="Switch light/dark mode">
            <svg xmlns="http://www.w3.org/2000/svg" class="hidden" aria-hidden="true" width="32" height="32" fill="currentColor" viewBox="0 0 24 24" id="theme-toggle-dark-icon"><path fill-rule="evenodd" d="M11.675 2.015a.998.998 0 0 0-.403.011C6.09 2.4 2 6.722 2 12c0 5.523 4.477 10 10 10 4.356 0 8.058-2.784 9.43-6.667a1 1 0 0 0-1.02-1.33c-.08.006-.105.005-.127.005h-.001l-.028-.002A5.227 5.227 0 0 0 20 14a8 8 0 0 1-8-8c0-.952.121-1.752.404-2.558a.996.996 0 0 0 .096-.428V3a1 1 0 0 0-.825-.985Z" clip-rule="evenodd"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="hidden" aria-hidden="true" width="32" height="32" fill="currentColor" viewBox="0 0 24 24" id="theme-toggle-light-icon"><path fill-rule="evenodd" d="M13 3a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0V3ZM6.343 4.929A1 1 0 0 0 4.93 6.343l1.414 1.414a1 1 0 0 0 1.414-1.414L6.343 4.929Zm12.728 1.414a1 1 0 0 0-1.414-1.414l-1.414 1.414a1 1 0 0 0 1.414 1.414l1.414-1.414ZM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm-9 4a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H3Zm16 0a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2h-2ZM7.757 17.657a1 1 0 1 0-1.414-1.414l-1.414 1.414a1 1 0 1 0 1.414 1.414l1.414-1.414Zm9.9-1.414a1 1 0 0 0-1.414 1.414l1.414 1.414a1 1 0 0 0 1.414-1.414l-1.414-1.414ZM13 19a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2Z" clip-rule="evenodd"/></svg>
            </button>
            HTML,
            Toggle::tag()
                ->addDefaultProvider(SelectorTheme::class)
                ->id('toggle-selector-theme')
                ->render(),
            'SelectorTheme provider must inline both sun and moon SVG markup unencoded.',
        );
    }
}
