<template>
<div class="row">
    <div class="col-md-12">
        <div class="form form-inline pull-right" style="padding:10px;">
            <input type="text" class="form-control" v-model="search_history.nome_cliente" placeholder="Digite cliente">
            <select class="form-control" v-model="search_history.tipo">
                <option value="" >Todos</option>
                <option value="Entrada">Entrada</option>
                <option value="Saida">Saida</option>
            </select>
            <button class="btn btn-primary" v-on:click="searchHistorico"><i class="fa fa-search" ></i></button>
            
        </div>
    
        <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>#</th>   
                        <th>Tipo</th>   
                        <th>Qtd</th>   
                        <th>Valor Uni.</th>   
                        <th>Valor Total</th>   
                        <th>Usuario</th>   
                        <th>Obs</th>   
                        <th>Cliente</th>        
                        <th>Data</th>        
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in listaHistorico">  
                        <td>{{item.id}}</td>
                        <td>{{item.tipo}}</td>
                        <td>{{item.qtd}}</td>
                        <td>R$ {{formatPrice(item.valor_unitario)}}</td>
                        <td>R$ {{formatPrice(item.valor_total)}}</td>
                        <td>{{item.usuario}}</td>
                        <td>{{item.obs}}</td>
                        <td>{{item.nome}}</td>
                        <td>{{item.created_at | moment("DD/MM/YYYY")}}</td>
                    </tr>
                </tbody>
            </table>
        <div class="text-center">
            
            <vc-pagination  :source="pagination" @navigate="navigate"></vc-pagination>
        </div>
    </div>
</div>
</template>

<script>

import VcPagination from './Pagination.vue';
import { bus } from '../app';
    export default {
        components:{
            VcPagination
        },
        data(){
            return{
                items:[],
                pagination:{},
                search_history:{},
                id_estoque:'',

            }
        },
        mounted() {
          bus.$on('id', (data)=>{
              this.id_estoque = data;
          })
       
        },
        computed: {
            listaHistorico: function(){
               this.pagination = this.$store.state.item
              return this.items = this.$store.state.item.data
            
            }
        },
        methods:{
          navigate(page){
              
              axios.post('estoque/history/'+ this.id_estoque +'?page='+page, this.search_history)
              .then(res =>{
                  this.$store.commit('setItem',res.data)
              })
          },
          searchHistorico(){
              
              axios.post('estoque/history/'+ this.id_estoque, this.search_history)
              .then(res =>{
                 
                  this.$store.commit('setItem',res.data)
              })
          },
          formatPrice(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
        }
        
    }
</script>
