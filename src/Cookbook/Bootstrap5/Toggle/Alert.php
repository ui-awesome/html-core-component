<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;

/**
 * Bootstrap5 toggle defaults for the close button used inside dismissible alerts.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Toggle::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\Alert::class)
 *     ->render();
 * ```
 *
 * @see https://getbootstrap.com/docs/5.3/components/alerts/#dismissing
 */
final class Alert implements DefaultsProviderInterface
{
    /**
     * Returns the Bootstrap5 alert close `toggle` default method-call definitions for the tag.
     *
     * @param BaseTag $tag Tag the provider is decorating.
     *
     * @return array<string, mixed> Method-call definitions merged into the tag at render time.
     */
    public function getDefaults(BaseTag $tag): array
    {
        return [
            'ariaAttributes' => [['label' => 'Close']],
            'class' => ['btn-close'],
            'dataAttributes' => [['bs-dismiss' => 'alert']],
        ];
    }
}
