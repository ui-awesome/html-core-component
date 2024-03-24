<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasLinkDisableClass;

final class HasLinkDisableClassTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use HasLinkDisableClass;

            public array $linkAttributes = [];
        };

        $this->assertNotSame($instance, $instance->linkDisableClass($instance->linkAttributes));
        $this->assertNotSame($instance, $instance->linkDisableClass($instance->linkAttributes, true));
    }

    public function testOverrideActiveClass(): void
    {
        $instance = new class () {
            use HasLinkDisableClass;

            public array $linkAttributes = [];

            public function getOverrideLinkDisableClass(): bool
            {
                return $this->overrideLinkDisableClass;
            }
        };

        $this->assertFalse($instance->getOverrideLinkDisableClass());

        $instance = $instance->linkDisableClass($instance->linkAttributes);

        $this->assertFalse($instance->getOverrideLinkDisableClass());

        $instance = $instance->linkDisableClass($instance->linkAttributes, true);

        $this->assertTrue($instance->getOverrideLinkDisableClass());
    }
}
