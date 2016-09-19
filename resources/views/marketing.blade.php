@extends('app')

@section('body-class', 'home')

@section('content')

<nav id="slide-menu" class="slide-menu" role="navigation">
    <a class="brand" href="{{ route('home')  }}">
        {!! svg('logo') !!}
    </a>
    <ul class="slide-main-nav">
        @include('partials.main-nav')
    </ul>
</nav>

<section class="hero gradient-red has-text-centered display">
	<div class="container">

        <div class="content">
            <h1>Solve problems. Once.</h1>
            <p>Modular Drag-and-drop Framework Without Limitations</p>
        </div>

        {!! svg('laptop') !!}
	</div>
</section>
<section class="hero has-text-centered">
    <div class="container">

        <br><br>

        <div class="divider">
            <span class="text">Coming soon!</span>
        </div>

        <div class="tile is-ancestor">
            <div class="tile is-parent is-4 is-1-mobile">
                <div class="tile is-child notification">
                    <p class="title">Dynamic Routing</p>
                    <p class="content">
                        Create routes on the go, without needing to change a single line of code.
                    </p>
                </div>
            </div>
            <div class="tile is-parent is-4 is-1-mobile">
                <div class="tile is-child notification">
                    <p class="title">Extendability</p>
                    <p class="content">
                        Create custom Elements, build features, implement designs. Easy does not mean powerless.
                    </p>
                </div>
            </div>
            <div class="tile is-parent is-4 is-1-mobile">
                <div class="tile is-child notification">
                    <p class="title">Layouts</p>
                    <p class="content">
                        Drag-and-drop Elements to your layout and complex build applications in minutes.
                    </p>
                </div>
            </div>
        </div>

        <br><br>

    </div>
</section>
@endsection
