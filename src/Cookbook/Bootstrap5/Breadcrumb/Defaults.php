<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Breadcrumb;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;

/**
 * Bootstrap5 breadcrumb defaults providing the default styling.
 *
 * Indicates the current page location within a navigational hierarchy with CSS-injected separators.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Breadcrumb::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Breadcrumb\Defaults::class)
 *     ->items($home, $reports)
 *     ->render();
 * ```
 *
 * @link https://getbootstrap.com/docs/5.3/components/breadcrumb/
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Defaults implements DefaultsProviderInterface
{
    public function getDefaults(BaseTag $tag): array
    {
        return [
            'listClass' => ['breadcrumb'],
            'listItemActiveClass' => ['active'],
            'listItemAriaCurrent' => [],
            'listItemClass' => ['breadcrumb-item'],
        ];
    }
}
