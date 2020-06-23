require('./bootstrap');



window.Vue = require('vue');

Vue.use(require('vue-resource'));



Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('InfiniteLoading', require('vue-infinite-loading'));



const app = new Vue({

    el: '#app'

});
