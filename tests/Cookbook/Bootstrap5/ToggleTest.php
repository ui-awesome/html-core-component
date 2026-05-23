<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Cookbook\Bootstrap5;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\{
    Alert,
    Dropdown,
    Menu,
    MenuDropdown,
    SelectorLanguage,
    SelectorTheme,
};
use UIAwesome\Html\Core\Component\Toggle;

/**
 * Unit tests for the {@see Toggle} component with Bootstrap5 default providers.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('toggle')]
final class ToggleTest extends TestCase
{
    public function testApplyAlertRendersCloseButton(): void
    {
        self::assertSame(
            <<<HTML
            <button class="btn-close" id="toggle-alert" type="button" aria-label="Close" data-bs-dismiss="alert">
            </button>
            HTML,
            Toggle::tag()
                ->addDefaultProvider(Alert::class)
                ->id('toggle-alert')
                ->render(),
            'Alert close-button provider must emit the dismiss attributes.',
        );
    }

    public function testApplyDropdownRendersToggleButton(): void
    {
        self::assertSame(
            <<<HTML
            <button class="btn btn-secondary dropdown-toggle" id="toggle-dropdown" type="button" aria-expanded="false" data-bs-toggle="dropdown">
            Dropdown button
            </button>
            HTML,
            Toggle::tag()
                ->addDefaultProvider(Dropdown::class)
                ->id('toggle-dropdown')
                ->render(),
            'Dropdown toggle provider must emit the dropdown button markup.',
        );
    }

    public function testApplyMenuDropdownRendersNavLink(): void
    {
        self::assertSame(
            <<<HTML
            <a class="nav-link dropdown-toggle" id="toggle-menu-dropdown" role="button" aria-expanded="false" data-bs-toggle="dropdown">
            Dropdown
            </a>
            HTML,
            Toggle::tag()
                ->addDefaultProvider(MenuDropdown::class)
                ->id('toggle-menu-dropdown')
                ->render(),
            'MenuDropdown provider must emit the nav-link anchor.',
        );
    }

    public function testApplyMenuRendersHamburger(): void
    {
        self::assertSame(
            <<<HTML
            <button class="navbar-toggler" id="toggle-menu-hamburger" type="button" aria-expanded="false" aria-label="Toggle navigation" data-bs-toggle="collapse">
            <span class="navbar-toggler-icon">
            </span>
            </button>
            HTML,
            Toggle::tag()
                ->addDefaultProvider(Menu::class)
                ->id('toggle-menu-hamburger')
                ->render(),
            'Menu provider must emit the hamburger toggler.',
        );
    }

    public function testApplySelectorLanguageRendersGlobeIcon(): void
    {
        self::assertSame(
            <<<HTML
            <button class="btn btn-primary dropdown-toggle d-flex align-items-center text-white" id="toggle-selector-language" type="button" title="Select language" aria-expanded="false" aria-label="Toggle language dropdown" data-bs-toggle="dropdown">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" aria-hidden="true" width="32" height="32" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M8.64 4.737A7.97 7.97 0 0 1 12 4a7.997 7.997 0 0 1 6.933 4.006h-.738c-.65 0-1.177.25-1.177.9 0 .33 0 2.04-2.026 2.008-1.972 0-1.972-1.732-1.972-2.008 0-1.429-.787-1.65-1.752-1.923-.374-.105-.774-.218-1.166-.411-1.004-.497-1.347-1.183-1.461-1.835ZM6 4a10.06 10.06 0 0 0-2.812 3.27A9.956 9.956 0 0 0 2 12c0 5.289 4.106 9.619 9.304 9.976l.054.004a10.12 10.12 0 0 0 1.155.007h.002a10.024 10.024 0 0 0 1.5-.19 9.925 9.925 0 0 0 2.259-.754 10.041 10.041 0 0 0 4.987-5.263A9.917 9.917 0 0 0 22 12a10.025 10.025 0 0 0-.315-2.5A10.001 10.001 0 0 0 12 2a9.964 9.964 0 0 0-6 2Zm13.372 11.113a2.575 2.575 0 0 0-.75-.112h-.217A3.405 3.405 0 0 0 15 18.405v1.014a8.027 8.027 0 0 0 4.372-4.307ZM12.114 20H12A8 8 0 0 1 5.1 7.95c.95.541 1.421 1.537 1.835 2.415.209.441.403.853.637 1.162.54.712 1.063 1.019 1.591 1.328.52.305 1.047.613 1.6 1.316 1.44 1.825 1.419 4.366 1.35 5.828Z" clip-rule="evenodd"/></svg>
            </button>
            HTML,
            Toggle::tag()
                ->addDefaultProvider(SelectorLanguage::class)
                ->id('toggle-selector-language')
                ->render(),
            'SelectorLanguage provider must inline the globe SVG icon.',
        );
    }

    public function testApplySelectorThemeRendersSunAndMoon(): void
    {
        self::assertSame(
            <<<HTML
            <button class="btn ms-2 me-2" id="toggle-selector-theme" type="button" title="Switch light/dark mode">
            <svg xmlns="http://www.w3.org/2000/svg" class="d-none" aria-hidden="true" width="32" height="32" fill="currentColor" viewBox="0 0 24 24" id="theme-dark-icon"><path fill-rule="evenodd" d="M11.675 2.015a.998.998 0 0 0-.403.011C6.09 2.4 2 6.722 2 12c0 5.523 4.477 10 10 10 4.356 0 8.058-2.784 9.43-6.667a1 1 0 0 0-1.02-1.33c-.08.006-.105.005-.127.005h-.001l-.028-.002A5.227 5.227 0 0 0 20 14a8 8 0 0 1-8-8c0-.952.121-1.752.404-2.558a.996.996 0 0 0 .096-.428V3a1 1 0 0 0-.825-.985Z" clip-rule="evenodd"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="d-none" aria-hidden="true" width="32" height="32" fill="currentColor" viewBox="0 0 24 24" id="theme-light-icon"><path fill-rule="evenodd" d="M13 3a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0V3ZM6.343 4.929A1 1 0 0 0 4.93 6.343l1.414 1.414a1 1 0 0 0 1.414-1.414L6.343 4.929Zm12.728 1.414a1 1 0 0 0-1.414-1.414l-1.414 1.414a1 1 0 0 0 1.414 1.414l1.414-1.414ZM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm-9 4a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H3Zm16 0a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2h-2ZM7.757 17.657a1 1 0 1 0-1.414-1.414l-1.414 1.414a1 1 0 1 0 1.414 1.414l1.414-1.414Zm9.9-1.414a1 1 0 0 0-1.414 1.414l1.414 1.414a1 1 0 0 0 1.414-1.414l-1.414-1.414ZM13 19a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2Z" clip-rule="evenodd"/></svg>
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
