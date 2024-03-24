<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasLastLinkClass;

final class HasLastLinkClassTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use HasLastLinkClass;
        };

        $this->assertNotSame($instance, $instance->lastLinkClass(''));
    }

    public function testOverrideActiveClass(): void
    {
        $instance = new class () {
            use HasLastLinkClass;

            public array $lastLinkAttributes = [];

            public function getOverrideLastLinkClass(): bool
            {
                return $this->overrideLastLinkClass;
            }
        };

        $this->assertTrue($instance->getOverrideLastLinkClass());

        $instance = $instance->lastLinkClass($instance->lastLinkAttributes);

        $this->assertTrue($instance->getOverrideLastLinkClass());

        $instance = $instance->lastLinkClass($instance->lastLinkAttributes, false);

        $this->assertFalse($instance->getOverrideLastLinkClass());
    }
}
