<template>
     <div class="row">
         <br>
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">

                </div>
                <div class="panel-body no-padding">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cargos</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <tr v-for="item in items">
                                <td>{{item.id}}</td>
                                <td>{{item.name}}</td>
                                <td>{{item.label}}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#permission" v-on:click="getPermission(item.id)" ><i class="fas fa-user-lock"></i></button>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        <modal nome="permission" titulo="Permissão">
            <form class="form-inline" v-on:submit.prevent="addPermisison()">
                <select class="custom-select form-control" v-model="permission.permission_id" required>
                    <option value="">Nenhum</option>
                    <option  v-for="item in list_permission" v-bind:value="item.id">{{item.name}}</option>
                </select>
                <input type="hidden" v-model="permission.role_id" >
                <button  class="form-control btn btn-primary"><i class="fas fa-plus"></i> Adicionar</button>
            </form>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Permissão</th>
                        <th>Descrição</th>
                        <th>Ação</th>
                        
                    </tr>
                </thead>
                <tbody> 
                    <tr v-for="item in permissions">
                        <td>{{item.id}}</td>
                        <td>{{item.name}}</td>
                        <td>{{item.label}}</td>
                        <td><button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePermission" v-on:click="getShowPermission(item.id)" ><i class="fas fa-trash-alt" aria-hidden="true"></i></button></td>
                    </tr>
                    <tr v-if="loading">
                        <th scope="row"></th>
                        <th scope="row"><i class="fa fa-spin fa-spinner"></i> Loading...</th>
                        <td colspan="3"></td>
                    </tr>
                    <tr v-if="message">
                        <th scope="row"></th>
                        <th scope="row">Nenhum registro</th>
                        <td colspan="7"></td>
                    </tr>
                </tbody>
            </table>
        </modal>
        <modal nome="deletePermission" titulo="Deletar Permissão" tamanho="modal-sm">
            <form v-on:submit.prevent="deletePermission(item_permission.id)">
            <div class="row">
                    <div class="col-md-12">
                        <h3>Deseja exluir essa Categoria ?</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <strong>#ID</strong> {{item_permission.id}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dl>
                            <dt>Permissão</dt>
                            <dd>{{item_permission.name}}</dd>
                        </dl>
                    </div>

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                </div>
            </form>
        </modal>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                items:[],
                permission:{
                    permission_id:'',
                    role_id:''
                },
                permissions:[ 
                ],
                item_permission:{},
                list_permission:[],
                loading: true,
                message:''
            }
        },
        mounted() {
            axios.get('role/lista')
            .then(res =>{
                this.items = res.data
            })

            axios.get('role/permissions')
            .then(res =>{
                
                this.list_permission = res.data
            });
        },
        methods:{
            getPermission(id){
                this.permission.role_id = id;
                this.message = false;
                axios.get('role/permission/' + id)
                .then(res =>{
                    
                    this.permissions = res.data;
                   
                }).finally(()=>{
                    this.loading = false;
                    if(this.permissions == ''){
                        this.message = true;
                    }
                });
            },
            getShowPermission(id){
                axios.get('role/showpermission/'+ id)
                .then(res =>{
                    
                    this.item_permission = res.data[0]
                })
            },
            addPermisison(){
                axios.post('role/permission', this.permission)
                .then(res =>{
                    new Noty({
                      theme: 'bootstrap-v4',
                      type: 'success', 
                      timeout:3000, 
                      layout:'topRight', 
                      text: '<i class="fas fa-check"></i> <strong>Sucesso! </strong><br>' + res.data
                      }).show();
                    this.getPermission(this.permission.role_id);
                })
            },
            deletePermission(id){
            //pega id da tabela permission_role
                axios.delete('role/permission_delete/'+id)
                .then(res =>{
                    //pega id do role para atualizar tabela
                    this.getPermission(this.permission.role_id)
                    $('#deletePermission').modal('hide')
                    new Noty({
                      theme: 'bootstrap-v4',
                      type: 'error', 
                      timeout:3000, 
                      layout:'topRight', 
                      text: '<i class="fas fa-trash-alt"></i> <strong>Deletado! </strong><br>' + res.data
                      }).show();
                })
            }
        }
    }
</script>
