<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests;

use PHPForge\Support\Stub\Unit;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\{Dropdown, Item, Toggle};
use UIAwesome\Html\Core\Component\Tests\Support\{Theme, VariantTheme};
use UIAwesome\Html\Core\Config\{Call, ComponentContext, Config, Cookbook, Recipe};
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Unit tests for the {@see Dropdown} component rendering and immutable configuration.
 */
#[Group('dropdown')]
final class DropdownTest extends TestCase
{
    public function testActivateItems(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <a class="active" href="/action" aria-current="true">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->activateItems(true)
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action')->active(),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->linkActiveClass('active')
                ->render(),
            "Active item must carry the active class and 'aria-current'.",
        );
    }

    public function testActivateItemsWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->activateItems(false)
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action')->active(),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            <div class="value" id="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->attributes(['class' => 'value'])
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testClass(): void
    {
        self::assertSame(
            <<<HTML
            <div class="dropdown" id="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->class('dropdown')
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->render(),
            'CSS class must be applied to the wrapper.',
        );
    }

    public function testConfigAppliesContainerAndToggleRecipe(): void
    {
        $toggle = Toggle::tag()
            ->class('dropdown-trigger')
            ->content('Dropdown button');

        $config = new Config(
            new Theme(
                'stub',
                new Recipe(
                    'stub.dropdown',
                    new Cookbook(
                        new Call('containerClass', 'dropdown-shell'),
                        new Call('containerTag', Block::DIV),
                        new Call('linkClass', 'dropdown-entry'),
                        new Call('listClass', 'dropdown-list'),
                        new Call('toggle',  $toggle),
                    ),
                ),
            ),
        );

        self::assertSame(
            <<<HTML
            <div class="dropdown-shell" id="dropdown">
            <button class="dropdown-trigger" type="button">
            Dropdown button
            </button>
            <ul class="dropdown-list">
            <li>
            <a class="dropdown-entry" href="/profile">
            Profile
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->config($config, new ComponentContext('dropdown'))
                ->id('dropdown')
                ->items(Item::tag()->label('Profile')->link('/profile'))
                ->render(),
            'Recipe must emit the container wrapper, the toggle, and the menu classes.',
        );
    }

    public function testConfigIsOverriddenByFluentCallsMadeAfterwards(): void
    {
        $config = new Config(
            new Theme(
                'stub',
                new Recipe(
                    'stub.dropdown',
                    new Cookbook(
                        new Call('listClass', 'from-config'),
                        new Call('id', 'id-config'),
                    ),
                ),
            ),
        );

        self::assertSame(
            <<<HTML
            <div id="id-user">
            <ul class="from-config">
            <li>
            <a href="/profile">
            Profile
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->config($config, new ComponentContext('dropdown'))
                ->id('id-user')
                ->items(Item::tag()->label('Profile')->link('/profile'))
                ->render(),
            'Local call must win over the recipe value.',
        );
    }

    public function testConfigResolvesVariantFromContext(): void
    {
        $config = new Config(
            new VariantTheme('stub', 'dropdown dropdown-%1$s', ['info', 'warning']),
        );

        self::assertSame(
            <<<HTML
            <div class="dropdown dropdown-info" id="dropdown">
            <ul>
            <li>
            <a href="/profile">
            Profile
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->config($config, new ComponentContext('dropdown', variant: 'info'))
                ->id('dropdown')
                ->items(Item::tag()->label('Profile')->link('/profile'))
                ->render(),
            'Menu wrapper class must carry the context variant.',
        );
    }

    public function testDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown" data-value="value">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->dataAttributes(['value' => 'value'])
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->render(),
            "Data attribute map must be applied as 'data-*'.",
        );
    }

    public function testDataBsToggle(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown" data-bs-toggle="value">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->addDataAttribute('bs-toggle', 'value')
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->render(),
            "'data-bs-toggle' must be serialized.",
        );
    }

    public function testFirstItemClass(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li class="value">
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->firstItemClass('value')
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->render(),
            'First item must carry the configured class.',
        );
    }

    public function testFirstItemClassReplacesListItemClass(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li class="first">
            <a href="/action">
            Action
            </a>
            </li>
            <li class="base">
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->firstItemClass('first')
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                )
                ->listItemClass('base')
                ->render(),
            'Only the first item must lose the base class.',
        );
    }

    public function testFirstLinkClass(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <a class="value" href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->firstLinkClass('value')
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->render(),
            'First link must carry the configured class.',
        );
    }

    public function testGenerateId(): void
    {
        self::assertStringContainsString(
            'dropdown-',
            Dropdown::tag()->items(Item::tag()->label('Home')->link('/'))->render(),
            "Auto-generated id must use the 'dropdown-' prefix.",
        );
    }

    public function testId(): void
    {
        self::assertSame(
            <<<HTML
            <div id="value">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('value')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->render(),
            'Explicit id must override the generated id.',
        );
    }

    public function testLastItemClass(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li class="value">
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            <div id="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a class="value" href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            <div id="dropdown">
            <ul>
            <li>
            <a class="value" href="/action" aria-current="true">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action')->active(),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->linkActiveClass('value')
                ->render(),
            'Active link must carry the configured class.',
        );
    }

    public function testLinkActiveClassReplacesLinkClass(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <a class="active-only" href="/action" aria-current="true">
            Action
            </a>
            </li>
            <li>
            <a class="base" href="/another-actionc">
            Another actionc
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action')->active(),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                )
                ->linkActiveClass('active-only')
                ->linkClass('base')
                ->render(),
            'Base class must not survive on the active link.',
        );
    }

    public function testLinkAriaCurrent(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <a href="/action" aria-current="true">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc" aria-current="true">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action')->active(),
                    Item::tag()->label('Another actionc')->link('/another-actionc')->active(),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->linkAriaCurrent(true)
                ->render(),
            "Active link must carry the 'aria-current' attribute.",
        );
    }

    public function testLinkAriaCurrentWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action')->active(),
                    Item::tag()->label('Another actionc')->link('/another-actionc')->active(),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->linkAriaCurrent(false)
                ->render(),
            "Disabled flag must drop the 'aria-current' attribute.",
        );
    }

    public function testLinkAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <a class="value" href="/action">
            Action
            </a>
            </li>
            <li>
            <a class="value" href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a class="value" href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            <div id="dropdown">
            <ul>
            <li>
            <a class="value" href="/action">
            Action
            </a>
            </li>
            <li>
            <a class="value" href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a class="value" href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            <div id="dropdown">
            <ul>
            <li>
            <div class="value">
            <a href="/action">
            Action
            </a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/another-actionc">
            Another actionc
            </a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/something-else-here">
            Something else here
            </a>
            </div>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            <div id="dropdown">
            <ul>
            <li>
            <div class="value">
            <a href="/action">
            Action
            </a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/another-actionc">
            Another actionc
            </a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/something-else-here">
            Something else here
            </a>
            </div>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            <div id="dropdown">
            <ul>
            <li>
            <div>
            <a href="/action">
            Action
            </a>
            </div>
            </li>
            <li>
            <div>
            <a href="/another-actionc">
            Another actionc
            </a>
            </div>
            </li>
            <li>
            <div>
            <a href="/something-else-here">
            Something else here
            </a>
            </div>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->linkContainerTag()
                ->render(),
            'Default link container tag must wrap every link.',
        );
    }

    public function testLinkContainerTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->linkContainerTag(false)
                ->render(),
            "'false' link container tag must drop the wrapper.",
        );
    }

    public function testLinkContainerTagWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <span>
            <a href="/action">
            Action
            </a>
            </span>
            </li>
            <li>
            <span>
            <a href="/another-actionc">
            Another actionc
            </a>
            </span>
            </li>
            <li>
            <span>
            <a href="/something-else-here">
            Something else here
            </a>
            </span>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->linkContainerTag('span')
                ->render(),
            'Custom link container tag must wrap every link.',
        );
    }

    public function testLinkDisableClass(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a class="value" href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here')->disabled(),
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
            <div id="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            <div id="dropdown">
            <ul>
            <li>
            Action
            </li>
            <li>
            Another actionc
            </li>
            <li>
            Something else here
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->linkTag(false)
                ->render(),
            "'false' link tag must drop the link wrapper.",
        );
    }

    public function testLinkTagWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <span>
            Action
            </span>
            </li>
            <li>
            <span>
            Another actionc
            </span>
            </li>
            <li>
            <span>
            Something else here
            </span>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            <div id="dropdown">
            <ul class="value">
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            <div id="dropdown">
            <ul class="value">
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->listClass('value')
                ->render(),
            'CSS class must be applied to the list wrapper.',
        );
    }

    public function testListItemAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li class="value">
            <a href="/action">
            Action
            </a>
            </li>
            <li class="value">
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li class="value">
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            <div id="dropdown">
            <ul>
            <li class="value">
            <a href="/action">
            Action
            </a>
            </li>
            <li class="value">
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li class="value">
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            <div id="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->listItemTag('li')
                ->render(),
            'Default list item tag must wrap every item.',
        );
    }

    public function testListItemTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            Action
            Another actionc
            Something else here
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action'),
                    Item::tag()->label('Another actionc'),
                    Item::tag()->label('Something else here'),
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
            <div id="dropdown">
            <ol>
            <li>
            Action
            </li>
            <li>
            Another actionc
            </li>
            <li>
            Something else here
            </li>
            </ol>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action'),
                    Item::tag()->label('Another actionc'),
                    Item::tag()->label('Something else here'),
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
            <div id="dropdown">
            prefix
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->prefix('prefix')
                ->render(),
            'Prefix must precede the inner wrapper.',
        );
    }

    public function testPrefixAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            prefix
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            <div id="dropdown">
            prefix
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->prefix('prefix')
                ->prefixClass('value')
                ->prefixTag()
                ->render(),
            'CSS class must be applied to the prefix wrapper.',
        );
    }

    public function testPrefixItems(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            prefix
            prefix-items
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            <div id="dropdown">
            prefix
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->prefix('prefix')
                ->prefixTag()
                ->render(),
            'Default prefix tag must wrap the prefix.',
        );
    }

    public function testPrefixTagwithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            prefix
            <ul>
            <li>
            Action
            </li>
            <li>
            Another actionc
            </li>
            <li>
            Something else here
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action'),
                    Item::tag()->label('Another actionc'),
                    Item::tag()->label('Something else here'),
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
            <div id="dropdown">
            <span>
            prefix
            </span>
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            Dropdown::tag()->render(),
            'Empty dropdown must render an empty string.',
        );
    }

    public function testRenderKeepsContainerAttributesAlongsideOwnAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown" data-controller="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->containerAttributes(['data-controller' => 'dropdown'])
                ->id('dropdown')
                ->items(Item::tag()->label('Action')->link('/action'))
                ->render(),
            'Both attribute maps must reach the container.',
        );
    }

    public function testRenderKeepsListAsDirectChildOfContainerMergingClasses(): void
    {
        self::assertSame(
            <<<HTML
            <div class="mine dropdown" id="dropdown">
            <ul class="dropdown-menu">
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->class('mine')
                ->containerClass('dropdown')
                ->id('dropdown')
                ->items(Item::tag()->label('Action')->link('/action'))
                ->listClass('dropdown-menu')
                ->render(),
            'No wrapper may sit between the container and the list.',
        );
    }

    public function testRenderReturnsEmptyEvenWithContainerTagWhenItemsAreEmpty(): void
    {
        self::assertEmpty(
            Dropdown::tag()->containerTag(Block::DIV)->render(),
            'Empty `items` list must short-circuit before wrapping with the container tag.',
        );
    }

    public function testRenderSkipsContainerWhenContainerTagIsNotBacked(): void
    {
        self::assertSame(
            <<<HTML
            <ul>
            <li>
            <a href="/profile">
            Profile
            </a>
            </li>
            </ul>
            HTML,
            Dropdown::tag()
                ->containerTag(Unit::value)
                ->id('dropdown')
                ->items(Item::tag()->label('Profile')->link('/profile'))
                ->render(),
            'A tag without a backing value must leave the menu unwrapped.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $instance = Dropdown::tag();

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
            $instance->linkRemoveAttribute('class'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkSetAttribute('id', 'x'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkTag('a'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listClass('x'),
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
            $instance->toggle(''),
            'New instance must be returned (immutability).',
        );
    }

    public function testStyle(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown" style='value'>
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
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
            <div id="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            </ul>
            suffix
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                )
                ->suffix('suffix')
                ->render(),
            'Suffix must follow the list.',
        );
    }

    public function testSuffixAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            </ul>
            suffix
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
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
            <div id="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            </ul>
            suffix
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                )
                ->suffix('suffix')
                ->suffixClass('value')
                ->suffixTag()
                ->render(),
            'CSS class must be applied to the suffix wrapper.',
        );
    }

    public function testSuffixItems(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            </ul>
            suffix-items
            suffix
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
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
            <div id="dropdown">
            <ul>
            <li>
            Action
            </li>
            <li>
            Another actionc
            </li>
            </ul>
            suffix
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action'),
                    Item::tag()->label('Another actionc'),
                )
                ->suffix('suffix')
                ->suffixTag()
                ->render(),
            'Default suffix tag must wrap the suffix.',
        );
    }

    public function testSuffixTagwithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            Action
            </li>
            <li>
            Another actionc
            </li>
            </ul>
            suffix
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action'),
                    Item::tag()->label('Another actionc'),
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
            <div id="dropdown">
            <ul>
            <li>
            Action
            </li>
            <li>
            Another actionc
            </li>
            </ul>
            <span>
            suffix
            </span>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action'),
                    Item::tag()->label('Another actionc'),
                )
                ->suffix('suffix')
                ->suffixTag(Inline::SPAN)
                ->render(),
            'Custom suffix tag must wrap the suffix.',
        );
    }

    public function testTemplateLink(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            contentAnother actionc
            </a>
            </li>
            <li>
            <a href="/something-else-here">
            Something else here
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()
                        ->content('content')
                        ->label('Another actionc')
                        ->link('/another-actionc')
                        ->iconClass('icon'),
                    Item::tag()->label('Something else here')->link('/something-else-here'),
                )
                ->templateLinkItem('{content}{icon}{label}')
                ->render(),
            'Custom link item template must control the link composition.',
        );
    }

    public function testToggle(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <button type="button" data-dropdown-toggle="dropdown-65f0094ceefe3">
            toggle
            </button>
            <ul>
            <li>
            <a href="/action">
            Action
            </a>
            </li>
            <li>
            <a href="/another-actionc">
            Another actionc
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(
                    Item::tag()->label('Action')->link('/action'),
                    Item::tag()->label('Another actionc')->link('/another-actionc'),
                )
                ->toggle(
                    Toggle::tag()
                        ->addDataAttribute('dropdown-toggle', 'dropdown-65f0094ceefe3')
                        ->content('toggle'),
                )
                ->render(),
            'Toggle must render before the inner wrapper.',
        );
    }
}
