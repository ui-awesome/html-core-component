<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Menu;

use UIAwesome\Html\Core\Component\Menu;

/**
 * Test the immutability of the Menu component.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = Menu::widget();

        $this->assertNotSame($instance, $instance->ariaCurrent(''));
        $this->assertNotSame($instance, $instance->dropdownDefaultDefinitions([]));
        $this->assertNotSame($instance, $instance->items($instance));
        $this->assertNotSame($instance, $instance->listDropdownItemClass(''));
        $this->assertNotSame($instance, $instance->type(''));
    }
}
