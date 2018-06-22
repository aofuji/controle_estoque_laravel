<template>
   <div class="row">
       <br>
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <a href="#" data-toggle="modal" data-target="#cadUser" ><i class="fa fa-plus" aria-hidden="true"></i> Adicionar</a>
                </div>
                <div class="panel-body no-padding">
                        <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Criado em</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                            <tbody>
            
                           
                                <tr v-for="item in items">
                                    <td>{{item.id}}</td>
                                    <td>{{item.name}}</td>
                                    <td>{{item.email}}</td>
                                    <td>{{item.created_at}}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit" v-on:click="getItem(item.id)" ><i class="fas fa-edit" aria-hidden="true"></i></button>  
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete" v-on:click="getItem(item.id)" ><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                           
                                 <tr v-if="loading">
                                    <th scope="row"></th>
                                    <th scope="row">Loading...</th>
                                    <td colspan="6"></td>
                                </tr>
                                <tr v-if="!contador">
                                    <th scope="row"></th>
                                    <th scope="row">Nenhum registro</th>
                                    <td colspan="7"></td>
                                </tr>
                           
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
         <modal nome="cadUser" titulo="Cadastrar">
            <form v-on:submit.prevent="addUser()">
                <div class="row">
                    <div class="col-md-12">
                        <label>Nome</label>
                        <input type="text" class="form-control" v-model="user.name" required>
                        <label>email</label>
                        <input type="email" class="form-control" v-model="user.email" required>
                        <label>Senha</label>
                        <input type="password" class="form-control" v-model="user.password" required>
                        
                        
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class=" col-md-12">
                        <div v-show="!buttonLoading">
                            <p><i class="fa fa-spin fa-spinner"></i> Loading...</p>
                        </div>
                        <button v-show="buttonLoading" type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Cadastrar</button>
                        <button v-show="buttonLoading" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                    </div>
                </div>
            </form>
        </modal>
        <modal nome="edit" titulo="Editar">
            <form v-on:submit.prevent="updateUser(item.id)">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Nome</label>
                        <input type="text" class="form-control"  v-model="item.name">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Email</label>
                        <input type="text" class="form-control"  v-model="item.email">
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="">Senha</label>
                        <input type="password" class="form-control" v-model="item.password" placeholder="Nova senha">
                    </div>
                </div>
                <div class="form-group">
                    <div v-show="!buttonLoading">
                        <p><i class="fa fa-spin fa-spinner"></i> Loading...</p>
                    </div>
                    <button v-show="buttonLoading" type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Atualizar</button>
                    <button v-show="buttonLoading" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                </div>
            </form>
        </modal>

        <modal nome="delete" titulo="Excluir" tamanho="modal-sm">
            <form v-on:submit.prevent="deleteUser(item.id)">
            <div class="row">
                    <div class="col-md-12">
                        <h3>Deseja exluir esse Usuario ?</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <strong>#ID</strong>{{item.id}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dl>
                            <dt>Email</dt>
                            <dd>{{item.email}}</dd>
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
                loading:true,
                buttonLoading: true,
                contador:'',
                item:{},
                user:{},
                niveis:[{
                    id:1,
                    nome: 'Administrador'
                    },
                    {id:2, nome:'Atendente'}
                    ],
            }
        },
        mounted() {
            axios.get('user/lista')
            .then(res=>{
                this.items = res.data.reverse()
            }).finally(()=>{
                this.loading = false
                this.contador = this.items.length
                })
        },
        methods:{
            atualizaTabela(){
                axios.get('user/lista')
            .then(res=>{
                this.items = res.data.reverse()
            }).finally(()=>{
                this.loading = false
                this.contador = this.items.length
                })
            },
            getItem(id){
                 axios.get('user/show/'+ id)
                .then(res =>{
                    
                    this.item = res.data
                })
            },
            addUser(){
              this.buttonLoading = false;
               axios.post('user/form', this.user)
               .then(res =>{
                      new Noty({
                          theme: 'bootstrap-v4',
                          type: 'success', 
                          timeout:4000, 
                          layout:'topRight', 
                          text: '<i class="fas fa-check"></i> <strong>Sucesso!</strong><br>' + res.data
                          }).show();
                          this.atualizaTabela();
                          this.user = {};
               }).finally(() => {
                   this.buttonLoading = true;
               })
            },
            updateUser(id){
              this.buttonLoading = false;
              axios.post('user/edit/'+ id, this.item)
              .then(res=>{
                  
                this.getItem(id)
               this.atualizaTabela()

                  new Noty({
                      theme: 'bootstrap-v4',
                      type: 'success', 
                      timeout:3000, 
                      layout:'topRight', 
                      text: '<i class="fas fa-check"></i> <strong>Sucesso! </strong><br>' + res.data
                      }).show();
              }).finally(()=>{
                  this.buttonLoading = true;
              })
          },
          deleteUser(id){
                axios.delete('user/delete/'+ id)
                .then(res=>{
                    new Noty({
                        theme: 'bootstrap-v4',
                        type: 'error', 
                        timeout:3000, 
                        layout:'topRight', 
                        text: '<i class="fas fa-trash-alt"></i> <strong>Deletado! </strong><br>' + res.data
                        }).show();
                    this.atualizaTabela();
                    $('#delete').modal('hide')
                })
            
            },
        }
    }
</script>
