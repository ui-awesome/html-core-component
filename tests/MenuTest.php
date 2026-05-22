<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\{Dropdown, Item, Menu, Toggle};
use UIAwesome\Html\Interop\Inline;

/**
 * Unit tests for the {@see Menu} component rendering and immutable configuration.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('menu')]
final class MenuTest extends TestCase
{
    public function testActivateItems(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <a class="active" href="/">
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
            HTML,
            Menu::tag()
                ->activateItems(true)
                ->currentPath('/')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->linkActiveClass('active')
                ->render(),
            'Active item must carry the active class.',
        );
    }

    public function testActivateItemsWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
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
            HTML,
            Menu::tag()
                ->activateItems(false)
                ->currentPath('/')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->linkActiveClass('active')
                ->render(),
            'Disabled activation must drop the active markers.',
        );
    }

    public function testAttributes(): void
    {
        self::assertSame(
            <<<HTML
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
            HTML,
            Menu::tag()
                ->attributes(['class' => 'value'])
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testClass(): void
    {
        self::assertSame(
            <<<HTML
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
            HTML,
            Menu::tag()
                ->class('value')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->render(),
            'CSS class must be applied to the wrapper.',
        );
    }

    public function testCurrentPath(): void
    {
        self::assertSame(
            <<<HTML
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
            <a class="active" href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->currentPath('/contact')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->linkActiveClass('active')
                ->render(),
            "Matching 'currentPath' must activate the item.",
        );
    }

    public function testDividerClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <hr>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->divider(),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->render(),
            'Divider item must render as the configured separator element.',
        );
    }

    public function testFirstItemClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li class="value">
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
            HTML,
            Menu::tag()
                ->firstItemClass('value')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->render(),
            'First item must carry the configured class.',
        );
    }

    public function testFirstLinkClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <a class="value" href="/">
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
            HTML,
            Menu::tag()
                ->firstLinkClass('value')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->render(),
            'First link must carry the configured class.',
        );
    }

    public function testId(): void
    {
        self::assertSame(
            <<<HTML
            <div id="value">
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
            HTML,
            Menu::tag()
                ->id('value')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->render(),
            'Explicit id must be applied to the wrapper.',
        );
    }

    public function testIsLinkAriaCurrent(): void
    {
        self::assertTrue(
            Menu::tag()->linkAriaCurrent(true)->isLinkAriaCurrent(),
            "Link 'aria-current' flag must be reflected by the accessor.",
        );
    }

    public function testIsListItemAriaCurrent(): void
    {
        self::assertTrue(
            Menu::tag()->listItemAriaCurrent(true)->isListItemAriaCurrent(),
            "List item 'aria-current' flag must be reflected by the accessor.",
        );
    }

    public function testLastItemClass(): void
    {
        self::assertSame(
            <<<HTML
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
            <li class="value">
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->lastItemClass('value')
                ->render(),
            'Last item must carry the configured class.',
        );
    }

    public function testLastLinkClass(): void
    {
        self::assertSame(
            <<<HTML
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
            <a class="value" href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->lastLinkClass('value')
                ->render(),
            'Last link must carry the configured class.',
        );
    }

    public function testLinkActiveClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <a class="value" href="/">
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/')->active(),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->linkActiveClass('value')
                ->render(),
            'Active link must carry the configured class.',
        );
    }

    public function testLinkActiveTag(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <span href="/about">
            About
            </span>
            </li>
            <li>
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about')->active(),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->linkActiveTag('span')
                ->render(),
            'Active link must use the configured tag.',
        );
    }

    public function testLinkAriaCurrent(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <a href="/" aria-current="page">
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/')->active(),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->linkAriaCurrent(true)
                ->render(),
            "Active link must carry the 'aria-current' attribute.",
        );
    }

    public function testLinkAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <a class="value" href="/">
            Home
            </a>
            </li>
            <li>
            <a class="value" href="/about">
            About
            </a>
            </li>
            <li>
            <a class="value" href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->linkAttributes(['class' => 'value'])
                ->render(),
            'Link attribute map must be applied to every link.',
        );
    }

    public function testLinkClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <a class="value" href="/">
            Home
            </a>
            </li>
            <li>
            <a class="value" href="/about">
            About
            </a>
            </li>
            <li>
            <a class="value" href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->linkClass('value')
                ->render(),
            'CSS class must be applied to every link.',
        );
    }

    public function testLinkContainerAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <div class="value">
            <a href="/">
            Home
            </a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/about">
            About
            </a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/contact">
            Contact
            </a>
            </div>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->linkContainerAttributes(['class' => 'value'])
                ->linkContainerTag()
                ->render(),
            'Link container attribute map must decorate every link wrapper.',
        );
    }

    public function testLinkContainerClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <div class="value">
            <a href="/">
            Home
            </a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/about">
            About
            </a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/contact">
            Contact
            </a>
            </div>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->linkContainerClass('value')
                ->linkContainerTag()
                ->render(),
            'CSS class must be applied to every link container.',
        );
    }

    public function testLinkContainerTag(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <div>
            <a href="/">
            Home
            </a>
            </div>
            </li>
            <li>
            <div>
            <a href="/about">
            About
            </a>
            </div>
            </li>
            <li>
            <div>
            <a href="/contact">
            Contact
            </a>
            </div>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->linkContainerTag()
                ->render(),
            'Default link container tag must wrap every link.',
        );
    }

    public function testLinkContainerTagWithItemValue(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <span>
            <a href="/">
            Home
            </a>
            </span>
            </li>
            <li>
            <div>
            <a href="/about">
            About
            </a>
            </div>
            </li>
            <li>
            <div>
            <a href="/contact">
            Contact
            </a>
            </div>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/')->linkContainerTag('span'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->linkContainerTag()
                ->render(),
            'Item-level link container tag must override the menu default.',
        );
    }

    public function testLinkContainerWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->linkContainerTag(false)
                ->render(),
            "'false' link container tag must drop the wrapper.",
        );
    }

    public function testLinkcontainerWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <article>
            <a href="/">
            Home
            </a>
            </article>
            </li>
            <li>
            <article>
            <a href="/about">
            About
            </a>
            </article>
            </li>
            <li>
            <article>
            <a href="/contact">
            Contact
            </a>
            </article>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->linkContainerTag('article')
                ->render(),
            'Custom link container tag must wrap every link.',
        );
    }

    public function testLinkDisableClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <a class="value" href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/about">
            About
            </a>
            </li>
            <li>
            <a class="value" href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/')->disabled(),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact')->disabled(),
                )
                ->linkDisabledClass('value')
                ->render(),
            'Disabled links must carry the configured class.',
        );
    }

    public function testListDropdownItemClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li class="value">
            <div>
            <ul>
            <li>
            <a href="#">
            Action
            </a>
            </li>
            <li>
            <a href="#">
            Another actionc
            </a>
            </li>
            <li>
            <a href="#">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Dropdown::tag()
                        ->containerTag(false)
                        ->id(null)
                        ->items(
                            Item::tag()->label('Action')->link('#'),
                            Item::tag()->label('Another actionc')->link('#'),
                            Item::tag()->label('Something else here')->link('#'),
                        ),
                )
                ->listDropdownItemClass('value')
                ->render(),
            'Nested dropdown item slot must carry the configured class.',
        );
    }

    public function testListItemActiveClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li class="value">
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/')->active(),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->listItemActiveClass('value')
                ->render(),
            'Active list item must carry the configured class.',
        );
    }

    public function testListItemAriaCurrent(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li aria-current="page">
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/')->active(),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->listItemAriaCurrent(true)
                ->render(),
            "Active list item must carry the 'aria-current' attribute.",
        );
    }

    public function testListItemAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li class="value">
            <a href="/">
            Home
            </a>
            </li>
            <li class="value">
            <a href="/about">
            About
            </a>
            </li>
            <li class="value">
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->listItemAttributes(['class' => 'value'])
                ->render(),
            'List item attribute map must decorate every list item.',
        );
    }

    public function testListItemClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li class="value">
            <a href="/">
            Home
            </a>
            </li>
            <li class="value">
            <a href="/about">
            About
            </a>
            </li>
            <li class="value">
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->listItemClass('value')
                ->render(),
            'CSS class must be applied to every list item.',
        );
    }

    public function testListItemTag(): void
    {
        self::assertSame(
            <<<HTML
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->listItemTag()
                ->render(),
            'Default list item tag must wrap every item.',
        );
    }

    public function testListItemTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <a href="/">
            Home
            </a>
            <a href="/about">
            About
            </a>
            <a href="/contact">
            Contact
            </a>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->listItemTag(false)
                ->render(),
            "'false' list item tag must drop the wrapper.",
        );
    }

    public function testListType(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ol>
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
            </ol>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->listType('ol')
                ->render(),
            'Custom list type must control the list element.',
        );
    }

    public function testPrefix(): void
    {
        self::assertSame(
            <<<HTML
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->prefix('prefix')
                ->render(),
            'Prefix must precede the wrapper.',
        );
    }

    public function testPrefixAttributes(): void
    {
        self::assertSame(
            <<<HTML
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
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
            Menu::tag()->render(),
            'Empty menu must render an empty string.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $instance = Menu::tag();

        self::assertNotSame(
            $instance,
            $instance->ariaCurrent(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->dropdownDefaultDefinitions([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->items(),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listDropdownItemClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->type(''),
            'New instance must be returned (immutability).',
        );
    }

    public function testSeparator(): void
    {
        self::assertSame(
            <<<HTML
            <nav>
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            >
            <a href="/about">
            About
            </a>
            </li>
            <li>
            >
            <a href="/contact">
            Contact
            </a>
            </li>
            </ul>
            </nav>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->separator('>')
                ->type('breadcrumb')
                ->render(),
            'Separator must precede each non-first item in breadcrumb type.',
        );
    }

    public function testStyle(): void
    {
        self::assertSame(
            <<<HTML
            <div style='value'>
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testSuffix(): void
    {
        self::assertSame(
            <<<HTML
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->suffix('suffix')
                ->render(),
            'Suffix must follow the wrapper.',
        );
    }

    public function testSuffixAttributes(): void
    {
        self::assertSame(
            <<<HTML
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
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
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
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
            Menu::tag()
                ->items(
                    Item::tag()->label('Home'),
                    Item::tag()->label('About'),
                    Item::tag()->label('Contact'),
                )
                ->template('<article>\n{menu}\n</article>')
                ->render(),
            'Custom template must control the rendered structure.',
        );
    }

    public function testTemplateItem(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <article>
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
            </article>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->templateItem('<article>\n{items}\n</article>')
                ->render(),
            'Custom items template must wrap the items block.',
        );
    }

    public function testTemplateLinkItem(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <a href="/">
            <span>Home</span>
            </a>
            </li>
            <li>
            <a href="/about">
            <span>About</span>
            </a>
            </li>
            <li>
            <a href="/contact">
            <span>Contact</span>
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->templateLinkItem('<span>{icon}{label}{content}</span>')
                ->render(),
            'Custom link item template must control the link composition.',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenListItemTagIsNotAllowed(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Value 'span' is not in the list of valid values for 'listItemTag': 'li'.",
        );

        Menu::tag()
            ->items(
                Item::tag()->label('Home')->link('/'),
                Item::tag()->label('About')->link('/about'),
                Item::tag()->label('Contact')->link('/contact'),
            )
            ->listItemTag('span')
            ->render();
    }

    public function testToggle(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            toggle
            </button>
            <div id="menu-default">
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
            HTML,
            Menu::tag()
                ->id('menu-default')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->toggle(Toggle::tag()->content('toggle'))
                ->render(),
            'Toggle must render before the wrapper.',
        );
    }
}
