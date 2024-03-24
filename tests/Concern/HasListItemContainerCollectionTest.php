<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasListItemContainerCollection;

final class HasListItemContainerCollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        $instance = new class () {
            use HasListItemContainerCollection;
        };

        $instance = $instance->listItemContainerAttributes(['class' => 'value']);
        $instance = $instance->listItemContainerAttributes(['disabled' => true]);

        $this->assertSame(['class' => 'value', 'disabled' => true], $instance->getListItemContainerAttributes());
    }

    public function testClass(): void
    {
        $instance = new class () {
            use HasListItemContainerCollection;

            public function getListItemContainerClass(): string
            {
                return $this->listItemContainerAttributes['class'] ?? '';
            }
        };

        $this->assertEmpty($instance->getListItemContainerClass());

        $instance = $instance->listItemContainerClass('class');

        $this->assertSame('class', $instance->getListItemContainerClass());

        $instance = $instance->listItemContainerClass('class-1');

        $this->assertSame('class class-1', $instance->getListItemContainerClass());

        $instance = $instance->listItemContainerClass('override-class', true);

        $this->assertSame('override-class', $instance->getListItemContainerClass());
    }

    public function testImmutability(): void
    {
        $instance = new class () {
            use HasListItemContainerCollection;

            public array $linkAttributes = [];
        };

        $this->assertNotSame($instance, $instance->listItemContainerAttributes([]));
        $this->assertNotSame($instance, $instance->listItemContainerClass(''));
        $this->assertNotSame($instance, $instance->listItemContainerTag(false));
    }

    public function testListTypeExceptionWithEmptyValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The list item container tag must be a non-empty string.');

        $instance = new class () {
            use HasListItemContainerCollection;
        };

        $instance->listItemContainerTag('');
    }
}
