
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'Vuex';
Vue.use(Vuex);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const store = new Vuex.Store({
    state:{
        itens:{}
    },
    mutations:{
        setItens(state, obj){
            state.itens = obj;
        }
    } 
});

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('menu-topo', require('./components/MenuTopo.vue'));
Vue.component('menu-left', require('./components/MenuLeft.vue'));
Vue.component('modal', require('./components/modal/Modal.vue'));
Vue.component('modal-link', require('./components/modal/ModalLink.vue'));
Vue.component('painel', require('./components/Painel.vue'));
Vue.component('tabela', require('./components/Tabela.vue'));

const app = new Vue({
    el: '#app',
    store,
    mounted: function(){
        document.getElementById('app').style.display = "block";
    }
});
