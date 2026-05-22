<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Cookbook\Bootstrap5;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\NavBar\{AlignRight, Defaults};
use UIAwesome\Html\Core\Component\{Item, Menu, NavBar};

/**
 * Unit tests for the {@see NavBar} component with Bootstrap5 default providers.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('navbar')]
final class NavBarTest extends TestCase
{
    public function testApplyAlignRightUsesFixedContainer(): void
    {
        self::assertSame(
            <<<HTML
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
            <a class="navbar-brand" href="/">
            My App
            </a>
            <button class="navbar-toggler" type="button" aria-expanded="false" aria-label="Toggle navigation" data-bs-toggle="collapse">
            <span class="navbar-toggler-icon">
            </span>
            </button>
            <div class="collapse justify-content-end navbar-collapse">
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
                ->menu(Menu::tag()->items(Item::tag()->label('Home')->link('/')))
                ->render(),
            'AlignRight provider must use the fixed container layout.',
        );
    }

    public function testApplyDefaultsRendersExpandLgNavbar(): void
    {
        self::assertSame(
            <<<HTML
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
            <a class="navbar-brand" href="/">
            My App
            </a>
            <button class="navbar-toggler" type="button" aria-expanded="false" aria-label="Toggle navigation" data-bs-toggle="collapse">
            <span class="navbar-toggler-icon">
            </span>
            </button>
            <div class="collapse navbar-collapse">
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
                ->menu(Menu::tag()->items(Item::tag()->label('Home')->link('/')))
                ->render(),
            'Default provider must emit the expand-on-large navbar layout.',
        );
    }
}
