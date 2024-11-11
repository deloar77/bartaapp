<template>
  <div>
    <!-- Loop through posts and show only a certain number -->
    <div v-if="postsToShow.length">
      <div v-for="post in postsToShow" :key="post.id" class="bg-white border border-gray-200 rounded-lg shadow-lg mx-auto w-[900px] mt-4 px-6 py-5 sm:px-8">
        <!-- Post Content -->
        <header>
          <div class="flex items-center justify-between">
            <div class="flex-shrink-0">
              <img
                class="h-10 w-10 rounded-full object-cover"
                :src="post.user.image ? '/storage/profile_images/' + post.user.image : '/images/default.jpg'"
                alt="User Image" />
              <a href="profile.html" class="hover:underline font-semibold text-lg truncate">
                {{ post.user.first_name }} {{ post.user.last_name }}
              </a>
            </div>
          </div>
        </header>

        <div class="mt-4 text-gray-700">
          <p class="leading-relaxed">{{ post.body }}</p>
        </div>

        <div class="mt-4 flex justify-center">
          <img
            class="w-full h-[400px] object-cover rounded-lg"
            :src="post.image ? '/storage/post_images/' + post.image : '/images/default.jpg'"
            alt="Post Image" />
        </div>

        <div class="flex items-center gap-2 text-gray-500 text-xs mt-4">
          <span>•</span>
        </div>

        <footer class="mt-4 border-t border-gray-100 pt-2">
          <div class="flex items-center justify-between">
            <div class="flex gap-4 text-gray-600">
              <button class="flex items-center text-xs text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                </svg>
                <p class="ml-1">comments</p>
              </button>
            </div>
          </div>
        </footer>
      </div>
    </div>

    <!-- Show More Button -->
    <div v-if="posts.length > postsToShow.length" class="text-center mt-4">
      <button @click="showMore" class="px-6 py-3 bg-indigo-500 text-white font-semibold text-lg rounded-lg shadow-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out">
        Show More
      </button>
    </div>

    
  </div>
</template>

<script setup>
import { defineProps, ref } from 'vue';

// Define the 'posts' prop to accept the data passed from Blade
const props = defineProps({
  posts: {
    type: Array,
    required: true
  }
});

// Set up a reactive variable to control the posts displayed
const postsToShow = ref(props.posts.slice(0, 10)); // Initially show 10 posts

// Method to show more posts
const showMore = () => {
  // Increase the number of posts displayed by 10 each time
  const nextPosts = props.posts.slice(postsToShow.value.length, postsToShow.value.length + 10);
  postsToShow.value.push(...nextPosts);
};
</script>

<style scoped>
/* Add styles here */
</style>
