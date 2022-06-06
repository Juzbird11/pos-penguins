
@if(session()->has('message'))
    <p {{ $attributes->merge(['class' => 'alert']) }}>{{ session()->get('message') }}</p>
@endif