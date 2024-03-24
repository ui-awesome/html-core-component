<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasFirstLinkClass;

final class HasFirstLinkClassTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use HasFirstLinkClass;
        };

        $this->assertNotSame($instance, $instance->firstLinkClass(''));
    }

    public function testOverrideActiveClass(): void
    {
        $instance = new class () {
            use HasFirstLinkClass;

            public array $linkAttributes = [];

            public function getOverrideFirstLinkClass(): bool
            {
                return $this->overrideFirstLinkClass;
            }
        };

        $this->assertTrue($instance->getOverrideFirstLinkClass());

        $instance = $instance->firstLinkClass($instance->linkAttributes);

        $this->assertTrue($instance->getOverrideFirstLinkClass());

        $instance = $instance->firstLinkClass($instance->linkAttributes, false);

        $this->assertFalse($instance->getOverrideFirstLinkClass());
    }
}
