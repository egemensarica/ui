<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
		<title>MudPi Relays</title>
	    <?php echo csrf_meta(); ?>
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="MudPi UI Relays">
	    <meta name="author" content="MudPi - Eric Davisson">

		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/fonts.css">
		<link rel="stylesheet" type="text/css" href="css/app.css">
	</head>
	<body>
		<div id="app" class="mnh-full">
			<?php include "partials/navigation.php"; ?>
			<div class="container">
			<div class="columns is-centered">
			<div class="column sm:column-12 md:column-12">
				<div class="content px-2 w-100">
					<h1 class="h2 text-primary" id="title">Relays</h1>
					<p class="mb-4 text-grey-dark" id="message">Toggle relays and components attached to MudPi.</p>
					<div id="errors" class="rounded-2 text-red-dark errors"></div>


					<h3 class="h3 text-primary">Relays</h3>
					<div class="columns" style="margin-left:-10px;margin-right:-10px;">
						<?php foreach($relays as $relay) { ?>
						<div class="column column-12 sm:column-12 md:column-4">
							<div class="box py-1 text-primary rounded-3 mb-2 relay" id="relay-<?php echo $relay->key ?>" data-topic="<?php echo $relay->topic ?>" data-key="<?php echo $relay->key ?>">
								<h3 class="h4"><?php echo $relay->name; ?></h3>
								<?php if(isset($relay->pin)) { ?>
									<span class="text-grey-dark-lightest text-xs mb-1">Pin: <?php echo $relay->pin; ?>
								<?php }?></span>
									<span class="text-grey-dark-lightest text-xs mb-1">(<?php echo $relay->topic; ?>)</span>
									<?php if(isset($relay->key)) { ?>
										<p class="text-primary font-bold text-xs"><?php echo ucfirst($relay->key); ?></p>
									<?php }?>
								<div class="columns">
									<div class="column px-1 py-3">
										<p class="text-primary font-bold h3"><?php echo $relay->value ? "ON" : "OFF" ?></p>
									</div>
								</div>
							</div>
						</div>
					<?php }?>
					</div>
					
				</div>


			</div> <!-- /Container -->
			</div> <!-- /Columns -->
			</div> <!-- /Column 10 -->
		</div>

		<script type="text/javascript" src="js/relays.js"></script>

	</body>
</html>