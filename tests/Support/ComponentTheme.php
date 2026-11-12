<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Support;

use UIAwesome\Html\Core\Component\Toggle;
use UIAwesome\Html\Core\Component\Values\{ComponentName, ComponentState, DropdownVariant, NavBarVariant, ToggleVariant};
use UIAwesome\Html\Core\Config\{Call, ComponentContext, Cookbook, Recipe};
use UIAwesome\Html\Core\Theme\ThemeInterface;

/**
 * Stub theme resolving one recipe per component context through the component vocabulary enums.
 *
 * Matches the component identifier against {@see ComponentName}, the variant against {@see DropdownVariant},
 * {@see NavBarVariant}, and {@see ToggleVariant}, and the states against {@see ComponentState}, as a real theme does.
 */
final readonly class ComponentTheme implements ThemeInterface
{
    public function getName(): string
    {
        return 'stub';
    }

    public function getRecipes(ComponentContext $context): iterable
    {
        $recipe = match ($context->component) {
            ComponentName::ALERT->value => $this->alert($context),
            ComponentName::BREADCRUMB->value => $this->recipe('breadcrumb', new Call('listClass', 'breadcrumb')),
            ComponentName::DROPDOWN->value => $this->dropdown($context),
            ComponentName::ITEM->value => $this->recipe('item', new Call('listItemClass', 'item')),
            ComponentName::MENU->value => $this->recipe('menu', new Call('listClass', 'menu')),
            ComponentName::NAVBAR->value => $this->navBar($context),
            ComponentName::TOGGLE->value => $this->toggle($context),
            default => null,
        };

        if ($recipe !== null) {
            yield $recipe;
        }
    }

    private function alert(ComponentContext $context): Recipe
    {
        if ($context->hasState(ComponentState::DISMISSIBLE) === false) {
            return $this->recipe('alert', new Call('class', 'alert'));
        }

        return $this->recipe(
            'alert.dismissible',
            new Call(
                'class',
                'alert alert-dismissible',
            ),
            new Call(
                'toggle',
                Toggle::tag()
                    ->addAriaAttribute('label', 'Close')
                    ->class('alert-close'),
            ),
        );
    }

    private function dropdown(ComponentContext $context): Recipe
    {
        if ($context->variant === DropdownVariant::LANGUAGE->value) {
            return $this->recipe('dropdown.language', new Call('class', 'dropdown dropdown-language'));
        }

        return $this->recipe('dropdown', new Call('class', 'dropdown'));
    }

    private function navBar(ComponentContext $context): Recipe
    {
        if ($context->variant === NavBarVariant::ALIGN_RIGHT->value) {
            return $this->recipe(
                'navbar.align-right',
                new Call(
                    'class',
                    'navbar',
                ),
                new Call(
                    'menuDefaultDefinitions',
                    ['listClass' => 'navbar-nav ms-auto'],
                ),
            );
        }

        return $this->recipe(
            'navbar',
            new Call(
                'class',
                'navbar',
            ),
            new Call(
                'menuDefaultDefinitions',
                ['listClass' => 'navbar-nav'],
            ),
        );
    }

    private function recipe(string $suffix, Call ...$calls): Recipe
    {
        return new Recipe("stub.{$suffix}", new Cookbook(...$calls));
    }

    private function toggle(ComponentContext $context): Recipe
    {
        return match ($context->variant) {
            ToggleVariant::MENU->value => $this->recipe(
                'toggle.menu',
                new Call(
                    'addAriaAttribute',
                    'label',
                    'Toggle navigation',
                ),
                new Call(
                    'class',
                    'navbar-toggler',
                ),
            ),
            ToggleVariant::MENU_DROPDOWN->value => $this->recipe(
                'toggle.menu-dropdown',
                new Call(
                    'class',
                    'nav-link dropdown-toggle',
                ),
            ),
            ToggleVariant::SELECTOR_THEME->value => $this->recipe(
                'toggle.selector-theme',
                new Call(
                    'addAriaAttribute',
                    'label',
                    'Toggle theme',
                ),
                new Call(
                    'class',
                    'theme-selector',
                ),
            ),
            default => $this->recipe('toggle', new Call('class', 'toggle')),
        };
    }
}
