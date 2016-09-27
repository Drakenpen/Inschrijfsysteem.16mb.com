<!doctype html>
<html>
<head>
</head>
<body>


@foreach($events as $event)

	<div class="eventbox" style="background-image:url('{{ $event['small_banner_url'] }}')">
		<div>
			<h2>{{ $event['title'] }}</h2>
			<h2>{{ $event['subtitle'] }}</h2>
			<p>{{ $event['description'] }}</p>
		</div> 
	</div>


@endforeach


</body>
</html>