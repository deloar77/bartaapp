@extends('layout.app')
@section('content')
    @include('components.navbar')
    <main class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 min-h-screen">
      <!-- Cover Container -->
       @include('components.user.user-top')
      <!-- /Cover Container -->

    

      <!-- User Specific Posts Feed -->
      <!-- Barta Card -->
       @include('components.user.barta-card')
      <!-- /Barta Card -->
     
    </main>
@endsection