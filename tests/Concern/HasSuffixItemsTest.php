<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasSuffixItems;

final class HasSuffixItemsTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use HasSuffixItems;
        };

        $this->assertNotSame($instance, $instance->suffixItems(''));
    }
}
