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
                                <th>Permissões</th>
                                <th>Descrição</th>
                                
                            </tr>
                        </thead>
                        <tbody> 
                            <tr v-for="item in lista">
                                <td>{{item.id}}</td>
                                <td>{{item.name}}</td>
                                <td>{{item.label}}</td>
                                
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
            
            
        }
    }
</script>
