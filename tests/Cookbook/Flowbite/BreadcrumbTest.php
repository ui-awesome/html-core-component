<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Cookbook\Flowbite;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\{Breadcrumb, Item};
use UIAwesome\Html\Core\Component\Cookbook\Flowbite\Breadcrumb\Defaults;

/**
 * Unit tests for the {@see Breadcrumb} component with Flowbite default providers.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('breadcrumb')]
final class BreadcrumbTest extends TestCase
{
    public function testApplyDefaultsRendersChevronSeparator(): void
    {
        self::assertSame(
            <<<HTML
            <nav class="flex" id="breadcrumb" aria-label="breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li>
            <div class="flex items-center">
            <a class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white" href="/">
            Home
            </a>
            </div>
            </li>
            <li aria-current="page">
            <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400" href="/reports">
            Reports
            </span>
            </div>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->addDefaultProvider(Defaults::class)
                ->currentPath('/reports')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Reports')->link('/reports'),
                )
                ->render(),
            'Default provider must emit the Flowbite chevron separator and active span.',
        );
    }

    public function testApplyDefaultsRendersMiddleItemWithLinkClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav class="flex" id="breadcrumb" aria-label="breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li>
            <div class="flex items-center">
            <a class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white" href="/">
            Home
            </a>
            </div>
            </li>
            <li>
            <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
            <a class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white" href="/reports">
            Reports
            </a>
            </div>
            </li>
            <li aria-current="page">
            <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400" href="/reports/2024">
            2024
            </span>
            </div>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->addDefaultProvider(Defaults::class)
                ->currentPath('/reports/2024')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Reports')->link('/reports'),
                    Item::tag()->label('2024')->link('/reports/2024'),
                )
                ->render(),
            'Middle item must carry the full Flowbite linkClass string.',
        );
    }
}
