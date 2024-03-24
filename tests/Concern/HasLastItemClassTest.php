<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasLastItemClass;

final class HasLastItemClassTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use HasLastItemClass;
        };

        $this->assertNotSame($instance, $instance->lastItemClass(''));
    }

    public function testOverrideActiveClass(): void
    {
        $instance = new class () {
            use HasLastItemClass;

            public array $linkAttributes = [];

            public function getOverrideLastItemClass(): bool
            {
                return $this->overrideLastItemClass;
            }
        };

        $this->assertTrue($instance->getOverrideLastItemClass());

        $instance = $instance->lastItemClass($instance->linkAttributes);

        $this->assertTrue($instance->getOverrideLastItemClass());

        $instance = $instance->lastItemClass($instance->linkAttributes, false);

        $this->assertFalse($instance->getOverrideLastItemClass());
    }
}
