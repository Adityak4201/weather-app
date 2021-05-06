<?php

	$error = "";
	$weather = "";
	
	if(array_key_exists('city', $_GET))
	{
		$city = str_replace(' ', '', $_GET['city']);
		$file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
		if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
		{
			$error = "This city could not be found";
		}
		else 
		{
			$forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
			$pageArray = explode('3 days)</span><p class="b-forecast__table-description-content"><span class="phrase">',$forecastPage);
			if(sizeof($pageArray) > 1)
			{
				$secondArray = explode('</span></p></td>', $pageArray[1]);
				if(sizeof($secondArray)> 1)
						$weather = $secondArray[0];
					else
						$error = "This City could not be found";
			}
			else
				$error = "This City could not be found";
		}
	}

?>

<html>

	<head>
	
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	
		<title>Weather Scraper</title>
		
		<script type="text/javascript" src="jquery.min.js"></script>
		
		<style type="text/css">
		
			body	{
				
				background-image:url("Image.jpg");
				margin:0 auto;
				font-family:helvetica, sans-serif;
				
			}
			
			.center	{
				
				text-align:center;
				
			}
			
			h1	{
				
				margin-top:100px;
				font-size:50px;
				color:#333333;
				
			}
			
			#city	{
				
				width:500px;
				margin:50px auto;
				
			}
			
			#submit	{
				
				margin: auto;
				
			}
			
			#name-city	{
				
				font-size:18px;
				color:#333333;
				
			}
			
			#msg	{
				
				width:500px;
				margin:0 auto;
				
			}
		
		</style>
		
	</head>
	
	<body>
	
		<div class="container">
	
			<h1 class="center">What's the Weather?</h1>
			
			<p class="center" id="name-city">Enter the name of a city.</p>
			<div class="center">
				<form>
				  <div class="form-group">
					<input type="text" name="city" class="form-control" id="city" placeholder="Eg. New-York, Delhi, Mumbai etc." value=""<?php 
					if(array_key_exists('city', $_GET))
						echo $_GET['city']; 
					?>">
				  </div>
				  <button id="submit" type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
			<div id="msg">
				<?php
				
					if($weather)
						echo '<div class="alert alert-success" role = "alert">'.$weather.'</div>';
					else if ($error)
						echo '<div class="alert alert-danger" role = "alert">'.$error.'</div>';
				
				?>;
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		
	</body>
	
</html>
	  