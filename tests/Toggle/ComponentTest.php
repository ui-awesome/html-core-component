<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Toggle;

use PHPForge\Support\Assert;
use UIAwesome\Html\Core\Component\Tests\Support\Toggle;

/**
 * Test for all the Toggle component methods.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ComponentTest extends \PHPUnit\Framework\TestCase
{
    public function testAriaControls(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" aria-controls="value"></button>
            HTML,
            Toggle::widget()->ariaControls('value')->render()
        );
    }

    public function testAriaControlWithTrueValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" aria-controls="value"></button>
            HTML,
            Toggle::widget()->ariaControls(true)->dataValue('value')->render()
        );
    }

    public function testAriaExpanded(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" aria-expanded="value"></button>
            HTML,
            Toggle::widget()->ariaExpanded('value')->render()
        );
    }

    public function testAriaLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" aria-label="value"></button>
            HTML,
            Toggle::widget()->ariaLabel('value')->render()
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button class="value" type="button"></button>
            HTML,
            Toggle::widget()->attributes(['class' => 'value'])->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button class="value" type="button"></button>
            HTML,
            Toggle::widget()->class('value')->render()
        );
    }

    public function testContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button">
            value
            </button>
            HTML,
            Toggle::widget()->content('value')->render()
        );
    }

    public function testDataAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-value="value"></button>
            HTML,
            Toggle::widget()->dataAttributes(['value' => 'value'])->render()
        );
    }

    public function testDataBsAutoClose(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-bs-auto-close="value"></button>
            HTML,
            Toggle::widget()->dataBsAutoClose('value')->render()
        );
    }

    public function testDataBsAutoCloseWithTrueValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-bs-auto-close="value"></button>
            HTML,
            Toggle::widget()->dataBsAutoClose(true)->dataValue('value')->render()
        );
    }

    public function testDataBsDismiss(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-bs-dismiss="value"></button>
            HTML,
            Toggle::widget()->dataBsDismiss('value')->render()
        );
    }

    public function testDataBsDismissWithTrueValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-bs-dismiss="value"></button>
            HTML,
            Toggle::widget()->dataBsDismiss(true)->dataValue('value')->render()
        );
    }

    public function testDataBsTarget(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-bs-target="value"></button>
            HTML,
            Toggle::widget()->dataBsTarget('value')->render()
        );
    }

    public function testDataBsTargetWithTrueValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-bs-target="#value"></button>
            HTML,
            Toggle::widget()->dataBsTarget(true)->dataValue('value')->render()
        );
    }

    public function testDataBsToggle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-bs-toggle="value"></button>
            HTML,
            Toggle::widget()->dataBsToggle('value')->render()
        );
    }

    public function testDataBsToggleWithTrueValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-bs-toggle="value"></button>
            HTML,
            Toggle::widget()->dataBsToggle(true)->dataValue('value')->render()
        );
    }

    public function testDataCollapseToggle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-collapse-toggle="value"></button>
            HTML,
            Toggle::widget()->dataCollapseToggle('value')->render()
        );
    }

    public function testDataCollapseToggleWithTrueValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-collapse-toggle="value"></button>
            HTML,
            Toggle::widget()->dataCollapseToggle(true)->dataValue('value')->render()
        );
    }

    public function testDataDismissTarget(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-dismiss-target="#value"></button>
            HTML,
            Toggle::widget()->dataDismissTarget(true)->dataValue('value')->render()
        );
    }

    public function testDataDismissTargetWithTrueValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-dismiss-target="#value"></button>
            HTML,
            Toggle::widget()->dataDismissTarget(true)->dataValue('value')->render()
        );
    }

    public function testDataDrawerTarget(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-drawer-target="value"></button>
            HTML,
            Toggle::widget()->dataDrawerTarget('value')->render()
        );
    }

    public function testDataDrawerTargetWithTrueValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-drawer-target="value"></button>
            HTML,
            Toggle::widget()->dataDrawerTarget(true)->dataValue('value')->render()
        );
    }

    public function testDataDropdownToggle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-dropdown-toggle="value"></button>
            HTML,
            Toggle::widget()->dataDropdownToggle('value')->render()
        );
    }

    public function testDataDropdownToggleWithTrueValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-dropdown-toggle="value"></button>
            HTML,
            Toggle::widget()->dataDropdownToggle(true)->dataValue('value')->render()
        );
    }

    public function testDataToggle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-toggle="value"></button>
            HTML,
            Toggle::widget()->dataToggle('value')->render()
        );
    }

    public function testDataToggleWithTrueValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" data-toggle="value"></button>
            HTML,
            Toggle::widget()->dataToggle(true)->dataValue('value')->render()
        );
    }

    public function testIconAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button">
            <i class="value"></i>
            </button>
            HTML,
            Toggle::widget()->iconAttributes(['class' => 'value'])->iconTag()->render()
        );
    }

    public function testIconClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button">
            <i class="value"></i>
            </button>
            HTML,
            Toggle::widget()->iconClass('value')->iconTag()->render()
        );
    }

    public function testIconContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button">
            <i>value</i>
            </button>
            HTML,
            Toggle::widget()->iconContent('value')->iconTag()->render()
        );
    }

    public function testIconFilePath(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" aria-hidden="true" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
            </button>
            HTML,
            Toggle::widget()
                ->iconFilePath(dirname(__DIR__) . '/Support/svg/toggle.svg')
                ->iconTag('svg')
                ->render()
        );
    }

    public function testIconTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button">
            <i></i>
            </button>
            HTML,
            Toggle::widget()->iconTag()->render()
        );
    }

    public function testIconTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button"></button>
            HTML,
            Toggle::widget()->iconTag(false)->render()
        );
    }

    public function testIconTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" aria-hidden="true" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
            </button>
            HTML,
            Toggle::widget()
                ->iconFilePath(dirname(__DIR__) . '/Support/svg/toggle.svg')
                ->iconTag('svg')
                ->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button id="value" type="button"></button>
            HTML,
            Toggle::widget()->id('value')->render()
        );
    }

    public function testLink(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <a type="button"></a>
            HTML,
            Toggle::widget()->link()->render()
        );
    }

    public function testLinkWithRoleTrueValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <a type="button" role="role"></a>
            HTML,
            Toggle::widget()->link()->role(true)->render()
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button name="value" type="button"></button>
            HTML,
            Toggle::widget()->name('value')->render()
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button"></button>
            HTML,
            Toggle::widget()->render()
        );
    }

    public function testRole(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" role="value"></button>
            HTML,
            Toggle::widget()->role('value')->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" style="value"></button>
            HTML,
            Toggle::widget()->style('value')->render()
        );
    }

    public function testTabindex(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" tabindex="1"></button>
            HTML,
            Toggle::widget()->tabindex(1)->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button">
            <div>
            <i>value</i>
            </div>
            </button>
            HTML,
            Toggle::widget()
                ->iconContent('value')
                ->iconTag()
                ->template('<div>\n{toggle}\n{icon}\n{content}\n</div>')
                ->render()
        );
    }

    public function testToggleAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button">
            <span class="value" aria-label="true"></span>
            </button>
            HTML,
            Toggle::widget()->toggleAttributes(['aria-label' => 'true'])->toggleClass('value')->render()
        );
    }

    public function testToggleClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button">
            <span class="value value-1"></span>
            </button>
            HTML,
            Toggle::widget()
                ->toggleAttributes(['class' => 'value'])
                ->toggleClass('value-1')
                ->render()
        );
    }

    public function testToggleClassWithOverrideTrueValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button">
            <span class="override-value"></span>
            </button>
            HTML,
            Toggle::widget()->toggleAttributes(['class' => 'value'])->toggleClass('override-value', true)->render()
        );
    }

    public function testToggleTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button">
            <span>content</span>
            </button>
            HTML,
            Toggle::widget()->toggleContent('content')->toggleTag('span')->render()
        );
    }

    public function testToggleTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button">
            content
            </button>
            HTML,
            Toggle::widget()->toggleContent('content')->toggleTag(false)->render()
        );
    }

    public function testToggleTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button">
            <span>content</span>
            </button>
            HTML,
            Toggle::widget()->toggleContent('content')->toggleTag('span')->render()
        );
    }
}
