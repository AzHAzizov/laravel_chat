

import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import router from './router';
app.component('example-component', ExampleComponent);



app.use(router);
app.mount('#app');
