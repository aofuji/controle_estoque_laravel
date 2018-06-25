<template>
    <div class="row">
        <br>
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <a href="#" data-toggle="modal" data-target="#cadCategoria"><i class="fas fa-plus"></i> Adicionar</a>
                    
                </div>
                <div class="panel-body no-padding">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Permissões</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <tr v-for="item in lista">
                                <td>{{item.id}}</td>
                                <td>{{item.name}}</td>
                                <td>{{item.label}}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit" v-on:click="getItem(item.id)" ><i class="fas fa-edit" aria-hidden="true"></i></button>  
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete" v-on:click="getItem(item.id)" ><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['lista'],
        mounted() {
            console.log(this.lista)
            console.log('Component mounted.')
        }
    }
</script>
