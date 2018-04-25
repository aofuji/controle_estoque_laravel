<template>
     <div class="col-lg-12">
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
                                    <th>#</th>
                                    <th>Nome Produto</th>
                                    <th>Categoria</th>
                                    <th>Qtd Rg Entrada</th>
                                    <th>Qtd Rg Saida</th>
                                    <th>Qtd Entrada</th>
                                    <th>Qtd Saida</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                        <tbody>
                            <tr v-for="(i, index) in items" :key="index">
                                <td>{{i.id}}</td>
                                <td>{{i.nome_produto}}</td>
                                <td>{{i.categoria}}</td>
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
      props:['titulo', 'url'],
      data(){
        return {
            items:null
        }
      },
      mounted(){
          axios.get(this.url)
          .then(res => (this.items = res.data));
          
          
      }
    }
</script>
