<template>
    <button type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + nome">{{titulo}}</button>
</template>

<script>
    export default {
        props:['tipo', 'nome', 'titulo', 'css']
    }
</script>
