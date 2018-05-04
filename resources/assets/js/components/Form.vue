<template>
    <form v-bind:action="action" v-bind:method="method">
        <input  v-if="token" type="hidden" name="_token" v-bind:value="token">
        <slot></slot>
    </form>
</template>

<script>

    export default {
        props:['token', 'action', 'method','css', 'teste'],
        data(){
        return{
          
        }
    },
    mounted(){
        console.log(this.action)
        console.log(this.teste)
    },
    methods: {
       
    },
    
    }
</script>
