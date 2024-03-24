<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasToggleCollection;

final class HasToggleCollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        $instance = new class () {
            use HasToggleCollection;
        };

        $instance = $instance->toggleAttributes(['class' => 'value']);
        $instance = $instance->toggleAttributes(['disabled' => true]);

        $this->assertSame(['class' => 'value', 'disabled' => true], $instance->getToggleAttributes());
    }

    public function testClass(): void
    {
        $instance = new class () {
            use HasToggleCollection;

            public function getToggleClass(): string
            {
                return $this->toggleAttributes['class'] ?? '';
            }
        };

        $this->assertEmpty($instance->getToggleClass());

        $instance = $instance->toggleClass('class');

        $this->assertSame('class', $instance->getToggleClass());

        $instance = $instance->toggleClass('class-1');

        $this->assertSame('class class-1', $instance->getToggleClass());

        $instance = $instance->toggleClass('override-class', true);

        $this->assertSame('override-class', $instance->getToggleClass());
    }

    public function testTagExceptionWithEmptyValue(): void
    {
        $instance = new class () {
            use HasToggleCollection;
        };

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The toggle tag must be a non-empty string.');

        $instance->toggleTag('');
    }

    public function testImmutability(): void
    {
        $instance = new class () {
            use HasToggleCollection;
        };

        $this->assertNotSame($instance, $instance->toggleAttributes([]));
        $this->assertNotSame($instance, $instance->toggleClass(''));
        $this->assertNotSame($instance, $instance->toggleContent(''));
        $this->assertNotSame($instance, $instance->toggleTag());
    }
}
