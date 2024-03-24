<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Alert;

use PHPForge\Support\Assert;
use UIAwesome\Html\Core\Component\Tests\Support\{Alert, Toggle};

/**
 * Test for all the Alert component methods.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ComponentTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value" id="alert_658fec01ac6cf" role="alert">
            content
            </div>
            HTML,
            Alert::widget()->attributes(['class' => 'value'])->content('content')->id('alert_658fec01ac6cf')->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value" id="alert_658fec01ac6cf" role="alert">
            content
            </div>
            HTML,
            Alert::widget()->class('value')->content('content')->id('alert_658fec01ac6cf')->render()
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            <div class="value">
            content
            </div>
            </div>
            HTML,
            Alert::widget()
                ->containerAttributes(['class' => 'value'])
                ->containerTag()
                ->content('content')
                ->id('alert_658fec01ac6cf')
                ->render()
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            <div class="value">
            content
            </div>
            </div>
            HTML,
            Alert::widget()
                ->containerClass('value')
                ->containerTag()
                ->content('content')
                ->id('alert_658fec01ac6cf')
                ->render()
        );
    }

    public function testContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            <article>
            content
            </article>
            </div>
            HTML,
            Alert::widget()->containerTag('article')->content('content')->id('alert_658fec01ac6cf')->render()
        );
    }

    public function testContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            content
            </div>
            HTML,
            Alert::widget()->content('content')->id('alert_658fec01ac6cf')->render()
        );
    }

    public function testGenerateId(): void
    {
        $this->assertStringContainsString('alert-', Alert::widget()->content('content')->render());
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value" id="value" role="alert">
            content
            </div>
            HTML,
            Alert::widget()->attributes(['class' => 'value'])->content('content')->id('value')->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            prefix
            content
            </div>
            HTML,
            Alert::widget()->content('content')->id('alert_658fec01ac6cf')->prefix('prefix')->render()
        );
    }

    public function testPrefixContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            <div class="value">
            prefix
            </div>
            content
            </div>
            HTML,
            Alert::widget()
                ->content('content')
                ->id('alert_658fec01ac6cf')
                ->prefix('prefix')
                ->prefixAttributes(['class' => 'value'])
                ->prefixTag()
                ->render()
        );
    }

    public function testPrefixContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            <div class="value">
            prefix
            </div>
            content
            </div>
            HTML,
            Alert::widget()
                ->content('content')
                ->id('alert_658fec01ac6cf')
                ->prefix('prefix')
                ->prefixClass('value')
                ->prefixTag()
                ->render()
        );
    }

    public function testPrefixContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            prefix
            content
            </div>
            HTML,
            Alert::widget()
                ->content('content')
                ->id('alert_658fec01ac6cf')
                ->prefix('prefix')
                ->prefixTag(false)
                ->render()
        );
    }

    public function testPrefixContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            <article>
            prefix
            </article>
            content
            </div>
            HTML,
            Alert::widget()
                ->content('content')
                ->id('alert_658fec01ac6cf')
                ->prefix('prefix')
                ->prefixTag('article')
                ->render()
        );
    }

    public function testRender(): void
    {
        $this->assertEmpty(Alert::widget()->render());
    }

    public function testRole(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="value">
            content
            </div>
            HTML,
            Alert::widget()->content('content')->id('alert_658fec01ac6cf')->role('value')->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert" style="value">
            content
            </div>
            HTML,
            Alert::widget()->content('content')->id('alert_658fec01ac6cf')->style('value')->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            content
            suffix
            </div>
            HTML,
            Alert::widget()->content('content')->id('alert_658fec01ac6cf')->suffix('suffix')->render()
        );
    }

    public function testSuffixContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            content
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Alert::widget()
                ->content('content')
                ->id('alert_658fec01ac6cf')
                ->suffix('suffix')
                ->suffixAttributes(['class' => 'value'])
                ->suffixTag()
                ->render()
        );
    }

    public function testSuffixContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            content
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Alert::widget()
                ->content('content')
                ->id('alert_658fec01ac6cf')
                ->suffix('suffix')
                ->suffixClass('value')
                ->suffixTag()
                ->render()
        );
    }

    public function testSuffixContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            content
            suffix
            </div>
            HTML,
            Alert::widget()
                ->content('content')
                ->id('alert_658fec01ac6cf')
                ->suffix('suffix')
                ->suffixTag(false)
                ->render()
        );
    }

    public function testSuffixContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            content
            <article>
            suffix
            </article>
            </div>
            HTML,
            Alert::widget()
                ->content('content')
                ->id('alert_658fec01ac6cf')
                ->suffix('suffix')
                ->suffixTag('article')
                ->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            <span>
            content
            </span>
            </div>
            HTML,
            Alert::widget()
                ->content('content')
                ->id('alert_658fec01ac6cf')
                ->template('<span>\n{content}\n</span>')
                ->render()
        );
    }

    public function testToggle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="alert_658fec01ac6cf" role="alert">
            content
            <button type="button" data-dropdown-toggle="alert_658fec01ac6cf">
            toggle
            </button>
            </div>
            HTML,
            Alert::widget()
                ->content('content')
                ->id('alert_658fec01ac6cf')
                ->toggle(Toggle::widget()->content('toggle')->dataDropdownToggle())
                ->render()
        );
    }
}
