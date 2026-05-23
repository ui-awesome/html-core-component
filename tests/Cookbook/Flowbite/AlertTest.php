<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Cookbook\Flowbite;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\Alert;
use UIAwesome\Html\Core\Component\Cookbook\Flowbite\Alert\{Defaults, Dismissible};

/**
 * Unit tests for the {@see Alert} component with Flowbite theme providers.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('alert')]
final class AlertTest extends TestCase
{
    public function testApplyDefaultsRendersDangerVariant(): void
    {
        self::assertSame(
            <<<HTML
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" id="alert" role="alert">
            Watch out!
            </div>
            HTML,
            Alert::tag()
                ->addThemeProvider('danger', Defaults::class)
                ->content(values: 'Watch out!')
                ->id('alert')
                ->render(),
            'Theme provider must emit the Tailwind danger palette.',
        );
    }

    public function testApplyDefaultsRendersInfoVariant(): void
    {
        self::assertSame(
            <<<HTML
            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" id="alert" role="alert">
            Heads up!
            </div>
            HTML,
            Alert::tag()
                ->addThemeProvider('info', Defaults::class)
                ->content('Heads up!')
                ->id('alert')
                ->render(),
            'Theme provider must emit the Tailwind info palette.',
        );
    }

    public function testApplyDismissibleEmitsCloseToggle(): void
    {
        self::assertSame(
            <<<HTML
            <div class="flex items-center justify-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400" id="alert" role="alert">
            <div class="ml-3 text-sm font-medium">
            Watch the bus!
            </div>
            <button class="ml-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-yellow-400 dark:hover:bg-gray-700" type="button" aria-label="Close">
            <span class="sr-only">
            Close
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
            </button>
            </div>
            HTML,
            Alert::tag()
                ->addThemeProvider('warning', Dismissible::class)
                ->content('Watch the bus!')
                ->id('alert')
                ->render(),
            'Dismissible theme provider must embed the close toggle.',
        );
    }
}
