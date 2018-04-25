<template>
<div class="panel panel-primary">
    <div class="panel-heading">
        {{titulo}}
    </div>
    <div class="panel-body">
        <div v-for="(i, index) in items" :key="index">
            {{i}}
        </div>
        
       <slot></slot>
    </div>
    
</div>
</template>

<script>
    export default {
      props:['titulo'],
      data(){
        return {
            items:null
        }
      },
      mounted(){
          axios.get('produto')
          .then(res => (this.items = res.data));
          
          
      }
    }
</script>
