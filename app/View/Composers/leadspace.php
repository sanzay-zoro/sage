<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Leadspace extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks.leadspace',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'leadspaceTitle' => 'this is leadspace'
        ];
    }

}
