@extends('layouts.app')

@section('content')
<br>
    <div class="row">
		<div class="col-md-12">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Mensalmente</h3>
					<p class="panel-subtitle">Periodo: mensal </p>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
							<div class="metric">
								<span class="icon"><i class="fas fa-user-tag"></i></span>
								<p>
									<span class="number">{{$contador_clientes}}</span>
									<span class="title">Clientes</span>
								</p>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="metric">
								<span class="icon"><i class="fas fa-box"></i></span>
								<p>
									<span class="number">{{$contador_produtos}}</span>
									<span class="title">Produtos</span>
								</p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="metric">
								<span class="icon"><i class="fa fa-shopping-bag"></i></span>
								<p>
									<span class="number">{{$contador_saidas}}</span>
									<span class="title">Saidas</span>
								</p>
							</div>
						</div>
					</div>

					<div class="row">
						
						
						<div class="col-md-12">
							<div class="weekly-summary text-right">
								<span class="number">R$ {{number_format($total_saidas, 2, ',', '.')}}</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 23%</span>
								<span class="info-label">Total do Mês</span>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
	
@endsection
