<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasFirstItemClass;

final class HasFirstItemClassTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use HasFirstItemClass;
        };

        $this->assertNotSame($instance, $instance->firstItemClass(''));
    }

    public function testOverrideActiveClass(): void
    {
        $instance = new class () {
            use HasFirstItemClass;

            public array $linkAttributes = [];

            public function getOverrideFirstItemClass(): bool
            {
                return $this->overrideFirstItemClass;
            }
        };

        $this->assertTrue($instance->getOverrideFirstItemClass());

        $instance = $instance->firstItemClass($instance->linkAttributes);

        $this->assertTrue($instance->getOverrideFirstItemClass());

        $instance = $instance->firstItemClass($instance->linkAttributes, false);

        $this->assertFalse($instance->getOverrideFirstItemClass());
    }
}
