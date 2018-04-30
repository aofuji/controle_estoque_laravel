<template>
    <form v-on:submit.prevent="addItem">
    
        <div class="form-group">
            <label>Nome Produto</label>
            <input v-model="item.produto_id"  class="form-control">
        </div>

        <div class="form-group">
            <label>Qtd entrada</label>
            <input v-model="item.qtd_entrada" class="form-control">
        </div>

        <div class="form-group">
            <label>Valor</label>
            <input v-model="item.valor" class="form-control">
        </div>
        
        <div class="form-group">
            <button  class="btn btn-primary">Enviar</button>
        </div>
    </form>
</template>

<script>

    export default {
        data(){
        return{
          item:{}
        }
    },
    methods: {
        addItem(){
            let url = 'entrada';
            axios.post('entrada', this.item)
            .then(res => console.log(res))
        }
    }
    
    }
</script>
