<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Item;

use UIAwesome\Html\Core\Component\Item;

/**
 * Test the immutability of the Item component.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = Item::widget();

        $this->assertNotSame($instance, $instance->items($instance));
        $this->assertNotSame($instance, $instance->label(''));
    }
}
