<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasLinkActiveClass;

final class HasLinkActiveClassTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use HasLinkActiveClass;

            public array $linkAttributes = [];
        };

        $this->assertNotSame($instance, $instance->linkActiveClass($instance->linkAttributes));
        $this->assertNotSame($instance, $instance->linkActiveClass($instance->linkAttributes, true));
    }

    public function testOverrideActiveClass(): void
    {
        $instance = new class () {
            use HasLinkActiveClass;

            public array $linkAttributes = [];

            public function getOverrideLinkActiveClass(): bool
            {
                return $this->overrideLinkActiveClass;
            }
        };

        $this->assertFalse($instance->getOverrideLinkActiveClass());

        $instance = $instance->linkActiveClass($instance->linkAttributes);

        $this->assertFalse($instance->getOverrideLinkActiveClass());

        $instance = $instance->linkActiveClass($instance->linkAttributes, true);

        $this->assertTrue($instance->getOverrideLinkActiveClass());
    }
}
