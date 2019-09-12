<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta name="description" content="Desenvolvimento de planos municipais de mobilidade urbana.">
  	<meta name="author" content="Marcus Roberto">

  	<title>PMMU</title>

  	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  
  	<link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
  	<link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet" type="text/css">
  	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  	<link href="{{ asset('css/landing-page.min.css') }}" rel="stylesheet">
</head>

<body>

  	<nav class="navbar navbar-light bg-light static-top">
		<div class="container">
			<a class="navbar-brand" href="#">PMMU</a>
			@guest
				<a class="btn btn-secondary" href="{{ route('login') }}">Entrar</a>
			@else
				<a class="btn btn-secondary" href="{{ route('home') }}">{{ auth()->user()->name }}</a>
			@endguest
		</div>
  	</nav>

  	<header class="masthead text-white text-center">
    	<div class="overlay"></div>
    	<div class="container">
      		<div class="row">
        		<div class="col-xl-9 mx-auto">
          			<h1 class="mb-5">Mobilidade Urbana</h1>
        		</div>
        		<div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
					<a href="#" class="btn btn-outline-light btn-lg">Visualizar Planos</a>
        		</div>
      		</div>
    	</div>
  	</header>

  	<section class="testimonials text-center bg-light">
    	<div class="container">
      		<h2 class="mb-5">Equipe e Colaboradores:</h2>
      		<div class="row">
        		<div class="col-lg-4">
          			<div class="testimonial-item mx-auto mb-5 mb-lg-0">
            			<img class="img-fluid rounded-circle mb-3" src="{{ asset('img/testimonials-1.jpg') }}" alt="">
            			<h5>Margaret E.</h5>
            			<p class="font-weight-light mb-0">Estagiária</p>
          			</div>
        		</div>
        		<div class="col-lg-4">
          			<div class="testimonial-item mx-auto mb-5 mb-lg-0">
            			<img class="img-fluid rounded-circle mb-3" src="{{ asset('img/testimonials-2.jpg') }}" alt="">
            			<h5>Fred S.</h5>
            			<p class="font-weight-light mb-0">Estagiário</p>
          			</div>
        		</div>
        		<div class="col-lg-4">
          			<div class="testimonial-item mx-auto mb-5 mb-lg-0">
            			<img class="img-fluid rounded-circle mb-3" src="{{ asset('img/testimonials-3.jpg') }}" alt="">
            			<h5>Sarah W.</h5>
            			<p class="font-weight-light mb-0">Estagiária</p>
          			</div>
        		</div>
      		</div>
    	</div>
  	</section>

  	<footer class="footer bg-light">
		<p class="text-muted text-center small mb-4 mb-lg-0">&copy; PMMU {{date('Y')}}. Todos os direitos reservados.</p>
		<p class="text-muted text-center small mb-4 mb-lg-0">Desenvolvido por <a href="https://github.com/marocama" target="_blank">Marcus Roberto</a>.</p>
  	</footer>

  	<script src="{{ asset('js/jquery.min.js') }}"></script>
  	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>