<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>sheep</title>
	<style>

	.error
	{
		color: #f00;
	}


	</style>
</head>
<body>

	<h1>{{ trans("emailmessages.welcome") }}</h1>

	@if (count($errors) > 0)
		<h1>{{ trans("emailmessages.errors") }}</h1>
		<div class="error" style="border: 1px solid #f00; background-color: #ede; margin: 20px;">
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
	{{ $errors->first("email", "<span class=\"error\">:message</span>") }}
	<br><br>
    {{ Form::submit("CLIKK!") }}
    {{ Form::close() }}
</body>
</html>
