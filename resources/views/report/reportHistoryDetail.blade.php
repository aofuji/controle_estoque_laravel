

<div class="">
<table>
    
    <tr>
        <th>#</th>   
        <th>Tipo</th>   
        <th>Qtd Entrada/Saida</th>   
        <th>Valor Unitario</th>   
        <th>Valor Total</th>   
        <th>Data</th>   
        
        <th>Cliente</th>   
        <th>Produto</th>   
        
    </tr>




    @foreach($historico as $item)
    
    <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->tipo}}</td>
        <td>{{$item->qtd}}</td>
        <td>R$ {{number_format($item->valor_unitario, 2, ',', '.')}}</td>
        <td>R$ {{number_format($item->valor_total, 2, ',', '.')}}</td>
        <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
        <td>{{$item->nome}}</td>
        <td>{{$item->nome_produto}}</td>
        
    </tr>
    @endforeach
<br>
</table>
</div>
<div class="footer">
    <strong>Total de Registro:</strong>{{$contador}}
    <br>
    @isset($item->valor_total)
    <strong>Valor Total:</strong>R$ {{number_format($valor_total, 2, ',', '.')}}
    @endisset
</div>
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

font-size:10px;
}
.footer{
    font-size: 10px;
}

</style>