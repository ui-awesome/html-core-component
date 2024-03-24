<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\CanBeListItemAreaCurrent;

final class CanBeListItemAreaCurrentTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use CanBeListItemAreaCurrent;
        };

        $this->assertNotSame($instance, $instance->listItemAriaCurrent(false));
    }

    public function testIsLinkAriaCurrent(): void
    {
        $instance = new class () {
            use CanBeListItemAreaCurrent;
        };

        $this->assertFalse($instance->isListItemAriaCurrent());
        $this->assertFalse($instance->listItemAriaCurrent(false)->isListItemAriaCurrent());
        $this->assertTrue($instance->listItemAriaCurrent()->isListItemAriaCurrent());
    }
}
