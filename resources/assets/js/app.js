
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.moment = require('moment');

import Vuex from 'Vuex';
import VuePaginate from 'vue-paginate'
import {VMoney} from 'v-money'
import daterangepicker from 'daterangepicker';

Vue.use(VuePaginate)
Vue.use(Vuex);




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(require('vue-moment'));

 
const store = new Vuex.Store({
    state:{
        item:{}
    },
    mutations:{
        setItem(state, obj){
            state.item = obj;
        }
    } 
});


Vue.component('menu-topo', require('./components/MenuTopo.vue'));
Vue.component('menu-left', require('./components/MenuLeft.vue'));
Vue.component('modal', require('./components/modal/Modal.vue'));
Vue.component('tabela-entrada', require('./components/TabelaEntrada.vue'));
Vue.component('formulario', require('./components/Form.vue'));
Vue.component('buttonview', require('./components/ButtonView.vue'));
Vue.component('buttonsaida', require('./components/ButtonSaida.vue'));
Vue.component('buttonex', require('./components/ButtonEx.vue'));
Vue.component('formentrada', require('./components/FormEntrada.vue'));



const app = new Vue({
    el: '#app',
    store,
    data(){
        return{
            money: {
                decimal: ',',
                thousands: '.',
                precision: 2,
                masked: false
            },
        }
    },
    mounted: function(){
      
        document.getElementById('app').style.display = "block";
    },
      directives: {money: VMoney}
});
