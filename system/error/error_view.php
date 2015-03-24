<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Error</title>

	<style>
		@font-face {
		    font-family: 'custom'; /*a name to be used later*/
		    src: url('/mvc/system/error/font.ttf'); /*URL to font*/
		}
		.error{
			position: fixed;
			margin: auto;
			width: 100%;
			margin-top: 5%;
		}
		.container{
			display: inline-block;
			width: 100%;
			height: 100%;
		}
	</style>

</head>
<body style="background-color: #DB3750; color: #fff; font-family: 'custom'; text-transform: uppercase; text-align: -webkit-center;">
	<div class="container">
		<div class="error">
			<img src="/mvc/system/error/error.png" style="max-width: 100px; margin-bottom: -70px;" alt="">
			<h1 style="font-size: 100px;">Error</h1>
			<p>
				<?php echo $message; ?>
			</p>
		</div>
	</div>
</body>
</html>