<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ContentImage extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks.content-image',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
      $content = get_field('content_image') ?? false;
        return [
            'title' => $content['title'] ?? false,
            'eyebrow' => $content['eyebrow'] ?? false,
            'description' => $content['description'] ?? false,
            'image' => (isset($content['image']) && !empty($content['image'])) ? $content['image'] : '' ,
        ];
    }

}
