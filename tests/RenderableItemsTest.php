<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use UIAwesome\Html\Contracts\RenderableInterface;
use UIAwesome\Html\Core\Component\{Breadcrumb, Dropdown, Item, Menu, Toggle};
use UIAwesome\Html\Core\Component\Tests\Support\RenderableValue;
use UIAwesome\Html\Interop\Lists;

/**
 * Regression tests for generic renderables accepted by menu-based components.
 */
#[Group('menu')]
final class RenderableItemsTest extends TestCase
{
    public function testBothWrappersCanBeDisabled(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <button type="button">
            Custom item
            </button>
            </div>
            HTML,
            Menu::tag()
                ->items(Toggle::tag()->content('Custom item'))
                ->listAttributes(['class' => 'unused-list'])
                ->listItemAttributes(['class' => 'unused-item'])
                ->listItemTag(false)
                ->listType(false)
                ->render(),
            'Disabled wrappers must not render list markup.',
        );
    }

    public function testBreadcrumbClonesAndRepeatedRendersPreserveItems(): void
    {
        $item = new RenderableValue('<span>Custom</span>');

        $empty = Breadcrumb::tag()->id('breadcrumb');

        $breadcrumb = $empty->items($item);

        $clone = clone $breadcrumb;

        $expected = <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            <span>Custom</span>
            </li>
            </ol>
            </nav>
            HTML;

        self::assertNotSame(
            $empty,
            $breadcrumb,
            'Configured instances must not mutate the source.',
        );
        self::assertSame(
            '',
            $empty->render(),
            'The source must remain empty.',
        );
        self::assertSame(
            0,
            $item->renders,
            'Setup must not render the item.',
        );
        self::assertSame(
            $expected,
            $breadcrumb->render(),
            'Rendered markup must preserve the item and wrappers.',
        );
        self::assertSame(
            1,
            $item->renders,
            'Each render must invoke the item once.',
        );
        self::assertSame(
            $expected,
            $breadcrumb->render(),
            'Repeated rendering must preserve the markup.',
        );
        self::assertSame(
            2,
            $item->renders,
            'Each render must invoke the item once.',
        );
        self::assertSame(
            $expected,
            $clone->render(),
            'Cloning must preserve the rendered markup.',
        );
        self::assertSame(
            3,
            $item->renders,
            'Rendering a clone must invoke the item once.',
        );
    }

    public function testBreadcrumbDelegatesDisabledWrappers(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <span>Custom</span>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(new RenderableValue('<span>Custom</span>'))
                ->listItemAttributes(['class' => 'unused-item'])
                ->listAttributes(['class' => 'unused-list'])
                ->listItemTag(false)
                ->listType(false)
                ->render(),
            'Disabled wrappers must leave the custom item unwrapped.',
        );
    }

    public function testBreadcrumbDelegatesToggleAndWrapperConfiguration(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ul class="entries">
            <li class="entry">
            <button type="button">
            Custom item
            </button>
            </li>
            </ul>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(Toggle::tag()->content('Custom item'))
                ->listAttributes(['class' => 'entries'])
                ->listItemAttributes(['class' => 'entry'])
                ->listType('ul')
                ->render(),
            'Configured wrapper attributes must appear in the rendered markup.',
        );
    }

    public function testBreadcrumbKeepsExistingItemSeparatorPolicy(): void
    {
        $item = new RenderableValue('<span>Custom</span>');

        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol>
            <li>
            First
            </li>
            <li>
            <span>Custom</span>
            </li>
            <li>
            /
            Last
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->id('breadcrumb')
                ->items(Item::tag()->label('First'), $item, Item::tag()->label('Last'))
                ->separator('/')
                ->render(),
            'Separators must follow the existing item policy.',
        );
        self::assertSame(1, $item->renders, 'The custom item must render once.');
    }

    public function testConfiguredWrappersAndAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div id="menu">
            <ol class="entries" data-list="A &amp; B">
            <li class="entry" data-item="A &amp; B">
            <strong>Custom</strong>
            </li>
            </ol>
            </div>
            HTML,
            Menu::tag()
                ->id('menu')
                ->items(new RenderableValue('<strong>Custom</strong>'))
                ->listAttributes(['class' => 'entries', 'data-list' => 'A & B'])
                ->listItemAttributes(['class' => 'entry', 'data-item' => 'A & B'])
                ->listItemTag(Lists::LI)
                ->listType(Lists::OL)
                ->render(),
            'Configured tags and escaped attributes must be rendered.',
        );
    }

    public function testDisabledItemWrapperKeepsListAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul class="entries">
            <li data-own="item">Custom</li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->items(new RenderableValue('<li data-own="item">Custom</li>'))
                ->listAttributes(['class' => 'entries'])
                ->listItemAttributes(['class' => 'unused'])
                ->listItemTag(false)
                ->render(),
            'List attributes must remain when item wrappers are disabled.',
        );
    }

    public function testDisabledListWrapperKeepsItemAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <li class="entry">
            <span>Custom</span>
            </li>
            </div>
            HTML,
            Menu::tag()
                ->items(new RenderableValue('<span>Custom</span>'))
                ->listAttributes(['class' => 'unused'])
                ->listItemAttributes(['class' => 'entry'])
                ->listType(false)
                ->render(),
            'Item attributes must remain when list wrappers are disabled.',
        );
    }

    public function testDropdownClonesAndRepeatedRendersPreserveItems(): void
    {
        $item = new RenderableValue('<span>Custom</span>');

        $empty = Dropdown::tag()->id('dropdown');

        $dropdown = $empty->items($item);

        $clone = clone $dropdown;

        $expected = <<<HTML
            <div id="dropdown">
            <ul>
            <li>
            <span>Custom</span>
            </li>
            </ul>
            </div>
            HTML;

        self::assertNotSame(
            $empty,
            $dropdown,
            'Configured instances must not mutate the source.',
        );
        self::assertSame(
            '',
            $empty->render(),
            'The source must remain empty.',
        );
        self::assertSame(
            0,
            $item->renders,
            'Setup must not render the item.',
        );
        self::assertSame(
            $expected,
            $dropdown->render(),
            'Rendered markup must preserve the item and wrappers.',
        );
        self::assertSame(1, $item->renders, 'Each render must invoke the item once.');
        self::assertSame(
            $expected,
            $dropdown->render(),
            'Repeated rendering must preserve the markup.',
        );
        self::assertSame(
            2,
            $item->renders,
            'Each render must invoke the item once.',
        );
        self::assertSame(
            $expected,
            $clone->render(),
            'Cloning must preserve the rendered markup.',
        );
        self::assertSame(
            3,
            $item->renders,
            'Rendering a clone must invoke the item once.',
        );
    }

    public function testDropdownDelegatesDisabledWrappersAndContainer(): void
    {
        $item = new RenderableValue('<span>Custom</span>');

        self::assertSame(
            '<span>Custom</span>',
            Dropdown::tag()
                ->containerTag(false)
                ->items($item)
                ->listItemAttributes(['class' => 'unused-item'])
                ->listAttributes(['class' => 'unused-list'])
                ->listItemTag(false)
                ->listType(false)
                ->render(),
            'Disabled wrappers and container must leave only the item output.',
        );
        self::assertSame(1, $item->renders, 'The item must render once.');
    }

    public function testDropdownDelegatesToggleAndWrapperConfiguration(): void
    {
        self::assertSame(
            <<<HTML
            <div id="dropdown">
            <ol class="entries">
            <li class="entry">
            <button type="button">
            Custom item
            </button>
            </li>
            </ol>
            </div>
            HTML,
            Dropdown::tag()
                ->id('dropdown')
                ->items(Toggle::tag()->content('Custom item'))
                ->listAttributes(['class' => 'entries'])
                ->listItemAttributes(['class' => 'entry'])
                ->listType('ol')
                ->render(),
            'Configured toggle and wrapper markup must be preserved.',
        );
    }

    public function testEmptyItemBetweenVisibleItemsDoesNotCreateWrapper(): void
    {
        $empty = new RenderableValue('');
        $visible = new RenderableValue('<span>Custom</span>');

        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            First
            </li>
            <li>
            <span>Custom</span>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()->items(Item::tag()->label('First'), $empty, $visible)->render(),
            'Empty items must not produce wrappers or disturb visible item order.',
        );
        self::assertSame(
            1,
            $empty->renders,
            'An empty item must still render once.',
        );
        self::assertSame(
            1,
            $visible->renders,
            'A visible item must render once.',
        );
    }

    public function testEmptyOutputDoesNotCreateWrappers(): void
    {
        $item = new RenderableValue('');

        self::assertSame(
            '',
            Menu::tag()
                ->id('menu')
                ->items($item)
                ->listAttributes(['class' => 'entries'])
                ->listItemAttributes(['class' => 'entry'])
                ->render(),
            'Empty output must not create wrappers.',
        );
        self::assertSame(
            1,
            $item->renders,
            'Empty output must still invoke its renderer once.',
        );
    }

    public function testGenericRenderablePreservesHtmlAndRendersOnce(): void
    {
        $item = new RenderableValue('<span data-label="A &amp; B">A &amp; B</span>');

        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <span data-label="A &amp; B">A &amp; B</span>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()->items($item)->render(),
            'Generic item HTML must remain unchanged in the rendered markup.',
        );
        self::assertSame(
            1,
            $item->renders,
            'The render count must increase once per menu render.',
        );
    }

    public function testMenuClonesAndRepeatedRendersPreserveItems(): void
    {
        $item = new RenderableValue('<span>Custom</span>');

        $empty = Menu::tag();

        $menu = $empty->items($item);
        $configured = $menu->listItemAttributes(['class' => 'copy']);

        $clone = clone $menu;

        $expected = <<<HTML
            <div>
            <ul>
            <li>
            <span>Custom</span>
            </li>
            </ul>
            </div>
            HTML;

        self::assertNotSame(
            $empty,
            $menu,
            'Configured instances must not mutate the source.',
        );
        self::assertSame(
            '',
            $empty->render(),
            'The source must remain empty.',
        );
        self::assertSame(
            0,
            $item->renders,
            'Configuration and cloning must not render items.',
        );
        self::assertSame(
            $expected,
            $menu->render(),
            'Rendered markup must preserve the item and wrappers.',
        );
        self::assertSame(
            1,
            $item->renders,
            'Each render must invoke the item once.',
        );
        self::assertSame(
            $expected,
            $menu->render(),
            'Repeated rendering must preserve the markup.',
        );
        self::assertSame(
            2,
            $item->renders,
            'Each render must invoke the item once.',
        );
        self::assertSame(
            $expected,
            $clone->render(),
            'Cloning must preserve the rendered markup.',
        );
        self::assertSame(
            3,
            $item->renders,
            'Rendering a clone must invoke the item once.',
        );
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li class="copy">
            <span>Custom</span>
            </li>
            </ul>
            </div>
            HTML,
            $configured->render(),
            'Configured clones must preserve their own item attributes.',
        );
        self::assertSame(
            4,
            $item->renders,
            'The configured clone must render the item once.',
        );
        self::assertSame(
            [],
            $menu->getListItemAttributes(),
            'Clone configuration must not mutate the source.',
        );
    }

    public function testMixedItemsKeepOrderAndSpecializedAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li class="first">
            <button class="active" type="button">
            First
            </button>
            </li>
            <li>
            <button type="button">
            Custom item
            </button>
            </li>
            <li class="last">
            <a class="disabled" href="/last">
            Last
            </a>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->firstItemClass('first')
                ->items(
                    Item::tag()
                        ->label('First')
                        ->link('/first')
                        ->linkTag('button')
                        ->linkAttributes(['type' => 'button'])
                        ->active(),
                    Toggle::tag()->content('Custom item'),
                    Item::tag()->label('Last')->link('/last')->disabled(),
                )
                ->lastItemClass('last')
                ->linkActiveClass('active')
                ->linkDisabledClass('disabled')
                ->render(),
            'Mixed item types must retain their order and specialized attributes.',
        );
    }

    public function testNestedDropdownKeepsSpecializedConfigurationInMixedMenu(): void
    {
        $dropdown = Dropdown::tag()
            ->id('nested')
            ->items(Item::tag()->label('Nested'));

        $item = Item::tag()
            ->label('First')
            ->listItemTag(false);

        $custom = new RenderableValue('<span>Custom</span>');

        self::assertSame(
            <<<HTML
            <div>
            <ul>
            First
            <li class="dropdown-slot">
            <div id="nested">
            <ol class="nested-list">
            <li>
            Nested
            </li>
            </ol>
            </div>
            </li>
            <li class="entry">
            <span>Custom</span>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()
                ->dropdownDefaultDefinitions(['listAttributes' => [['class' => 'nested-list']], 'listType' => 'ol'])
                ->items($item, $dropdown, $custom)
                ->listDropdownItemClass('dropdown-slot')
                ->listItemAttributes(['class' => 'entry'])
                ->render(),
            'Nested dropdown configuration must remain isolated within mixed items.',
        );
        self::assertSame(
            1,
            $custom->renders,
            'The custom item must render once.',
        );
        self::assertSame(
            [],
            $dropdown->getListAttributes(),
            'Parent defaults must not mutate a nested dropdown.',
        );
        self::assertSame(
            [],
            $item->getListItemAttributes(),
            'Parent attributes must not mutate an Item.',
        );
    }

    public function testRenderableErrorsPropagate(): void
    {
        $item = self::createStub(RenderableInterface::class);

        $item
            ->method('render')
            ->willThrowException(new RuntimeException('Cannot render item.'));

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            'Cannot render item.',
        );

        Menu::tag()->items($item)->render();
    }

    public function testToggleRendersAloneAndInsideMenu(): void
    {
        $toggle = Toggle::tag()->content('Custom item');

        self::assertSame(
            <<<HTML
            <button type="button">
            Custom item
            </button>
            HTML,
            $toggle->render(),
            'A standalone toggle must render its button markup.',
        );
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <button type="button">
            Custom item
            </button>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()->items($toggle)->render(),
            'A menu must preserve the toggle markup inside its wrappers.',
        );
    }

    public function testWrapperPolicyDoesNotInspectRenderedHtml(): void
    {
        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            <li>Caller-owned item</li>
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()->items(new RenderableValue('<li>Caller-owned item</li>'))->render(),
            'Wrapper policy must not depend on custom item HTML.',
        );
    }

    public function testZeroOutputIsNotEmpty(): void
    {
        $item = new RenderableValue('0');

        self::assertSame(
            <<<HTML
            <div>
            <ul>
            <li>
            0
            </li>
            </ul>
            </div>
            HTML,
            Menu::tag()->items($item)->render(),
            'The string `0` must remain visible and wrapped.',
        );
        self::assertSame(1, $item->renders, 'The item must render once.');
    }

    public function testZeroOutputSurvivesWithoutWrappers(): void
    {
        self::assertSame(
            '0',
            Dropdown::tag()
                ->containerTag(false)
                ->items(new RenderableValue('0'))
                ->listItemTag(false)
                ->listType(false)
                ->render(),
            'The string `0` must remain visible without wrappers.',
        );
    }
}
