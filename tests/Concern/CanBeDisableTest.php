<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\CanBeDisable;

final class CanBeDisableTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use CanBeDisable;
        };

        $this->assertNotSame($instance, $instance->disable());
    }

    public function testIsVisible(): void
    {
        $instance = new class () {
            use CanBeDisable;
        };

        $this->assertFalse($instance->isDisable());
        $this->assertFalse($instance->disable(false)->isDisable());
        $this->assertTrue($instance->disable()->isDisable());
    }
}
