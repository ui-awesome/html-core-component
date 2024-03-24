<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasPrefixItems;

final class HasPrefixItemsTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use HasPrefixItems;
        };

        $this->assertNotSame($instance, $instance->prefixItems(''));
    }
}
