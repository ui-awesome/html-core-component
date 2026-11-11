<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Support;

use UIAwesome\Html\Core\Component\ToggleInterface;

/**
 * Toggle implementing {@see ToggleInterface} without extending {@see \UIAwesome\Html\Core\Component\Base\BaseToggle},
 * so its content cannot be replaced by a toggle label.
 */
final class PlainToggle implements ToggleInterface
{
    public function __toString(): string
    {
        return $this->render();
    }

    public function dataValue(string $value): static
    {
        return $this;
    }

    public function render(): string
    {
        return '<button type="button">Plain</button>';
    }
}
