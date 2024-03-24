<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\NavBar;

use UIAwesome\Html\Core\Component\{Menu, Tests\Support\NavBar};

/**
 * Test the immutability of the NavBar component.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutable(): void
    {
        $instance = NavBar::widget();

        $this->assertNotSame($instance, $instance->brandAttributes([]));
        $this->assertNotSame($instance, $instance->brandClass(''));
        $this->assertNotSame($instance, $instance->brandImage(''));
        $this->assertNotSame($instance, $instance->brandLink(''));
        $this->assertNotSame($instance, $instance->brandLinkAttributes([]));
        $this->assertNotSame($instance, $instance->brandLinkClass(''));
        $this->assertNotSame($instance, $instance->brandLinkTemplate(''));
        $this->assertNotSame($instance, $instance->brandTag(''));
        $this->assertNotSame($instance, $instance->brandTemplate(''));
        $this->assertNotSame($instance, $instance->brandText(''));
        $this->assertNotSame($instance, $instance->brandToggle(''));
        $this->assertNotSame($instance, $instance->containerMenuAttributes([]));
        $this->assertNotSame($instance, $instance->containerMenuClass(''));
        $this->assertNotSame($instance, $instance->containerMenuTag());
        $this->assertNotSame($instance, $instance->menu(Menu::widget()));
        $this->assertNotSame($instance, $instance->menuDefaultDefinitions([]));
    }
}
