<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>sheep</title>
	<style>
	</style>
</head>
<body>

    @if (!empty($message))
    {{ "<div>" . $message . "</div>" }}
    @endif
    {{ Form::open(["method" => "POST" ] ) }}

    {{ Form::label("name", "name") }}
    {{ Form::text("name", "asdfasdfasdfasdfasdfasdf") }}
    {{ Form::submit("CLIKK!") }}
    {{ Form::close() }}
</body>
</html>
