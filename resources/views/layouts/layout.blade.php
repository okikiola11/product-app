
    
        {{-- INCLUDE is used for pages that don't change --}}
        @extends('layouts.header')


    <div class="container">
        {{-- YIELD used for changing pages --}}
        @yield('content')
    </div>
