<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Toggle;

use UIAwesome\Html\Core\Component\Tests\Support\Toggle;

/**
 * Test the immutability of the Toggle component.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = Toggle::widget();

        $this->assertNotSame($instance, $instance->link());
    }
}
