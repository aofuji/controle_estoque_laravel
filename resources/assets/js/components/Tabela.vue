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
                                <td>{{i.categoria}}</td>
                                <td>{{i.status == 1? 'Ativo':'Inativo'}}</td>
                                <td>{{i.qtd_registro_entrada}}</td>
                                <td>{{i.qtd_registro_saida}}</td>
                                <td>{{i.quantidade_entrada}}</td>
                                <td>{{i.quantidade_saida}}</td>
                                <td>{{i.total}}</td>
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
