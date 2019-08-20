@if(isset($menu))

<div class="menu classic">
    <ul id="nav" class="menu">
        @include(env('THEME').'.customMenuItems',['items' => $mBuilder->roots()])


    </ul>
</div>
@endif
