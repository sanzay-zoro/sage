{{--
    script[ ]script
    style[content-image.scss]style
    Title: Content Image
    Description: This is 50-50 content and image block
    Category: image
    Icon: admin-tools
    Keywords: content, image
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

    <section class="content-image bg-ocean py-4 py-md-10 py-xl-14">
      <!-- <header>
        <h2 class="h2">Content title</h2>
      </header> -->
      <div class="container">
        <div class="row flex-lg-row-reverse align-items-center">
          <div class="col-lg-6">
            @if($image)
              <figure class="content-image__image ratio ratio-1x1">
                <img loading="lazy" class="object-fit" src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
              </figure>
            @endif
          </div>
          <div class="col-lg-6">
            <div class="content-image__content">
              @if($eyebrow)
                <div class="eyebrow">
                  {{$eyebrow}}
                </div>
              @endif

              @if($title)
                <h2 class="h2 content-image__content-title">
                  {{$title}}
                </h2>
              @endif

              @if($description)
                <p class="content-image__content-description">
                  {{$description}}
                </p>
              @endif
            </div>
          </div>   
        </div>
      </div>
    </section>

@endif

