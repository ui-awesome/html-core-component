<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Menu;

use PHPForge\Support\Assert;
use UIAwesome\Html\Core\Component\{Item, Menu, Tests\Support\Dropdown, Tests\Support\Toggle};

/**
 * Test for all the Menu component methods.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ComponentTest extends \PHPUnit\Framework\TestCase
{
    public function testActivateItems(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <a class="active" href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->activateItems(true)
                ->currentPath('/')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->linkActiveClass('active')
                ->render()
        );
    }

    public function testActivateItemsWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
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
            HTML,
            Menu::widget()
                ->activateItems(false)
                ->currentPath('/')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->linkActiveClass('active')
                ->render()
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
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
            HTML,
            Menu::widget()
                ->attributes(['class' => 'value'])
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
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
            HTML,
            Menu::widget()
                ->class('value')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->render()
        );
    }

    public function testCurrentPath(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a class="active" href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->currentPath('/contact')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->linkActiveClass('active')
                ->render()
        );
    }

    public function testDividerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <hr>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->divider(),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->render()
        );
    }

    public function testFirstItemClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li class="value">
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
            HTML,
            Menu::widget()
                ->firstItemClass('value')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->render()
        );
    }

    public function testFirstLinkClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <a class="value" href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->firstLinkClass('value')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="value">
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
            HTML,
            Menu::widget()
                ->id('value')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->render()
        );
    }

    public function testIsLinkAriaCurrent(): void
    {
        $this->assertTrue(Menu::widget()->linkAriaCurrent(true)->isLinkAriaCurrent());
    }

    public function testIsListItemAriaCurrent(): void
    {
        $this->assertTrue(Menu::widget()->listItemAriaCurrent(true)->isListItemAriaCurrent());
    }

    public function testLastItemClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li class="value">
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->lastItemClass('value')
                ->render()
        );
    }

    public function testLastLinkClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a class="value" href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->lastLinkClass('value')
                ->render()
        );
    }

    public function testLinkActiveClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <a class="value" href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/')->active(),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->linkActiveClass('value')
                ->render()
        );
    }

    public function testLinkActiveTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <span>About</span>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about')->active(),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->linkActiveTag('span')
                ->render()
        );
    }

    public function testLinkAriaCurrent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <a href="/" aria-current="page">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/')->active(),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->linkAriaCurrent(true)
                ->render()
        );
    }

    public function testLinkAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <a class="value" href="/">Home</a>
            </li>
            <li>
            <a class="value" href="/about">About</a>
            </li>
            <li>
            <a class="value" href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->linkAttributes(['class' => 'value'])
                ->render()
        );
    }

    public function testLinkClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <a class="value" href="/">Home</a>
            </li>
            <li>
            <a class="value" href="/about">About</a>
            </li>
            <li>
            <a class="value" href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->linkClass('value')
                ->render()
        );
    }

    public function testLinkContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <div class="value">
            <a href="/">Home</a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/about">About</a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/contact">Contact</a>
            </div>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->linkContainerAttributes(['class' => 'value'])
                ->linkContainerTag()
                ->render()
        );
    }

    public function testLinkContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <div class="value">
            <a href="/">Home</a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/about">About</a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/contact">Contact</a>
            </div>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->linkContainerClass('value')
                ->linkContainerTag()
                ->render()
        );
    }

    public function testLinkContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <div>
            <a href="/">Home</a>
            </div>
            </li>
            <li>
            <div>
            <a href="/about">About</a>
            </div>
            </li>
            <li>
            <div>
            <a href="/contact">Contact</a>
            </div>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->linkContainerTag()
                ->render()
        );
    }

    public function testLinkContainerTagWithItemValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <span><a href="/">Home</a></span>
            </li>
            <li>
            <div>
            <a href="/about">About</a>
            </div>
            </li>
            <li>
            <div>
            <a href="/contact">Contact</a>
            </div>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/')->linkContainerTag('span'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->linkContainerTag()
                ->render()
        );
    }

    public function testLinkContainerWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->linkContainerTag(false)
                ->render()
        );
    }

    public function testLinkcontainerWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <article>
            <a href="/">Home</a>
            </article>
            </li>
            <li>
            <article>
            <a href="/about">About</a>
            </article>
            </li>
            <li>
            <article>
            <a href="/contact">Contact</a>
            </article>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->linkContainerTag('article')
                ->render()
        );
    }

    public function testLinkDisableClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <a class="value" href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a class="value" href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/')->disable(),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')->disable()
                )
                ->linkDisableClass('value')
                ->render()
        );
    }

    public function testListDropdownItemClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li class="value">
            <ul>
            <li>
            <a href="#">Action</a>
            </li>
            <li>
            <a href="#">Another actionc</a>
            </li>
            <li>
            <a href="#">Something else here</a>
            </li>
            </ul>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Dropdown::widget()
                        ->containerTag(false)
                        ->items(
                            Item::widget()->label('Action')->link('#'),
                            Item::widget()->label('Another actionc')->link('#'),
                            Item::widget()->label('Something else here')->link('#'),
                        )
                        ->tag(false)
                )
                ->listDropdownItemClass('value')
                ->render()
        );
    }

    public function testListItemActiveClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li class="value">
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/')->active(),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->listItemActiveClass('value')
                ->render()
        );
    }

    public function testListItemAriaCurrent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li aria-current="page">
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/')->active(),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->listItemAriaCurrent(true)
                ->render()
        );
    }

    public function testListItemAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li class="value">
            <a href="/">Home</a>
            </li>
            <li class="value">
            <a href="/about">About</a>
            </li>
            <li class="value">
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->listItemAttributes(['class' => 'value'])
                ->render()
        );
    }

    public function testListItemClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li class="value">
            <a href="/">Home</a>
            </li>
            <li class="value">
            <a href="/about">About</a>
            </li>
            <li class="value">
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->listItemClass('value')
                ->render()
        );
    }

    public function testListItemTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->listItemTag()
                ->render()
        );
    }

    public function testListItemTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/contact">Contact</a>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->listItemTag(false)
                ->render()
        );
    }

    public function testListType(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/about">About</a>
            </li>
            <li>
            <a href="/contact">Contact</a>
            </li>
            </ol>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->listType('ol')
                ->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->prefix('prefix')
                ->render()
        );
    }

    public function testPrefixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
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
            <span>prefix</span>
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->prefix('prefix')
                ->prefixTag('span')
                ->tag(false)
                ->render()
        );
    }

    public function testRender(): void
    {
        $this->assertEmpty(Menu::widget()->render());
    }

    public function testSeparator(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            >
            <a href="/about">About</a>
            </li>
            <li>
            >
            <a href="/contact">Contact</a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->separator('>')
                ->type('breadcrumb')
                ->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div style="value">
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->style('value')
                ->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->suffix('suffix')
                ->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
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
            <span>suffix</span>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )
                ->suffix('suffix')
                ->suffixTag('span')
                ->tag(false)
                ->render()
        );
    }

    public function testTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav>
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
            </nav>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )->tag('nav')
                ->render()
        );
    }

    public function testTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
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
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )->tag(false)
                ->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <article>
            <div>
            <ul>
            <li>
            Home
            </li>
            <li>
            About
            </li>
            <li>
            Contact
            </li>
            </ul>
            </div>
            </article>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('About'),
                    Item::widget()->label('Contact')
                )
                ->template('<article>\n{menu}\n</article>')
                ->render()
        );
    }

    public function testTemplateItem(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article>
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
            </article>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact')
                )->templateItem('<article>\n{items}\n</article>')
                ->render()
        );
    }

    public function testTemplateLinkItem(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <ul>
            <li>
            <a href="/"><span>Home</span></a>
            </li>
            <li>
            <a href="/about"><span>About</span></a>
            </li>
            <li>
            <a href="/contact"><span>Contact</span></a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::widget()
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact'),
                )
                ->templateLinkItem('<span>{icon}{label}{content}</span>')
                ->render()
        );
    }

    public function testToggle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button">
            toggle
            </button>
            <div id="menu-default">
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
            HTML,
            Menu::widget()
                ->id('menu-default')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('About')->link('/about'),
                    Item::widget()->label('Contact')->link('/contact'),
                )
                ->toggle(Toggle::widget()->content('toggle'))
                ->render()
        );
    }
}
