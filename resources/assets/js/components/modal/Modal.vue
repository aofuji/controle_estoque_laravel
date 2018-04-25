<template>
<div v-bind:id="nome" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" v-bind:aria-labelledby="nome" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <slot></slot>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props:['nome']
    }
</script>
