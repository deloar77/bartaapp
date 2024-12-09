import './bootstrap';
import './echo';
import axios from 'axios';
import { createApp } from 'vue';


import HomeFeed from './components/HomeFeed.vue';



const app = createApp({});
app.component('HomeFeed', HomeFeed);

app.mount('#app');
