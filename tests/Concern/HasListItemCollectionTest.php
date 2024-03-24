<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasListItemCollection;

final class HasListItemCollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        $instance = new class () {
            use HasListItemCollection;
        };

        $instance = $instance->listItemAttributes(['class' => 'value']);
        $instance = $instance->listItemAttributes(['disabled' => true]);

        $this->assertSame(['class' => 'value', 'disabled' => true], $instance->getListItemAttributes());
    }

    public function testClass(): void
    {
        $instance = new class () {
            use HasListItemCollection;

            public function getListItemClass(): string
            {
                return $this->listItemAttributes['class'] ?? '';
            }
        };

        $this->assertEmpty($instance->getListItemClass());

        $instance = $instance->listItemClass('class');

        $this->assertSame('class', $instance->getListItemClass());

        $instance = $instance->listItemClass('class-1');

        $this->assertSame('class class-1', $instance->getListItemClass());

        $instance = $instance->listItemClass('override-class', true);

        $this->assertSame('override-class', $instance->getListItemClass());
    }

    public function testTag(): void
    {
        $instance = new class () {
            use HasListItemCollection;

            public function getListItemTag(): false|string
            {
                return $this->listItemTag;
            }
        };

        $this->assertSame('li', $instance->getListItemTag());

        $instance = $instance->listItemTag('li');

        $this->assertSame('li', $instance->getListItemTag());

        $instance = $instance->listItemTag();

        $this->assertSame('li', $instance->getListItemTag());

        $instance = $instance->listItemTag(false);

        $this->assertFalse($instance->getListItemTag());
    }

    public function testTagExceptionWithEmptyValue(): void
    {
        $instance = new class () {
            use HasListItemCollection;
        };

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must not be empty. The valid values are: "li".');

        $instance->listItemTag('');
    }

    public function testTagExceptionWithInvalidValue(): void
    {
        $instance = new class () {
            use HasListItemCollection;
        };

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value "value". The list item tag must be one of: "li".');

        $instance->listItemTag('value');
    }

    public function testImmutability(): void
    {
        $instance = new class () {
            use HasListItemCollection;
        };

        $this->assertNotSame($instance, $instance->listItemAttributes([]));
        $this->assertNotSame($instance, $instance->listItemClass(''));
        $this->assertNotSame($instance, $instance->listItemTag(false));
    }
}
