<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Breadcrumb;

use UIAwesome\Html\Core\Component\Tests\Support\Breadcrumb;

/**
 * Test the immutability of the Breadcrumb component.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = Breadcrumb::widget();

        $this->assertNotSame($instance, $instance->ariaCurrent(''));
        $this->assertNotSame($instance, $instance->items());
    }
}
