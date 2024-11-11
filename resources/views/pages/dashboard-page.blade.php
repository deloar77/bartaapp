@extends('layout.app')
@section('content')
    @include('components.navbar')
    <div id="app">
   <home-feed :posts="{{ json_encode($posts) }}"></home-feed>
 
  </div>
      
@endsection
@vite('resources/js/app.js')