<template>
    <li  class="dropdown">
        <slot></slot>
                   
    </li>
</template>

<script>
    export default {
        props:['UserAuth'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
