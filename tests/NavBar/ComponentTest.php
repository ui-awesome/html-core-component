<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\NavBar;

use PHPForge\Support\Assert;
use UIAwesome\Html\Core\Component\{Item, Menu, Tests\Support\NavBar};

/**
 * Test for all the NavBar component methods.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ComponentTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="value">
            <div>
            <div class="value">
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->attributes(['class' => 'value'])
                ->menu(
                    Menu::widget()
                        ->attributes(['class' => 'value'])
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testBrandAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <div class="value">
            brand-text
            </div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->brandAttributes(['class' => 'value'])
                ->brandTag()
                ->brandText('brand-text')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testBrandClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <div class="value value-1">
            brand-text
            </div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->brandAttributes(['class' => 'value'])
                ->brandClass('value-1')
                ->brandTag()
                ->brandText('brand-text')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testBrandClassWithOverrideTrue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <div class="override-value">
            brand-text
            </div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->brandAttributes(['class' => 'value'])
                ->brandClass('override-value', true)
                ->brandTag()
                ->brandText('brand-text')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testBrandImage(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <img src="brand-image">
            brand-text
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->brandImage('<img src="brand-image">')
                ->brandText('brand-text')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testBrandLink(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <a href="brand-link">
            <img src="brand-image">
            brand-text
            </a>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->brandImage('<img src="brand-image">')
                ->brandLink('brand-link')
                ->brandText('brand-text')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testBrandLinkAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <a class="value" href="brand-link">
            <img src="brand-image">
            brand-text
            </a>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->brandImage('<img src="brand-image">')
                ->brandLinkAttributes(['class' => 'value'])
                ->brandLink('brand-link')
                ->brandText('brand-text')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testBrandLinkClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <a class="value value-1" href="brand-link">
            <img src="brand-image">
            brand-text
            </a>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->brandImage('<img src="brand-image">')
                ->brandLinkAttributes(['class' => 'value'])
                ->brandLinkClass('value-1')
                ->brandLink('brand-link')
                ->brandText('brand-text')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testBrandLinkClassWithOverrideTrue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <a class="override-value" href="brand-link">
            <img src="brand-image">
            brand-text
            </a>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->brandImage('<img src="brand-image">')
                ->brandLinkAttributes(['class' => 'value'])
                ->brandLinkClass('override-value', true)
                ->brandLink('brand-link')
                ->brandText('brand-text')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testBrandTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <div>
            <a href="brand-link">
            brand-text
            </a>
            </div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->brandLink('brand-link')
                ->brandTag()
                ->brandText('brand-text')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testBrandTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <a href="brand-link">
            brand-text
            </a>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->brandLink('brand-link')
                ->brandTag(false)
                ->brandText('brand-text')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testBrandTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <p>
            <a href="brand-link">
            brand-text
            </a>
            </p>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->brandLink('brand-link')
                ->brandTag('p')
                ->brandText('brand-text')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testBrandTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            brand-toggle
            <a href="brand-link">
            brand-text
            </a>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->brandLink('brand-link')
                ->brandTemplate('{toggle}\n{link}')
                ->brandText('brand-text')
                ->brandToggle('brand-toggle')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testBrandText(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            brand-text
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->brandText('brand-text')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testBrandToggle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            brand-toggle
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->brandToggle('brand-toggle')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="value">
            <div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->class('value')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            <nav>
            <div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            </div>
            HTML,
            NavBar::widget()
                ->containerAttributes(['class' => 'value'])
                ->containerTag()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value value-1">
            <nav>
            <div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            </div>
            HTML,
            NavBar::widget()
                ->containerAttributes(['class' => 'value'])
                ->containerClass('value-1')
                ->containerTag()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testContainerClassWithOverrideTrue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="override-value">
            <nav>
            <div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            </div>
            HTML,
            NavBar::widget()
                ->containerAttributes(['class' => 'value'])
                ->containerClass('override-value', true)
                ->containerTag()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testContainerMenuAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div class="value">
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->containerMenuAttributes(['class' => 'value'])
                ->containerMenuTag()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testContainerMenuClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div class="value value-1">
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->containerMenuAttributes(['class' => 'value'])
                ->containerMenuClass('value-1')
                ->containerMenuTag()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testContainerMenuClassWithOverrideTrue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div class="override-value">
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->containerMenuAttributes(['class' => 'value'])
                ->containerMenuClass('override-value', true)
                ->containerMenuTag()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testContainerMenuTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div class="value">
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->containerMenuAttributes(['class' => 'value'])
                ->containerMenuTag()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testContainerMenuTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->containerMenuAttributes(['class' => 'value'])
                ->containerMenuTag(false)
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testContainerMenuTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <article class="value">
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </article>
            </nav>
            HTML,
            NavBar::widget()
                ->containerMenuAttributes(['class' => 'value'])
                ->containerMenuTag('article')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <nav>
            <div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            </div>
            HTML,
            NavBar::widget()
                ->containerTag()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->containerTag(false)
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <nav>
            <div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            </article>
            HTML,
            NavBar::widget()
                ->containerTag('article')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="value">
            <div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->id('value')
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            prefix
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->prefix('prefix')
                ->render()
        );
    }

    public function testPrefixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <div class="value">
            prefix
            </div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->prefix('prefix')
                ->prefixAttributes(['class' => 'value'])
                ->prefixTag()
                ->render()
        );
    }

    public function testPrefixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <div class="value">
            prefix
            </div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->prefix('prefix')
                ->prefixClass('value')
                ->prefixTag()
                ->render()
        );
    }

    public function testPrefixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <div>
            prefix
            </div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->prefix('prefix')
                ->prefixTag()
                ->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            prefix
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->prefix('prefix')
                ->prefixTag(false)
                ->render()
        );
    }

    public function testPrefixTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <span>prefix</span>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->prefix('prefix')
                ->prefixTag('span')
                ->render()
        );
    }

    public function testRender(): void
    {
        $this->assertEmpty(NavBar::widget()->render());
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            suffix
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->suffix('suffix')
                ->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            <div class="value">
            suffix
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->suffix('suffix')
                ->suffixAttributes(['class' => 'value'])
                ->suffixTag()
                ->render()
        );
    }

    public function testSuffixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            <div class="value">
            suffix
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->suffix('suffix')
                ->suffixClass('value')
                ->suffixTag()
                ->render()
        );
    }

    public function testSuffixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            <div>
            suffix
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->suffix('suffix')
                ->suffixTag()
                ->render()
        );
    }

    public function testSuffixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            suffix
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->suffix('suffix')
                ->suffixTag(false)
                ->render()
        );
    }

    public function testSuffixTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            <span>suffix</span>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->suffix('suffix')
                ->suffixTag('span')
                ->render()
        );
    }

    public function testTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->tag('nav')
                ->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
            <div>
            <article>
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            </article>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->menu(
                    Menu::widget()
                        ->items(
                            Item::widget()->label('Home')->link('/'),
                            Item::widget()->label('About')->link('/about'),
                            Item::widget()->label('Contact')->link('/contact')
                        )
                )
                ->template('<article>\n{menu}\n</article>')
                ->render()
        );
    }
}
