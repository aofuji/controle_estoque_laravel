<template>
 
    <div class="row">
        
        <br>
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <a href="#" v-if="!gate_add" data-toggle="modal" v-on:click="clearForm" data-target="#cadastro" ><i class="fa fa-plus" aria-hidden="true"></i> Adicionar</a>
                    &nbsp;
                    <a href="#" v-if="!gate_import" data-toggle="modal" data-target="#import"  ><i class="fas fa-upload"></i> Importar</a>
                    
                    
                    <div class="pull-right ">
                        <div class="form form-inline">

                            <select class="custom-select form-control" v-model="search.categoria">
                                <option value="">Selecione categoria</option>
                                <option v-for="categoria in categorias" v-bind:value="categoria.id">{{categoria.categoria}}</option>
                            </select>
                            <input type="text" v-model="search.codigo_produto" class="form-control" placeholder="Digite codigo produto">
                            <input type="text" list="idOfDatalist"  class="form-control" v-model="search.nome_produto" placeholder="Digite nome do produto"> 

                            <datalist id="idOfDatalist">
                                <option v-for="produto in listaProdutos" v-bind:value="produto.nome_produto">{{produto.nome_produto}}</option>
                            </datalist>

                            <input type="number" v-model="search.qtd_estoque" class="form-control" placeholder="Digite a quantidade">
                            <button type="submit" class="btn btn-primary form-control" v-on:click="searchEstoque"><i class="fa fa-search" ></i></button>
                        </div>
                    </div>
                </div>
                <div class="panel-body no-padding">
                    <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cod. Produto</th>
                                    <th>Nome Produto</th>
                                    <th>Categoria</th>
                                    <th>Quantidade</th>
                                    <th>Preço Custo</th>
                                    <th>Preço Venda</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        <tbody>
                            <tr v-for="item in items">
                                <td v-bind:class="item.qtd_estoque == 0? 'bg-row':''">{{item.id}}</td>
                                <td v-bind:class="item.qtd_estoque == 0? 'bg-row':''"><a href="#" data-toggle="modal" v-on:click="getHistorico(item.id)" data-target="#historico">{{item.codigo_produto}}</a></td>
                                <td v-bind:class="item.qtd_estoque == 0? 'bg-row':''">{{item.nome_produto}}</td>
                                <td v-bind:class="item.qtd_estoque == 0? 'bg-row':''">{{item.categoria}}</td>
                                <td v-bind:class="item.qtd_estoque == 0? 'bg-row':''">{{item.qtd_estoque}}</td>
                                <td v-bind:class="item.qtd_estoque == 0? 'bg-row':''">R$ {{formatPrice(item.preco_custo)}}</td>
                                <td v-bind:class="item.qtd_estoque == 0? 'bg-row':''">R$ {{formatPrice(item.preco_venda)}}</td>
                                <td v-bind:class="item.qtd_estoque == 0? 'bg-row':''">{{item.created_at | moment("DD/MM/YYYY")}}</td>
                                <td v-bind:class="item.qtd_estoque == 0? 'bg-row':''">
                                   <span v-tooltip="'Entrada'" v-if="!gate_entrada">
                                        <button  class="btn btn-success btn-sm" data-toggle="modal" data-target="#entrada" v-on:click="getItem(item.id)"><i class="fas fa-sign-in-alt"></i></button>
                                    </span>
                                    <span v-tooltip="'Saida'">
                                        <button v-show="item.qtd_estoque != 0" class="btn btn-info btn-sm" data-toggle="modal" data-target="#saida"  v-on:click="getItem(item.id)"><i class="fas fa-sign-out-alt"></i></button>
                                    </span>
                                    <span v-tooltip="'Editar'" v-if="!gate_edit">
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit" v-on:click="getEdit(item.id)" ><i class="fas fa-edit" aria-hidden="true"></i></button>  
                                    </span>
                                    <span v-tooltip="'Deletar'" v-if="!gate_delete">
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete" v-on:click="getItem(item.id)" ><i class="fas fa-trash-alt" aria-hidden="true"></i></button>    
                                    </span>
                                </td>
                            </tr>
                        <tr v-if="loading">
                            <th scope="row"></th>
                            <th scope="row">Loading...</th>
                            <td colspan="6"></td>
                        </tr>
                        <tr v-if="contador == 0">
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
    <modal nome="cadastro" titulo="Cadastrar" tamanho="modal-lg">
         
        <form v-on:submit.prevent="addItem" class="form">
            <div class="row">
                    <div class="form-group col-md-2">
                        <label for="inputEmail4">Cod. Produto</label>
                        <input type="text" class="form-control" v-model="itemCad.codigo_produto" placeholder="Digite codigo...." required>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="inputEmail4">Nome Produto</label>
                        <input type="text" class="form-control" v-model="itemCad.nome_produto" placeholder="Digite Nome do Produto...." required>
                    </div>
                    <div class="form-group col-md-5">
                    <label for="inputState">Categoria</label>
                    <select  class="form-control" v-model="itemCad.categoria_id" required>  
                        <option value="" selected>Selecione Categoria</option>     
                        <option v-for="categoria in categorias" v-bind:value="categoria.id">{{categoria.categoria}}</option>    
                    </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Quantidade</label>
                        <input type="text" class="form-control" v-model="itemCad.qtd_estoque" placeholder="Digite quantidade...." required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Preço Custo</label>

                        <div class="form-group input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" v-model="itemCad.preco_custo" v-money="money" class="form-control" placeholder="Digite preço custo...." required>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Preço Venda</label>

                        <div class="form-group input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" v-model="itemCad.preco_venda" v-money="money" class="form-control" placeholder="Digite preço venda...." required>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <div v-show="!buttonLoading">
                            <p><i class="fa fa-spin fa-spinner"></i> Loading...</p>
                        </div>
                            <button v-show="buttonLoading"  class="btn btn-success"><i class="fas fa-plus"></i> Cadastrar</button>
                        <button v-show="buttonLoading" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                       

                    </div>
            </div>
        </form>
    </modal>

    <modal nome="historico" titulo="Historico" tamanho="modal-lg">
        <tabelahistorico></tabelahistorico>
    </modal>

    <modal nome="entrada" titulo="Entrada">
       
        <form v-on:submit.prevent="addEntrada(produto.id)">
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Codigo do Produto</label> 
                <input type="text" class="form-control" v-bind:value="produto.codigo_produto" disabled>
                </div>
                
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label>Nome</label>
                    <input type="text" class="form-control" v-bind:value="produto.nome_produto" disabled>
                    
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Quantidade</label>
                    <input type="text" class="form-control" v-bind:value="produto.qtd_estoque" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label>Preço Custo</label>
                    <div class="form-group input-group">
                        <span class="input-group-addon">R$</span>
                        <input type="text" v-money="money" class="form-control" v-bind:value="produto.preco_custo" disabled>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label>Preço Venda</label>
                    <div class="form-group input-group">
                        <span class="input-group-addon">R$</span>
                        <input type="text" v-money="money" class="form-control" v-bind:value="produto.preco_venda" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label>Entrada</label>
                    <input type="number" min="1"  class="form-control" v-model="entrada.qtd_entrada" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <div v-show="!buttonLoading">
                            <p><i class="fa fa-spin fa-spinner"></i> Loading...</p>
                        </div>
                    <button v-show="buttonLoading" class="btn btn-success "><i class="fas fa-plus"></i> Cadastrar</button>
                    <button v-show="buttonLoading" class="btn btn-danger " data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                </div>
            </div>
        </form>
    </modal>

    <modal nome="saida" titulo="Saida" >
      <form v-on:submit.prevent="addSaida(produto.id)">      
        <div class="row">
            <div class="form-group col-md-12">
                <label>Codigo do Produto</label>
                <input type="text" class="form-control" v-bind:value="produto.codigo_produto" disabled>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label>Nome</label>
                <input type="text" class="form-control" v-bind:value="produto.nome_produto" disabled>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label>Quantidade</label>
                <input type="text" class="form-control" v-bind:value="produto.qtd_estoque" disabled>
            </div>
            <div class="form-group col-md-4">
                <label>Preço Custo</label>
                <div class="form-group input-group">
                    <span class="input-group-addon">R$</span>
                    <input type="text" v-money="money" class="form-control" v-bind:value="produto.preco_custo" disabled>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label>Preço Venda</label>
                <div class="form-group input-group">
                    <span class="input-group-addon">R$</span>
                    <input type="text" v-money="money" class="form-control" v-bind:value="produto.preco_venda" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class=" col-md-8">
                <label>Cliente</label>
                 <div class="pull-right">
                    <a href="" data-toggle="modal"  data-target="#cliente"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar</a>
                </div>
                
                <select class="selectpicker form-control" v-model="saida.cliente" data-live-search="true" required>
                    <option value="" selected>Selecione Cliente</option>
                    <option v-for="cliente in clientes" v-bind:value="cliente.id">{{cliente.nome}} | {{cliente.rg}}</option>
                </select>
            </div>

            <div class="form-group col-md-4">
                <label>Saida</label>
            <input type="number" min="1" v-bind:max="produto.qtd_estoque" class="form-control" v-model="saida.qtd_saida" required>
            </div>
            
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label>Total</label>
                <div class="form-group input-group">
                    <span class="input-group-addon">R$</span>
                    <input type="number" class="form-control" v-bind:value="(saida.qtd_saida * produto.preco_venda) " disabled>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div v-show="!buttonLoading">
                    <p><i class="fa fa-spin fa-spinner"></i> Loading...</p>
                </div>
                <button v-show="buttonLoading" class="btn btn-success"><i class="fas fa-plus"></i> Cadastrar</button>
                <button v-show="buttonLoading" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
            </div>
        </div>
     </form>
    </modal>

    <modal nome="edit" titulo="Editar" tamanho="modal-lg">
        <form v-on:submit.prevent="updateEstoque(edit.id)">
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="inputEmail4">Cod. Produto</label>
                    <input type="text" class="form-control" v-model="edit.codigo_produto" required>
                </div>
                <div class="form-group col-md-5">
                    <label for="inputEmail4">Nome Produto</label>
                    <input type="text" class="form-control"  v-model="edit.nome_produto" required>   
                </div>
                <div class="form-group col-md-5">
                    <label for="">Categoria</label>
                    <select class="custom-select form-control" v-model="edit.categoria_id">
                        <option v-for="categoria in categorias" v-bind:value="categoria.id">{{categoria.categoria}}</option>
                    </select>
                </div>
            </div>
        
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Quantidade</label>
                    <input type="text" class="form-control"  v-model="edit.qtd_estoque" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Preço custo</label>
                    <div class="form-group input-group">
                            <span class="input-group-addon">R$</span>
                            <input type="text" name="valor" v-money="money" v-model="edit.preco_custo" class="form-control" placeholder="Digite valor....">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Preço Venda</label>
                    <div class="form-group input-group">
                            <span class="input-group-addon">R$</span>
                            <input type="text" name="valor" v-money="money" v-model="edit.preco_venda" class="form-control" placeholder="Digite valor....">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div v-show="!buttonLoading">
                        <p><i class="fa fa-spin fa-spinner"></i> Loading...</p>
                    </div>
                    <button v-show="buttonLoading" type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Atualizar</button>
                    <button v-show="buttonLoading" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                </div>
            </div>    
        </form>          
    </modal>

    <modal nome="cliente" titulo="Cliente" tamanho="modal-lg">
        
        
        <form v-on:submit.prevent="addCliente">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Nome</label>
                    <input type="text" class="form-control" v-model="cliente.nome" placeholder="Digite Nome Completo" required>
                </div>
            </div>
        
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">RG</label>
                    <input type="text" class="form-control" v-model="cliente.rg" maxlength="9" placeholder="Digite RG sem ponto sem traço." required>
                </div>
                <div class="form-group col-md-4">
                    <label for="">CPF</label>
                    <input type="text" class="form-control" v-model="cliente.cpf" maxlength="11" placeholder="Digite CPF sem ponto sem traco" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Data Nascimento</label>
                    <input type="date" class="form-control" v-model="cliente.data_nascimento" placeholder="Digite Data Nascimento" required>
                </div>
            </div>
    
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Endereco</label>
                    <input type="text" class="form-control" v-model="cliente.endereco" placeholder="Digite Endereço" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Cidade</label>
                    <input type="text" class="form-control" v-model="cliente.cidade" placeholder="Digite Cidade" required>
                </div>
                <div class="form-group col-md-1">
                    <label for="">Estado</label>
                    <input type="text" class="form-control" maxlength="2" v-model="cliente.estado" placeholder="UF" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Cep</label>
                    <input type="text" class="form-control" v-model="cliente.cep" placeholder="Digite CEP">
                </div>
            </div>
    
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Telefone</label>
                    <input type="text" class="form-control" maxlength="11" v-model="cliente.telefone" placeholder="Digite Telefone" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Celular</label>
                    <input type="text" class="form-control" maxlength="12" v-model="cliente.celular" placeholder="Digite Celular" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Email</label>
                    <input type="email" class="form-control" v-model="cliente.email" placeholder="Digite Email" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Cadastrar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                </div>
            </div>
        </form>
    </modal>

    <modal nome="delete" titulo="Deletar" tamanho="modal-sm">
        <form v-on:submit.prevent="deleteEstoque(produto.id)">
            <div class="row">
                <div class="col-md-12">
                    <h3>Deseja exluir esse produto ?</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <strong>#ID</strong> {{produto.id}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>Nome</label> 
                        {{produto.nome_produto}}<br>
                        <label>Cod. Produto</label> 
                        {{produto.codigo_produto}}
                
                </div>
            
            </div>

            <div class="form-group">
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
            </div>
        </form>
    </modal>
    <modal nome="import" titulo="Importar">
        <form v-on:submit.prevent="onUpload">
            <div class="row">
                <div class="form-group col-md-12">
                        <label for="">Importe arquivo com extensão .xlsx</label>
                        <input type="file" class="form-control" @change="onFileChanged" required>
                </div>
            </div>
            <div class="form-group">
                <div v-show="!buttonLoading">
                    <p><i class="fa fa-spin fa-spinner"></i> Loading...</p>
                </div>
                <button v-show="buttonLoading" class="btn btn-success" ><i class="fas fa-upload" ></i> Importar</button>
                <button v-show="buttonLoading" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
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
import {VMoney} from 'v-money';



    export default {
        components:{
            VcPagination
        },
        props:['gate_entrada','gate_edit','gate_delete','gate_add','gate_import'],
        data(){
            return{
                buttonLoading:true,
                selectedFile: null,
                contador:0,
                items:[],
                categorias:[],
                clientes:[],
                listaProdutos:[],
                loading:true,
                pagination:{},
                search:{
                    categoria:''
                },
                searchCliente:'',
                itemCad:{
                    categoria_id:''
                },
                produto:{},
                entrada:{},
                saida:{
                    cliente:'',
                    qtd_saida:0
                    
                },
                cliente:{},
                edit:{
                    codigo_produto:'',
                    nome_produto:'',
                    categoria_id:'',
                    qtd_estoque:'',
                    valor:''
                },
                money: {
                    decimal: ',',
                    thousands: '.',
                    precision: 2,
                    masked: false
                },

            }
        },
        computed:{
            
        },  
        mounted() {
            
            
            axios.post('estoque/lista')
            .then(res =>{
                this.pagination = res.data
                this.items = res.data.data
            })
            .finally(() => {
                this.loading = false
                this.contador = this.items.length
               
                })
            
            axios.get('estoque/listacategoria')
                .then(res =>{
                    this.categorias = res.data
                })

            axios.get('estoque/cliente')
                .then(res=>{
                    this.clientes = res.data
                })
            
            axios.get('estoque/listaproduto')
                .then(res =>{
                    this.listaProdutos = res.data;
                })
        },
        methods:{
            
            onFileChanged (event) {
                this.selectedFile = event.target.files[0]
                
            },
            onUpload() {
                this.buttonLoading = false;
                const formData = new FormData()
                formData.append('file', this.selectedFile, this.selectedFile.name)
                axios.post('estoque/import', formData)
                .then(res=>{
                    
                    this.searchEstoque();

                   if(res.data.sucess){
                       new Noty({
                           theme: 'bootstrap-v4',
                           type: 'success', 
                           timeout:3000, 
                           layout:'topRight', 
                           text: '<i class="fas fa-check"></i> <strong>Sucesso!</strong><br>' + res.data.sucess
                           }).show();
                   } else if(res.data.erro){
                       new Noty({
                           theme: 'bootstrap-v4',
                           type: 'warning', 
                           timeout:3000, 
                           layout:'topRight', 
                           text: '<i class="fas fa-exclamation-triangle"></i> <strong>Alerta!</strong><br>' + res.data.erro
                           }).show();
                   }

                }).finally(() =>{
                    this.buttonLoading = true;
                })
            },
            Atualiza(){
                axios.post('estoque/lista')
                    .then(res =>{
                        
                        this.pagination = res.data
                        this.items = res.data.data
                    })
                    .finally(() => this.loading = false)
                    },
            AtualizaCliente(){
                axios.get('estoque/cliente')
                .then(res=>{
                    
                    this.clientes = res.data
                })
                
                },
            clearForm(){
                this.itemCad = {
                    categoria_id:''
                }
                
            },
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            navigate(page){
              
              axios.post('estoque/lista?page='+page, this.search)
              .then(res =>{
                  this.pagination = res.data
                  this.items = res.data.data
              })
          },
          searchEstoque(){
              axios.post('estoque/lista',this.search)
                .then(res =>{
                    this.pagination = res.data
                    this.items = res.data.data
                })
          },
          addItem(){
              this.buttonLoading = false;
               axios.post('estoque/cadastrar', this.itemCad)
               .then(res =>{
                   new Noty({
                       theme: 'bootstrap-v4',
                       type: 'success', timeout:3000, 
                       layout:'topRight', 
                       text: '<i class="fas fa-check"></i><strong>Sucesso!</strong><br>' + res.data
                       }).show();
                   this.Atualiza();
                   this.clearForm();
               }).finally(() => {
                   this.buttonLoading = true;
               })
          },
          getHistorico(id){
               bus.$emit('id', id)
               axios.get('estoque/history/'+id)
               .then(res =>{
                   this.$store.commit('setItem',res.data)
               })
              
          },
          getItem(id){
             
             axios.get('estoque/show/'+ id)
              .then(res =>{
                 
                 this.produto = res.data
                  
              })
          },
          getEdit(id){
            
             axios.get('estoque/show/'+ id)
              .then(res =>{
                this.edit = res.data
                  
              })
          },
          addEntrada(id){
              this.buttonLoading = false;
              axios.post('estoque/entrada/'+id, this.entrada)
              .then(res=>{
                  if(res.data.perm){
                       new Noty({
                      theme: 'bootstrap-v4',
                      type: 'warning', 
                      timeout:3000, 
                      layout:'topRight', 
                      text: '<i class="fas fa-exclamation-triangle"></i> <strong>Alerta! </strong><br>' + res.data.perm
                      }).show();
                  }else if(res.data.sucess){
                       this.entrada.qtd_entrada = '';
                        this.getItem(id)
                        this.searchEstoque();
                        new Noty({
                            theme: 'bootstrap-v4',
                            type: 'success', 
                            timeout:3000, 
                            layout:'topRight', 
                            text: '<i class="fas fa-check"></i> <strong>Sucesso!</strong><br>' + res.data
                            }).show();
                  }else if(res.data.error){
                       new Noty({
                          theme: 'bootstrap-v4',
                          type: 'warning', 
                          timeout:3000, 
                          layout:'topRight', 
                          text: '<i class="fas fa-exclamation-triangle"></i> <strong>Alerta! </strong><br>' + res.data.error
                          }).show();
                  }
                 
              })
              .finally(()=>this.buttonLoading = true)
          },
          addSaida(id){
              this.buttonLoading = false;
              axios.post('estoque/saida/'+id, this.saida)
              .then(res=>{
                  
                  
                  this.saida.qtd_saida = '';
                  this.getItem(id)
                  this.searchEstoque();
                  new Noty({
                      theme: 'bootstrap-v4',
                      type: 'success', 
                      timeout:3000, 
                      layout:'topRight', 
                      text: '<i class="fas fa-check"></i> <strong>Sucesso!</strong><br>' + res.data
                      }).show();
              }).finally(() => this.buttonLoading = true)
          },
          addCliente(){
              axios.post('cliente/cadastrar', this.cliente )
              .then(res=>{
                  if(res.data.sucess){
                      
                      this.AtualizaCliente();
                      
                      new Noty({
                          theme: 'bootstrap-v4',
                          type: 'success', 
                          timeout:3000, 
                          layout:'topRight', 
                          text: '<i class="fas fa-check"></i> <strong>Sucesso!</strong><br>' + res.data.sucess
                          }).show();
                          
                          
                  }else if(res.data.erro){
                      new Noty({
                          theme: 'bootstrap-v4',
                          type: 'warning', 
                          timeout:3000, 
                          layout:'topRight', 
                          text: '<i class="fas fa-exclamation-triangle"></i> <strong>Alerta! </strong><br>' + res.data.erro
                          }).show();
                  }
      
              })
          },
          updateEstoque(id){
              this.buttonLoading = false;
              axios.post('estoque/edit/'+ id, this.edit)
              .then(res=>{
                  
                if(res.data.perm){
                       new Noty({
                      theme: 'bootstrap-v4',
                      type: 'warning', 
                      timeout:3000, 
                      layout:'topRight', 
                      text: '<i class="fas fa-exclamation-triangle"></i> <strong>Alerta! </strong><br>' + res.data.perm
                      }).show();
                  }else if(res.data.sucess){
                       
                        this.getItem(id)
                        this.searchEstoque();
                        new Noty({
                            theme: 'bootstrap-v4',
                            type: 'success', 
                            timeout:3000, 
                            layout:'topRight', 
                            text: '<i class="fas fa-check"></i> <strong>Sucesso!</strong><br>' + res.data
                            }).show();
                  }else if(res.data.error){
                       new Noty({
                          theme: 'bootstrap-v4',
                          type: 'warning', 
                          timeout:3000, 
                          layout:'topRight', 
                          text: '<i class="fas fa-exclamation-triangle"></i> <strong>Alerta! </strong><br>' + res.data.error
                          }).show();
                  }
              }).finally(()=>{
                  this.buttonLoading = true;
              })
          },
          deleteEstoque(id){
              axios.delete('estoque/delete/'+ id)
              .then(res=>{

                  if(res.data.perm){
                       new Noty({
                      theme: 'bootstrap-v4',
                      type: 'warning', 
                      timeout:3000, 
                      layout:'topRight', 
                      text: '<i class="fas fa-exclamation-triangle"></i> <strong>Alerta! </strong><br>' + res.data.perm
                      }).show();
                      $('#delete').modal('hide')
                  }else if(res.data.sucess){
                        this.searchEstoque();
                        new Noty({
                            theme: 'bootstrap-v4',
                            type: 'error', 
                            timeout:3000, 
                            layout:'topRight', 
                            text: '<i class="fas fa-trash-alt"></i> <strong>Deletado! </strong><br>' + res.data
                            }).show();
                            $('#delete').modal('hide')
                  }else if(res.data.error){
                       new Noty({
                          theme: 'bootstrap-v4',
                          type: 'warning', 
                          timeout:3000, 
                          layout:'topRight', 
                          text: '<i class="fas fa-exclamation-triangle"></i> <strong>Alerta! </strong><br>' + res.data.error
                          }).show();
                  }
              })
          }
        },
        directives: {money: VMoney}
    }
</script>
