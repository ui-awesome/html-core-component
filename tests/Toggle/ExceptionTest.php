<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Toggle;

use UIAwesome\Html\Core\Component\Tests\Support\Toggle;

/**
 * Test the exceptions of the Toggle component.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testTagNameWithEmptyValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The toggle tag must be a non-empty string.');

        Toggle::widget()->toggleTag('')->render();
    }
}
