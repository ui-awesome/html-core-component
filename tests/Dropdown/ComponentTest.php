<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Dropdown;

use PHPForge\Support\Assert;
use UIAwesome\Html\Core\Component\{Item, Tests\Support\Dropdown, Tests\Support\Toggle};

/**
 * Test for all the Dropdown component methods.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ComponentTest extends \PHPUnit\Framework\TestCase
{
    public function testActivateItems(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a class="active" href="/action" aria-current="true">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->activateItems(true)
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action')->active(),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->linkActiveClass('active')
                ->render()
        );
    }

    public function testActivateItemsWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->activateItems(false)
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action')->active(),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->linkActiveClass('active')
                ->render()
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value" id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->attributes(['class' => 'value'])
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="dropdown" id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->class('dropdown')
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->render()
        );
    }

    public function testDataAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3" data-value="value">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->dataAttributes(['value' => 'value'])
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->render()
        );
    }

    public function testDataBsToggle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3" data-bs-toggle="value">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->dataBsToggle('value')
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->render()
        );
    }

    public function testFirstItemClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li class="value">
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->firstItemClass('value')
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->render()
        );
    }

    public function testFirstLinkClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a class="value" href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->firstLinkClass('value')
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->render()
        );
    }

    public function testGenerateId(): void
    {
        $this->assertStringContainsString(
            'dropdown-',
            Dropdown::widget()->items(Item::widget()->label('Home')->link('/'))->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="value">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('value')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->render()
        );
    }

    public function testLastItemClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li class="value">
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->lastItemClass('value')
                ->render()
        );
    }

    public function testLastLinkClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a class="value" href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->lastLinkClass('value')
                ->render()
        );
    }

    public function testLinkActiveClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a class="value" href="/action" aria-current="true">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action')->active(),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->linkActiveClass('value')
                ->render()
        );
    }

    public function testLinkAriaCurrent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action" aria-current="true">Action</a>
            </li>
            <li>
            <a href="/another-actionc" aria-current="true">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action')->active(),
                    Item::widget()->label('Another actionc')->link('/another-actionc')->active(),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->linkAriaCurrent(true)
                ->render()
        );
    }

    public function testLinkAriaCurrentWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action')->active(),
                    Item::widget()->label('Another actionc')->link('/another-actionc')->active(),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->linkAriaCurrent(false)
                ->render()
        );
    }

    public function testLinkAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a class="value" href="/action">Action</a>
            </li>
            <li>
            <a class="value" href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a class="value" href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->linkAttributes(['class' => 'value'])
                ->render()
        );
    }

    public function testLinkClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a class="value" href="/action">Action</a>
            </li>
            <li>
            <a class="value" href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a class="value" href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->linkClass('value')
                ->render()
        );
    }

    public function testLinkContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <div class="value">
            <a href="/action">Action</a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/another-actionc">Another actionc</a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/something-else-here">Something else here</a>
            </div>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->linkContainerAttributes(['class' => 'value'])
                ->linkContainerTag()
                ->render()
        );
    }

    public function testLinkContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <div class="value">
            <a href="/action">Action</a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/another-actionc">Another actionc</a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/something-else-here">Something else here</a>
            </div>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->linkContainerClass('value')
                ->linkContainerTag()
                ->render()
        );
    }

    public function testLinkContainerTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <div>
            <a href="/action">Action</a>
            </div>
            </li>
            <li>
            <div>
            <a href="/another-actionc">Another actionc</a>
            </div>
            </li>
            <li>
            <div>
            <a href="/something-else-here">Something else here</a>
            </div>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->linkContainerTag()
                ->render()
        );
    }

    public function testLinkContainerTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->linkContainerTag(false)
                ->render()
        );
    }

    public function testLinkContainerTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <span><a href="/action">Action</a></span>
            </li>
            <li>
            <span><a href="/another-actionc">Another actionc</a></span>
            </li>
            <li>
            <span><a href="/something-else-here">Something else here</a></span>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->linkContainerTag('span')
                ->render()
        );
    }

    public function testLinkDisableClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a class="value" href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here')->disable(),
                )
                ->linkDisableClass('value')
                ->render()
        );
    }

    public function testLinkTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->linkTag()
                ->render()
        );
    }

    public function testLinkTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
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
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->linkTag(false)
                ->render()
        );
    }

    public function testLinkTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <span>Action</span>
            </li>
            <li>
            <span>Another actionc</span>
            </li>
            <li>
            <span>Something else here</span>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->linkTag('span')
                ->render()
        );
    }

    public function testListAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul class="value">
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->listAttributes(['class' => 'value'])
                ->render()
        );
    }

    public function testListClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul class="value">
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->listClass('value')
                ->render()
        );
    }

    public function testListItemAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li class="value">
            <a href="/action">Action</a>
            </li>
            <li class="value">
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li class="value">
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->listItemAttributes(['class' => 'value'])
                ->render()
        );
    }

    public function testListItemClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li class="value">
            <a href="/action">Action</a>
            </li>
            <li class="value">
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li class="value">
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->listItemClass('value')
                ->render()
        );
    }

    public function testListItemTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->listItemTag('li')
                ->render()
        );
    }

    public function testListItemTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            Action
            Another actionc
            Something else here
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action'),
                    Item::widget()->label('Another actionc'),
                    Item::widget()->label('Something else here'),
                )
                ->listItemTag(false)
                ->render()
        );
    }

    public function testListType(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
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
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action'),
                    Item::widget()->label('Another actionc'),
                    Item::widget()->label('Something else here'),
                )
                ->listType('ol')
                ->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            prefix
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->prefix('prefix')
                ->render()
        );
    }

    public function testPrefixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            prefix
            </div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->prefix('prefix')
                ->prefixAttributes(['class' => 'value'])
                ->prefixTag()
                ->render()
        );
    }

    public function testPrefixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div class="value">
            prefix
            </div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->prefix('prefix')
                ->prefixClass('value')
                ->prefixTag()
                ->render()
        );
    }

    public function testPrefixItems(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            prefix
            <div id="dropdown-65f0094ceefe3">
            prefix-items
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->prefix('prefix')
                ->prefixItems('prefix-items')
                ->render()
        );
    }

    public function testPrefixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            prefix
            </div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->prefix('prefix')
                ->prefixTag()
                ->render()
        );
    }

    public function testPrefixTagwithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            prefix
            <div id="dropdown-65f0094ceefe3">
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
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action'),
                    Item::widget()->label('Another actionc'),
                    Item::widget()->label('Something else here'),
                )
                ->prefix('prefix')
                ->prefixTag(false)
                ->render()
        );
    }

    public function testPrefixTagWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <span>prefix</span>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->prefix('prefix')
                ->prefixTag('span')
                ->render()
        );
    }

    public function testRender(): void
    {
        $this->assertEmpty(Dropdown::widget()->render());
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3" style="value">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->style('value')
                ->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            </ul>
            </div>
            suffix
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                )
                ->suffix('suffix')
                ->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            </ul>
            </div>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                )
                ->suffix('suffix')
                ->suffixAttributes(['class' => 'value'])
                ->suffixTag()
                ->render()
        );
    }

    public function testSuffixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            </ul>
            </div>
            <div class="value">
            suffix
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                )
                ->suffix('suffix')
                ->suffixClass('value')
                ->suffixTag()
                ->render()
        );
    }

    public function testSuffixItems(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            </ul>
            suffix-items
            </div>
            suffix
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                )
                ->suffix('suffix')
                ->suffixItems('suffix-items')
                ->render()
        );
    }

    public function testSuffixTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            Action
            </li>
            <li>
            Another actionc
            </li>
            </ul>
            </div>
            <div>
            suffix
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action'),
                    Item::widget()->label('Another actionc'),
                )
                ->suffix('suffix')
                ->suffixTag()
                ->render()
        );
    }

    public function testSuffixTagwithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            Action
            </li>
            <li>
            Another actionc
            </li>
            </ul>
            </div>
            suffix
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action'),
                    Item::widget()->label('Another actionc'),
                )
                ->suffix('suffix')
                ->suffixTag(false)
                ->render()
        );
    }

    public function testSuffixWithValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            Action
            </li>
            <li>
            Another actionc
            </li>
            </ul>
            </div>
            <span>suffix</span>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action'),
                    Item::widget()->label('Another actionc'),
                )
                ->suffix('suffix')
                ->suffixTag('span')
                ->render()
        );
    }

    public function testTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <article id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            Action
            </li>
            <li>
            Another actionc
            </li>
            </ul>
            </article>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action'),
                    Item::widget()->label('Another actionc'),
                )
                ->tag('article')
                ->render()
        );
    }

    public function testTemplateLink(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">content<i class="icon"></i>Another actionc</a>
            </li>
            <li>
            <a href="/something-else-here">Something else here</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()
                        ->content('content')
                        ->label('Another actionc')
                        ->link('/another-actionc')
                        ->iconClass('icon'),
                    Item::widget()->label('Something else here')->link('/something-else-here'),
                )
                ->templateLinkItem('{content}{icon}{label}')
                ->render()
        );
    }

    public function testToggle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <button type="button" data-dropdown-toggle="dropdown-65f0094ceefe3">
            toggle
            </button>
            <div id="dropdown-65f0094ceefe3">
            <ul>
            <li>
            <a href="/action">Action</a>
            </li>
            <li>
            <a href="/another-actionc">Another actionc</a>
            </li>
            </ul>
            </div>
            </div>
            HTML,
            Dropdown::widget()
                ->id('dropdown-65f0094ceefe3')
                ->items(
                    Item::widget()->label('Action')->link('/action'),
                    Item::widget()->label('Another actionc')->link('/another-actionc'),
                )
                ->toggle(Toggle::widget()->content('toggle')->dataDropdownToggle())
                ->render()
        );
    }
}
