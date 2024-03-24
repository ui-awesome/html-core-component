<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\CanBeActive;

final class CanBeActiveTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use CanBeActive;
        };

        $this->assertNotSame($instance, $instance->active());
    }

    public function testIsVisible(): void
    {
        $instance = new class () {
            use CanBeActive;


            public function isActive(): bool
            {
                return $this->active;
            }
        };

        $this->assertFalse($instance->isActive());
        $this->assertFalse($instance->active(false)->isActive());
        $this->assertTrue($instance->active()->isActive());
    }
}
