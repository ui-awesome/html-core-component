<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasListItemDisableClass;

final class HasListItemDisableClassTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use HasListItemDisableClass;

            public array $listItemAttributes = [];
        };

        $this->assertNotSame($instance, $instance->listItemDisableClass($instance->listItemAttributes));
        $this->assertNotSame($instance, $instance->listItemDisableClass($instance->listItemAttributes, true));
    }

    public function testOverrideActiveClass(): void
    {
        $instance = new class () {
            use HasListItemDisableClass;

            public array $listItemAttributes = [];

            public function getOverrideListItemDisableClass(): bool
            {
                return $this->overrideListItemDisableClass;
            }
        };

        $this->assertFalse($instance->getOverrideListItemDisableClass());

        $instance = $instance->listItemDisableClass($instance->listItemAttributes, true);

        $this->assertTrue($instance->getOverrideListItemDisableClass());

        $instance = $instance->listItemDisableClass($instance->listItemAttributes);

        $this->assertFalse($instance->getOverrideListItemDisableClass());
    }
}
