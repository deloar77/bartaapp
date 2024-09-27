<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  {{$post->id}}
  
  <article class="bg-white border border-gray-200 rounded-lg shadow-lg mx-auto w-[900px] px-6 py-5 sm:px-8">
    <!-- Barta Card Top -->
    
    <!-- Content (Editable Textarea) -->
    <div class="mt-4 text-gray-700">
      <label for="body" class="block text-sm font-medium text-gray-700">Edit Post</label>
      <textarea id="body" name="body" rows="5" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('body', $post->body) }}</textarea>
    </div>

    <!-- Image Section (Editable Image Upload) -->
    <div class="mt-4 flex justify-center">
      <div>
         <input type="hidden" name="current_image" value="{{ $post->image }}">
        <label for="image" class="block text-sm font-medium text-gray-700">Change Image</label>
        <!-- Hidden Input for Existing Image Path -->
        
        <input type="file" value="{{ $post->image }}" onchange="previewImage(event)" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />

        <!-- Current Image Preview -->
        <div class="mt-4">
          <img
            class="w-full h-[400px] object-cover rounded-lg"
            src="{{ $post->image ? asset('storage/post_images/' . $post->image) : asset('images/default.jpg') }}"
              id="newImagePreview"
            alt="Current Image" />
        </div>
      </div>
    </div>
    <!-- /Image Section -->

    <!-- Date Created & View Stat (Static Information) -->
    <div class="flex items-center gap-2 text-gray-500 text-xs mt-4">
      <span>{{ $post->created_at }}</span>
      <span>•</span>
      <span> views</span>
    </div>

    <!-- Save and Cancel Buttons -->
    <footer class="mt-4 border-t border-gray-100 pt-2">
      <div class="flex items-center justify-between">
        <!-- Save Changes Button -->
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-indigo-700">
          Save Changes
        </button>

        <!-- Cancel Button (Redirect Back) -->
        <a href="{{ route('profile.page') }}" class="text-indigo-600 hover:underline">
          Cancel
        </a>
      </div>
    </footer>
    <!-- /Barta Card Bottom -->
  </article>
</form>
