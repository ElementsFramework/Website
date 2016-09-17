@extends('app')

@section('body-class', 'home')

@section('content')

<nav id="slide-menu" class="slide-menu" role="navigation">

	<div class="brand">
		<a href="/">
			<img src="/assets/img/logo-white.png" height="50" alt="Elements white logo">
		</a>
	</div>

	<ul class="slide-main-nav">
		@include('partials.main-nav')
	</ul>

</nav>

<section class="hero">
	<div class="container">

        <div class="content">
            <h1>Solve problems. Once.</h1>
            <p>Drag-and-drop Builder Without Limitations</p>
        </div>


        <div class="callout rule">
            <span class="text">Coming soon!</span>
        </div>

        <div class="callouts">
            <a href="/docs/scout" class="callout minimal third">
                <div class="callout-head">
                    <div class="callout-title">Dynamic Routing</div>
                </div>
                <p>Create routes on the go, without needing to change a single line of code.</p>
            </a>
            <a href="/docs/broadcasting" class="callout minimal third">
                <div class="callout-head">
                    <div class="callout-title">Layouts</div>
                </div>
                <p>Drag-and-drop Elements to your layout and complex build applications in minutes.</p>
            </a>
            <a href="/docs/passport" class="callout minimal third">
                <div class="callout-head">
                    <div class="callout-title">Extendability</div>
                </div>
                <p>Create custom Elements, build features, integrate designs. Easy does not mean powerless.</p>
            </a>
        </div>
	</div>
</section>
@endsection
