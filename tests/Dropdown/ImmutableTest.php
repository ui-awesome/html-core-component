<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Dropdown;

use UIAwesome\Html\Core\Component\{Item, Tests\Support\Dropdown, Tests\Support\Toggle};

/**
 * Test the immutability of the Dropdown component.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = Dropdown::widget();

        $this->assertNotSame($instance, $instance->ariaCurrent('value'));
        $this->assertNotSame($instance, $instance->items(Item::widget()));
        $this->assertNotSame($instance, $instance->items(Toggle::widget()));
        $this->assertNotSame($instance, $instance->Toggle(''));
    }
}
