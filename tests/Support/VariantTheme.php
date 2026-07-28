<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Support;

use UIAwesome\Html\Core\Config\{Call, ComponentContext, Cookbook, Recipe};
use UIAwesome\Html\Core\Theme\ThemeInterface;

use function in_array;
use function sprintf;

/**
 * Stub theme resolving a wrapper class from the variant carried by the component context.
 *
 * Replaces the removed variant-aware provider API: the variant is read from the context instead of being passed as a
 * separate argument.
 */
final readonly class VariantTheme implements ThemeInterface
{
    /**
     * @param string $name Stable theme identifier.
     * @param string $classTemplate `sprintf` template receiving the context variant.
     * @param list<string> $variants Variants the theme recognizes.
     */
    public function __construct(
        private string $name,
        private string $classTemplate,
        private array $variants,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getRecipes(ComponentContext $context): iterable
    {
        $variant = $context->variant;

        if ($variant === null || in_array($variant, $this->variants, true) === false) {
            return;
        }

        yield new Recipe(
            "{$this->name}.{$context->component}",
            new Cookbook(new Call('class', sprintf($this->classTemplate, $variant))),
        );
    }
}
