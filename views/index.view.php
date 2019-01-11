<?php $title = "Chat Application using PHP Ajax Jquery"; ?>
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
							<label>Re-enter Password</label>
							<input type="password" name="confirm_password" class="form-control">
						</div>
						<div class="form-group">
							<input type="submit" name="register" class="btn btn-info" value="Register">
						</div>
						<div align="center">
							<a href="login.php">Login</a>
						</div>
					</form>
				</div>
			</div>
		</div>
    </body>
</html>