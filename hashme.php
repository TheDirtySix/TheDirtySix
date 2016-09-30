<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>SALT ME</title>
		
	</head>
	<body>
		<div class="col-md-6 col-md-offset-3">
			<form action="" method="POST" role="form" id="fillin" name="fillin">
				<h3 align="center">Hash Me</h3>
				<div class="form-group" align="center">
					<input type="text" class="form-control" id="" name="salt">
					<br/>
					<?php if(isset($_POST["salt"])){
						print("MD5 : ");
						print(md5($_POST["salt"]));
					}
					?>
					
				</div>
				<div align="center">
				<p>
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn btn-danger">Refill</button>
				</div>
			</form>
		</div>
	</body>
</html>