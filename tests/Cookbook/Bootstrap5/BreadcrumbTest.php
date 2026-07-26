<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Cookbook\Bootstrap5;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\{Breadcrumb, Item};
use UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Breadcrumb\Defaults;

/**
 * Unit tests for the {@see Breadcrumb} component with Bootstrap5 default providers.
 */
#[Group('breadcrumb')]
final class BreadcrumbTest extends TestCase
{
    public function testApplyDefaultsRendersBreadcrumbList(): void
    {
        self::assertSame(
            <<<HTML
            <nav id="breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="/">
            Home
            </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
            Reports
            </li>
            </ol>
            </nav>
            HTML,
            Breadcrumb::tag()
                ->addDefaultProvider(Defaults::class)
                ->currentPath('/reports')
                ->id('breadcrumb')
                ->items(
                    Item::tag()->label('Home')->link('/'),
                    Item::tag()->label('Reports')->link('/reports'),
                )
                ->render(),
            'Default provider must apply the Bootstrap5 breadcrumb classes.',
        );
    }
}
