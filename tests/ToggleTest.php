<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\Toggle;

/**
 * Unit tests for the {@see Toggle} component rendering and immutable configuration.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('toggle')]
final class ToggleTest extends TestCase
{
    public function testAriaControls(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" aria-controls="value">
            </button>
            HTML,
            Toggle::tag()
                ->addAriaAttribute('controls', 'value')
                ->render(),
            "'aria-controls' must be serialized.",
        );
    }

    public function testAriaExpanded(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" aria-expanded="value">
            </button>
            HTML,
            Toggle::tag()
                ->addAriaAttribute('expanded', 'value')
                ->render(),
            "'aria-expanded' must be serialized.",
        );
    }

    public function testAriaLabel(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" aria-label="value">
            </button>
            HTML,
            Toggle::tag()
                ->addAriaAttribute('label', 'value')
                ->render(),
            "'aria-label' must be serialized.",
        );
    }

    public function testAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <button class="value" type="button">
            </button>
            HTML,
            Toggle::tag()
                ->attributes(['class' => 'value'])
                ->render(),
            'Attribute map must be applied.',
        );
    }

    public function testClass(): void
    {
        self::assertSame(
            <<<HTML
            <button class="value" type="button">
            </button>
            HTML,
            Toggle::tag()
                ->class('value')
                ->render(),
            'CSS class must be applied to the wrapper.',
        );
    }

    public function testContent(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            content
            </button>
            HTML,
            Toggle::tag()
                ->content('content')
                ->render(),
            'Content must render inside the wrapper.',
        );
    }

    public function testDataAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" data-value="value">
            </button>
            HTML,
            Toggle::tag()
                ->dataAttributes(['value' => 'value'])
                ->render(),
            "Data attribute map must be applied as 'data-*'.",
        );
    }

    public function testDataBsAutoClose(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" data-bs-auto-close="value">
            </button>
            HTML,
            Toggle::tag()
                ->addDataAttribute('bs-auto-close', 'value')
                ->render(),
            "'data-bs-auto-close' must be serialized.",
        );
    }

    public function testDataBsDismiss(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" data-bs-dismiss="value">
            </button>
            HTML,
            Toggle::tag()
                ->addDataAttribute('bs-dismiss', 'value')
                ->render(),
            "'data-bs-dismiss' must be serialized.",
        );
    }

    public function testDataBsTarget(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" data-bs-target="value">
            </button>
            HTML,
            Toggle::tag()
                ->addDataAttribute('bs-target', 'value')
                ->render(),
            "'data-bs-target' must be serialized.",
        );
    }

    public function testDataBsTargetWithHashPrefix(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" data-bs-target="#value">
            </button>
            HTML,
            Toggle::tag()
                ->addDataAttribute('bs-target', '#value')
                ->render(),
            "Hash-prefixed 'data-bs-target' must be serialized verbatim.",
        );
    }

    public function testDataBsToggle(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" data-bs-toggle="value">
            </button>
            HTML,
            Toggle::tag()
                ->addDataAttribute('bs-toggle', 'value')
                ->render(),
            "'data-bs-toggle' must be serialized.",
        );
    }

    public function testDataCollapseToggle(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" data-collapse-toggle="value">
            </button>
            HTML,
            Toggle::tag()
                ->addDataAttribute('collapse-toggle', 'value')
                ->render(),
            "'data-collapse-toggle' must be serialized.",
        );
    }

    public function testDataDismissTarget(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" data-dismiss-target="#value">
            </button>
            HTML,
            Toggle::tag()
                ->addDataAttribute('dismiss-target', '#value')
                ->render(),
            "Hash-prefixed 'data-dismiss-target' must be serialized verbatim.",
        );
    }

    public function testDataDrawerTarget(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" data-drawer-target="value">
            </button>
            HTML,
            Toggle::tag()
                ->addDataAttribute('drawer-target', 'value')
                ->render(),
            "'data-drawer-target' must be serialized.",
        );
    }

    public function testDataDropdownToggle(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" data-dropdown-toggle="value">
            </button>
            HTML,
            Toggle::tag()
                ->addDataAttribute('dropdown-toggle', 'value')
                ->render(),
            "'data-dropdown-toggle' must be serialized.",
        );
    }

    public function testDataToggle(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" data-toggle="value">
            </button>
            HTML,
            Toggle::tag()
                ->addDataAttribute('toggle', 'value')
                ->render(),
            "'data-toggle' must be serialized.",
        );
    }

    public function testIconAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            <i class="value">
            </i>
            </button>
            HTML,
            Toggle::tag()
                ->iconAttributes(['class' => 'value'])
                ->iconTag()
                ->render(),
            'Icon attribute map must decorate the icon element.',
        );
    }

    public function testIconClass(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            <i class="value">
            </i>
            </button>
            HTML,
            Toggle::tag()
                ->iconClass('value')
                ->iconTag()
                ->render(),
            'CSS class must be applied to the icon element.',
        );
    }

    public function testIconContent(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            <i>
            value
            </i>
            </button>
            HTML,
            Toggle::tag()
                ->iconContent('value')
                ->iconTag()
                ->render(),
            'Icon content must render inside the icon element.',
        );
    }

    public function testIconFilePath(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" aria-hidden="true" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
            </button>
            HTML,
            Toggle::tag()
                ->iconFilePath(__DIR__ . '/Support/svg/toggle.svg')
                ->iconTag('svg')
                ->render(),
            'SVG file content must be inlined inside the wrapper.',
        );
    }

    public function testIconTag(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            </button>
            HTML,
            Toggle::tag()
                ->iconTag()
                ->render(),
            "Default icon tag must be '<i>'.",
        );
    }

    public function testIconTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            </button>
            HTML,
            Toggle::tag()->iconTag(false)->render(),
            "'false' icon tag must drop the icon element.",
        );
    }

    public function testIconTagWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" aria-hidden="true" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
            </button>
            HTML,
            Toggle::tag()
                ->iconFilePath(__DIR__ . '/Support/svg/toggle.svg')
                ->iconTag('svg')
                ->render(),
            'Custom icon tag must wrap the icon content.',
        );
    }

    public function testId(): void
    {
        self::assertSame(
            <<<HTML
            <button id="value" type="button">
            </button>
            HTML,
            Toggle::tag()
                ->id('value')
                ->render(),
            'Explicit id must be applied to the wrapper.',
        );
    }

    public function testImmutable(): void
    {
        $instance = Toggle::tag();

        self::assertNotSame(
            $instance,
            $instance->dataValue(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->iconAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->iconClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->iconContent(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->iconFilePath(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->iconRemoveAttribute('key'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->iconSetAttribute('key', 'value'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->iconTag(false),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->link(),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->toggleAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->toggleClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->toggleContent(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->toggleTag(false),
            'New instance must be returned (immutability).',
        );
    }

    public function testLink(): void
    {
        self::assertSame(
            <<<HTML
            <a>
            </a>
            HTML,
            Toggle::tag()
                ->link()
                ->render(),
            "Link flag must render the wrapper as '<a>'.",
        );
    }

    public function testLinkWithRole(): void
    {
        self::assertSame(
            <<<HTML
            <a role="button">
            </a>
            HTML,
            Toggle::tag()
                ->link()
                ->role('button')
                ->render(),
            "'role' must be applied to the link wrapper.",
        );
    }

    public function testName(): void
    {
        self::assertSame(
            <<<HTML
            <button name="value" type="button">
            </button>
            HTML,
            Toggle::tag()
                ->name('value')
                ->render(),
            "'name' attribute must be serialized.",
        );
    }

    public function testRender(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            </button>
            HTML,
            Toggle::tag()->render(),
            "Default render must produce a '<button>' wrapper.",
        );
    }

    public function testRole(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" role="button">
            </button>
            HTML,
            Toggle::tag()
                ->role('button')
                ->render(),
            "'role' must be serialized.",
        );
    }

    public function testStyle(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" style='value'>
            </button>
            HTML,
            Toggle::tag()
                ->style('value')
                ->render(),
            "'style' must be serialized.",
        );
    }

    public function testTabIndex(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button" tabindex="1">
            </button>
            HTML,
            Toggle::tag()
                ->tabIndex(1)
                ->render(),
            "'tabindex' must be serialized.",
        );
    }

    public function testTemplate(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            <div>
            <i>
            value
            </i>
            </div>
            </button>
            HTML,
            Toggle::tag()
                ->iconContent('value')
                ->iconTag()
                ->template('<div>\n{toggle}\n{icon}\n{content}\n</div>')
                ->render(),
            'Custom template must control the rendered structure.',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenToggleTagIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The toggle tag must be a non-empty string.',
        );

        Toggle::tag()->toggleTag('')->render();
    }

    public function testToggleAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            <span class="value" aria-label="true">
            </span>
            </button>
            HTML,
            Toggle::tag()
                ->toggleAttributes(['aria-label' => 'true'])
                ->toggleClass('value')
                ->render(),
            'Attribute map must decorate the toggle decoration.',
        );
    }

    public function testToggleAttributesMergesAcrossCalls(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            <span class="first" data-x="value">
            content
            </span>
            </button>
            HTML,
            Toggle::tag()
                ->toggleAttributes(['class' => 'first'])
                ->toggleAttributes(['data-x' => 'value'])
                ->toggleContent('content')
                ->toggleTag('span')
                ->render(),
            "Repeated 'toggleAttributes()' calls must merge values from prior invocations.",
        );
    }

    public function testToggleClass(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            <span class="value value-1">
            </span>
            </button>
            HTML,
            Toggle::tag()
                ->toggleAttributes(['class' => 'value'])
                ->toggleClass('value-1')
                ->render(),
            'Classes must merge on the toggle decoration.',
        );
    }

    public function testToggleClassWithOverrideTrueValue(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            <span class="override-value">
            </span>
            </button>
            HTML,
            Toggle::tag()
                ->toggleAttributes(['class' => 'value'])
                ->toggleClass('override-value', true)
                ->render(),
            "'true' override flag must replace classes on the toggle decoration.",
        );
    }

    public function testToggleTag(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            <span>
            content
            </span>
            </button>
            HTML,
            Toggle::tag()
                ->toggleContent('content')
                ->toggleTag('span')
                ->render(),
            'Custom tag must wrap the toggle decoration content.',
        );
    }

    public function testToggleTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <button type="button">
            content
            </button>
            HTML,
            Toggle::tag()
                ->toggleContent('content')
                ->toggleTag(false)
                ->render(),
            "'false' tag must drop the toggle decoration wrapper.",
        );
    }
}
