<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasDivider;

final class HasDividerTest extends \PHPUnit\Framework\TestCase
{
    public function testDivider(): void
    {
        $instance = new class () {
            use HasDivider;

            public function getDivider(): string
            {
                return $this->divider;
            }
        };

        $this->assertEmpty($instance->getDivider());
        $this->assertSame('<hr>', $instance->divider('hr')->getDivider());
        $this->assertSame('<hr class="value">', $instance->divider('hr', ['class' => 'value'])->getDivider());
    }

    public function testImmutability(): void
    {
        $instance = new class () {
            use HasDivider;
        };

        $this->assertNotSame($instance, $instance->divider());
    }
}
