<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests;

use LogicException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use UIAwesome\Html\Core\Component\{Alert, Breadcrumb, Dropdown, Item, Menu, NavBar, Toggle};
use UIAwesome\Html\Core\Component\Base\BaseToggle;
use UIAwesome\Html\Interop\{Block, Inline};

/**
 * Regression tests for component opening/closing tags, independent of complete-render decoration.
 */
#[Group('streaming')]
final class StreamingComponentsTest extends TestCase
{
    public function testAlertClosesWithoutConfiguredContent(): void
    {
        self::assertSame(
            "<div id=\"alert\" role=\"alert\">\nbody\n</div>",
            Alert::tag()->id('alert')->begin() . 'body' . Alert::end(),
            'An empty alert must still close its streaming wrapper.',
        );
    }

    public function testAlertDecorationsRemainExclusiveToCompleteRendering(): void
    {
        $alert = Alert::tag()
            ->id('alert')
            ->content('<body> &')
            ->prefix('<b>Before</b>')
            ->suffix('<i>After</i>')
            ->containerTag(Inline::SPAN)
            ->toggle(Toggle::tag()->content('Close'))
            ->template('{prefix}{content}{suffix}{toggle}');

        $expected = <<<HTML
            <div id="alert" role="alert">
            <b>Before</b><span>
            &lt;body&gt; &amp;
            </span><i>After</i><button type="button">
            Close
            </button>
            </div>
            HTML;

        self::assertSame(
            $expected,
            $alert->render(),
            'Complete alert output must retain its decorations.',
        );
        self::assertSame(
            "<div id=\"alert\" role=\"alert\">\n<strong>body</strong>\n</div>",
            $alert->begin() . '<strong>body</strong>' . Alert::end(),
            'Streaming must not replay configured content or decorations.',
        );
        self::assertSame(
            $expected,
            $alert->render(),
            'Streaming must not consume alert configuration.',
        );
    }

    public function testBreadcrumbClosesWithoutItems(): void
    {
        self::assertSame(
            "<nav id=\"crumb\" aria-label=\"breadcrumb\">\nbody\n</nav>",
            Breadcrumb::tag()->id('crumb')->begin() . 'body' . Breadcrumb::end(),
            'An empty breadcrumb must close the opened navigation tag.',
        );
    }

    public function testBreadcrumbDoesNotAppendItsConfiguredList(): void
    {
        $breadcrumb = Breadcrumb::tag()->id('crumb')->items(Item::tag()->label('Home')->link('/'));

        $expected = <<<HTML
            <nav id="crumb" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">
            Home
            </a>
            </li>
            </ol>
            </nav>
            HTML;

        self::assertSame(
            $expected,
            $breadcrumb->render(),
            'Complete breadcrumb rendering must include the list.',
        );
        self::assertSame(
            "<nav id=\"crumb\" aria-label=\"breadcrumb\">\nbody\n</nav>",
            $breadcrumb->begin() . 'body' . Breadcrumb::end(),
            'Streaming must leave list markup to the caller.',
        );
        self::assertSame(
            $expected,
            $breadcrumb->render(),
            'Closing must not consume breadcrumb items.',
        );
    }

    public function testDifferentComponentsCanNest(): void
    {
        self::assertSame(
            "<div id=\"alert\" role=\"alert\">\n<button type=\"button\">\nbody\n</button>\n</div>",
            Alert::tag()->id('alert')->begin() . Toggle::tag()->begin() . 'body' . Toggle::end() . Alert::end(),
            'Nested component classes must close their own primary tags.',
        );
    }

    public function testDistinctInstancesCanNestAndBeReused(): void
    {
        $outer = Alert::tag()->id('outer');

        $inner = $outer->id('inner');
        $html = $outer->begin() . $inner->begin() . 'body' . Alert::end() . Alert::end();

        self::assertSame(
            "<div id=\"outer\" role=\"alert\">\n<div id=\"inner\" role=\"alert\">\nbody\n</div>\n</div>",
            $html,
            'Distinct immutable instances must close in last-in-first-out order.',
        );
        self::assertSame(
            "<div id=\"outer\" role=\"alert\">\nagain\n</div>",
            $outer->begin() . 'again' . Alert::end(),
            'An instance must support another sequential streaming operation.',
        );
    }

    public function testDropdownClosesWithoutItems(): void
    {
        self::assertSame(
            "<div id=\"dropdown\">\nbody\n</div>",
            Dropdown::tag()->id('dropdown')->begin() . 'body' . Dropdown::end(),
            'An empty dropdown must close its streaming wrapper.',
        );
    }

    public function testDropdownContainerOptionsRemainExclusiveToCompleteRendering(): void
    {
        $dropdown = Dropdown::tag()
            ->id('dropdown')
            ->class('outer')
            ->containerTag(Block::SECTION)
            ->containerClass('container')
            ->items(Item::tag()->label('Entry'));

        $expected = <<<HTML
            <section class="outer container" id="dropdown">
            <ul>
            <li>
            Entry
            </li>
            </ul>
            </section>
            HTML;

        self::assertSame(
            $expected,
            $dropdown->render(),
            'Complete dropdown rendering must retain its container.',
        );
        self::assertSame(
            "<div class=\"outer\" id=\"dropdown\">\nbody\n</div>",
            $dropdown->begin() . 'body' . Dropdown::end(),
            'Streaming must close the primary tag actually opened, not the render-only container.',
        );
        self::assertSame(
            $expected,
            $dropdown->render(),
            'Streaming must preserve container configuration.',
        );

        $unwrapped = $dropdown->containerTag(false);

        self::assertSame(
            "<div class=\"outer\" id=\"dropdown\">\nbody\n</div>",
            $unwrapped->begin() . 'body' . Dropdown::end(),
            'Disabling the complete-render container must not create an unmatched streaming close.',
        );
    }

    public function testDropdownMenuStillClosesThePrimaryTagItOpened(): void
    {
        $menu = Menu::tag()
            ->type('dropdown')
            ->items(Item::tag()->label('Entry'));

        self::assertSame(
            "<div>\nbody\n</div>",
            $menu->begin() . 'body' . Menu::end(),
            'The wrapperless complete-render mode must not leave the inherited streaming div open.',
        );
        self::assertSame(
            "<ul>\n<li>\nEntry\n</li>\n</ul>",
            $menu->render(),
            'Complete dropdown-menu rendering must remain wrapperless.',
        );
    }

    public function testEndHookExceptionResetsTheInstanceAndStack(): void
    {
        $toggle = new class extends BaseToggle {
            private bool $throw = true;

            protected function afterRun(string $result): string
            {
                if ($this->throw) {
                    $this->throw = false;

                    throw new RuntimeException('Closing hook failed.');
                }

                return parent::afterRun($result);
            }
        };

        self::assertSame(
            "<button type=\"button\">\n",
            $toggle->begin(),
            'Opening must not invoke end hooks.',
        );

        try {
            $toggle::end();
            self::fail(
                'The closing hook exception must propagate.',
            );
        } catch (RuntimeException $exception) {
            self::assertSame(
                'Closing hook failed.',
                $exception->getMessage(),
                'The original error must propagate.',
            );
        }

        self::assertSame(
            "<button type=\"button\">\n</button>",
            $toggle->render(),
            'The finally block must restore complete rendering after an exception.',
        );

        $this->expectException(LogicException::class);

        $toggle::end();
    }

    public function testItemClosesWithoutLabelOrContent(): void
    {
        self::assertSame(
            "<li>\nbody\n</li>",
            Item::tag()->begin() . 'body' . Item::end(),
            'An empty item must still close its streaming wrapper.',
        );
    }

    public function testItemRenderOnlySuppressionDoesNotLeaveItsStreamingWrapperOpen(): void
    {
        $item = Item::tag()
            ->label('Entry')
            ->listItemTag(false);

        $hidden = $item->visible(false);
        $divider = $item->divider();

        self::assertSame(
            'Entry',
            $item->render(),
            'Complete rendering must retain its disabled wrapper.',
        );
        self::assertSame(
            '',
            $hidden->render(),
            'Complete rendering must retain visibility suppression.',
        );
        self::assertSame(
            '<hr>',
            $divider->render(),
            'Complete rendering must retain divider output.',
        );

        foreach ([$item, $hidden, $divider] as $component) {
            self::assertSame(
                "<li>\nbody\n</li>",
                $component->begin() . 'body' . Item::end(),
                'Render-only options must not suppress the close for an already opened primary tag.',
            );
        }
    }

    public function testItemUsesPrimaryAttributesWithoutReplayingChildren(): void
    {
        $item = Item::tag()
            ->id('primary')
            ->listItemAttributes(['id' => 'entry'])
            ->label('Parent &')
            ->items(Item::tag()->label('Child'));

        $expected = "<li id=\"entry\">\nParent &amp;\n<ul>\n<li>\nChild\n</li>\n</ul>\n</li>";

        self::assertSame(
            $expected,
            $item->render(),
            'Complete item rendering must retain child output and escaping.',
        );
        self::assertSame(
            "<li id=\"primary\">\nbody\n</li>",
            $item->begin() . 'body' . Item::end(),
            'Streaming must retain the inherited primary opening and close it without rendering children.',
        );
        self::assertSame(
            $expected,
            $item->render(),
            'Streaming must not consume the D4 subtree.',
        );
    }

    public function testMenuClosesWithoutItems(): void
    {
        self::assertSame(
            "<div>\nbody\n</div>",
            Menu::tag()->begin() . 'body' . Menu::end(),
            'An empty menu must still close its streaming wrapper.',
        );
    }

    public function testMenuUsesItsTypeWithoutAppendingRenderOnlyDecoration(): void
    {
        $menu = Menu::tag()
            ->type('navigation')
            ->id('menu')
            ->prefix('<b>Before</b>')
            ->items(Item::tag()->label('Entry'));

        $expected = "<b>Before</b>\n<nav id=\"menu\">\n<ul>\n<li>\nEntry\n</li>\n</ul>\n</nav>";

        self::assertSame(
            $expected,
            $menu->render(),
            'Complete menu rendering must retain its outer decoration.',
        );
        self::assertSame(
            "<nav id=\"menu\">\nbody\n</nav>",
            $menu->begin() . 'body' . Menu::end(),
            'The closing tag must match the menu type without replaying its items or prefix.',
        );
        self::assertSame(
            $expected,
            $menu->render(),
            'Streaming must not consume menu items.',
        );
    }

    public function testMismatchedEndLeavesTheMatchingBlocksAvailable(): void
    {
        $html = Alert::tag()
            ->id('alert')
            ->begin()
            . Toggle::tag()->begin()
            . 'body';

        try {
            Alert::end();

            self::fail(
                'Ending the wrong component must throw.',
            );
        } catch (RuntimeException) {
            $html .= Toggle::end() . Alert::end();
        }

        self::assertSame(
            "<div id=\"alert\" role=\"alert\">\n<button type=\"button\">\nbody\n</button>\n</div>",
            $html,
            'A rejected end must not pop either matching operation.',
        );
    }

    public function testNavBarClosesWithoutMenu(): void
    {
        self::assertSame(
            "<nav>\nbody\n</nav>",
            NavBar::tag()->begin() . 'body' . NavBar::end(),
            'An empty navbar must close its streaming wrapper.',
        );
    }

    public function testNavBarDoesNotAppendAuxiliaryWrappersOrBrand(): void
    {
        $navbar = NavBar::tag()
            ->id('navbar')
            ->containerTag(Block::SECTION)
            ->containerClass('outer')
            ->containerMenuTag()
            ->containerMenuClass('inner')
            ->brandText('Brand')
            ->menu(Menu::tag()->items(Item::tag()->label('Entry')));

        $expected = <<<HTML
            <section class="outer">
            <nav id="navbar">
            <div class="inner">
            Brand
            <div>
            <ul>
            <li>
            Entry
            </li>
            </ul>
            </div>
            </div>
            </nav>
            </section>
            HTML;

        self::assertSame(
            $expected,
            $navbar->render(),
            'Complete navbar rendering must retain its wrappers and brand.',
        );
        self::assertSame(
            "<nav id=\"navbar\">\nbody\n</nav>",
            $navbar->begin() . 'body' . NavBar::end(),
            'Streaming must only close the primary nav tag opened by BaseBlock.',
        );
        self::assertSame(
            $expected,
            $navbar->render(),
            'Closing must not change navbar configuration.',
        );
    }

    public function testToggleDecorationDoesNotOpenAnotherButtonOnEnd(): void
    {
        $toggle = Toggle::tag()
            ->content('Configured')
            ->toggleContent('<i>Icon</i>')
            ->template('{toggle}{content}');

        $expected = "<button type=\"button\">\n<span>\n<i>Icon</i>\n</span>Configured\n</button>";

        self::assertSame(
            $expected,
            $toggle->render(),
            'Complete toggle rendering must retain its template.',
        );
        self::assertSame(
            "<button type=\"button\">\nbody\n</button>",
            $toggle->begin() . 'body' . Toggle::end(),
            'Closing must not invoke the decorated complete-render path.',
        );
        self::assertSame(
            $expected,
            $toggle->render(),
            'Streaming must not change the toggle template.',
        );
    }

    public function testToggleLinkDoesNotAcquireButtonDefaults(): void
    {
        $button = Toggle::tag()->content('Configured');

        $link = $button
            ->link()
            ->attributes(['href' => '/a?x=1&y=2']);

        self::assertSame(
            "<a href=\"/a?x=1&amp;y=2\">\nbody\n</a>",
            $link->begin() . 'body' . Toggle::end(),
            'Link streaming must neither add a button type nor append configured content.',
        );
        self::assertSame(
            "<button type=\"button\">\nConfigured\n</button>",
            $button->render(),
            'Configuring a link must not change the source button.',
        );
        self::assertSame(
            "<a href=\"/a?x=1&amp;y=2\">\nConfigured\n</a>",
            $link->render(),
            'Closing must restore complete rendering for the link.',
        );
    }

    public function testToggleOpensWithDefaultButtonType(): void
    {
        $toggle = Toggle::tag();

        self::assertSame(
            "<button type=\"button\">\nbody\n</button>",
            $toggle->begin() . 'body' . Toggle::end(),
            'Streaming must open exactly one button with its default type.',
        );
        self::assertSame(
            null,
            $toggle->getAttribute('type'),
            'Rendering defaults must not mutate attributes.',
        );
        self::assertSame(
            "<button type=\"button\">\n</button>",
            $toggle->render(),
            'The toggle must remain reusable.',
        );
    }

    public function testTogglePreservesExplicitTypeAndEscapedAttributes(): void
    {
        self::assertSame(
            "<button type=\"submit\" title=\"&lt;save&gt; &amp; &quot;send&quot;\">\nSave\n</button>",
            Toggle::tag()
                ->attributes(['type' => 'submit'])
                ->title('<save> & "send"')
                ->begin() . 'Save' . Toggle::end(),
            'An explicit button type and attribute escaping must survive opening.',
        );
    }
}
