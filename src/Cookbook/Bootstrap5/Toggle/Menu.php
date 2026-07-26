<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;

/**
 * Bootstrap5 toggle defaults for the navbar collapse button (hamburger).
 *
 * The `data-bs-target` and `aria-controls` attributes must be supplied by the caller to reference the collapsible
 * navbar ID, as Bootstrap collapse plugin uses them to locate the target element to expand or collapse.
 *
 * Usage example:
 * ```php
 * $navId = 'navbarSupportedContent';
 *
 * \UIAwesome\Html\Core\Component\Toggle::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\Menu::class)
 *     ->addAriaAttribute('controls', $navId)
 *     ->addDataAttribute('bs-target', '#' . $navId);
 * ```
 *
 * @see https://getbootstrap.com/docs/5.3/components/navbar/#toggler
 */
final class Menu implements DefaultsProviderInterface
{
    /**
     * Returns the Bootstrap5 navbar-collapse `toggle` default method-call definitions for the tag.
     *
     * @param BaseTag $tag Tag the provider is decorating.
     *
     * @return array<string, mixed> Method-call definitions merged into the tag at render time.
     */
    public function getDefaults(BaseTag $tag): array
    {
        return [
            'ariaAttributes' => [['expanded' => 'false', 'label' => 'Toggle navigation']],
            'class' => ['navbar-toggler'],
            'dataAttributes' => [['bs-toggle' => 'collapse']],
            'toggleClass' => ['navbar-toggler-icon'],
            'toggleTag' => ['span'],
        ];
    }
}
