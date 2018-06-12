<template>
<div class="row">
        <div class="form form-inline pull-right" style="padding:10px;">
            <input type="text" class="form-control" v-model="search.tipo" placeholder="Digite">
            <button class="btn btn-primary" v-on:click="searchEstoque">Procurar</button>
            
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
                    <tr v-for="item in atualiza">  
                        <td>{{item.id}}</td>
                        <td>{{item.tipo}}</td>
                        <td>{{item.qtd}}</td>
                        <td>{{item.valor_unitario}}</td>
                        <td>{{item.valor_total}}</td>
                        <td>{{item.usuario}}</td>
                        <td>{{item.obs}}</td>
                        <td>{{item.nome}}</td>
                        <td>{{item.created_at}}</td>
                    </tr>
                </tbody>
            </table>
        <div class="text-center">
            
            <vc-pagination  :source="pagination" @navigate="navigate"></vc-pagination>
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
                search:{},
                idestoque:'',

            }
        },
        mounted() {
          bus.$on('id', (data)=>{
              this.idestoque = data;
          })
        },
        computed: {
            atualiza: function(){
                
               this.pagination = this.$store.state.item
                return this.items = this.$store.state.item.data
            }
        },
        methods:{
          navigate(page){
              
              axios.post('estoque/history/'+ this.idestoque +'?page='+page, this.search)
              .then(res =>{
                  this.$store.commit('setItem',res.data)
              })
          },
          searchEstoque(){
              
              axios.post('estoque/history/'+ this.idestoque, this.search)
              .then(res =>{
                  
                  this.$store.commit('setItem',res.data)
              })
          },
          
        }
        
    }
</script>
