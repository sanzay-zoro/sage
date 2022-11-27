<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Header extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.header'
    ];

    public function with()
    {
        return [     
          'mainMenu' => wp_get_nav_menu_items('main_menu', array('order' => 'DESC')),
        ];
    }
}
