<form
    method="POST"
    action="{{route('posts.store')}}"
    enctype="multipart/form-data"
    class="bg-white border-2 border-gray-200 rounded-lg shadow-lg mx-auto w-[900px] px-6 py-5 sm:px-8 space-y-4">
    @csrf

    <!-- Create Post Card Top -->
    <div>
        <div class="flex items-start gap-4">
            <!-- User Avatar -->
            <div class="flex-shrink-0">
                <img
                    class="h-10 w-10 rounded-full object-cover"
                    src="{{$user->image ? asset('storage/profile_images/' . $user->image) : asset('images/default.jpg')}}"
                    alt="{{$user->name}}" />
            </div>
            <!-- /User Avatar -->

            <!-- Content -->
            <div class="w-full">
                <textarea
                    class="block w-full p-2 text-gray-900 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent"
                    name="body"
                    rows="3"
                    placeholder="What's going on, {{ $user->name }}?">{{ old('body') }}</textarea>
                
                <!-- Validation Error for Body -->
                @error('body')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Create Post Card Bottom -->
    <div>
        <!-- Card Bottom Action Buttons -->
        <div class="flex items-center justify-between">
            <div class="flex gap-6 text-gray-600">
                <!-- Upload Picture Button -->
                <div>
                    <input
                        type="file"
                        name="image"
                        id="picture"
                        class="hidden" />
                    
                    <label
                        for="picture"
                        class="flex gap-2 items-center text-xs p-2 text-gray-600 hover:text-gray-800 cursor-pointer rounded-full hover:bg-gray-100 transition duration-300 ease-in-out">
                        <span class="sr-only">Upload Picture</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </label>

                    <!-- Validation Error for Image -->
                    @error('image')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Post Button -->
            <button
                type="submit"
                class="flex gap-2 items-center text-xs font-semibold px-4 py-2 rounded-full bg-gray-800 hover:bg-black text-white transition duration-300 ease-in-out">
                Post
            </button>
        </div>
    </div>
</form>
