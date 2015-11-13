<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dropbox dashboard</title>
	<style>
	code
	{
		padding: 0;
		padding-top: 0.2em;
		padding-bottom: 0.2em;
		margin: 0;
		font-size: 85%;
		background-color: rgba(0,0,0,0.04);
		border-radius: 3px;
	}
	</style>
</head>
<body>
    @if (!empty($message))
    {{ "<div>" . $message . "</div>" }}
    @endif

	<h1>Welcome, {{ Session::get("dropbox-name") }}!</h1>
	<p>Your token: <code>{{ Session::get("dropbox-token") }}</code> <a id="#logout" href="dropbox/logout">Forget</a></p>

    {{ Form::open(["url" => "dropbox-dashboard-download", "method" => "POST" ] ) }}

    {{ Form::label("filename", "Filename") }}
    {{ Form::text("filename", "x.png") }}<br><br>

    {{ Form::submit("Download file!") }}
    {{ Form::close() }}<br><br>

	{{ Form::open(["url" => "dropbox-dashboard-upload", "files" => true, "method" => "POST" ] ) }}

    {{ Form::label("filename", "Filename") }}
    {{ Form::file("file") }}<br><br>

    {{ Form::submit("Upload file!") }}
    {{ Form::close() }}
</body>
</html>
