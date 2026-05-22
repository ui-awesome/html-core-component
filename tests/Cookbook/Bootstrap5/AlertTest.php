<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Cookbook\Bootstrap5;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\Alert;
use UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Alert\{Defaults, Dismissible};

/**
 * Unit tests for the {@see Alert} component with Bootstrap5 theme providers.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('alert')]
final class AlertTest extends TestCase
{
    public function testApplyDefaultsRendersDangerVariant(): void
    {
        self::assertSame(
            <<<HTML
            <div class="alert alert-danger" id="alert" role="alert">
            Watch out!
            </div>
            HTML,
            Alert::tag()
                ->addThemeProvider('danger', Defaults::class)
                ->content('Watch out!')
                ->id('alert')
                ->render(),
            'Theme provider must emit the contextual class.',
        );
    }

    public function testApplyDefaultsRendersInfoVariant(): void
    {
        self::assertSame(
            <<<HTML
            <div class="alert alert-info" id="alert" role="alert">
            Heads up!
            </div>
            HTML,
            Alert::tag()
                ->addThemeProvider('info', Defaults::class)
                ->content('Heads up!')
                ->id('alert')
                ->render(),
            'Theme provider must emit the contextual class.',
        );
    }

    public function testApplyDismissibleEmitsCloseToggle(): void
    {
        self::assertSame(
            <<<HTML
            <div class="alert alert-warning alert-dismissible fade show" id="alert" role="alert">
            Watch the bus!
            <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="alert">
            </button>
            </div>
            HTML,
            Alert::tag()
                ->addThemeProvider('warning', Dismissible::class)
                ->content('Watch the bus!')
                ->id('alert')
                ->render(),
            'Dismissible theme provider must embed the close toggle.',
        );
    }
}
