@forelse ($posts as $post)
  <article class="bg-white border border-gray-200 rounded-lg shadow-lg mx-auto w-[900px] mt-4 px-6 py-5 sm:px-8">
    <!-- Barta Card Top -->
    <header>
      <div class="flex items-center justify-between">
        <div class="flex-shrink-0">
          <img
            class="h-10 w-10 rounded-full object-cover"
            src="{{ $post->user_image ? asset('storage/profile_images/' . $post->user_image) : asset('images/default.jpg') }}"
            alt="User Image" />
          <a href="profile.html" class="hover:underline font-semibold text-lg truncate">
            {{ $post->first_name }} {{ $post->last_name }} 
          </a>
        </div>
        <!-- Card Action Dropdown -->
        <div class="relative" x-data="{ open: false }">
          <button @click="open = !open" class="flex items-center rounded-full p-2 text-gray-500 hover:text-gray-700">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
            </svg>
          </button>

          <!-- Dropdown Menu -->
          <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-40 bg-white rounded-md shadow-lg">
            @if (Auth::check())
              @if ($post->user_id === Auth::user()->id)
                <a href="{{ route('posts.edit', $post->post_id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                <form  action="{{ url('/posts', $post->post_id) }}" method="POST" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  @csrf
                  @method('DELETE')
                  <button type="submit"   onclick="confirmDelete(event, this)" class="text-red-500 hover:underline">Delete Post</button>
                </form>
              @else
                <!-- Actions for other users can go here -->
              @endif
            @else
              <p>Please log in to access more features.</p>
            @endif
          </div>
        </div>
        <!-- /Card Action Dropdown -->
      </div>
    </header>

    <!-- Content -->
    <div class="mt-4 text-gray-700">
      <p class="leading-relaxed">
        {{ $post->body }} <!-- Assuming the post body is stored in 'body' field -->
      </p>
    </div>

    <!-- Image Section -->
    <div class="mt-4 flex justify-center">
      <img
        class="w-full h-[400px] object-cover rounded-lg"
        src="{{ $post->post_image ? asset('storage/post_images/' . $post->post_image) : asset('images/default.jpg') }}"
        alt="Post Image" />
    </div>
    <!-- /Image Section -->

    <!-- Date Created & View Stat -->
    <div class="flex items-center gap-2 text-gray-500 text-xs mt-4">
      <!-- Display time since created -->
      <span>•</span>
       <!-- Assuming you have a views field -->
    </div>

    <!-- Barta Card Bottom -->
    <footer class="mt-4 border-t border-gray-100 pt-2">
      <div class="flex items-center justify-between">
        <div class="flex gap-4 text-gray-600">
          <!-- Comment Button -->
          <button class="flex items-center text-xs text-gray-600 hover:text-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
            </svg>
            <p class="ml-1"> comments</p> <!-- Assuming you have a way to count comments -->
          </button>
          <!-- /Comment Button -->
        </div>
      </div>
    </footer>
    <!-- /Barta Card Bottom -->
  </article>

@empty
  <p class="text-gray-500 text-center">No posts available.</p>
@endforelse
