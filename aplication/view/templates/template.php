	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>esta cosa funca</title>
		<?php foreach ($css as $value): ?>
			<link rel="stylesheet" href="<?php echo 'http://localhost/mvc/'.$value ?>">
		<?php endforeach ?>
	</head>
	<body>
		<div class="container">
			<?php echo $content; ?>
		</div>
	</body>
	</html>