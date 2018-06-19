<template>
    <div class="row">
        <br>
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="pull-right form-inline">   
                        <select class="form-control" v-model="search.tipo">
                            <option value="">Selecione</option>
                            <option value="Entrada">Entrada</option>
                            <option value="Saida">Saida</option>
                        </select>
                        <input type="text" v-model="search.nome_produto" class="form-control" placeholder="Digite nome do produto">
                        <input type="text" v-model="search.nome_cliente" name="nome_cliente" class="form-control" placeholder="Digite o nome cliente">
                        <button class="btn btn-primary " v-on:click="searchHistorico()"><i class="fa fa-search" ></i></button>
                    </div>
                </div>

                <div class="panel-body no-padding">
                    
                    <table class="table table-striped" >
                            <thead>
                                <tr>
                                    <th>#</th>   
                                    <th>Tipo</th>   
                                    <th>Qtd Ent./Sai.</th>   
                                    <th>Valor Unitario</th>   
                                    <th>Valor Total</th>   
                                    <th>Usuario</th>   
                                    <th>Obs</th>   
                                    <th>Cliente</th>   
                                    <th>Estoque</th>   
                                    <th>Data Criação</th>   
                                        
                                </tr>
                            </thead>
                            <tbody>
                            
                                <tr v-for="item in items"> 
                                    <td>{{item.id}}</td>
                                    <td>{{item.tipo}}</td>
                                    <td>{{item.qtd}}</td>
                                    <td>R$ {{formatPrice(item.valor_unitario)}}</td>
                                    <td>R$ {{formatPrice(item.valor_total)}}</td>
                                    <td>{{item.usuario}}</td>
                                    <td>{{item.obs}}</td>
                                    <td>{{item.nome}}</td>
                                    <td>{{item.nome_produto}}</td>
                                    <td>{{item.created_at | moment("DD/MM/YYYY")}}</td>
                                </tr>  
                                <tr v-if="loading">
                                    <th scope="row"></th>
                                    <th scope="row">Loading...</th>
                                    <td colspan="6"></td>
                                </tr>
                                <tr v-show="contador == 0">
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
    </div>
</template>

<script>
import VcPagination from './Pagination.vue';

    export default {
        components:{
            VcPagination,
        },
        data(){
            return{
                items:[],
                pagination:{},
                search:{
                    tipo:''
                },
                loading:true,
                contador:'',
            }
        },
        mounted() {
            axios.get('historico/lista')
            .then(res =>{
                this.items = res.data.data;
                this.pagination = res.data;
            }).finally(()=>{
                this.loading = false
                this.contador = this.items.length
                })
        },
        methods:{
             formatPrice(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            navigate(page){
              
              axios.post('historico/lista?page='+page, this.search)
              .then(res =>{
                  this.pagination = res.data
                  this.items = res.data.data
              })
          },
           searchHistorico(){
              axios.post('historico/lista',this.search)
                .then(res =>{
                    this.pagination = res.data
                    this.items = res.data.data
                })
            },
        }
    }
</script>
