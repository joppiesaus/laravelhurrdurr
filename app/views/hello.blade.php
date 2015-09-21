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
    {{ Form::open(["method" => "POST" ] ) }}
    
    {{ Form::label("email", "Email Addresssss") }}
    {{ Form::text("email", "foo@bar.com") }}
    {{ Form::submit("CLIKK!") }}
    {{ Form::close() }}
</body>
</html>
