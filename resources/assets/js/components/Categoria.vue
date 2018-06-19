<template>
    <div class="row">
        <br>
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <a href="#" data-toggle="modal" data-target="#cadCategoria"><i class="fas fa-plus"></i> Adicionar</a>
                    <div class="pull-right ">
                        <div class="form form-inline">

                            <input type="text" list="idOfDatalist"  class="form-control" v-model="search.categoria" placeholder="Digite categoria."> 
                            <datalist id="idOfDatalist" >
                                
                                <option value="" />
                                
                            </datalist>
                            <button type="submit" class="btn btn-primary form-control" v-on:click="searchCategoria()"  ><i class="fa fa-search" ></i></button>
                        </div>
                    </div>
                </div>
                <div class="panel-body no-padding">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Categorias</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <tr v-for="item in items">
                                <td>{{item.id}}</td>
                                <td>{{item.categoria}}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit" v-on:click="getItem(item.id)" ><i class="fas fa-edit" aria-hidden="true"></i></button>  
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
        <modal nome="cadCategoria" titulo="Cadastrar">
            <form v-on:submit.prevent="addCategoria()">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Categoria</label>
                        <input type="text" class="form-control" v-model="item.categoria">
                    </div>
                </div>
                <div class="row">
                        <div class="form-group col-md-12">
                            <div v-show="!buttonLoading">
                                <p><i class="fa fa-spin fa-spinner"></i> Loading...</p>
                            </div>
                            <button v-show="buttonLoading" type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Cadastrar</button>
                            <button v-show="buttonLoading" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                        </div>
                    </div>
            </form>
        </modal>
        <modal nome="edit" titulo="Editar">
            <form v-on:submit.prevent="updateCategoria(categoria.id)">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Categoria</label>
                        <input type="text" class="form-control"  v-model="categoria.categoria">
                    </div>
                </div>
                <div class="form-group">
                    <div v-show="!buttonLoading">
                        <p><i class="fa fa-spin fa-spinner"></i> Loading...</p>
                    </div>
                    <button v-show="buttonLoading" type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Atualizar</button>
                    <button v-show="buttonLoading" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                </div>
            </form>
        </modal>
        <modal nome="delete" titulo="Excluir">
            <form v-on:submit.prevent="deleteCategoria(categoria.id)">
            <div class="row">
                    <div class="col-md-12">
                        <h3>Deseja exluir essa Categoria ?</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <strong>#ID</strong> {{categoria.id}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dl>
                            <dt>Categoria</dt>
                            <dd>{{categoria.categoria}}</dd>
                        </dl>
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
                loading:true,
                contador:'',
                search:{},
                item:{},
                categoria:{}
            }
        },
        mounted() {
            axios.get('categoria/lista')
            .then(res =>{
                this.items = res.data.data;
                this.pagination = res.data;
            }).finally(()=>{
                this.loading = false
                this.contador = this.items.length
                })
        },
        methods:{
            atualizaTabela(){
                axios.get('categoria/lista')
                    .then(res =>{
                        this.items = res.data.data
                        this.pagination = res.data
                        
                    }).finally(()=>{
                        this.loading = false
                        this.contador = this.items.length
                        })
            },
            addCategoria(){
              this.buttonLoading = false;
               axios.post('categoria/form', this.item)
               .then(res =>{
                      new Noty({
                          theme: 'bootstrap-v4',
                          type: 'success', 
                          timeout:4000, 
                          layout:'topRight', 
                          text: '<i class="fas fa-check"></i> <strong>Sucesso!</strong><br>' + res.data
                          }).show();
                          this.atualizaTabela();
                          this.item = {};
               }).finally(() => {
                   this.buttonLoading = true;
               })
            },
            navigate(page){
              
              axios.post('categoria/lista?page='+page, this.search)
              .then(res =>{
                  this.pagination = res.data
                  this.items = res.data.data
              })
          },
            getItem(id){
                axios.get('categoria/show/'+ id)
                .then(res =>{
                    this.categoria = res.data
                })
            },
            searchCategoria(){
              axios.post('categoria/lista',this.search)
                .then(res =>{
                    this.pagination = res.data
                    this.items = res.data.data
                })
            },
            updateCategoria(id){
              this.buttonLoading = false;
              axios.post('categoria/edit/'+ id, this.categoria)
              .then(res=>{
                  
                this.getItem(id)
               this.searchCategoria()

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
            deleteCategoria(id){
                axios.delete('categoria/delete/'+ id)
                .then(res=>{
                    new Noty({
                        theme: 'bootstrap-v4',
                        type: 'error', 
                        timeout:3000, 
                        layout:'topRight', 
                        text: '<i class="fas fa-trash-alt"></i> <strong>Deletado! </strong><br>' + res.data
                        }).show();
                    this.searchCategoria();
                    $('#delete').modal('hide')
                })
            
            },
      }
    }
</script>
