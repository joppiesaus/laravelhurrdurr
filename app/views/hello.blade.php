<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>sheep</title>
	<style>
		div
        {
            font-family: "Comic Sans MS";
            font-size: 8em;
            color: #f00;
            text-decoration: underline;
        }

	</style>
</head>
<body>
	<h1>{{ trans("emailmessages.welcome") }}</h1>

	@if (count($errors) > 0)
		<h1>Oh noes there are errors!!1!@</h1>
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

    {{ Form::open(["method" => "POST" ] ) }}

    {{ Form::label("email", "Email Addresssss") }}
    {{ Form::text("email", "foo@bar.com") }}
    {{ Form::submit("CLIKK!") }}
    {{ Form::close() }}
</body>
</html>
