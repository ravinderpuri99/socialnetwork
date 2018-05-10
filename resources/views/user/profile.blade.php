@extends('layouts/app')

@section('content')

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-body text-center">
			<img src="{{ asset('images/avtar.png') }}" class="profile-img">
			<h1>{{ $user->name }}</h1>
			<h5>{{ $user->email }}</h5>
			<h5>{{ $user->dob->format('l j F Y') }} ({{ $user->dob->age}} years old)</h5>

			<button class="btn btn-success">Follow</button>
			</div>
		</div>
		</div>
	</div>

@endsection