<template>
     <div v-bind:class="csstamanho || 'col-lg-12'">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastrar">
                            <span class="glyphicon glyphicon-plus"></span>
                            </button>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <select class="form-control" >
                                    <option>10</option>
                                    <option>15</option>
                                    <option>20</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <input type="text" v-model="search" class="form-control" placeholder="Pesquisar.."> 
                        </div>
                       
                      </div>

                    </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                       
                        <table class="table table-striped" >
                            <thead>
                                <tr>
                                    <th v-for="(titulo,index) in titulotabela" :key="index">{{titulo}}</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <div  v-if="loading">Loading...</div>
                                <div v-if="items == ''">Nenhum registro</div>
                                <tr v-for="(i, index) in lista" :key="index">
                                    
                                    <td>{{i.id}}</td>
                                    <td>{{i.nome_produto}}</td>
                                    <td>{{i.created_at | moment("DD/MM/YYYY - h:mm:ss a")}}</td>
                                    <td>{{i.updated_at | moment("DD/MM/YYYY - h:mm:ss a") }}</td>
                                    <td>R$ {{formatPrice(i.valor) }}</td>    
                                    <td>{{i.qtd_entrada}}</td>
                                    <td>           
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar" v-on:click="getItem(i.id)" ><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                        <button class="btn btn-danger btn-sm" v-on:click="removeItem(i.id)" ><i class="fa fa-trash-o" aria-hidden="true"></i></button>                                
                                    </td>
                                </tr>  
                            </tbody>
                        </table>
                   
                        <div class="text-center">
                        
                            
                        </div>

                       </div>
                <!-- /.table-responsive -->
                    </div>
                <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
                <modal nome="modalCadastrar" titulo="Cadastrar">
                    <div class="container">
                         
                      <form v-on:submit.prevent="addItem" class="form">
                          <div class="row">
                              <div v-if="message" class="alert alert-success alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Successo!</strong> {{message}}.
                          </div>
                               <div class="col-lg-2 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Categoria</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                </div>
                            </div>
                              <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label>Nome Produto</label>
                                    <input v-model="item.produto_id"  class="form-control">
                                </div>
                            </div>
                          </div>

                        <div class="row">
                           <div class="col-lg-2 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label>Qtd entrada</label>
                                <input v-model="item.qtd_entrada" class="form-control">
                            </div>
                           </div>
                           <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label>Valor</label>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">R$</span>
                                    <input type="text" v-model="item.valor" v-money="money" class="form-control">
                                </div>
                            </div>
                           </div>
                        </div>  
                        <div class="form-group">
                            <button  class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                    </div>
                </modal>

                <modal nome="modalEditar" titulo="Editar">
                    <div class="container"> 
                      <form v-on:submit.prevent="updateItem(edit.id)">
                          <div class="row">
                              <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="form-group">
                                    <label>Nome Produto</label>
                                    <input v-model="edit.produto_id"  class="form-control">
                                </div>
                               </div>
                          </div>
                          <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label>Qtd entrada</label>
                                    <input v-model="edit.qtd_entrada" class="form-control">
                                </div>
                              </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                              <div class="form-group">
                                <label>Valor</label>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">R$</span>
                                    <input type="text" v-model="edit.valor" v-money="money" class="form-control">
                                </div>
                               </div>
                            </div>
                          </div>
                        <div class="form-group">
                            <button  class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                   </div>
                </modal>
        </div>
        
</template>



<script>

 import {VMoney} from 'v-money'
 import VPagination from './Pagination.vue'

    export default {

    components: {
        VPagination
    },
      props:[ 'url', 'csstamanho','titulotabela'],
      data(){
        return {
            paginate: ['items'],
            items:[],
            message:"",
            loading:true,
            item:{},
            edit:{},
            money: {
                decimal: ',',
                thousands: '.',
                precision: 2,
                masked: false
            },
            search:"",
            n_exibir:10,

        }
      },
      
      mounted(){
          
          axios.get(this.url)
          .then(req => {
              this.items = req.data.data
              console.log(this.items)
              })
          .finally(() => this.loading = false)
      },
      computed:{
          filtroEntrada: function (){
              const re = new RegExp(this.search, 'i')
              return this.items.filter(entrada => entrada.nome_produto.match(re)
              )
          },
          lista: function(){
              
              return this.items.filter(res => {
                 if(res.nome_produto.toLowerCase().indexOf(this.search.toLowerCase()) >= 0){
                     return true
                 }else {
                     return false
                 }
                
                  
              })
          }
          
      },
      methods:{
          navigate(page){
              this.getaNavigate(page);
          },
          teste: function(e){
              console.log(e)
          },
          
          formatPrice(value) {
            let val = (value/1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
          },
          atualiza(){
            axios.get(this.url)
            .then(res => (this.items = res.data))
          },
          getaNavigate(page){
            axios.get('entrada/lista?page='+ page)
            .then(req => {
                    this.items = req.data.data
                    this.pagination = req.data
              })
              
          },
          cleanForm(){
              this.item.produto_id = "";
              this.item.qtd_entrada = "";
              this.item.valor = "";
          },
          addItem(){
            axios.post('entrada', this.item)
            .then(res =>{
                this.atualiza();
                
                this.message = res.data;
                this.cleanForm();
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
                 console.log(res.data)
             })
             .catch(res =>
             console.log(res.data)
             )
         },
         getCategoria(){
            
         }
      },
      directives: {money: VMoney}
    }
</script>

<style>
.pointer {cursor: pointer;}
</style>
