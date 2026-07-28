<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\{Dropdown, Item, Menu, NavBar, Toggle};
use UIAwesome\Html\Core\Component\Tests\Support\Theme;
use UIAwesome\Html\Core\Config\{Call, ComponentContext, Config, Cookbook, Recipe};
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for the {@see NavBar} component rendering and immutable configuration.
 */
#[Group('navbar')]
final class NavBarTest extends TestCase
{
    public function testAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <nav class="value">
            <div class="value">
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->attributes(['class' => 'value'])
                ->menu(
                    Menu::tag()
                        ->attributes(['class' => 'value'])
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testBrandAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div class="value">
            brand-text
            </div>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->brandAttributes(['class' => 'value'])
                ->brandTag()
                ->brandText('brand-text')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Attribute map must decorate the brand wrapper.',
        );
    }

    public function testBrandClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div class="value value-1">
            brand-text
            </div>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->brandAttributes(['class' => 'value'])
                ->brandClass('value-1')
                ->brandTag()
                ->brandText('brand-text')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Classes must merge on the brand wrapper.',
        );
    }

    public function testBrandClassWithOverrideTrue(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div class="override-value">
            brand-text
            </div>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->brandAttributes(['class' => 'value'])
                ->brandClass('override-value', true)
                ->brandTag()
                ->brandText('brand-text')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            '`true` override flag must replace classes on the brand wrapper.',
        );
    }

    public function testBrandImage(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <img src="brand-image">
            brand-text
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->brandImage('<img src="brand-image">')
                ->brandText('brand-text')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Image markup must render inside the brand block.',
        );
    }

    public function testBrandLink(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <a href="brand-link">
            <img src="brand-image">
            brand-text
            </a>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->brandImage('<img src="brand-image">')
                ->brandLink('brand-link')
                ->brandText('brand-text')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Anchor must wrap the image and text.',
        );
    }

    public function testBrandLinkAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <a class="value" href="brand-link">
            <img src="brand-image">
            brand-text
            </a>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->brandImage('<img src="brand-image">')
                ->brandLinkAttributes(['class' => 'value'])
                ->brandLink('brand-link')
                ->brandText('brand-text')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Attribute map must decorate the brand anchor.',
        );
    }

    public function testBrandLinkClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <a class="value value-1" href="brand-link">
            <img src="brand-image">
            brand-text
            </a>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->brandImage('<img src="brand-image">')
                ->brandLinkAttributes(['class' => 'value'])
                ->brandLinkClass('value-1')
                ->brandLink('brand-link')
                ->brandText('brand-text')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Classes must merge on the brand anchor.',
        );
    }

    public function testBrandLinkClassWithOverrideTrue(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <a class="override-value" href="brand-link">
            <img src="brand-image">
            brand-text
            </a>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->brandImage('<img src="brand-image">')
                ->brandLinkAttributes(['class' => 'value'])
                ->brandLinkClass('override-value', true)
                ->brandLink('brand-link')
                ->brandText('brand-text')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            '`true` override flag must replace classes on the brand anchor.',
        );
    }

    public function testBrandTag(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div>
            <a href="brand-link">
            brand-text
            </a>
            </div>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->brandLink('brand-link')
                ->brandTag()
                ->brandText('brand-text')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Default tag must wrap the brand block.',
        );
    }

    public function testBrandTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <a href="brand-link">
            brand-text
            </a>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->brandLink('brand-link')
                ->brandTag(false)
                ->brandText('brand-text')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            "'false' tag must drop the brand wrapper.",
        );
    }

    public function testBrandTagWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <p>
            <a href="brand-link">
            brand-text
            </a>
            </p>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->brandLink('brand-link')
                ->brandTag(Block::P)
                ->brandText('brand-text')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Custom tag must wrap the brand block.',
        );
    }

    public function testBrandTemplate(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            brand-toggle
            <a href="brand-link">
            brand-text
            </a>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->brandLink('brand-link')
                ->brandTemplate('{toggle}\n{link}')
                ->brandText('brand-text')
                ->brandToggle('brand-toggle')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Custom template must control the brand composition.',
        );
    }

    public function testBrandText(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            brand-text
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->brandText('brand-text')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Text must render inside the brand block.',
        );
    }

    public function testBrandToggle(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            brand-toggle
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->brandToggle('brand-toggle')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Toggle markup must render alongside the brand link.',
        );
    }

    public function testClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav class="value">
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->class('value')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'CSS class must be applied to the wrapper.',
        );
    }

    public function testConfigAppliesRecipeDefaults(): void
    {
        $config = new Config(
            new Theme(
                'stub',
                new Recipe(
                    'stub.navbar',
                    new Cookbook(
                        new Call('brandLinkClass', 'brand-link'),
                        new Call('class', 'navbar-shell'),
                        new Call('containerMenuClass', 'menu-container'),
                        new Call('containerMenuTag', Block::DIV),
                    ),
                ),
            ),
        );

        self::assertSame(
            <<<HTML
            <nav class="navbar-shell">
            <div class="menu-container">
            <a class="brand-link" href="/">
            My App
            </a>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->config($config, new ComponentContext('navbar'))
                ->brandLink('/')
                ->brandText('My App')
                ->menu(Menu::tag()->items(Item::tag()->label('Home')->link('/')))
                ->render(),
            'Recipe must apply the wrapper, container, and brand classes.',
        );
    }

    public function testConfigIsOverriddenByFluentCallsMadeAfterwards(): void
    {
        $config = new Config(
            new Theme(
                'stub',
                new Recipe(
                    'stub.navbar',
                    new Cookbook(
                        new Call('class', 'from-config'),
                        new Call('brandText', 'Config App'),
                    ),
                ),
            ),
        );

        self::assertSame(
            <<<HTML
            <nav class="from-config">
            User App
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->config($config, new ComponentContext('navbar'))
                ->brandText('User App')
                ->menu(Menu::tag()->items(Item::tag()->label('Home')->link('/')))
                ->render(),
            'Local brand text must win over the recipe value.',
        );
    }

    public function testContainerAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div class="value">
            <nav>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            </div>
            HTML,
            NavBar::tag()
                ->containerAttributes(['class' => 'value'])
                ->containerTag(Block::DIV)
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Attribute map must decorate the outer container.',
        );
    }

    public function testContainerClass(): void
    {
        self::assertSame(
            <<<HTML
            <div class="value value-1">
            <nav>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            </div>
            HTML,
            NavBar::tag()
                ->containerAttributes(['class' => 'value'])
                ->containerClass('value-1')
                ->containerTag(Block::DIV)
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Classes must merge on the outer container.',
        );
    }

    public function testContainerClassWithOverrideTrue(): void
    {
        self::assertSame(
            <<<HTML
            <div class="override-value">
            <nav>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            </div>
            HTML,
            NavBar::tag()
                ->containerAttributes(['class' => 'value'])
                ->containerClass('override-value', true)
                ->containerTag(Block::DIV)
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            "'true' override flag must replace classes on the outer container.",
        );
    }

    public function testContainerMenuAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div class="value">
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->containerMenuAttributes(['class' => 'value'])
                ->containerMenuTag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Attribute map must decorate the menu container.',
        );
    }

    public function testContainerMenuClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div class="value value-1">
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->containerMenuAttributes(['class' => 'value'])
                ->containerMenuClass('value-1')
                ->containerMenuTag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Classes must merge on the menu container.',
        );
    }

    public function testContainerMenuClassWithOverrideTrue(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div class="override-value">
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->containerMenuAttributes(['class' => 'value'])
                ->containerMenuClass('override-value', true)
                ->containerMenuTag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            "'true' override flag must replace classes on the menu container.",
        );
    }

    public function testContainerMenuTag(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div class="value">
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->containerMenuAttributes(['class' => 'value'])
                ->containerMenuTag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Default tag must wrap the menu container.',
        );
    }

    public function testContainerMenuTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->containerMenuAttributes(['class' => 'value'])
                ->containerMenuTag(false)
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            "'false' tag must drop the menu container wrapper.",
        );
    }

    public function testContainerMenuTagWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <article class="value">
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </article>
            </nav>
            HTML,
            NavBar::tag()
                ->containerMenuAttributes(['class' => 'value'])
                ->containerMenuTag(Block::ARTICLE)
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Custom tag must wrap the menu container.',
        );
    }

    public function testContainerTag(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <nav>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            </div>
            HTML,
            NavBar::tag()
                ->containerTag(Block::DIV)
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Default tag must wrap the outer container.',
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->containerTag(false)
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            "'false' tag must drop the outer wrapper.",
        );
    }

    public function testContainerTagWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <article>
            <nav>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            </article>
            HTML,
            NavBar::tag()
                ->containerTag(Block::ARTICLE)
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Custom tag must wrap the outer container.',
        );
    }

    public function testId(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="value">
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->id('value')
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->render(),
            'Explicit id must be applied to the wrapper.',
        );
    }

    public function testMenuDefaultDefinitionsConfigureNestedMenuAndDropdown(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div class="menu-shell" id="nav">
            <ul class="menu-list">
            <li class="menu-item">
            <a class="menu-link" href="/">
            Home
            </a>
            </li>
            <li class="menu-item has-dropdown">
            <button class="dropdown-trigger" type="button">
            Dropdown
            </button>
            <ul class="dropdown-list">
            <li>
            <a class="dropdown-entry" href="/action">
            Action
            </a>
            </li>
            </ul>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->menuDefaultDefinitions(
                    [
                        'class' => 'menu-shell',
                        'dropdownDefaultDefinitions' => [
                            [
                                'linkClass' => 'dropdown-entry',
                                'listClass' => 'dropdown-list',
                                'toggle' => Toggle::tag()->class('dropdown-trigger')->content('Dropdown'),
                            ],
                        ],
                        'linkClass' => 'menu-link',
                        'listClass' => 'menu-list',
                        'listDropdownItemClass' => 'menu-item has-dropdown',
                        'listItemClass' => 'menu-item',
                    ],
                )
                ->menu(
                    Menu::tag()
                        ->id('nav')
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Dropdown::tag()
                                ->containerTag(false)
                                ->id(null)
                                ->items(Item::tag()->label('Action')->link('/action')),
                        ),
                )
                ->render(),
            'Nested menu and dropdown must inherit the configured definitions.',
        );
    }

    public function testPrefix(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            prefix
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->prefix('prefix')
                ->render(),
            'Prefix must precede the menu block.',
        );
    }

    public function testPrefixAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            prefix
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->prefix('prefix')
                ->prefixAttributes(['class' => 'value'])
                ->prefixTag()
                ->render(),
            'Prefix attribute map must decorate the prefix wrapper.',
        );
    }

    public function testPrefixClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            prefix
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->prefix('prefix')
                ->prefixClass('value')
                ->prefixTag()
                ->render(),
            'CSS class must be applied to the prefix wrapper.',
        );
    }

    public function testPrefixTag(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            prefix
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->prefix('prefix')
                ->prefixTag()
                ->render(),
            'Default prefix tag must wrap the prefix.',
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            prefix
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->prefix('prefix')
                ->prefixTag(false)
                ->render(),
            "'false' prefix tag must drop the prefix wrapper.",
        );
    }

    public function testPrefixTagWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <span>
            prefix
            </span>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::tag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->prefix('prefix')
                ->prefixTag(Inline::SPAN)
                ->render(),
            'Custom prefix tag must wrap the prefix.',
        );
    }

    public function testRender(): void
    {
        self::assertEmpty(
            NavBar::tag()->render(),
            'Empty navbar must render an empty string.',
        );
    }

    public function testRenderReturnsEmptyEvenWithBrandWhenMenuIsEmpty(): void
    {
        self::assertEmpty(
            NavBar::tag()->brandText('My App')->brandLink('/')->render(),
            "Empty 'menu' must short-circuit before rendering brand or other slots.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $instance = NavBar::tag();

        self::assertNotSame(
            $instance,
            $instance->brandAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->brandClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->brandImage(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->brandLink(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->brandLinkAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->brandLinkClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->brandLinkTemplate(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->brandTag(false),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->brandTemplate(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->brandText(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->brandToggle(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->containerMenuAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->containerMenuClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->containerMenuTag(),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->menu(Menu::tag()),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->menuDefaultDefinitions([]),
            'New instance must be returned (immutability).',
        );
    }

    public function testSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            suffix
            </nav>
            HTML,
            NavBar::tag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->suffix('suffix')
                ->render(),
            'Suffix must follow the menu block.',
        );
    }

    public function testSuffixAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            suffix
            </nav>
            HTML,
            NavBar::tag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->suffix('suffix')
                ->suffixAttributes(['class' => 'value'])
                ->suffixTag()
                ->render(),
            'Suffix attribute map must decorate the suffix wrapper.',
        );
    }

    public function testSuffixClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            suffix
            </nav>
            HTML,
            NavBar::tag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->suffix('suffix')
                ->suffixClass('value')
                ->suffixTag()
                ->render(),
            'CSS class must be applied to the suffix wrapper.',
        );
    }

    public function testSuffixTag(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            suffix
            </nav>
            HTML,
            NavBar::tag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->suffix('suffix')
                ->suffixTag()
                ->render(),
            'Default suffix tag must wrap the suffix.',
        );
    }

    public function testSuffixTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            suffix
            </nav>
            HTML,
            NavBar::tag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->suffix('suffix')
                ->suffixTag(false)
                ->render(),
            "'false' suffix tag must drop the suffix wrapper.",
        );
    }

    public function testSuffixTagWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            <span>
            suffix
            </span>
            </nav>
            HTML,
            NavBar::tag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->suffix('suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            'Custom suffix tag must wrap the suffix.',
        );
    }

    public function testTemplate(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <article>
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            </article>
            </nav>
            HTML,
            NavBar::tag()
                ->menu(
                    Menu::tag()
                        ->items(
                            Item::tag()->label('Home')->link('/'),
                            Item::tag()->label('About')->link('/about'),
                            Item::tag()->label('Contact')->link('/contact'),
                        ),
                )
                ->template('<article>\n{menu}\n</article>')
                ->render(),
            'Custom template must control the rendered structure.',
        );
    }
}
