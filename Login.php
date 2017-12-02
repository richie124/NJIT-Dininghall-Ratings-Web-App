<!DOCTYPE html>
<html lang = "en">
<head>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="/CSS/CSS.css"> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="/JavaScript/SubmitForm.js"></script>
</head>
<body>
	<br>
	<div class="container">
		<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading" class="col-xs-1" align="center">
					<h2>Login</h2>
				</div>
				
					<nav aria-label="...">
						<ul class="pager">
							<li class="previous"><a href="index.php"><span aria-hidden="true">&larr;</span> Back to Home Page</a></li>
						</ul>
					</nav>
				
				<div class="panel-body">
					<form action="PHP/ProcessLogin.php" method="post" class="form-horizontal">
            
						<fieldset id="fieldset" >
							<br>

							<div class = "form-group" id = "user">
								<label for="Item" class = "col-sm-4 control-label">Username</label> 
								<div class="col-sm-5">
									<input type = "text" class = "form-control" name = "user" autocomplete = off step="any" placeholder = "Enter username" >
								</div>
							</div>
							
							<div class = "form-group" id = "password">
								<label for="Rating" class = "col-sm-4 control-label">Password</label> 
								<div class="col-sm-5">
									<input type = "password" class = "form-control" name = "password" autocomplete = off step="any" placeholder = "Enter password" >
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-5 col-sm-5">
									<button type="submit" class="btn btn-default">Sign in</button>
									<br>
								</div>
								<div class="col-sm-5 col-sm-offset-4">
									Don't have an account? <a href = "registration.php">Register Here</a>
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