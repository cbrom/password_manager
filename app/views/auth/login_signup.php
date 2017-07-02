
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PSD MGR HOME</title>
<link rel="stylesheet" href="../public/css/index.css" type="text/css" />
</head>
<body>
<header>
	<nav>
		<ul>
			<li><h3 style="line-height: 2.3em;color:#fefefe">PSD MGR</h3></li>
			<li><a href="">Home</a></li>
			
			<li><a href="">About Us</a></li>
		</ul>
	</nav>
</header><main>


<div id="main-form">
<center>
<div id="login-form">
	<form method="post" action="../auth/signin">
		<table id="signin-table">
			<tr>
				<td><label for="email">Email</label></td>
				<td><input type="email" name="email" maxlength="25" required/></td>
			</tr>
			<tr>
				<td><label for="password">Password</label></td>
				<td><input type="password" name="password" maxlength="25" required/></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<button type="submit" name="btn-login"> Sign In</button>
				</td>
			</tr>
			<?php
			
			if(isset($errors['login']) && $errors['login'] == 'fail'){
				echo "<tr>
				<td>Invalid Email or Password</td>
				</tr>";
				unset($errors['login']);
			}
			?>
		</table>
	</form>
</div>
<div id="signup-form">
	<form method="post" action="../auth/signup">
		<table id="signup-table">
			<tr>
				<td><label for="susername">User Name</label></td>
				<td><input type="text" name="susername" maxlength="25" required /></td>
			</tr>
			            <?php
				if(isset($errors['username']) && $errors['username'] == "invalid"){
					echo "<td>Invalid username</td>";
					unset($errors['username']);
				}
				
				?>
			<tr>
				<td><label for="semail">Email</label></td>
				<td><input type="email" name="semail" maxlength="25" required/></td>
			</tr>
			<tr>
				<td><label for="spassword">Password</label></td>
				<td><input type="password" name="spassword" maxlength="25" required/></td>
			</tr>
			<tr>
				<td><label for="sconfirmpassword">Confirm Password</label></td>
				<td><input type="password" name="sconfirmpassword" maxlength="25" required>
				
			</tr>
			<tr>
				<td>
					<td><button type="submit" name="btn-signup">Sign Up</button></td>
            </tr>
            <?php
				if(isset($errors['signup-password']) && $errors['signup-password'] == "notmatch"){
					echo "<td>Password not matchhed</td>";
					unset($errors['signup-password']);
				}
				if(isset($errors['signup-password']) && $errors['signup-password'] == "shortpassword"){
					echo "<td>Password not strong enough<td>";
				}
				?>
            <?php
            if(isset($msg['signup']) && $msg['signup'] == 'fail' && $msg['email']== 'exists'){
            	echo "<p>Email address already exists</p>";
            	unset($msg['email']);
            	unset($msg['signup']);
            }
            ?>
        </table>
    </form>
    </div>
    </center>
    </div>
    </main>
    </body>
</html>