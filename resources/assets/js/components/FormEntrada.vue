<template>
    <form v-on:submit.prevent="updateItem()">
        
       <div class="row">
            <div class="form-group col-md-2">
                <label>Entrada</label>
                <input type="number" min="1"  class="form-control" v-model="edit.qtd_entrada" required>
                
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary ">Cadastrar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
            </div>
        </div>
    </form>
</template>

<script>

    export default {
        props:['token', 'url','css'],
        data(){
        return{
          edit:{}
        }
    },
    mounted(){
        
    },
    methods: {
       updateItem(){
           
           axios.post(this.url, this.edit)
           .then(res =>{
               console.log(res.data)
           })
       }
    },
    
    }
</script>
