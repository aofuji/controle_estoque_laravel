<template>
   <div class="row">
        <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="row">
                        
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <form method="get" class="form form-inline" v-bind:action="actionlink">
                                <select class="form-control" name="tipo">
                                    <option value="Entrada">Entrada</option>
                                    <option value="Saida">Saida</option>
                                </select>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Relatorio</button>
                            </form>
                        </div>
                    
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <input type="text" name="tipo" class="form-control" v-model="search"  placeholder="Digite..">
                            
                        </div>
                      </div>
                    </div>
                <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped" >
                                <thead>
                                    <tr>
                                        <th>#</th>   
                                        <th>Tipo</th>   
                                        <th>Quantidade</th>   
                                        <th>Valor Unitario</th>   
                                        <th>Valor Total</th>   
                                        <th>Usuario</th>   
                                        <th>Obs</th>   
                                        <th>Cliente</th>   
                                        
                                         
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="i in $store.state.item" > 
                                        <td>{{i.id}}</td>
                                        <td>{{i.tipo}}</td>
                                        <td>{{i.qtd}}</td>
                                        <td>{{i.valor_unitario}}</td>
                                        <td>{{i.valor_total}}</td>
                                        <td>{{i.usuario}}</td>
                                        <td>{{i.obs}}</td>
                                        <td>{{i.nome}}</td>
                                    </tr>  
                                </tbody>
                            </table>
                    
                            <div class="text-center">
                              <paginate
                                name="items"
                                :list="filtroEntrada"
                                :per="12"
                                >
                                <li v-for="i in paginated('items')">
                                    {{ i.id }}
                                    {{ i.tipo }}
                                </li>
                                </paginate>
                                <paginate-links class="pagination" for="items"></paginate-links>
                            </div>
                        </div>
                    <!-- /.table-responsive -->
                    </div>
                <!-- /.panel-body -->
                </div>
        </div>
    </div>
</template>

<script>
import VuePaginate from 'vue-paginate'
Vue.use(VuePaginate)
    export default {
        props:['actionlink'],
        data(){
            return{
                paginate: ['items'],
                items:[],
                search:''
            }
        },
        mounted() {
            
        },
        computed: {
           filtroEntrada: function (){
              const re = new RegExp(this.search, 'i')
              return this.$store.state.item.filter(res => res.tipo.match(re)
              )}
        },
        methods:{
          
        }
        
    }
</script>
