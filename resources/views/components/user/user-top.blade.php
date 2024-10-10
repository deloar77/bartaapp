<section
    class="bg-white border-2 p-8 border-gray-800 rounded-xl min-h-[350px] space-y-8 flex items-center flex-col justify-center mx-auto  w-[900px]  shadow-lg">

    <!-- Profile Info -->
    <div class="flex flex-col gap-4 justify-center text-center items-center">
        <!-- Avatar -->
        <div class="relative">
            <img
                class="w-32 h-32 rounded-full border-4 border-gray-800 shadow-lg"
                src="{{$user->image?asset('storage/profile_images/' . $user->image):asset('images/default.jpg')}}"
                alt="Ahmed Shamim" />
        </div>
        <!-- /Avatar -->

        <!-- User Meta -->
        <div>
            <h1 class="font-bold text-xl md:text-2xl text-gray-900">{{$user['first_name']}} {{$user['last_name']}}</h1>
            <p class="text-gray-700 mt-2">Less Talk, More Code 💻</p>
        </div>
        <!-- /User Meta -->
    </div>
    <!-- /Profile Info -->

    <!-- Profile Stats -->
    <div class="flex gap-16 justify-center text-center items-center">
        <!-- Total Posts Count -->
        <div class="flex flex-col justify-center items-center">
            <h4 class="text-2xl font-bold text-gray-900">3</h4>
            <p class="text-gray-600">Posts</p>
        </div>

        <!-- Total Comments Count -->
        <div class="flex flex-col justify-center items-center">
            <h4 class="text-2xl font-bold text-gray-900">14</h4>
            <p class="text-gray-600">Comments</p>
        </div>
    </div>
    <!-- /Profile Stats -->

    <!-- Edit Profile Button (Only visible to the profile owner) -->
   @if (Auth::check())
       @if ($user->id===Auth::user()->id)
           <a
        href=""
        type="button"
        class="flex gap-2 items-center rounded-full px-6 py-3 font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700 transition-all duration-300 ease-in-out">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-5 h-5">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
        </svg>
        Edit Profile
    </a> 
       @endif
   @endif
    <!-- /Edit Profile Button -->
</section>
