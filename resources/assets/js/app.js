
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.moment = require('moment');

import Vuex from 'Vuex';
import {VMoney} from 'v-money'


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
        },
       
    } 
});

export const bus = new Vue();


Vue.component('modal', require('./components/modal/Modal.vue'));
Vue.component('tabelahistorico', require('./components/TabelaHistorico.vue'));
Vue.component('estoque', require('./components/Estoque.vue'));
Vue.component('cliente', require('./components/Cliente.vue'));
Vue.component('categoria', require('./components/Categoria.vue'));
Vue.component('historico', require('./components/Historico.vue'));
Vue.component('usuario', require('./components/Usuario.vue'));


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
        
       

        $.fn.clickToggle = function( f1, f2 ) {
            return this.each( function() {
                var clicked = false;
                $(this).bind('click', function() {
                    if(clicked) {
                        clicked = false;
                        return f2.apply(this, arguments);
                    }
        
                    clicked = true;
                    return f1.apply(this, arguments);
                });
            });
        
        }
        $(document).ready(function() {

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

           

            /*-----------------------------------/
            /*	TOP NAVIGATION AND LAYOUT
            /*----------------------------------*/
        
            $('.btn-toggle-fullwidth').on('click', function() {
                if(!$('body').hasClass('layout-fullwidth')) {
                    $('body').addClass('layout-fullwidth');
        
                } else {
                    $('body').removeClass('layout-fullwidth');
                    $('body').removeClass('layout-default'); // also remove default behaviour if set
                }
        
                //$(this).find('.lnr').toggleClass('lnr-arrow-left-circle lnr-arrow-right-circle');
        
                if($(window).innerWidth() < 1025) {
                    if(!$('body').hasClass('offcanvas-active')) {
                        $('body').addClass('offcanvas-active');
                    } else {
                        $('body').removeClass('offcanvas-active');
                    }
                }
            });
        
            $(window).on('load', function() {
                if($(window).innerWidth() < 1025) {
                    $('.btn-toggle-fullwidth').find('.icon-arrows')
                    .removeClass('icon-arrows-move-left')
                    .addClass('icon-arrows-move-right');
                }
        
                // adjust right sidebar top position
                $('.right-sidebar').css('top', $('.navbar').innerHeight());
        
                // if page has content-menu, set top padding of main-content
                if($('.has-content-menu').length > 0) {
                    $('.navbar + .main-content').css('padding-top', $('.navbar').innerHeight());
                }
        
                // for shorter main content
                if($('.main').height() < $('#sidebar-nav').height()) {
                    $('.main').css('min-height', $('#sidebar-nav').height());
                }
            });
        
        
            /*-----------------------------------/
            /*	SIDEBAR NAVIGATION
            /*----------------------------------*/
        
            $('.sidebar a[data-toggle="collapse"]').on('click', function() {
                if($(this).hasClass('collapsed')) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });
        
            
        
        
            /*-----------------------------------/
            /*	PANEL FUNCTIONS
            /*----------------------------------*/
        
            // panel remove
            $('.panel .btn-remove').click(function(e){
        
                e.preventDefault();
                $(this).parents('.panel').fadeOut(300, function(){
                    $(this).remove();
                });
            });
        
            // panel collapse/expand
            var affectedElement = $('.panel-body');
        
            $('.panel .btn-toggle-collapse').clickToggle(
                function(e) {
                    e.preventDefault();
        
                    // if has scroll
                    if( $(this).parents('.panel').find('.slimScrollDiv').length > 0 ) {
                        affectedElement = $('.slimScrollDiv');
                    }
        
                    $(this).parents('.panel').find(affectedElement).slideUp(300);
                    $(this).find('i.lnr-chevron-up').toggleClass('lnr-chevron-down');
                },
                function(e) {
                    e.preventDefault();
        
                    // if has scroll
                    if( $(this).parents('.panel').find('.slimScrollDiv').length > 0 ) {
                        affectedElement = $('.slimScrollDiv');
                    }
        
                    $(this).parents('.panel').find(affectedElement).slideDown(300);
                    $(this).find('i.lnr-chevron-up').toggleClass('lnr-chevron-down');
                }
            );
        
        
            /*-----------------------------------/
            /*	PANEL SCROLLING
            /*----------------------------------*/
        
            if( $('.panel-scrolling').length > 0) {
                $('.panel-scrolling .panel-body').slimScroll({
                    height: '430px',
                    wheelStep: 2,
                });
            }
        
            if( $('#panel-scrolling-demo').length > 0) {
                $('#panel-scrolling-demo .panel-body').slimScroll({
                    height: '175px',
                    wheelStep: 2,
                });
            }
        
            /*-----------------------------------/
            /*	TODO LIST
            /*----------------------------------*/
        
            $('.todo-list input').change( function() {
                if( $(this).prop('checked') ) {
                    $(this).parents('li').addClass('completed');
                }else {
                    $(this).parents('li').removeClass('completed');
                }
            });
        
  
        });
    },
      directives: {money: VMoney}
});
