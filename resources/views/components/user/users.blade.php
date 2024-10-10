<!-- resources/views/components/search-results.blade.php -->
@if(isset($users))
    <div class="flex flex-col mt-10 items-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-3xl">
            <h2 class="text-2xl font-semibold text-gray-700 text-center">Search Results</h2>
            @if($users->isEmpty())
                <p class="text-red-500 mt-4 text-center">No users found.</p>
            @else
                <div class="grid grid-cols-1  gap-4 mt-4">
                    @foreach($users as $user)
                        <div class="bg-gray-50 shadow-md rounded-lg p-4 border border-gray-200">
                          <a href="{{ route('user.show', $user->id) }}" class="inline-block px-4 py-2 bg-blue-500 text-white font-bold rounded hover:bg-blue-700">
                             {{$user->first_name}} {{$user->last_name}}
                              </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endif
