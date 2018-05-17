<template>
    <a class="btn btn-info btn-sm" data-toggle="modal" v-bind:data-target="'#' + modalnome" v-on:click="getItens(idview)" >
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
</template>

<script>
    export default {
        props:['modalnome','url','idview'],
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
