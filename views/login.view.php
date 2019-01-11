<?php $title = "Login !"; ?>
<?php include 'partials/header.php'; ?>
		<div class="container">
			<br>
			<h3 align="center">Chat Application Using PHP Ajax Jquery</h3> <br> <br>
			<div class="panel panel-default">
				<div class="panel-heading">
					Chat Application Register
				</div>
				<div class="panel-body">
					<form method="post">
						<p class="text-danger"><?= $message ?></p>
						<div class="form-group">
							<label>Enter Username</label>
							<input type="text" name="username" class="form-control">
						</div>
						<div class="form-group">
							<label>Enter Password</label>
							<input type="password" name="password" class="form-control">
						</div>
						<div class="form-group">
							<input type="submit" name="login" class="btn btn-info" value="Login">
						</div>
						<div align="center">
							<a href="index.php">Register</a>
						</div>
					</form>
				</div>
			</div>
		</div>
    </body>
</html>