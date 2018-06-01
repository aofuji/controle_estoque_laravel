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
			<!-- PANEL HEADLINE -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Panel Headline</h3>
					<p class="panel-subtitle">Panel to display most important information</p>
				</div>
				<div class="panel-body">
					<h4>Panel Content</h4>
					<p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
				</div>
			</div>
			<!-- END PANEL HEADLINE -->
		</div>
		<div class="col-md-4">

			<!-- PANEL NO PADDING -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Panel No Padding</h3>
					<div class="right">
						<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
						<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
					</div>
				</div>
				<div class="panel-body no-padding bg-primary text-center">
					<div class="padding-top-30 padding-bottom-30">
						<i class="fa fa-thumbs-o-up fa-5x"></i>
						<h3>No Content Padding</h3>
					</div>
				</div>
			</div>
			<!-- END PANEL NO PADDING -->
		</div>
	</div>
@endsection
