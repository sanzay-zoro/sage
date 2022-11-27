{{--
    script[leadspace.js,banner.js,slider.js]script
    style[leadspace.scss,slider.scss]style
    Title: Leadspace B
    Description: Leadspace Description]
    Category: outside
    Icon: admin-tools
    Keywords: leadspace
    Mode: auto
    Align: center
    PostTypes: post page
    SupportsMode: false
    SupportsMultiple: true
    SupportsAlign: left right
    SupportsAlignContent: center
    EnqueueStyle:
    EnqueueScript:
    EnqueueAssets: assetsEnqueue
    EnqueueAssetsCSS: styles/banner.css,styles/slider.css
    EnqueueAssetsJS: scripts/banner.js,scripts/slider.js
--}}
<!-- leadspace html goes here -->

@if ( ! empty( $is_preview  ) )
    @php
        /* Render screenshot for example */
        $imgUrl = \Roots\asset('images/preview/leadspace.webp')->uri();
    @endphp
    <img loading="lazy" src="{!! $imgUrl !!}" style="width:100%;height:auto;">
@else
    @php
        $blockId = $block['id'];
    @endphp


    @include('blocks.modules.leadspace', [
        'blockId' => $blockId,
        'class' => '',
        'leadspaceTitle' => $leadspaceTitle
    ])


    @include('blocks.modules.leadspace', [
        'blockId' => $blockId,
        'class' => 'card2',
        'leadspaceTitle' => $leadspaceTitle
    ])

@endif

