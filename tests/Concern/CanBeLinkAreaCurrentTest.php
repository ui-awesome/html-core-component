<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\CanBeLinkAreaCurrent;

final class CanBeLinkAreaCurrentTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use CanBeLinkAreaCurrent;
        };

        $this->assertNotSame($instance, $instance->linkAriaCurrent(false));
    }

    public function testIsLinkAriaCurrent(): void
    {
        $instance = new class () {
            use CanBeLinkAreaCurrent;
        };

        $this->assertFalse($instance->isLinkAriaCurrent());
        $this->assertFalse($instance->linkAriaCurrent(false)->isLinkAriaCurrent());
        $this->assertTrue($instance->linkAriaCurrent()->isLinkAriaCurrent());
    }
}
