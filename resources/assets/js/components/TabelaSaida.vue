<template>
     <div v-bind:class="csstamanho || 'col-lg-12'">
                <div class="panel panel-default">
                    <div class="panel-heading">
                         {{titulo}}
                         
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
                                <td>{{i.id}}</td>
                                <td>{{i.nome_produto}}</td>
                                <td>{{i.valor}}</td>    
                                <td>{{i.qtd_saida}}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a class="btn btn-danger btn-sm" href="" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
        </div>
</template>

<script>
    export default {
      props:['titulo', 'url', 'csstamanho','titulotabela'],
      data(){
        return {
            items:null,
            loading:true
        }
      },
      mounted(){
          
    
          axios.get(this.url)
          .then(res => (this.items = res.data))
          .finally(() => this.loading = false)
      }
    }
</script>
