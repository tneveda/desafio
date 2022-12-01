<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">

        <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="/css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="/css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/custom.css">

    <link rel=”stylesheet” href=”https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css”>

	    <!-- Modernizer for Portfolio -->
		<script src="/js/modernizer.js"></script>


    </head>
    <body>

 
   
    <tr>
    <div id="hosting" class="section wb" style="background: rgb(248, 248, 248)">
	<br>
	<br>
    <table  cellpadding="0" height="100" width="100%">
    <tr>
    <td text-align="center" valign="top" class="email-container">

		<div>
        <td text-align='center' style='text-align:center'>
                 
		</div>
		<br>


		<div class="row dev-list ">
			
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">

				<div class="wow fadeIn" text-align="center" style="background-color: rgba(0, 0, 0, 0.10); border-radius: 15px;" data-wow-duration="1s" data-wow-delay="0.3s">
					<br>
					<div class="message-box">
						<div class="widget-title">
							<h3 style="color: #E62B36;"><strong>Caro {{$data['nome']}}, a sua compra foi realizada com sucesso, valor total de  {{$data['soma']}}€.
                                A encomenda chegará ao seu destino, através da transportadora {{$data['transportadora']}}. De seguida pode verificar o conteúdo da sua compra</strong></h3>
                            <br>
                            <br>
                   
                            <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead style="text-align: center;">
    <tr>
    <th class="sorting_desc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 102px;" aria-sort="descending"></th>
    <th>Nome</th>
    <th>Qtd</th>
    <th>Valor (€)</th>
    
    </tr>
    </thead>
    <tbody>
    @foreach($data['compras'] as $compra)
    <tr>
    <td style="text-align: center; vertical-align: middle"></td>
    <td style="text-align: center; vertical-align: middle">{{$compra->nome}}</td>
    <td style="text-align: center; vertical-align: middle">{{$compra->qtd}}</td>
    <td style="text-align: center; vertical-align: middle">{{$compra->valor}}</td>
    
    
    </td>
    </tr>
    @endforeach
    </tbody>
        </table>
             
						</div>
						<!-- end title -->
						
					</div>
					<hr>
                    <h6 text-align="center"> © {{ date('Y') }} Desafio Tecnico. Todos os Direitos Reservados</h6>
					<br>
					<br>
				</div>
				<!--widget -->
				<br>
			</div><!-- end col -->

		</div><!-- end row -->
</tr>
         </table>
	</div><!-- end container -->
