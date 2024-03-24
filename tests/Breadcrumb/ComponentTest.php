<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Breadcrumb;

use PHPForge\Support\Assert;
use UIAwesome\Html\Core\Component\{Item, Tests\Support\Breadcrumb};

/**
 * Test for all the Breadcrumb component methods.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ComponentTest extends \PHPUnit\Framework\TestCase
{
    public function testActivateItems(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li class="active" aria-current="page">
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->currentPath('/data')
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->listItemActiveClass('active')
                ->listItemAriaCurrent(true)
                ->render()
        );
    }

    public function testActivateItemsWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->activateItems(false)
                ->currentPath('/data')
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->listItemActiveClass('active')
                ->render()
        );
    }

    public function testAriaLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="value">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->ariaLabel('value')
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->render()
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="value" id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->attributes(['class' => 'value'])
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->render()
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="value" id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->class('value')
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->render()
        );
    }

    public function testCurrentPath(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li class="active" aria-current="page">
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->currentPath('/data')
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->listItemActiveClass('active')
                ->listItemAriaCurrent(true)
                ->render()
        );
    }

    public function testFirstItemClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li class="value">
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->firstItemClass('value')
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->render()
        );
    }

    public function firstLinkClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a class="value" href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->firstLinkClass('value')
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->render()
        );
    }

    public function testGenerateId(): void
    {
        $this->assertStringContainsString(
            'breadcrumb-',
            Breadcrumb::widget()->items(Item::widget()->label('Home')->link('/'))->render()
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="value" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('value')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->render()
        );
    }

    public function testLastItemClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li class="value">
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->lastItemClass('value')
                ->render()
        );
    }

    public function testLastLinkClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a class="value" href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->lastLinkClass('value')
                ->render()
        );
    }

    public function testLinkActiveClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a class="value" href="/library" aria-current="page">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->currentPath('/library')
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->linkActiveClass('value')
                ->linkActiveTag('a')
                ->linkAriaCurrent(true)
                ->render()
        );
    }

    public function testLinkActiveTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <span aria-current="page">Library</span>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->currentPath('/library')
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->linkActiveTag('span')
                ->linkAriaCurrent(true)
                ->render()
        );
    }

    public function testLinkAriaCurrent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library" aria-current="page">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->currentPath('/library')
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->linkAriaCurrent(true)
                ->linkActiveTag('a')
                ->render()
        );
    }

    public function testLinkAriaCurrentWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->currentPath('/library')
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->linkAriaCurrent(false)
                ->linkActiveTag('a')
                ->render()
        );
    }

    public function testLinkAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a class="value" href="/">Home</a>
            </li>
            <li>
            <a class="value" href="/library">Library</a>
            </li>
            <li>
            <a class="value" href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->linkAttributes(['class' => 'value'])
                ->render()
        );
    }

    public function testLinkClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a class="value" href="/">Home</a>
            </li>
            <li>
            <a class="value" href="/library">Library</a>
            </li>
            <li>
            <a class="value" href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->linkClass('value')
                ->render()
        );
    }

    public function testLinkContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <div class="value">
            <a href="/">Home</a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/library">Library</a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/data">Data</a>
            </div>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
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
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <div class="value">
            <a href="/">Home</a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/library">Library</a>
            </div>
            </li>
            <li>
            <div class="value">
            <a href="/data">Data</a>
            </div>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
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
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <div>
            <a href="/">Home</a>
            </div>
            </li>
            <li>
            <div>
            <a href="/library">Library</a>
            </div>
            </li>
            <li>
            <div>
            <a href="/data">Data</a>
            </div>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->linkContainerTag()
                ->render()
        );
    }

    public function testLinkDisableClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a class="value" href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data')->disable(),
                )
                ->linkDisableClass('value')
                ->render()
        );
    }

    public function testLinkTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->linktag()
                ->render()
        );
    }

    public function testLinkTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->linktag(false)
                ->render()
        );
    }

    public function testLinkTagWitValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <span>Home</span>
            </li>
            <li>
            <span>Library</span>
            </li>
            <li>
            <span>Data</span>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->linktag('span')
                ->render()
        );
    }

    public function testListAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol class="value">
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->listAttributes(['class' => 'value'])
                ->render()
        );
    }

    public function testListClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol class="value">
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->listClass('value')
                ->render()
        );
    }

    public function testListItemActiveClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li class="value" aria-current="page">
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->currentPath('/data')
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->listItemActiveClass('value')
                ->listItemAriaCurrent(true)
                ->render()
        );
    }

    public function testListItemAriaCurrent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li class="active" aria-current="page">
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->activateItems(true)
                ->currentPath('/data')
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->listItemActiveClass('active')
                ->listItemAriaCurrent(true)
                ->render()
        );
    }

    public function testListItemAriaCurrentWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li class="active">
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->activateItems(true)
                ->currentPath('/data')
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->listItemActiveClass('active')
                ->listItemAriaCurrent(false)
                ->render()
        );
    }

    public function testListItemAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li class="value">
            <a href="/">Home</a>
            </li>
            <li class="value">
            <a href="/library">Library</a>
            </li>
            <li class="value">
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->listItemAttributes(['class' => 'value'])
                ->render()
        );
    }

    public function testListItemClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li class="value">
            <a href="/">Home</a>
            </li>
            <li class="value">
            <a href="/library">Library</a>
            </li>
            <li class="value">
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->listItemClass('value')
                ->render()
        );
    }

    public function testListItemDisbaleClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li class="value">
            <a href="/">Home</a>
            </li>
            <li class="value">
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/')->disable(),
                    Item::widget()->label('Library')->link('/library')->disable(),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->listItemDisableClass('value')
                ->render()
        );
    }

    public function testListItemTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('Library'),
                    Item::widget()->label('Data'),
                )
                ->listItemTag()
                ->render()
        );
    }

    public function testListItemTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            Home
            Library
            Data
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('Library'),
                    Item::widget()->label('Data'),
                )
                ->listItemTag(false)
                ->render()
        );
    }

    public function testListType(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ul>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ul>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->listType('ul')
                ->render()
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            prefix
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->prefix('prefix')
                ->render()
        );
    }

    public function testPrefixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            prefix
            </div>
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->prefixAttributes(['class' => 'value'])
                ->prefix('prefix')
                ->prefixTag()
                ->render()
        );
    }

    public function testPrefixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="value">
            prefix
            </div>
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->prefixClass('value')
                ->prefix('prefix')
                ->prefixTag()
                ->render()
        );
    }

    public function testPrefixItems(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            prefix
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            prefix-items
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('Library'),
                    Item::widget()->label('Data'),
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
            prefix
            </div>
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('Library'),
                    Item::widget()->label('Data'),
                )
                ->prefix('prefix')
                ->prefixTag()
                ->render()
        );
    }

    public function testPrefixTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            prefix
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('Library'),
                    Item::widget()->label('Data'),
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
            <span>prefix</span>
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('Library'),
                    Item::widget()->label('Data'),
                )
                ->prefix('prefix')
                ->prefixTag('span')
                ->render()
        );
    }

    public function testRender(): void
    {
        $this->assertEmpty(Breadcrumb::widget()->render());
    }

    public function testSeparator(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            >
            Library
            </li>
            <li>
            >
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('Library'),
                    Item::widget()->label('Data'),
                )
                ->separator('>')
                ->render()
        );
    }

    public function testStyle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb" style="value">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('Library'),
                    Item::widget()->label('Data'),
                )
                ->style('value')
                ->render()
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            suffix
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('Library'),
                    Item::widget()->label('Data'),
                )
                ->suffix('suffix')
                ->render()
        );
    }

    public function testSuffixAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            <div class="value">
            suffix
            </div>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->suffixAttributes(['class' => 'value'])
                ->suffix('suffix')
                ->suffixTag()
                ->render()
        );
    }

    public function testSuffixClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            <div class="value">
            suffix
            </div>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->label('Library')->link('/library'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->suffixClass('value')
                ->suffix('suffix')
                ->suffixTag()
                ->render()
        );
    }

    public function testSuffixItems(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            suffix-items
            </nav>
            suffix
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('Library'),
                    Item::widget()->label('Data'),
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
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            <div>
            suffix
            </div>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('Library'),
                    Item::widget()->label('Data'),
                )
                ->suffix('suffix')
                ->suffixTag()
                ->render()
        );
    }

    public function testSuffixWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            suffix
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('Library'),
                    Item::widget()->label('Data'),
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
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </nav>
            <span>suffix</span>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('Library'),
                    Item::widget()->label('Data'),
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
            <article id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            </article>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('Library'),
                    Item::widget()->label('Data'),
                )
                ->tag('article')
                ->render()
        );
    }

    public function testTagWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ol>
            <li>
            Home
            </li>
            <li>
            Library
            </li>
            <li>
            Data
            </li>
            </ol>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home'),
                    Item::widget()->label('Library'),
                    Item::widget()->label('Data'),
                )
                ->tag(false)
                ->render()
        );
    }

    public function testTemplateLinkItem(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav id="breadcrumb-65eed2adb4307" aria-label="breadcrumb">
            <ol>
            <li>
            <a href="/">Home</a>
            </li>
            <li>
            <a href="/library">content<i class="icon"></i>Library</a>
            </li>
            <li>
            <a href="/data">Data</a>
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::widget()
                ->id('breadcrumb-65eed2adb4307')
                ->items(
                    Item::widget()->label('Home')->link('/'),
                    Item::widget()->content('content')->label('Library')->link('/library')->iconClass('icon'),
                    Item::widget()->label('Data')->link('/data'),
                )
                ->templateLinkItem('{content}{icon}{label}')
                ->render()
        );
    }
}
