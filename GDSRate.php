<?php
session_start();
$_SESSION['delay'] = 0;
include ("PHP/Process_Function.php");
gatekeeper();
?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>GDS Ratings</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="/CSS/CSS.css"> 
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="/JavaScript/SubmitForm.js"></script>
		<script src="JavaScript/Stars.js"></script>
		<script>
		
			$(document).ready(function() {
				$("#entryForm").submit(function(e) {
					e.preventDefault();
					
					// Get data from form
					var data = $('#entryForm').serializeArray();
					
					// Add in rating data based on what stars are selected
					var rating = 0;
					for (var i = 5; i >= 0; i--) {
						if ($("#star" + i).hasClass("fa-star")) {
							rating = i;
							break;
						}
					}
					data.push({name: 'Rating', value: rating});

					$.post("PHP/ProcessAddEntry.php", data);
					
					setTimeout(function() {
						window.location = "index.php";
					}, 100);
				});
				
			});
			
		</script>
	</head>
	<body>
		<br>
		<div class="container">
			<div class="panel-group">
				<div class="panel panel-default">
					
					<div class="panel-heading" class="col-xs-1" align="center">
						<h2>Add Entry</h2>
					</div>
					
					<nav aria-label="...">
						<ul class="pager">
							<li class="previous"><a href="index.php"><span aria-hidden="true">&larr;</span> Back to Home Page</a></li>
						</ul>
					</nav>

					<div class="panel-body">
						<form id="entryForm" action="PHP/ProcessAddEntry.php" method="post" class="form-horizontal">

							<fieldset id="fieldset" >
								<br>

								<div class = "form-group" id = "Station">
									<label for="Station" class = "col-sm-4 control-label">Station</label> 
									<div class="col-sm-5">
										<select name="Station" class="form-control" onchange="appear()" id="choice"> 
											<option value=""> 			Choose One		</option>
											<option value="Entree"> 	Entree 			</option>
											<option value="Carving">	Carving 		</option>
										</select>
									</div>
								</div>

								<div class = "form-group" id = "Item">
									<label for="Item" class = "col-sm-4 control-label">Menu Item</label> 
									<div class="col-sm-5">
										<input type = "text" class = "form-control" name = "Item" autocomplete = off step="any" placeholder = "What food" >
									</div>
								</div>

								<div class = "form-group" id = "Rating">
									<label for="Rating" class = "col-sm-4 control-label">Rating (optional)</label> 
									<div class="col-sm-5">
										<div class="starGroup">
											<i class="fa fa-star-o" aria-hidden="true" id="star1"></i>
											<i class="fa fa-star-o" aria-hidden="true" id="star2"></i>
											<i class="fa fa-star-o" aria-hidden="true" id="star3"></i>
											<i class="fa fa-star-o" aria-hidden="true" id="star4"></i>
											<i class="fa fa-star-o" aria-hidden="true" id="star5"></i>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-offset-5 col-sm-5">
										<button type="submit" class="btn btn-default">Add Entry</button>
									</div>
								</div>

							</fieldset>

						</form>

					</div>
				</div>
			</div>
		</div>
	</body>
</html>