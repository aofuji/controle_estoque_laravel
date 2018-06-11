<template>
<div class="row">
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
        
        <vc-pagination :source="pagination" @navigate="navigate"></vc-pagination>
    </div>
</div>
</template>

<script>

import VcPagination from './Pagination.vue'
    export default {
        components:{
            VcPagination
        },
        data(){
            return{
                items:[],
                pagination:{},
                search:''
            }
        },
        mounted() {
          
        },
        computed: {
            atualiza: function(){
                this.pagination = this.$store.state.item
                return this.items = this.$store.state.item.data
            }
        },
        methods:{
          navigate(page){
              axios.get('http://localhost:8000/estoque/history/23?page='+page)
              .then(res =>{
                  this.$store.commit('setItem',res.data)
              })
          }
        }
        
    }
</script>
