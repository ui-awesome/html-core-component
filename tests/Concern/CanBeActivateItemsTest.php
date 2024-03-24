<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\CanBeActivateItems;

final class CanBeActivateItemsTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use CanBeActivateItems;
        };

        $this->assertNotSame($instance, $instance->activateItems());
    }

    public function testIsActivateItems(): void
    {
        $instance = new class () {
            use CanBeActivateItems;
        };

        $this->assertTrue($instance->isActivateItems());
        $this->assertFalse($instance->activateItems(false)->isActivateItems());
        $this->assertTrue($instance->activateItems()->isActivateItems());
    }
}
