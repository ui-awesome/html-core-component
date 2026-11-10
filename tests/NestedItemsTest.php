<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\{Item, Menu};

/**
 * Regression tests for nested menu items and their independent configuration.
 */
#[Group('item')]
final class NestedItemsTest extends TestCase
{
    public function testChildCanDisableItsOwnWrappers(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            Parent
            <ul>
            <li class="custom">Child</li>
            </ul>
            </li>
            HTML,
            Item::tag()
                ->label('Parent')
                ->items(
                    Item::tag()
                        ->label('Child')
                        ->link('/unused')
                        ->linkTag(false)
                        ->listItemTag(false)
                        ->listItemAttributes(['id' => 'unused'])
                        ->linkContainerTag()
                        ->templateLinkItem('<li class="custom">{label}</li>'),
                )
                ->render(),
            'Explicit child wrapper choices must remain authoritative.',
        );
    }

    public function testChildKeepsItsTagsTemplatesAndMarkup(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <div class="parent-container">
            <button>
            Parent
            </button>
            </div>
            <ul>
            <li class="child-item">
            <span class="child-container">
            <em>Before</em><button class="child-link">
            <strong>Child</strong>: <i>Body</i>
            </button>
            </span>
            </li>
            </ul>
            </li>
            HTML,
            Item::tag()
                ->label('Parent')
                ->linkTag('button')
                ->linkContainerTag()
                ->linkContainerClass('parent-container')
                ->items(
                    Item::tag()
                        ->label('<strong>Child</strong>', false)
                        ->html('<i>Body</i>')
                        ->linkTag('button')
                        ->linkClass('child-link')
                        ->listItemClass('child-item')
                        ->linkContainerTag('span')
                        ->linkContainerClass('child-container')
                        ->separator('<em>Before</em>')
                        ->template('{separator}{link}')
                        ->templateLinkItem('{label}: {content}'),
                )
                ->render(),
            'Children must use their own wrappers, templates and intentional HTML.',
        );
    }

    public function testChildRendersAfterTheParentLink(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/parent">
            Parent
            </a>
            <ul>
            <li>
            <a href="/child">
            Child
            </a>
            </li>
            </ul>
            </li>
            HTML,
            Item::tag()
                ->label('Parent')
                ->link('/parent')
                ->items(Item::tag()->label('Child')->link('/child'))
                ->render(),
            'The child list must be inside the parent item and outside its link.',
        );
    }

    public function testClonesAndRepeatedRendersPreserveTheSourceItems(): void
    {
        $parent = Item::tag()->label('Parent');
        $child = Item::tag()->label('Child');

        $nested = $parent->items($child);

        $clone = clone $nested;

        $expected = <<<HTML
            <li>
            Parent
            <ul>
            <li>
            Child
            </li>
            </ul>
            </li>
            HTML;

        self::assertNotSame(
            $parent,
            $nested,
            'Adding children must return a new instance.',
        );
        self::assertSame(
            $expected,
            $nested->render(),
            'The configured instance must render its children.',
        );
        self::assertSame(
            $expected,
            $nested->render(),
            'Repeated rendering must not append or consume children.',
        );
        self::assertSame(
            $expected,
            $clone->render(),
            'Cloning must retain the subtree.',
        );
        self::assertSame(
            "<li>\nParent\n</li>",
            $parent->render(),
            'Adding children must not mutate the source parent.',
        );
        self::assertSame(
            "<li>\nChild\n</li>",
            $child->render(),
            'Rendering must not mutate the source child.',
        );
        self::assertSame(
            "<li>\nParent\n</li>",
            $nested->items()->render(),
            'Replacing children with an empty collection must restore the leaf output.',
        );
        self::assertSame(
            $expected,
            $nested->render(),
            'Replacing children must not mutate the original collection.',
        );
    }

    public function testDisabledParentWrapperDoesNotDisableChildWrappers(): void
    {
        self::assertSame(
            <<<HTML
            <a href="/parent">
            Parent
            </a>
            <ul>
            <li>
            Child
            </li>
            </ul>
            HTML,
            Item::tag()
                ->label('Parent')
                ->link('/parent')
                ->listItemTag(false)
                ->linkContainerTag()
                ->items(Item::tag()->label('Child'))
                ->render(),
            'Disabling the parent wrapper must preserve its existing container bypass and the child list.',
        );
    }

    public function testEmptyParentCanRenderChildren(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <ul>
            <li>
            Child
            </li>
            </ul>
            </li>
            HTML,
            Item::tag()
                ->linkContainerTag()
                ->items(Item::tag()->label('Child'))
                ->render(),
            'Children must survive an empty parent without creating an empty link container.',
        );
    }

    public function testEmptyParentWithHiddenChildrenRemainsEmpty(): void
    {
        self::assertSame(
            '',
            Item::tag()->items(Item::tag()->visible(false), Item::tag())->render(),
            'An entirely empty subtree must remain empty.',
        );
    }

    public function testGrandchildAndSiblingsRenderInOrder(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            Parent
            <ul>
            <li>
            First
            <ul>
            <li>
            Grandchild
            </li>
            </ul>
            </li>
            <li>
            Last
            </li>
            </ul>
            </li>
            HTML,
            Item::tag()
                ->label('Parent')
                ->items(
                    Item::tag()
                        ->label('First')
                        ->items(Item::tag()->label('Grandchild')),
                    Item::tag()->label('Last'),
                )
                ->render(),
            'Each generation and sibling must render once in insertion order.',
        );
    }

    public function testHiddenAndEmptyChildrenDoNotCreateAnEmptyList(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            Parent
            </li>
            HTML,
            Item::tag()
                ->label('Parent')
                ->items(
                    Item::tag()
                        ->label('Hidden')
                        ->visible(false)
                        ->items(Item::tag()->label('Grandchild')),
                    Item::tag(),
                )
                ->render(),
            'Children with empty output must not introduce an empty list.',
        );
    }

    public function testHiddenChildrenDoNotSeparateVisibleSiblings(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            Parent
            <ul>
            <li>
            First
            </li>
            <li>
            Last
            </li>
            </ul>
            </li>
            HTML,
            Item::tag()
                ->label('Parent')
                ->items(
                    Item::tag()->visible(false),
                    Item::tag()->label('First'),
                    Item::tag()
                        ->label('Hidden')
                        ->visible(false),
                    Item::tag()->label('Last'),
                    Item::tag(),
                )
                ->render(),
            'Only visible nonempty children must contribute markup.',
        );
    }

    public function testHiddenParentSuppressesItsSubtree(): void
    {
        self::assertSame(
            '',
            Item::tag()
                ->label('Parent')
                ->visible(false)
                ->items(
                    Item::tag()
                        ->label('Child')
                        ->items(Item::tag()->label('Grandchild')))
                ->render(),
            'An invisible parent must suppress all descendants.',
        );
    }

    public function testMenuConfigurationStopsAtItsImmediateItem(): void
    {
        self::assertSame(
            <<<HTML
            <div id="menu">
            <ol id="list">
            <li class="active" id="parent-item">
            <div id="parent-container">
            <button id="parent-link">
            <strong>Parent</strong>
            </button>
            </div>
            <ul>
            <li id="child-item">
            <span id="child-container">
            <a id="child-link" href="/child">
            Child
            </a>
            </span>
            </li>
            </ul>
            </li>
            </ol>
            </div>
            HTML,
            Menu::tag()
                ->id('menu')
                ->listType('ol')
                ->listAttributes(['id' => 'list'])
                ->listItemAttributes(['id' => 'parent-item'])
                ->linkAttributes(['id' => 'parent-link'])
                ->linkTag('button')
                ->linkActiveTag('button')
                ->linkContainerTag()
                ->linkContainerAttributes(['id' => 'parent-container'])
                ->templateLinkItem('<strong>{label}</strong>')
                ->currentPath('/parent')
                ->listItemActiveClass('active')
                ->items(
                    Item::tag()
                        ->label('Parent')
                        ->link('/parent')
                        ->items(
                            Item::tag()
                                ->label('Child')
                                ->link('/child')
                                ->listItemAttributes(['id' => 'child-item'])
                                ->linkAttributes(['id' => 'child-link'])
                                ->linkContainerTag('span')
                                ->linkContainerAttributes(['id' => 'child-container']),
                        ),
                )
                ->render(),
            'Menu defaults and IDs must not leak into descendants or the child list.',
        );
    }

    public function testNestedTextAndAttributesAreEncodedOnce(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            Parent &amp; &lt;text&gt;
            <ul>
            <li>
            <a href="/child?a=1&amp;b=2" title="&quot;Child&quot; &amp; &lt;text&gt;">
            &lt;b&gt;Child&lt;/b&gt; &amp;amp; "quoted"
            &lt;i&gt;Body&lt;/i&gt; &amp;
            </a>
            </li>
            </ul>
            </li>
            HTML,
            Item::tag()
                ->label('Parent & <text>')
                ->items(
                    Item::tag()
                        ->label('<b>Child</b> &amp; "quoted"')
                        ->content('<i>Body</i> &')
                        ->link('/child?a=1&b=2')
                        ->linkAttributes(['title' => '"Child" & <text>']),
                )
                ->render(),
            'Nested HTML composition must not encode rendered child markup again.',
        );
    }

    public function testUnwrappedZeroChildIsNotEmpty(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            0
            <ul>
            0
            </ul>
            </li>
            HTML,
            Item::tag()
                ->label('0')
                ->items(
                    Item::tag()
                        ->label('0')
                        ->listItemTag(false)
                )
                ->render(),
            'Zero must remain content even without a child item wrapper.',
        );
    }
}
