<template>
    <a class="btn btn-danger btn-sm" data-toggle="modal" v-bind:data-target="'#' + modalnome" v-on:click="getItens(idsaida)" >
        <i class="fa fa-trash-o" aria-hidden="true"></i>
    </a>
</template>

<script>
    export default {
        props:['modalnome','url','idsaida'],
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
