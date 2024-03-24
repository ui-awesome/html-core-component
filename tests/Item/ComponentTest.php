<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Item;

use PHPForge\Support\Assert;
use UIAwesome\Html\Core\Component\Item;

/**
 * Test for all the Item component methods.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ComponentTest extends \PHPUnit\Framework\TestCase
{
    public function testActivateItems(): void
    {
        $this->assertTrue(Item::widget()->active()->link('/')->isActive());
    }

    public function testActivateItemsWithFalseValue(): void
    {
        $this->assertFalse(Item::widget()->activateItems(false)->active()->link('/')->isActive());
    }

    public function testActiveItems(): void
    {
        $this->assertTrue(Item::widget()->active()->link('/')->isActive());
    }

    public function testContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a href="/">content</a>
            </li>
            HTML,
            Item::widget()->content('content')->link('/')->render()
        );
    }

    public function testCurrentPath(): void
    {
        $this->assertTrue(Item::widget()->currentPath('/')->link('/')->isActive());
    }

    public function testDisabled(): void
    {
        $this->assertTrue(Item::widget()->disable()->link('/')->isDisable());
    }

    public function testIconAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a href="/"><i class="icon"></i></a>
            </li>
            HTML,
            Item::widget()->iconAttributes(['class' => 'icon'])->link('/')->render()
        );
    }

    public function testIconClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a href="/"><i class="icon"></i></a>
            </li>
            HTML,
            Item::widget()->iconClass('icon')->link('/')->render()
        );
    }

    public function testIconContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a href="/"><i>value</i></a>
            </li>
            HTML,
            Item::widget()->iconContent('value')->link('/')->render()
        );
    }

    public function testIconFilePath(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a href="/">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" aria-hidden="true" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
            </a>
            </li>
            HTML,
            Item::widget()
                ->iconFilePath(dirname(__DIR__) . '/Support/svg/toggle.svg')
                ->iconTag('svg')
                ->link('/')
                ->render()
        );
    }

    public function testIconTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a href="/"><i>value</i></a>
            </li>
            HTML,
            Item::widget()->iconContent('value')->iconTag()->link('/')->render()
        );
    }

    public function testIconTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a href="/"></a>
            </li>
            HTML,
            Item::widget()->iconContent('value')->iconTag(false)->link('/')->render()
        );
    }

    public function testIconTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a href="/">
            <svg>
            value
            </svg>
            </a>
            </li>
            HTML,
            Item::widget()->iconContent('value')->iconTag('svg')->link('/')->render()
        );
    }

    public function testIsActiveWithEmptyLink(): void
    {
        $this->assertFalse(Item::widget()->active()->isActive());
    }

    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a href="/">&lt;b&gt;label&lt;b&gt;</a>
            </li>
            HTML,
            Item::widget()->label('<b>label<b>')->link('/')->render()
        );
    }

    public function testLabelWithEncodeFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a href="/"><strong>label</strong></a>
            </li>
            HTML,
            Item::widget()->label('<strong>label</strong>', false)->link('/')->render()
        );
    }

    public function testLink(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a href="/"></a>
            </li>
            HTML,
            Item::widget()->link('/')->render()
        );
    }

    public function testLinkAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a class="value" href="/"></a>
            </li>
            HTML,
            Item::widget()->link('/')->linkAttributes(['class' => 'value'])->render()
        );
    }

    public function testLinkClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a class="value" href="/"></a>
            </li>
            HTML,
            Item::widget()->link('/')->linkClass('value')->render()
        );
    }

    public function testLinkContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <div class="value">
            <a href="/"></a>
            </div>
            </li>
            HTML,
            Item::widget()->link('/')->linkContainerAttributes(['class' => 'value'])->linkContainerTag()->render()
        );
    }

    public function testLinkContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <div class="value">
            <a href="/"></a>
            </div>
            </li>
            HTML,
            Item::widget()->link('/')->linkContainerClass('value')->linkContainerTag()->render()
        );
    }

    public function testLinkContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <div>
            <a href="/"></a>
            </div>
            </li>
            HTML,
            Item::widget()->link('/')->linkContainerTag()->render()
        );
    }

    public function testLinkContainerFalseTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a href="/"></a>
            </li>
            HTML,
            Item::widget()->link('/')->linkContainerTag(false)->render()
        );
    }

    public function testLinkContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <span><a href="/"></a></span>
            </li>
            HTML,
            Item::widget()->link('/')->linkContainerTag('span')->render()
        );
    }

    public function testLinkTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a href="/"></a>
            </li>
            HTML,
            Item::widget()->link('/')->linkTag()->render()
        );
    }

    public function testLinkTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            value
            </li>
            HTML,
            Item::widget()->label('value')->link('/')->linkTag(false)->render()
        );
    }

    public function testLinkTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <span>value</span>
            </li>
            HTML,
            Item::widget()->label('value')->link('/')->linkTag('span')->render()
        );
    }

    public function testListItemAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li class="value">
            <a href="/"></a>
            </li>
            HTML,
            Item::widget()->link('/')->listItemAttributes(['class' => 'value'])->render()
        );
    }

    public function testListItemClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li class="value">
            <a href="/"></a>
            </li>
            HTML,
            Item::widget()->link('/')->listItemClass('value')->render()
        );
    }

    public function testListItemTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a href="/"></a>
            </li>
            HTML,
            Item::widget()->link('/')->listItemTag()->render()
        );
    }

    public function testListItemTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <a href="/">value</a>
            HTML,
            Item::widget()->label('value')->link('/')->listItemTag(false)->render()
        );
    }

    public function testRender(): void
    {
        $this->assertEmpty(Item::widget()->render());
    }

    public function testSeparator(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            >
            <a href="/">value</a>
            </li>
            HTML,
            Item::widget()->label('value')->link('/')->separator('>')->render()
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <div>
            <a href="/">value</a>
            </div>
            </li>
            HTML,
            Item::widget()->label('value')->link('/')->template('<div>\n{link}\n</div>')->render()
        );
    }

    public function testTemplateLinkItem(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            <a href="/"><span><i>icon</i>label content</span></a>
            </li>
            HTML,
            Item::widget()
                ->iconContent('icon')
                ->label('label')
                ->content('content')
                ->link('/')
                ->templateLinkItem('<span>{icon}{label} {content}</span>')
                ->render()
        );
    }

    public function testVisible(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <li>
            label
            </li>
            HTML,
            Item::widget()->label('label')->visible(true)->render()
        );
    }

    public function testVisibleWithFalseValue(): void
    {
        $this->assertEmpty(Item::widget()->visible(false)->render());
    }
}
