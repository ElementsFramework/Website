@extends('app')

@section('content')
<nav id="slide-menu" class="slide-menu" role="navigation">
	<a class="brand" href="{{ route('home')  }}">
		{!! svg('logo') !!}
	</a>
	<ul class="slide-main-nav">
		@include('partials.main-nav')
	</ul>
	<div class="slide-docs-nav">
		{!! $index !!}
	</div>
</nav>

<div class="docs-wrapper container">

	<section class="sidebar">
		{!! $index !!}
	</section>

	<article>
		<div class="search">
			{!! svg('search') !!}
			<input placeholder="search" type="text" v-model="search" id="search-input" v-on:blur="reset" />
		</div>
		<br><br>
		<div class="documentation-content">
		{!! $content !!}
		</div>
	</article>
</div>
@endsection
