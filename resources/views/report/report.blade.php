


<table>
    
        <tr>
            <th>#</th>   
            <th>Tipo</th>   
            <th>Qtd</th>   
            <th>Valor Unitario</th>   
            <th>Valor Total</th>   
            <th>Usuario</th>   
            
            <th>Cliente</th>   
            <th>Estoque</th>   
            
        </tr>

    


        @foreach($historico as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->tipo}}</td>
            <td>{{$item->qtd}}</td>
            <td>R$ {{$item->valor_unitario}}</td>
            <td>R$ {{$item->valor_total}}</td>
            <td>{{$item->usuario}}</td>
            <td>{{$item->nome}}</td>
            <td>{{$item->nome_produto}}</td>
            
        </tr>
        @endforeach
   
</table>

<style>
table {
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 2px;
    border-collapse: collapse;
    width: 100%;
}


</style>