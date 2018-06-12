<template>
    <a href="#" v-bind:class="cssbtn" data-toggle="modal" v-bind:data-target="'#' + modalnome"  v-on:click="getItens(id)" >
        <i v-bind:class="cssicon"  data-toggle="tooltip" v-bind:title="tooltipname"></i>
        <slot></slot>
    </a>
</template>

<script>
    export default {
        props:['modalnome','url','id','cssbtn','cssicon', 'tooltipname'],
        mounted() {
           
            
        },
        methods:{
            getItens(id){
               
                axios.get(this.url + id)
                .then(res =>{
                   
                    this.$store.commit('setItem',res.data)
                    
                });
                
            }
        }
    }
</script>
