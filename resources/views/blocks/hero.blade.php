{{--
    script[ ]script
    style[ ]style
    Title: Hero
    Description: This is hero module
    Category: outside
    Icon: admin-tools
    Keywords: hero
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
    EnqueueAssetsCSS: 
    EnqueueAssetsJS: 
--}}
<!-- leadspace html goes here -->

@if ( ! empty( $is_preview  ) )
    @php
        /* Render screenshot for example */
        $imgUrl = \Roots\asset('images/preview/leadspace.webp')->uri();
    @endphp
    <img loading="lazy" src="{!! $imgUrl !!}" style="width:95%;height:auto;padding:0 50px;">
@else
    @php
        $blockId = $block['id'];
    @endphp

    <section>
        <p>this is hero section</p>
    </section>

@endif

