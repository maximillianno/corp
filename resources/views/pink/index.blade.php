@extends(env('THEME').'.layouts.site')

@section('navigation')
    {!! $navigation !!}
{{--    @include('pink.navigation')--}}
@endsection

@section('slider')
    {!! $slides !!}
@endsection

@section('content')
    {!! $content !!}
@endsection

@section('bar')
    {!! $rightBar !!}
@endsection


