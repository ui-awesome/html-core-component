<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Dropdown;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\Dropdown;
use UIAwesome\Html\Core\Component\Toggle;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;
use UIAwesome\Html\Interop\Block;

/**
 * Bootstrap5 dropdown defaults providing the default styling and toggle.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Dropdown::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Dropdown\Defaults::class)
 *     ->items($item1, $item2)
 *     ->render();
 * ```
 *
 * @link https://getbootstrap.com/docs/5.3/components/dropdowns/
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Defaults implements DefaultsProviderInterface
{
    /**
     * Returns the Bootstrap5 `dropdown` default method-call definitions for the tag.
     *
     * @param BaseTag $tag Tag the provider is decorating.
     *
     * @return array<string, mixed> Method-call definitions merged into the tag at render time.
     */
    public function getDefaults(BaseTag $tag): array
    {
        return [
            'containerClass' => ['dropdown'],
            'containerTag' => [Block::DIV],
            'linkClass' => ['dropdown-item'],
            'listClass' => ['dropdown-menu'],
            'toggle' => [Toggle::tag()->addDefaultProvider(Dropdown::class)],
        ];
    }
}
