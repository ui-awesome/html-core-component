<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasListCollection;

final class HasListCollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        $instance = new class () {
            use HasListCollection;
        };

        $instance = $instance->listAttributes(['class' => 'value']);
        $instance = $instance->listAttributes(['disabled' => true]);

        $this->assertSame(['class' => 'value', 'disabled' => true], $instance->getListAttributes());
    }

    public function testClass(): void
    {
        $instance = new class () {
            use HasListCollection;

            public function getListClass(): string
            {
                return $this->listAttributes['class'] ?? '';
            }
        };

        $this->assertEmpty($instance->getListClass());

        $instance = $instance->listClass('class');

        $this->assertSame('class', $instance->getListClass());

        $instance = $instance->listClass('class-1');

        $this->assertSame('class class-1', $instance->getListClass());

        $instance = $instance->listClass('override-class', true);

        $this->assertSame('override-class', $instance->getListClass());
    }

    public function testImmutability(): void
    {
        $instance = new class () {
            use HasListCollection;

            public array $linkAttributes = [];
        };

        $this->assertNotSame($instance, $instance->listAttributes([]));
        $this->assertNotSame($instance, $instance->listClass(''));
        $this->assertNotSame($instance, $instance->listType(false));
    }

    public function testListTypeExceptionWithEmptyValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must not be empty. The valid values are: "ol", "ul".');

        $instance = new class () {
            use HasListCollection;
        };

        $instance->listType('');
    }

    public function testListTypeExceptionWithInvalidValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value "li" for the list type method. Allowed values are: "ol", "ul".');

        $instance = new class () {
            use HasListCollection;
        };

        $instance->listType('li');
    }
}
