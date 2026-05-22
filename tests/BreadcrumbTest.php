<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\{Breadcrumb, Item};
use UIAwesome\Html\Interop\Inline;

/**
 * Unit tests for the {@see Breadcrumb} component rendering and immutable configuration.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('breadcrumb')]
final class BreadcrumbTest extends TestCase
{
    public function testActivateItems(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li class="active" aria-current="page">
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->currentPath('/data')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->listItemActiveClass('active')
                ->listItemAriaCurrent(true)
                ->render(),
            "Active item must carry the active class and 'aria-current'.",
        );
    }

    public function testActivateItemsWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->activateItems(false)
                ->currentPath('/data')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->listItemActiveClass('active')
                ->render(),
            'Disabled activation must drop the active markers.',
        );
    }

    public function testAriaLabel(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="value">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->ariaLabel('value')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->render(),
            "'aria-label' must be applied to the wrapper.",
        );
    }

    public function testAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <nav class="value" id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->attributes(['class' => 'value'])
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav class="value" id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->class('value')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->render(),
            'CSS class must be applied to the wrapper.',
        );
    }

    public function testCurrentPath(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li class="active" aria-current="page">
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->currentPath('/data')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->listItemActiveClass('active')
                ->listItemAriaCurrent(true)
                ->render(),
            "Matching 'currentPath' must activate the item.",
        );
    }

    public function testFirstItemClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li class="value">
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->firstItemClass('value')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->render(),
            'First item must carry the configured class.',
        );
    }

    public function testFirstLinkClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a class="value" href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->firstLinkClass('value')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->render(),
            'First link must carry the configured class.',
        );
    }

    public function testGenerateId(): void
    {
        self::assertStringContainsString(
            'breadcrumb-',
            Breadcrumb::tag()
                ->items(Item::tag()->label('Home')->link('/'))
                ->render(),
            "Auto-generated id must use the 'breadcrumb-' prefix.",
        );
    }

    public function testId(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="value" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('value')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->render(),
            'Explicit id must override the generated id.',
        );
    }

    public function testLastItemClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li class="value">
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
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
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a class="value" href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
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
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a class="value" href="/library" aria-current="page">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->currentPath('/library')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->linkActiveClass('value')
                ->linkActiveTag('a')
                ->linkAriaCurrent(true)
                ->render(),
            'Active link must carry the configured class.',
        );
    }

    public function testLinkActiveTag(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <span href="/library" aria-current="page">
            Library
            </span>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->currentPath('/library')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->linkActiveTag('span')
                ->linkAriaCurrent(true)
                ->render(),
            'Active link must use the configured tag.',
        );
    }

    public function testLinkAriaCurrent(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library" aria-current="page">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->currentPath('/library')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->linkAriaCurrent(true)
                ->linkActiveTag('a')
                ->render(),
            "Active link must carry the 'aria-current' attribute.",
        );
    }

    public function testLinkAriaCurrentWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->currentPath('/library')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->linkAriaCurrent(false)
                ->linkActiveTag('a')
                ->render(),
            "Disabled flag must drop the 'aria-current' attribute.",
        );
    }

    public function testLinkAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a class="value" href="/">
            Home
            </a>
            </li>
            <li>
            <a class="value" href="/library">
            Library
            </a>
            </li>
            <li>
            <a class="value" href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
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
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a class="value" href="/">
            Home
            </a>
            </li>
            <li>
            <a class="value" href="/library">
            Library
            </a>
            </li>
            <li>
            <a class="value" href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
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
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <div class="value">
            <a href="/">
            Home
            </a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/library">
            Library
            </a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/data">
            Data
            </a>
            </div>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
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
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <div class="value">
            <a href="/">
            Home
            </a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/library">
            Library
            </a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/data">
            Data
            </a>
            </div>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
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
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <div>
            <a href="/">
            Home
            </a>
            </div>
            </li>
            <li>
            <div>
            <a href="/library">
            Library
            </a>
            </div>
            </li>
            <li>
            <div>
            <a href="/data">
            Data
            </a>
            </div>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->linkContainerTag()
                ->render(),
            'Link container tag must wrap every link.',
        );
    }

    public function testLinkDisableClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a class="value" href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data')->disabled(),
                )
                ->linkDisabledClass('value')
                ->render(),
            'Disabled link must carry the configured class.',
        );
    }

    public function testLinkTag(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->linkTag()
                ->render(),
            "Default link tag must be '<a>'.",
        );
    }

    public function testLinkTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->linkTag(false)
                ->render(),
            "'false' link tag must drop the link wrapper.",
        );
    }

    public function testLinkTagWitValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <span href="/">
            Home
            </span>
            </li>
            <li>
            <span href="/library">
            Library
            </span>
            </li>
            <li>
            <span href="/data">
            Data
            </span>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->linkTag('span')
                ->render(),
            'Custom link tag must wrap every link.',
        );
    }

    public function testListAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol class="value">
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->listAttributes(['class' => 'value'])
                ->render(),
            'List attribute map must decorate the list wrapper.',
        );
    }

    public function testListClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol class="value">
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->listClass('value')
                ->render(),
            'CSS class must be applied to the list wrapper.',
        );
    }

    public function testListItemActiveClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li class="value" aria-current="page">
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->currentPath('/data')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->listItemActiveClass('value')
                ->listItemAriaCurrent(true)
                ->render(),
            'Active list item must carry the configured class.',
        );
    }

    public function testListItemAriaCurrent(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li class="active" aria-current="page">
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->activateItems(true)
                ->currentPath('/data')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->listItemActiveClass('active')
                ->listItemAriaCurrent(true)
                ->render(),
            "Active list item must carry the 'aria-current' attribute.",
        );
    }

    public function testListItemAriaCurrentWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li class="active">
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->activateItems(true)
                ->currentPath('/data')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->listItemActiveClass('active')
                ->listItemAriaCurrent(false)
                ->render(),
            "Disabled flag must drop the 'aria-current' attribute.",
        );
    }

    public function testListItemAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li class="value">
            <a href="/">
            Home
            </a>
            </li>
            <li class="value">
            <a href="/library">
            Library
            </a>
            </li>
            <li class="value">
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
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
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li class="value">
            <a href="/">
            Home
            </a>
            </li>
            <li class="value">
            <a href="/library">
            Library
            </a>
            </li>
            <li class="value">
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->listItemClass('value')
                ->render(),
            'CSS class must be applied to every list item.',
        );
    }

    public function testListItemDisabledClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li class="value">
            <a href="/">
            Home
            </a>
            </li>
            <li class="value">
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/')->disabled(),
                    Item::tag()->label('Library')->link('/library')->disabled(),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->listItemDisabledClass('value')
                ->render(),
            'Disabled list item must carry the configured class.',
        );
    }

    public function testListItemTag(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home'),
                    Item::tag()->label('Library'),
                    Item::tag()->label('Data'),
                )
                ->listItemTag()
                ->render(),
            "Default list item tag must be '<li>'.",
        );
    }

    public function testListItemTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            Home
            Library
            Data
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home'),
                    Item::tag()->label('Library'),
                    Item::tag()->label('Data'),
                )
                ->listItemTag(false)
                ->render(),
            "'false' list item tag must drop the list item wrapper.",
        );
    }

    public function testListType(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ul>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ul>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->listType('ul')
                ->render(),
            'Custom list type must control the list element.',
        );
    }

    public function testPrefix(): void
    {
        self::assertSame(
            <<<HTML
            prefix
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
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
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->prefixAttributes(['class' => 'value'])
                ->prefix('prefix')
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
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->prefixClass('value')
                ->prefix('prefix')
                ->prefixTag()
                ->render(),
            'CSS class must be applied to the prefix wrapper.',
        );
    }

    public function testPrefixItems(): void
    {
        self::assertSame(
            <<<HTML
            prefix
            <nav id="breadcrumb" aria-label="breadcrumb">
            prefix-items
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home'),
                    Item::tag()->label('Library'),
                    Item::tag()->label('Data'),
                )
                ->prefix('prefix')
                ->prefixItems('prefix-items')
                ->render(),
            'Prefix items must precede the list.',
        );
    }

    public function testPrefixTag(): void
    {
        self::assertSame(
            <<<HTML
            prefix
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home'),
                    Item::tag()->label('Library'),
                    Item::tag()->label('Data'),
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
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home'),
                    Item::tag()->label('Library'),
                    Item::tag()->label('Data'),
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
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home'),
                    Item::tag()->label('Library'),
                    Item::tag()->label('Data'),
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
            Breadcrumb::tag()->render(),
            'Empty breadcrumb must render an empty string.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $instance = Breadcrumb::tag();

        self::assertNotSame(
            $instance,
            $instance->activateItems(true),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->ariaCurrent(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->ariaLabel(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->currentPath(''),
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
            $instance->separator(''),
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
    }

    public function testSeparator(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            >
            Library
            </li>
            <li>
            >
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home'),
                    Item::tag()->label('Library'),
                    Item::tag()->label('Data'),
                )
                ->separator('>')
                ->render(),
            'Separator must precede each non-first item.',
        );
    }

    public function testStyle(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" style='value' aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home'),
                    Item::tag()->label('Library'),
                    Item::tag()->label('Data'),
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
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            suffix
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home'),
                    Item::tag()->label('Library'),
                    Item::tag()->label('Data'),
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
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            suffix
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->suffixAttributes(['class' => 'value'])
                ->suffix('suffix')
                ->suffixTag()
                ->render(),
            'Suffix attribute map must decorate the suffix wrapper.',
        );
    }

    public function testSuffixClass(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            Library
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            suffix
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Library')->link('/library'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->suffixClass('value')
                ->suffix('suffix')
                ->suffixTag()
                ->render(),
            'CSS class must be applied to the suffix wrapper.',
        );
    }

    public function testSuffixItems(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            suffix-items
            </nav>
            suffix
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home'),
                    Item::tag()->label('Library'),
                    Item::tag()->label('Data'),
                )
                ->suffix('suffix')
                ->suffixItems('suffix-items')
                ->render(),
            'Suffix items must follow the list.',
        );
    }

    public function testSuffixTag(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            suffix
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home'),
                    Item::tag()->label('Library'),
                    Item::tag()->label('Data'),
                )
                ->suffix('suffix')
                ->suffixTag()
                ->render(),
            'Default suffix tag must wrap the suffix.',
        );
    }

    public function testSuffixWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            suffix
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home'),
                    Item::tag()->label('Library'),
                    Item::tag()->label('Data'),
                )
                ->suffix('suffix')
                ->suffixTag(false)
                ->render(),
            "'false' suffix tag must drop the suffix wrapper.",
        );
    }

    public function testSuffixWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            <span>
            suffix
            </span>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home'),
                    Item::tag()->label('Library'),
                    Item::tag()->label('Data'),
                )
                ->suffix('suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            'Custom suffix tag must wrap the suffix.',
        );
    }

    public function testTemplateLinkItem(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            <li>
            <a href="/library">
            contentLibrary
            </a>
            </li>
            <li>
            <a href="/data">
            Data
            </a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->content('content')->label('Library')->link('/library')->iconClass('icon'),
                    Item::tag()->label('Data')->link('/data'),
                )
                ->templateLinkItem('{content}{icon}{label}')
                ->render(),
            'Custom link item template must control the link composition.',
        );
    }
}
