<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Attribute\Values\{Data, Role};
use UIAwesome\Html\Core\Component\{Alert, Toggle};
use UIAwesome\Html\Interop\Block;

/**
 * Unit tests for the {@see Alert} component rendering and immutable configuration.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('alert')]
final class AlertTest extends TestCase
{
    public function testRenderAutoGeneratesId(): void
    {
        self::assertStringContainsString(
            'alert-',
            Alert::tag()
                ->content('value')
                ->render(),
            "Auto-generated id must use the 'alert-' prefix.",
        );
    }

    public function testRenderEmpty(): void
    {
        self::assertEmpty(
            Alert::tag()->render(),
            'Empty alert must render an empty string.',
        );
    }

    public function testRenderOmitsPrefixWrapperWhenPrefixContentIsEmpty(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            content
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->prefixTag(Block::DIV)
                ->render(),
            'Empty prefix content must skip the prefix wrapper even when the prefix tag is a valid enum.',
        );
    }

    public function testRenderWithAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div class="value" id="alert" role="alert">
            content
            </div>
            HTML,
            Alert::tag()
                ->attributes(['class' => 'value'])
                ->content('content')
                ->id('alert')
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testRenderWithContainerAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            <div class="value">
            content
            </div>
            </div>
            HTML,
            Alert::tag()
                ->containerAttributes(['class' => 'value'])
                ->containerTag(Block::DIV)
                ->content('content')
                ->id('alert')
                ->render(),
            'Container attributes must decorate the inner wrapper.',
        );
    }

    public function testRenderWithContainerTag(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            <article>
            content
            </article>
            </div>
            HTML,
            Alert::tag()
                ->containerTag(Block::ARTICLE)
                ->content('content')
                ->id('alert')
                ->render(),
            'Custom container tag must wrap the content.',
        );
    }

    public function testRenderWithContent(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            content
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->render(),
            'Content must render between the wrapper tags.',
        );
    }

    public function testRenderWithId(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            content
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->render(),
            'Explicit id must override the generated id.',
        );
    }

    public function testRenderWithPrefix(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            prefix
            content
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->prefix('prefix')
                ->render(),
            'Prefix must precede the content.',
        );
    }

    public function testRenderWithPrefixAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            <div class="value">
            prefix
            </div>
            content
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->prefix('prefix')
                ->prefixAttributes(['class' => 'value'])
                ->prefixTag(Block::DIV)
                ->render(),
            'Prefix attributes must decorate the prefix wrapper.',
        );
    }

    public function testRenderWithPrefixTag(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            <article>
            prefix
            </article>
            content
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->prefix('prefix')
                ->prefixTag(Block::ARTICLE)
                ->render(),
            'Custom prefix tag must wrap the prefix.',
        );
    }

    public function testRenderWithPrefixTagFalse(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            prefix
            content
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->prefix('prefix')
                ->prefixTag(false)
                ->render(),
            "'false' prefix tag must drop the prefix wrapper.",
        );
    }

    public function testRenderWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="banner">
            content
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->role('banner')
                ->render(),
            "'role' must override the 'alert' default.",
        );
    }

    public function testRenderWithRoleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="banner">
            content
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->role(Role::BANNER)
                ->render(),
            "'role' must override the 'alert' default.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert" style='value'>
            content
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testRenderWithSuffix(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            content
            suffix
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->suffix('suffix')
                ->render(),
            'Suffix must follow the content.',
        );
    }

    public function testRenderWithSuffixAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            content
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->suffix('suffix')
                ->suffixAttributes(['class' => 'value'])
                ->suffixTag(Block::DIV)
                ->render(),
            'Suffix attributes must decorate the suffix wrapper.',
        );
    }

    public function testRenderWithSuffixTag(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            content
            <article>
            suffix
            </article>
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->suffix('suffix')
                ->suffixTag(Block::ARTICLE)
                ->render(),
            'Custom suffix tag must wrap the suffix.',
        );
    }

    public function testRenderWithSuffixTagFalse(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            content
            suffix
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->suffix('suffix')
                ->suffixTag(false)
                ->render(),
            "'false' suffix tag must drop the suffix wrapper.",
        );
    }

    public function testRenderWithTemplate(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            <span>
            content
            </span>
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->template('<span>\n{content}\n</span>')
                ->render(),
            'Custom template must control the rendered structure.',
        );
    }

    public function testRenderWithToggle(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            content
            <button type="button" data-dropdown-toggle="value">
            toggle-content
            </button>
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->toggle(
                    Toggle::tag()
                        ->addDataAttribute('dropdown-toggle', 'value')
                        ->content('toggle-content'),
                )
                ->render(),
            'Toggle must render after the content.',
        );
    }

    public function testRenderWithToggleUsingEnum(): void
    {
        self::assertSame(
            <<<HTML
            <div id="alert" role="alert">
            content
            <button type="button" data-toggle="value">
            toggle-content
            </button>
            </div>
            HTML,
            Alert::tag()
                ->content('content')
                ->id('alert')
                ->toggle(
                    Toggle::tag()
                        ->addDataAttribute(Data::TOGGLE, 'value')
                        ->content('toggle-content'),
                )
                ->render(),
            'Toggle must render after the content.',
        );
    }
}
