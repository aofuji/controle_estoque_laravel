<template>

     <div v-bind:class="csstamanho || 'col-lg-12'">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <modal-link  nome="modalEntrada" titulo="Cadastrar" css=""></modal-link>
                         
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
                                <td>{{i.id_entrada}}</td>
                                <td>{{i.nome_produto}}</td>
                                <td>{{i.valor}}</td>    
                                <td>{{i.qtd_entrada}}</td>
                                <td>
                                       
                                    <a class="btn btn-warning btn-sm" href="#" v-on:click="teste(1)" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            
                                    <a class="btn btn-danger btn-sm" href="#" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        
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
                <modal nome="modalEntrada">
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
                </modal>
        </div>
        
</template>

<script>
    export default {
      props:[ 'url', 'csstamanho','titulotabela'],
      data(){
        return {
            items:null,
            loading:true,
            item:{}
        }
      },
      mounted(){
          axios.get(this.url)
          .then(res => (this.items = res.data))
          .finally(() => this.loading = false)
      },
      methods:{
          teste: function(e){
              this.items.push(this.lista);
          },
          atualiza(){
            axios.get(this.url)
            .then(res => (this.items = res.data))
          },
          addItem(){
            let url = 'entrada';
            axios.post('entrada', this.item)
            .then(res =>{
                this.atualiza();
                console.log(res);
            })
        }
      }
    }
</script>
