<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\NavBar;

use UIAwesome\Html\Core\Component\Tests\Support\NavBar;

/**
 * Test the exceptions of the NavBar component.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testContainerMenuTagWithEmptyValuer(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The container menu tag must be a non-empty string.');

        NavBar::widget()->containerMenuTag('')->render();
    }
}
