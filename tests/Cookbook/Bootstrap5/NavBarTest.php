<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Cookbook\Bootstrap5;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\NavBar\{AlignRight, Defaults};
use UIAwesome\Html\Core\Component\{Dropdown, Item, Menu, NavBar, Toggle};

/**
 * Unit tests for the {@see NavBar} component with Bootstrap5 default providers.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('navbar')]
final class NavBarTest extends TestCase
{
    public function testApplyAlignRightRendersNavbarWithDropdownItem(): void
    {
        $navId = 'navbarSupportedContent';

        self::assertSame(
            <<<HTML
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
            <a class="navbar-brand" href="/">
            My App
            </a>
            <button class="navbar-toggler" type="button" aria-expanded="false" aria-label="Toggle navigation" data-bs-toggle="collapse" aria-controls="navbarSupportedContent" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon">
            </span>
            </button>
            <div class="collapse justify-content-end navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="/">
            Home
            </a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" aria-expanded="false" data-bs-toggle="dropdown">
            Dropdown
            </a>
            <div>
            <ul class="dropdown-menu">
            <li>
            <a class="dropdown-item" href="#">
            Action
            </a>
            </li>
            </ul>
            </div>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->addDefaultProvider(AlignRight::class)
                ->brandText('My App')
                ->brandLink('/')
                ->menu(
                    Menu::tag()
                        ->id($navId)
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Dropdown::tag()
                                ->containerTag(false)
                                ->id(null)
                                ->items(Item::tag()->label('Action')->link('#')),
                        )
                        ->toggle(
                            Toggle::tag()
                                ->addDefaultProvider(
                                    \UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\Menu::class,
                                )
                                ->addAriaAttribute('controls', $navId)
                                ->addDataAttribute('bs-target', "#{$navId}"),
                        ),
                )
                ->render(),
            'AlignRight provider must apply the same dropdown classes as Defaults.',
        );
    }

    public function testApplyAlignRightUsesFixedContainer(): void
    {
        $navId = 'navbarSupportedContent';

        self::assertSame(
            <<<HTML
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
            <a class="navbar-brand" href="/">
            My App
            </a>
            <button class="navbar-toggler" type="button" aria-expanded="false" aria-label="Toggle navigation" data-bs-toggle="collapse" aria-controls="navbarSupportedContent" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon">
            </span>
            </button>
            <div class="collapse justify-content-end navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="/">
            Home
            </a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->addDefaultProvider(AlignRight::class)
                ->brandText('My App')
                ->brandLink('/')
                ->menu(
                    Menu::tag()
                        ->id($navId)
                        ->items(Item::tag()->label('Home')->link('/'))
                        ->toggle(
                            Toggle::tag()
                                ->addDefaultProvider(
                                    \UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\Menu::class,
                                )
                                ->addAriaAttribute('controls', $navId)
                                ->addDataAttribute('bs-target', "#{$navId}"),
                        ),
                )
                ->render(),
            'AlignRight provider must use the fixed container layout.',
        );
    }

    public function testApplyDefaultsRendersExpandLgNavbar(): void
    {
        $navId = 'navbarSupportedContent';

        self::assertSame(
            <<<HTML
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
            <a class="navbar-brand" href="/">
            My App
            </a>
            <button class="navbar-toggler" type="button" aria-expanded="false" aria-label="Toggle navigation" data-bs-toggle="collapse" aria-controls="navbarSupportedContent" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon">
            </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" href="/">
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
                ->menu(
                    Menu::tag()
                        ->id($navId)
                        ->items(Item::tag()->label('Home')->link('/'))
                        ->toggle(
                            Toggle::tag()
                                ->addDefaultProvider(
                                    \UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\Menu::class,
                                )
                                ->addAriaAttribute('controls', $navId)
                                ->addDataAttribute('bs-target', "#{$navId}"),
                        ),
                )
                ->render(),
            'Default provider must emit the expand-on-large navbar layout wired to the collapse target.',
        );
    }

    public function testApplyDefaultsRendersNavbarWithDropdownItem(): void
    {
        $navId = 'navbarSupportedContent';

        self::assertSame(
            <<<HTML
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
            <a class="navbar-brand" href="/">
            My App
            </a>
            <button class="navbar-toggler" type="button" aria-expanded="false" aria-label="Toggle navigation" data-bs-toggle="collapse" aria-controls="navbarSupportedContent" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon">
            </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" href="/">
            Home
            </a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" aria-expanded="false" data-bs-toggle="dropdown">
            Dropdown
            </a>
            <div>
            <ul class="dropdown-menu">
            <li>
            <a class="dropdown-item" href="#">
            Action
            </a>
            </li>
            </ul>
            </div>
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
                ->menu(
                    Menu::tag()
                        ->id($navId)
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Dropdown::tag()
                                ->containerTag(false)
                                ->id(null)
                                ->items(Item::tag()->label('Action')->link('#')),
                        )
                        ->toggle(
                            Toggle::tag()
                                ->addDefaultProvider(
                                    \UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\Menu::class,
                                )
                                ->addAriaAttribute('controls', $navId)
                                ->addDataAttribute('bs-target', "#{$navId}"),
                        ),
                )
                ->render(),
            'Nested dropdown must inherit Bootstrap5 nav-item, dropdown-menu, and dropdown-item classes.',
        );
    }
}
