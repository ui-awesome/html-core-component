<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;

/**
 * Bootstrap5 toggle defaults for a navbar link that opens a nested dropdown.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Toggle::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\MenuDropdown::class)
 *     ->render();
 * ```
 *
 * @see https://getbootstrap.com/docs/5.3/components/navbar/#nav
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class MenuDropdown implements DefaultsProviderInterface
{
    /**
     * Returns the Bootstrap5 nested-dropdown `toggle` default method-call definitions for the tag.
     *
     * @param BaseTag $tag Tag the provider is decorating.
     *
     * @return array<string, mixed> Method-call definitions merged into the tag at render time.
     */
    public function getDefaults(BaseTag $tag): array
    {
        return [
            'ariaAttributes' => [['expanded' => 'false']],
            'class' => ['nav-link dropdown-toggle'],
            'content' => ['Dropdown'],
            'dataAttributes' => [['bs-toggle' => 'dropdown']],
            'link' => [],
            'role' => ['button'],
        ];
    }
}
