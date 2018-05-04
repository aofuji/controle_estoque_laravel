<template>
     <div >
  
       <v-client-table :data="tableData" :columns="columns" ></v-client-table>
       
        </div>
</template>

<script>
import {ServerTable, ClientTable, Event} from 'vue-tables-2';
Vue.use(ClientTable);

    export default {
      props:['url'],
     
      data(){
        return {
            items:[],
            columns: ['id', 'nome_produto', 'created_at','updated_at', 'valor', 'qtd_saida'],
            tableData: [],
            options: {
               headings: {
                nome_produto: 'Nome',
                created_at: 'Criado em',
                updated_at: 'Atualizado',
                valor: 'Valor', 
                qtd_saida: 'Quantidade'
            },
        }
        }
      },
      mounted(){
          axios.get('saida/lista')
          .then(req => {
              this.tableData = req.data.data
              this.items = req.data.data
              })

      }
    }
</script>
