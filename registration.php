<!DOCTYPE html>
<?php

	

?>
<html lang = "en">
	<head>
		<title>GDS Ratings</title>
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
						<h2>Register</h2>
					</div>
					
					<nav aria-label="...">
						<ul class="pager">
							<li class="previous"><a href="index.php"><span aria-hidden="true">&larr;</span> Back to Home Page</a></li>
						</ul>
					</nav>

					<div class="panel-body">
						<form action="PHP/ProcessRegistration.php" method="post" class="form-horizontal">

							<fieldset id="fieldset" >
								<br>

                <div class="form-group">
                  <label for="user" class = "col-sm-4 control-label" >User</label>
                    <div class="col-sm-5">
                      <input type=text class="form-control" name = "user" id="user" placeholder="Enter User" required>
                    </div>
                </div>

                <div class="form-group">
                  <label for="user" class = "col-sm-4 control-label" >Email</label>
                    <div class="col-sm-5">
                      <input type=text class="form-control" name="email" id="email" placeholder="Enter Email" required>
                    </div>
                </div>

                <div class="form-group">
                  <label for="password" class = "col-sm-4 control-label">Password</label>
                    <div class="col-sm-5">
                      <input type="password" class="form-control" name = "password" id="password" placeholder="Enter Password" required onkeyup="checkPasswordMatch();">
                    </div>
                </div>
                <div class="form-group">
                  <label for="password" class = "col-sm-4 control-label">Re-enter Password</label>
                    <div class="col-sm-5">
                      <input type="password" class="form-control" name = "password2" id="password2" placeholder="Re-enter Password" required onkeyup="checkPasswordMatch();">
                    </div>
                </div>
								
							<div class="form-group">
                  <label for="registrationFormAlert" class = "col-sm-4 control-label">Password Check</label>
										<div class="col-sm-5">
  						 			 <div class="form-control" id="PasswordCheck">
											</div>
								</div>
								</div>

								<div class="form-group">
									<div class="col-sm-offset-5 col-sm-5">
										<button type="submit" class="btn btn-default">Register</button>
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

<script>
	
</script>