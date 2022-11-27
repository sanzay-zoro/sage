<section class="leadspace {{ $class }}" id="{{ $blockId }}">
    {{ $leadspaceTitle }}
    @include('blocks.cards.card1', [
        'blockId' => $blockId,
        'class' => ''
    ])
    
</section>