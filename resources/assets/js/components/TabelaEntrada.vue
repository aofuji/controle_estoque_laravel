<template>
     <div v-bind:class="csstamanho || 'col-lg-12'">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastrar">
                            <span class="glyphicon glyphicon-plus"></span>
                            </button>

                    </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th v-for="(titulo,index) in titulotabela" :key="index">{{titulo}}</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <div  v-if="loading">Loading...</div>
                                <tr v-for="(i, index) in items" :key="index">
                                    <td>{{i.id}}</td>
                                    <td>{{i.nome_produto}}</td>
                                    <td>{{i.created_at | moment("DD/MM/YYYY, h:mm:ss")}}</td>
                                    <td>{{i.updated_at | moment("DD/MM/YYYY, h:mm:ss") }}</td>
                                    <td>{{i.valor}}</td>    
                                    <td>{{i.qtd_entrada}}</td>
                                    <td>           
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit" v-on:click="getItem(i.id)" ><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                        <button class="btn btn-danger btn-sm" v-on:click="removeItem(i.id)" ><i class="fa fa-trash-o" aria-hidden="true"></i></button>                                
                                    </td>
                                </tr>  
                            </tbody>
                        </table>
                       </div>
                <!-- /.table-responsive -->
                    </div>
                <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
                <modal nome="modalCadastrar">
                    
                      <form v-on:submit.prevent="addItem">
                          <div v-if="message" class="alert alert-success alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Successo!</strong> {{message}}.
                        </div>
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
                </modal>

                <modal nome="modalEdit">
                    
                      <form v-on:submit.prevent="updateItem(edit.id)">
                          <div v-if="message" class="alert alert-success alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Successo!</strong> {{message}}.
                        </div>
                        <div class="form-group">
                            <label>Nome Produto</label>
                            <input v-model="edit.produto_id"  class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Qtd entrada</label>
                            <input v-model="edit.qtd_entrada" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Valor</label>
                            <input v-model="edit.valor" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <button  class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </modal>
        </div>
        
</template>

<script>
    export default {
      props:[ 'url', 'csstamanho','titulotabela'],
      data(){
        return {
            items:null,
            message:"",
            loading:true,
            item:{},
            edit:{},
           
        }
      },
      mounted(){
          
          axios.get(this.url)
          .then(res => (this.items = res.data))
          .finally(() => this.loading = false)
      },
      methods:{
          
          teste: function(e){
              console.log(e)
          },
          atualiza(){
            axios.get(this.url)
            .then(res => (this.items = res.data))
          },
          addItem(){
            axios.post('entrada', this.item)
            .then(res =>{
                this.atualiza();
                this.message = res.data;
                
            })
        },
          removeItem(id){
            axios.get('entrada/delete/'+ id)
            .then(res => {
                 this.atualiza();
                 console.log(res)
            })
        },
          getItem(id){
            axios.get('entrada/edit/' + id)
            .then(res => (this.edit = res.data))
        },
          updateItem(id){
             axios.post('entrada/update/'+ id, this.edit)
             .then(res => {
                 this.atualiza();
                 console.log(res)
             } )
         }
      }
    }
</script>
