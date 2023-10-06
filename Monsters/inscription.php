<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link
			href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600"
			rel="stylesheet"
			type="text/css"
		/>
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet" />
		<title>Document</title>
²	<link rel="stylesheet" href="inscription.css">
	</head>
	<body>
		<div class="testbox">
			<h1>Registration</h1>

			<form action="test.php?action=inscription" method="POST">
				<hr />
				<hr />
				<label id="icon" for="name"><i class="icon-envelope"></i></label>
				<input type="text" name="mail" id="mail" placeholder="Email" required />
				<label id="icon" for="name"><i class="icon-user"></i></label>
				<input type="text" name="prenom" id="prenom" placeholder="prenom" required />
				<label id="icon" for="name"><i class="icon-user"></i></label>
				<input type="text" name="nom" id="name" placeholder="nom" required />
				<label id="icon" for="name"><i class="icon-shield"></i></label>
				<input type="password" name="password" id="password" placeholder="Password" required />
				<label id="icon" for="name"><i class="icon-shield"></i></label>
				<input type="password" name="password-chk" id="password-chk" placeholder="Confirm Password" required />
				<input type="submit" value="Envoyer">
			</form>

            <?php 
				if(isset($_POST['mail']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['password-chk'])){
					echo $_POST['mail']. "<br>";
					echo $_POST['name']. "<br>";
					echo $_POST['password']. "<br>";
					echo $_POST['password-chk']. "<br>";
				}
			?>




		</div>
	</body>
</html>
