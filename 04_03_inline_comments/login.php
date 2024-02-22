<?php 
	/**
	 * Generates logins and stores them in a file.
	 */
	function generate_logins() {
		$logins = array(
			'joe' => 'hello-there',
			'erin' => 'thats-poodoo',
			'rob' => 'do-the-impossible',
			't' => 'i-like-anakin',
			'lou' => 'eat-everything'
		);

		$file_contents = '';
		/**
		 * This code block iterates over an array of logins and generates a file with login information.
		 * Each login entry consists of the username and the hashed password.
		 *
		 * @param array $logins An array containing the login information.
		 * @param string $file_contents A string variable to store the generated file contents.
		 */
		foreach ($logins as $name => $pw) {
			$file_contents .= $name . ',' . password_hash($pw, PASSWORD_DEFAULT) . "\n";
		}

		file_put_contents('logins.txt', $file_contents);
	}
	
	
	function login($username, $password) {
		$logins = file_get_contents('logins.txt');
		$logins = explode( "\n", $logins );

		foreach ($logins as $login) {
			$login = explode( ',', $login );
			if( $username == $login[0] && password_verify( $password, $login[1] ) ) {
				setcookie( 'loggedin', true );
				$_COOKIE['loggedin'] = true;
				setcookie( 'username', $username );
				$_COOKIE['username'] = $username;
				return true;
			}
		}

		if ( ! file_exists('logins.txt') ) {
			generate_logins();
		}

		/**
		 * This code block is responsible for clearing the login-related cookies.
		 * It sets the 'loggedin' cookie to false and expires it by setting the expiration time to the past.
		 * It also sets the 'username' cookie to an empty string and expires it by setting the expiration time to the past.
		 */
		setcookie( 'loggedin', false, time()-3600 );
		$_COOKIE['loggedin'] = false;
		setcookie( 'username', '', time()-3600 );
		echo '<h4>Username and/or Password Incorrect</h4>';
		return false;

	}
	
	if ( isset( $_POST['submit'] ) ) {
		/**
		 * This line of code logs in the user by calling the login function with the provided username and password.
		 * The username is converted to lowercase and trimmed of any leading or trailing whitespace.
		 * The password is also trimmed of any leading or trailing whitespace.
		 * The result of the login function is stored in the $logged_in variable.
		 */
		$logged_in = login(strtolower(trim($_POST['username'])), trim($_POST['password']));
	} 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta name="author" value="Joe Casabona" />
		<link rel="stylesheet" href="../style.css" />
	</head>
	<body>
		<main>
			<?php
				if ( $_COOKIE['loggedin'] ) {
					echo '<h2>Welcome, ' . $_COOKIE['username'] . '</h2>';
				}
			?>
			<form name="login" method="POST">
				<div>
					<label for="username">Username:</label>
					<input type="text" name="username" />
				</div>
				<div>
					<label for="password">Password:</label>
					<input type="password" name="password" />
				</div>
				<div>
						<input type="submit" name="submit" value="Submit" />
				</div>
			</form>	
		</main>
	</body>
</html>