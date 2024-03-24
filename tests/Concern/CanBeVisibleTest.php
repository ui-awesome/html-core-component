<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\CanBeVisible;

final class CanBeVisibleTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use CanBeVisible;
        };

        $this->assertNotSame($instance, $instance->visible());
    }

    public function testIsVisible(): void
    {
        $instance = new class () {
            use CanBeVisible;
        };

        $this->assertTrue($instance->isVisible());
        $this->assertFalse($instance->visible(false)->isVisible());
        $this->assertTrue($instance->visible()->isVisible());
    }
}
