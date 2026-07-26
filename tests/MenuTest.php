<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\{Dropdown, Item, Menu, Toggle};
use UIAwesome\Html\Core\Component\Tests\Support\RenderToggleOverride;
use UIAwesome\Html\Interop\Inline;

/**
 * Unit tests for the {@see Menu} component rendering and immutable configuration.
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
                ->activateItems()
                ->currentPath('/')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                    Item::tag()->label('Contact')->link('/contact'),
                )
                ->linkActiveClass('active')
                ->render(),
            "Default 'activateItems' argument must enable activation.",
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

    public function testFirstItemClassOverridesBaseClass(): void
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
            <li class="base">
            <a href="/about">
            About
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
                )
                ->listItemAttributes(['class' => 'base'])
                ->render(),
            "Default 'firstItemClass' override must replace the base list-item class.",
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

    public function testLastItemClassOverridesBaseClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li class="base">
            <a href="/">
            Home
            </a>
            </li>
            <li class="value">
            <a href="/about">
            About
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                )
                ->lastItemClass('value')
                ->listItemAttributes(['class' => 'base'])
                ->render(),
            "Default 'lastItemClass' override must replace the base list-item class.",
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

    public function testLastLinkClassOverridesBaseClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <a class="base" href="/">
            Home
            </a>
            </li>
            <li>
            <a class="value" href="/about">
            About
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('About')->link('/about'),
                )
                ->lastLinkClass('value')
                ->linkAttributes(['class' => 'base'])
                ->render(),
            "Default 'lastLinkClass' override must replace the base link class.",
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
                ->linkAriaCurrent()
                ->render(),
            "Default 'linkAriaCurrent' argument must carry the 'aria-current' attribute on the active link.",
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

    public function testLinkClassMergesWithBaseLinkAttributeClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <a class="base value" href="/">
            Home
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->linkAttributes(['class' => 'base'])
                ->linkClass('value')
                ->render(),
            "Default 'linkClass' merge must append to existing link class.",
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

    public function testLinkContainerAttributesMergesAcrossCalls(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <span class="first" data-x="value">
            <a href="/">
            Home
            </a>
            </span>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->linkContainerAttributes(['class' => 'first'])
                ->linkContainerAttributes(['data-x' => 'value'])
                ->linkContainerTag('span')
                ->render(),
            'Prior values must be retained on merge.',
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

    public function testLinkContainerClassMergesWithBaseLinkContainerAttributeClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <span class="base value">
            <a href="/">
            Home
            </a>
            </span>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->linkContainerAttributes(['class' => 'base'])
                ->linkContainerClass('value')
                ->linkContainerTag('span')
                ->render(),
            "Default 'linkContainerClass' merge must append to existing link-container class.",
        );
    }

    public function testLinkContainerRemoveAttribute(): void
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
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->linkContainerAttributes(['data-x' => 'value'])
                ->linkContainerRemoveAttribute('data-x')
                ->linkContainerTag('span')
                ->render(),
            'Removed link-container attribute must not appear on the rendered wrapper.',
        );
    }

    public function testLinkContainerSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <span data-x="value">
            <a href="/">
            Home
            </a>
            </span>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->linkContainerSetAttribute('data-x', 'value')
                ->linkContainerTag('span')
                ->render(),
            'Set link-container attribute must appear on the rendered wrapper.',
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

    public function testLinkDisabledClassMergesWithBaseLinkAttributeClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <a class="base value" href="/">
            Home
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/')->disabled())
                ->linkAttributes(['class' => 'base'])
                ->linkDisabledClass('value')
                ->render(),
            "Default 'linkDisabledClass' merge must append to existing link class for disabled items.",
        );
    }

    public function testLinkRemoveAttribute(): void
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
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->linkAttributes(['rel' => 'nofollow'])
                ->linkRemoveAttribute('rel')
                ->render(),
            'Removed link attribute must not appear on the rendered link.',
        );
    }

    public function testLinkSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <a href="/" rel="nofollow">
            Home
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->linkSetAttribute('rel', 'nofollow')
                ->render(),
            'Set link attribute must appear on the rendered link.',
        );
    }

    public function testListAttributesMergesAcrossCalls(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul class="first" data-x="value">
            <li>
            <a href="/">
            Home
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->listAttributes(['class' => 'first'])
                ->listAttributes(['data-x' => 'value'])
                ->render(),
            'Prior values must be retained on merge.',
        );
    }

    public function testListClassMergesWithBaseListAttributeClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul class="base value">
            <li>
            <a href="/">
            Home
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->listAttributes(['class' => 'base'])
                ->listClass('value')
                ->render(),
            "Default 'listClass' merge must append to existing list class.",
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

    public function testListItemClassMergesWithBaseListItemAttributeClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li class="base value">
            <a href="/">
            Home
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->listItemAttributes(['class' => 'base'])
                ->listItemClass('value')
                ->render(),
            "Default 'listItemClass' merge must append to existing list-item class.",
        );
    }

    public function testListItemDisabledClassMergesWithBaseListItemAttributeClass(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li class="base value">
            <a href="/">
            Home
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/')->disabled())
                ->listItemAttributes(['class' => 'base'])
                ->listItemDisabledClass('value')
                ->render(),
            "Default 'listItemDisabledClass' merge must append to existing list-item class for disabled items.",
        );
    }

    public function testListItemRemoveAttribute(): void
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
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->listItemAttributes(['data-x' => 'value'])
                ->listItemRemoveAttribute('data-x')
                ->render(),
            "Removed list-item attribute must not appear on the rendered '<li>'.",
        );
    }

    public function testListItemSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li data-x="value">
            <a href="/">
            Home
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->listItemSetAttribute('data-x', 'value')
                ->render(),
            "Set list-item attribute must appear on the rendered '<li>'.",
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

    public function testListItemTagWithBackedEnumValue(): void
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
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->listItemTag(\UIAwesome\Html\Interop\Lists::LI)
                ->render(),
            "`BackedEnum` value must normalize to its scalar before validating against `'li'`.",
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

    public function testListRemoveAttribute(): void
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
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->listAttributes(['data-x' => 'value'])
                ->listRemoveAttribute('data-x')
                ->render(),
            "Removed list attribute must not appear on the rendered '<ul>'.",
        );
    }

    public function testListSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul data-x="value">
            <li>
            <a href="/">
            Home
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->listSetAttribute('data-x', 'value')
                ->render(),
            "Set list attribute must appear on the rendered '<ul>'.",
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

    public function testListTypeWithBackedEnumValue(): void
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
            </ol>
            </div>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->listType(\UIAwesome\Html\Interop\Lists::OL)
                ->render(),
            "`BackedEnum` value must normalize to its scalar before validating against `'ol'`/`'ul'`.",
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

    public function testRenderReturnsEmptyEvenWithToggleWhenItemsAreEmpty(): void
    {
        self::assertEmpty(
            Menu::tag()->toggle(Toggle::tag()->content('toggle'))->render(),
            'Empty `items` list must short-circuit before rendering the toggle.',
        );
    }

    public function testRenderToggleRemainsProtectedForSubclassOverride(): void
    {
        self::assertInstanceOf(
            Menu::class,
            new RenderToggleOverride(),
            'Override subclass must be a `Menu` instance.',
        );
    }

    public function testRenderWithNavigationType(): void
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
            </ul>
            </nav>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->type('navigation')
                ->render(),
            "Type 'navigation' must wrap the menu in a '<nav>' element.",
        );
    }

    public function testRenderWithNavType(): void
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
            </ul>
            </nav>
            HTML,
            Menu::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->type('nav')
                ->render(),
            "Type 'nav' must wrap the menu in a '<nav>' element.",
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $instance = Menu::tag();

        self::assertNotSame(
            $instance,
            $instance->activateItems(),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->ariaCurrent(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->currentPath(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->dropdownDefaultDefinitions([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->firstItemClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->firstLinkClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->items(),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->lastItemClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->lastLinkClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkActiveClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkActiveTag(false),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkAriaCurrent(),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkContainerAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkContainerClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkContainerRemoveAttribute('key'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkContainerSetAttribute('key', 'value'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkContainerTag(false),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkDisabledClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkRemoveAttribute('key'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkSetAttribute('key', 'value'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkTag(false),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listDropdownItemClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listItemActiveClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listItemAriaCurrent(),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listItemAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listItemClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listItemDisabledClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listItemRemoveAttribute('key'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listItemSetAttribute('key', 'value'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listItemTag(false),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listRemoveAttribute('key'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listSetAttribute('key', 'value'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listType(false),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->prefixItems(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->suffixItems(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->templateLinkItem(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->separator(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->templateItem(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->toggle(''),
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

    public function testThrowInvalidArgumentExceptionWhenListTypeIsNotAllowed(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Value 'span' is not in the list of valid values for 'listType': 'ol', 'ul'.",
        );

        Menu::tag()->listType('span');
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
