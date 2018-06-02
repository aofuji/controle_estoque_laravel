@extends('layouts.app')

@section('content')
<div class="row">
		<div class="col-md-8">
				<h1 class="">Inicio</h1>
				<br>
		</div>
</div>
    <div class="row">
		<div class="col-md-8">
			<div class="panel panel-headline">
					<div class="panel-heading">
						<h3 class="panel-title">Semanalmente</h3>
						<p class="panel-subtitle">Periodo: Jan 14, 2016 - Jun 21, 2016</p>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-4">
								<div class="metric">
									<span class="icon"><i class="fas fa-user-tag"></i></span>
									<p>
										<span class="number">252</span>
										<span class="title">Clientes</span>
									</p>
								</div>
							</div>
							<div class="col-md-4">
								<div class="metric">
									<span class="icon"><i class="fa fa-shopping-bag"></i></span>
									<p>
										<span class="number">500</span>
										<span class="title">Vendas</span>
									</p>
								</div>
							</div>
							<div class="col-md-4">
								<div class="metric">
									<span class="icon"><i class="fas fa-box"></i></span>
									<p>
										<span class="number">1,800</span>
										<span class="title">Estoque</span>
									</p>
								</div>
							</div>
							
						</div>

						<div class="row">
							
							<div class="col-md-4">
								<div class="weekly-summary text-right">
									<span class="number">2,315</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 12%</span>
									<span class="info-label">Total</span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="weekly-summary text-right">
									<span class="number">R$ 5.758,00</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 23%</span>
									<span class="info-label">Total do Mes</span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="weekly-summary text-right">
									<span class="number">R$ 938,00</span> <span class="percentage"><i class="fa fa-caret-down text-danger"></i> 8%</span>
									<span class="info-label">Despesas</span>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
		<div class="col-md-4">
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Lembretes</h3>
					
				</div>
				<div class="panel-body">
					<ul class="list-unstyled todo-list">
						<li>
							
							
							<p>
								<strike>
								<span class="title">Verificar Estoque</span>
								<span class="short-description">Joao estara ajudando analisar estoque sobre encomenda chegando no dia 22/10/2018.</span>
								</strike>
								<span class="date">Jan 9, 2018</span>
							</p>
							<div class="controls">
								<a href="#"><i class="icon-software icon-software-pencil"></i></a> <a href="#"><i class="icon-arrows icon-arrows-circle-remove"></i></a>
							</div>
						</li>
						<li>
							
							<p>
								<span class="title">Receber mercadorias</span>
								<span class="short-description">Conforme site de rastreio dos correios BRAJNOJ7678LR sera entregue no dia 09/05/2018.</span>
								<span class="date">Jan 23, 2018</span>
							</p>
							<div class="controls">
								<a href="#"><i class="icon-software icon-software-pencil"></i></a> <a href="#"><i class="icon-arrows icon-arrows-circle-remove"></i></a>
							</div>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
		
	</div>
	<div class="row">
			<div class="col-md-12">
					<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title">Pedidos</h3>
								<div class="right">
									
								</div>
							</div>
							<div class="panel-body no-padding">
								<table class="table table-striped">
									<thead>
										<tr><th>Pedido No.</th><th>Nome</th><th>Valor</th><th>Data &amp; Horas</th><th>Status</th></tr>
									</thead>
									<tbody>
										<tr><td><a href="#">763648</a></td><td>Steve</td><td>R$ 1,22</td><td>Oct 21, 2016</td><td><span class="label label-success">FINALIZADO</span></td></tr>
										<tr><td><a href="#">763649</a></td><td>Amber</td><td>R$ 6,20</td><td>Oct 21, 2016</td><td><span class="label label-warning">PENDENTE</span></td></tr>
										<tr><td><a href="#">763650</a></td><td>Michael</td><td>R$ 3,40</td><td>Oct 18, 2016</td><td><span class="label label-danger">CANCELADO</span></td></tr>
										<tr><td><a href="#">763651</a></td><td>Roger</td><td>R$ 1,86</td><td>Oct 17, 2016</td><td><span class="label label-success">FINALIZADO</span></td></tr>
										<tr><td><a href="#">763652</a></td><td>Smith</td><td>R$ 3,62</td><td>Oct 16, 2016</td><td><span class="label label-success">FINALIZADO</span></td></tr>
									</tbody>
								</table>
							</div>
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Ultimas 24 horas</span></div>
									
								</div>
							</div>
						</div>
			</div>
	</div>
@endsection
