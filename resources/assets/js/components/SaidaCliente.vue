<template>
    <div class="form-group col-md-4">
        <label>Cliente</label>
        <slot></slot>
        
        <input class="form-control" type="text" v-model="search" placeholder="Pesquisar">
        <select multiple class="form-control" name="cliente" required>
           
                <option v-for="(cliente, key) in filtroCliente.reverse()" v-bind:value="cliente.id">RG {{cliente.rg}} | {{cliente.nome}}</option>
           
        </select>
    </div>
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                search:'',
                items:[]
            }
        },
        computed:{
            filtroCliente: function(){
                return this.items.filter((res) =>{
                    return res.nome.toLowerCase().match(this.search)
                })
            }
        },
        mounted() {
            this.items = this.url.slice(0.10)
            
        },
        methods:{
            
        }

    }
</script>
