<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Cookbook\Flowbite;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\Cookbook\Flowbite\NavBar\Defaults;
use UIAwesome\Html\Core\Component\{Item, Menu, NavBar};

/**
 * Unit tests for the {@see NavBar} component with Flowbite default providers.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('navbar')]
final class NavBarTest extends TestCase
{
    public function testApplyDefaultsRendersResponsiveNavbar(): void
    {
        self::assertSame(
            <<<HTML
            <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a class="flex items-center space-x-3 rtl:space-x-reverse" href="/">
            My App
            </a>
            <button class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button" aria-expanded="false">
            <span class="sr-only">
            Open main menu
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" aria-hidden="true" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
            </button>
            <div class="hidden w-full md:block md:w-auto">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            <li>
            <a class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" href="/">
            Home
            </a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->addDefaultProvider(Defaults::class)
                ->brandText('My App')
                ->brandLink('/')
                ->menu(Menu::tag()->items(Item::tag()->label('Home')->link('/')))
                ->render(),
            'Default provider must emit the Flowbite responsive layout.',
        );
    }
}
