<template>
<div class="row">
    <br>
    <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <a href="#" data-toggle="modal"  data-target="#cadastro" ><i class="fa fa-plus" aria-hidden="true"></i> Adicionar</a>

                    <div class="pull-right ">
                        <div class="form form-inline">

                            <input type="text" list="idOfDatalist"  class="form-control" v-model="search.nome_cliente" placeholder="Digite nome do Cliente."> 
                            <datalist id="idOfDatalist" >
                                
                                <option value="" />
                                
                            </datalist>
                            <button type="submit" class="btn btn-primary form-control"  v-on:click="searchCliente" ><i class="fa fa-search" ></i></button>
                        </div>
                    </div>
                </div>
                <div class="panel-body no-padding">
                    <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Endereço</th>
                                    <th>Cidade</th>
                                    <th>Estado</th>
                                    <th>Telefone</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        <tbody>
                            <tr v-for="item in items">
                                <td>{{item.id}}</td>
                                <td><a href="#" data-toggle="modal" data-target="#clienteView" v-on:click="getItem(item.id)">{{item.nome}}</a></td>
                                <td>{{item.endereco}}</td>
                                <td>{{item.cidade}}</td>
                                <td>{{item.estado}}</td>
                                <td>{{item.telefone}}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit" v-on:click="getEdit(item.id)" ><i class="fas fa-edit" aria-hidden="true"></i></button>  
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete" v-on:click="getItem(item.id)" ><i class="fas fa-trash-alt" aria-hidden="true"></i></button>    
                                </td>
                            </tr>
                        <tr v-if="loading">
                            <th scope="row"></th>
                            <th scope="row">Loading...</th>
                            <td colspan="6"></td>
                        </tr>
                        <tr v-if="!contador">
                            <th scope="row"></th>
                            <th scope="row">Nenhum registro</th>
                            <td colspan="7"></td>
                        </tr>
                        
                        </tbody>
                    </table>
                    <div class="text-center">
                            <vc-pagination  :source="pagination" @navigate="navigate"></vc-pagination>
                    </div>
                </div>
            </div>
        </div>
    <modal nome="cadastro" titulo="Cadastrar Cliente" tamanho="modal-lg">
        <form v-on:submit.prevent="addCliente()">
            <div class="row">
            <div class="form-group col-md-12">
                    <label for="">Nome</label>
                    <input type="text" class="form-control" v-model="cadCliente.nome" placeholder="Digite Nome Completo" required>
                </div>
                
            </div>
    
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">RG</label>
                    <input type="text" class="form-control" v-model="cadCliente.rg" maxlength="9" placeholder="Digite RG sem ponto sem traço." required>
                </div>
                <div class="form-group col-md-4">
                    <label for="">CPF</label>
                    <input type="text" class="form-control" v-model="cadCliente.cpf" maxlength="11" placeholder="Digite CPF sem ponto sem traco" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Data Nascimento</label>
                    <input type="date" class="form-control" v-model="cadCliente.data_nascimento" placeholder="Digite Data Nascimento" required>
                </div>
            </div>
    
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Endereco</label>
                    <input type="text" class="form-control" v-model="cadCliente.endereco" placeholder="Digite Endereço" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Cidade</label>
                    <input type="text" class="form-control" v-model="cadCliente.cidade" placeholder="Digite Cidade" required>
                </div>
                <div class="form-group col-md-1">
                    <label for="">Estado</label>
                    <input type="text" class="form-control" maxlength="2" v-model="cadCliente.estado" placeholder="UF" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Cep</label>
                    <input type="text" class="form-control" v-model="cadCliente.cep" placeholder="Digite CEP">
                </div>
            </div>
    
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Telefone</label>
                    <input type="text" class="form-control" maxlength="11"  v-model="cadCliente.telefone" placeholder="Digite Telefone" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Celular</label>
                    <input type="text" class="form-control" maxlength="12" v-model="cadCliente.celular" placeholder="Digite Celular" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Email</label>
                    <input type="email" class="form-control" v-model="cadCliente.email" placeholder="Digite Email" required>
                </div>
                
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <div v-show="!buttonLoading">
                        <p><i class="fa fa-spin fa-spinner"></i> Loading...</p>
                    </div>
                    <button v-show="buttonLoading" type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Cadastrar</button>
                    <button v-show="buttonLoading" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                </div>
            </div>
        </form>
    </modal>

    <modal nome="clienteView" titulo="Vizualização" tamanho="modal-lg">
        <div class="row">
            <div class="form-group col-md-12">
                    <label for="">Nome</label>
                    <input type="text" class="form-control"  v-model="cliente.nome" disabled>
            </div>
                
            </div>
    
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">RG</label>
                    <input type="text" class="form-control" v-model="cliente.rg"  disabled>
                </div>
                <div class="form-group col-md-5">
                    <label for="">CPF</label>
                    <input type="text" class="form-control" v-model="cliente.cpf"  disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Data Nascimento</label>
                    <input type="date" class="form-control" v-model="cliente.data_nascimento"  disabled>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Endereco</label>
                    <input type="text" class="form-control" v-model="cliente.endereco" disabled>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Cidade</label>
                    <input type="text" class="form-control" v-model="cliente.cidade" disabled>
                </div>
                <div class="form-group col-md-1">
                    <label for="">Estado</label>
                    <input type="text" class="form-control" v-model="cliente.estado" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Cep</label>
                    <input type="text" class="form-control" v-model="cliente.cep"  disabled>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Telefone</label>
                    <input type="text" class="form-control" v-model="cliente.telefone"  disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Celular</label>
                    <input type="text" class="form-control" v-model="cliente.celular"  disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Email</label>
                    <input type="email" class="form-control" v-model="cliente.email" disabled>
                </div>
                
            </div>
    </modal>

    <modal nome="edit" titulo="Editar" tamanho="modal-lg">
        <form v-on:submit.prevent="updateEstoque(edit.id)">                         
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Nome</label>
                    <input type="text" class="form-control"  v-model="edit.nome">
                </div>
            </div>
        
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">RG</label>
                    <input type="text" class="form-control" v-model="edit.rg">
                </div>
                <div class="form-group col-md-4">
                    <label for="">CPF</label>
                    <input type="text" class="form-control" v-model="edit.cpf">
                </div>
                <div class="form-group col-md-3">
                    <label for="">Data Nascimento</label>
                    <input type="date" class="form-control" v-model="edit.data_nascimento">
                </div>
            </div>
    
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Endereco</label>
                    <input type="text" class="form-control" v-model="edit.endereco">
                </div>
                <div class="form-group col-md-3">
                    <label for="">Cidade</label>
                    <input type="text" class="form-control" v-model="edit.cidade">
                </div>
                <div class="form-group col-md-1">
                    <label for="">Estado</label>
                    <input type="text" class="form-control" v-model="edit.estado">
                </div>
                <div class="form-group col-md-3">
                    <label for="">Cep</label>
                    <input type="text" class="form-control" v-model="edit.cep">
                </div>
            </div>
    
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Telefone</label>
                    <input type="text" class="form-control" v-model="edit.telefone">
                </div>
                <div class="form-group col-md-4">
                    <label for="">Celular</label>
                    <input type="text" class="form-control" v-model="edit.celular">
                </div>
                <div class="form-group col-md-4">
                    <label for="">Email</label>
                    <input type="email" class="form-control" v-model="edit.email">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <div v-show="!buttonLoading">
                        <p><i class="fa fa-spin fa-spinner"></i> Loading...</p>
                    </div>
                    <button v-show="buttonLoading" type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Atualizar</button>
                    <button v-show="buttonLoading" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                </div>
            </div>
        </form>

    </modal>
    <modal nome="delete" titulo="Deletar" tamanho="modal-sm">
        <form v-on:submit.prevent="deleteCliente(cliente.id)">
            <div class="row">
                <div class="col-md-12">
                    <h3>Deseja exluir esse cliente ?</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <strong>#ID</strong> {{cliente.id}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>Nome</label> 
                        {{cliente.nome}}
                
                </div>
            
            </div>

            <div class="form-group">
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
            </div>
        </form>
    </modal>
</div>
</template>

<script>
import Noty from 'noty';
import bootbox from 'bootbox';
import { bus } from '../app';
import VcPagination from './Pagination.vue';

    export default {
         components:{
            VcPagination,
        },
        
        data(){
            return{
                items:[],
                pagination:{},
                buttonLoading:true,
                cadCliente:{},
                cliente:{},
                edit:{},
                search:{},
                contador:'',
                loading:true,
            }
        },
        mounted() {
            axios.get('cliente/lista')
            .then(res =>{
                this.items = res.data.data
                this.pagination = res.data
                
            }).finally(()=>{
                this.loading = false
                this.contador = this.items.length
                })
        },
        methods:{
            atualizaTabela(){
                axios.get('cliente/lista')
                    .then(res =>{
                        this.items = res.data.data
                        this.pagination = res.data
                        
                    }).finally(()=>{
                        this.loading = false
                        this.contador = this.items.length
                        })
            },
            navigate(page){
              
              axios.post('cliente/lista?page='+page, this.search)
              .then(res =>{
                  this.pagination = res.data
                  this.items = res.data.data
              })
          },
          searchCliente(){
              axios.post('cliente/lista',this.search)
                .then(res =>{
                    this.pagination = res.data
                    this.items = res.data.data
                })
          },
          addCliente(){
              this.buttonLoading = false;
               axios.post('cliente/cadastrar', this.cadCliente)
               .then(res =>{
                   if(res.data.sucess){
                      new Noty({
                          theme: 'bootstrap-v4',
                          type: 'success', 
                          timeout:4000, 
                          layout:'topRight', 
                          text: '<i class="fas fa-check"></i> <strong>Sucesso!</strong><br>' + res.data.sucess
                          }).show();
                          this.atualizaTabela();
                          this.cadCliente = {};
                  }else if(res.data.erro){
                      new Noty({
                          theme: 'bootstrap-v4',
                          type: 'warning', 
                          timeout:3000, 
                          layout:'topRight', 
                          text: '<i class="fas fa-exclamation-triangle"></i> <strong>Alerta! </strong><br>' + res.data.erro
                          }).show();
                  }
                   
                   
               }).finally(() => {
                   this.buttonLoading = true;
               })
          },
           updateEstoque(id){
              this.buttonLoading = false;
              axios.post('cliente/edit/'+ id, this.edit)
              .then(res=>{
                  
                this.getEdit(id)
                this.searchCliente()

                  new Noty({
                      theme: 'bootstrap-v4',
                      type: 'success', 
                      timeout:3000, 
                      layout:'topRight', 
                      text: '<i class="fas fa-check"></i> <strong>Sucesso! </strong><br>' + res.data
                      }).show();
              }).finally(()=>{
                  this.buttonLoading = true;
              })
          },
          deleteCliente(id){
              axios.delete('cliente/delete/'+ id)
              .then(res=>{
                  new Noty({
                      theme: 'bootstrap-v4',
                      type: 'error', 
                      timeout:3000, 
                      layout:'topRight', 
                      text: '<i class="fas fa-trash-alt"></i> <strong>Deletado! </strong><br>' + res.data
                      }).show();
                  this.searchCliente();
                  $('#delete').modal('hide')
              })
          
        },
          getItem(id){
             
             axios.get('cliente/show/'+ id)
              .then(res =>{
                 this.cliente = res.data
                  
              })
          },
          getEdit(id){
              axios.get('cliente/show/'+ id)
              .then(res =>{
                 this.edit = res.data
                  
              })
          }
        }
    }
</script>
