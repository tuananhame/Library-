<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Trang chủ</title>
	<link rel="stylesheet" href="{{ asset('css/container.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	
</head>

<body>
	<header>
		<h1 id="head">Chia sẻ để nhận lại</h1>
	</header>	
	<div class="wrapper">
		@include('news.partials.header')
		<div class="content">
			@yield('content')
			@include('news.partials.footer')
		</div>

	<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/container.js') }}"></script>
	
	<script type="text/javascript">
		$(".inputs").hide();
		$("#show").click(function () {
			$("#show").hide();
			$(".inputs").show();


		})

	</script>

</body>