<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>{{ isset($title) ? $title . ' - ' : null }}Elements Framework - Solve problems once</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="author" content="Igor Rinkovec">
	<meta name="description" content="Elements Framework provides tools for developers to deliver easy to use drag-and-drop CMS functionalities to the client without sacrificing any custom implementation ability or website performance.">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@if (isset($canonical))
		<link rel="canonical" href="{{ url($canonical) }}" />
	@endif
	<!--[if lte IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,700,600,400italic,700italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ elixir('assets/css/laravel.css') }}">
	<link rel="apple-touch-icon" href="/favicon.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
</head>
<body class="@yield('body-class', 'docs') language-php">

	<span class="overlay"></span>

	<nav class="nav">
		<div class="container">
			<div class="nav-left">
				<a class="nav-item is-brand" href="{{ route('home')  }}">
					{!! svg('logo') !!}
				</a>
			</div>

			<span class="nav-toggle toggle-slide">
				<span></span>
				<span></span>
				<span></span>
			</span>

			<div class="nav-right nav-menu">
				<a class="nav-item" href="https://github.com/ElementsFramework">
					<span class="icon">
						<i class="fa fa-github"></i>
					</span>
				</a>
				@include('partials.main-nav')
				<span class="nav-item">
					<a class="button is-primary" href="/docs/master">
						<span class="icon">
							<i class="fa fa-download"></i>
						</span>
						<span>Installation</span>
					</a>
				</span>
				@if(false)
					@if (Request::is('docs*') && isset($currentVersion))
						@include('partials.switcher')
					@endif
				@endif
			</div>
		</div>
	</nav>


	@yield('content')

	<footer class="footer has-text-centered">
		<p>Copyright &copy; <a href="http://igor-rinkovec.from.hr" target="_BLANK">Igor Rinkovec</a>.</p>
	</footer>

	<script>
		var algolia_app_id      = '<?php echo Config::get('algolia.connections.main.id', false); ?>';
		var algolia_search_key  = '<?php echo Config::get('algolia.connections.main.search_key', false); ?>';
		@if (isset($currentVersion))
		var version             = '<?php echo $currentVersion; ?>';
		@endif
	</script>

	@include('partials.algolia_template')

	<script src="{{ elixir('assets/js/laravel.js') }}"></script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-51519562-6', 'auto');
		ga('send', 'pageview');
	</script>
</body>
</html>
