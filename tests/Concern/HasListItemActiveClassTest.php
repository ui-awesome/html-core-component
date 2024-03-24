<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasListItemActiveClass;

final class HasListItemActiveClassTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use HasListItemActiveClass;

            public array $listItemAttributes = [];
        };

        $this->assertNotSame($instance, $instance->listItemActiveClass($instance->listItemAttributes));
        $this->assertNotSame($instance, $instance->listItemActiveClass($instance->listItemAttributes, true));
    }

    public function testOverrideActiveClass(): void
    {
        $instance = new class () {
            use HasListItemActiveClass;

            public array $listItemAttributes = [];

            public function getOverrideListItemActiveClass(): bool
            {
                return $this->overrideListItemActiveClass;
            }
        };

        $this->assertFalse($instance->getOverrideListItemActiveClass());

        $instance = $instance->listItemActiveClass($instance->listItemAttributes, true);

        $this->assertTrue($instance->getOverrideListItemActiveClass());

        $instance = $instance->listItemActiveClass($instance->listItemAttributes);

        $this->assertFalse($instance->getOverrideListItemActiveClass());
    }
}
