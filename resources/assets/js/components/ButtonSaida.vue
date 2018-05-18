<template>
    <a v-if="validacao != 0" v-bind:class="cssbtn" data-toggle="modal" v-bind:data-target="'#' + modalnome" v-on:click="getItens(id)">
        <i v-bind:class="cssicon" aria-hidden="true"></i>
    </a>
</template>

<script>
    export default {
        props:['modalnome','url','id','cssbtn','cssicon', 'validacao'],
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
