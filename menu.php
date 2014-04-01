<header>
	<div class="logo">
		<a href="index.php">
			<!-- <img class="logo_positivo" src="img/logo_positivo.png" alt="Salco Italia"> -->
			<img class="logo_positivo" src="img/logo_negativo.png" alt="Salco Italia">
		</a>
	</div>
</header>

<nav>
	<ul>
	<?php 
		if (isset($_SESSION["user_logedIn"]) && $_SESSION["user_logedIn"] === true) {
	?>
		<li><a href="clients.php">Clienti</a></li>

		<?php if (isset($_SESSION["livello"]) && ($_SESSION["livello"] == 1 || $_SESSION["livello"] == 3)) { ?>
			<li><a href="renewal.php">Renewals</a></li>
		<?php } ?>

		<?php if (isset($_SESSION["livello"]) && $_SESSION["livello"] == 1) { ?>
			<li><a href="reminder.php">Reminder</a></li>
			<li><a href="users.php">Utenti</a></li>
		<?php } ?>

		<li><a href="logout.php">Logout</a></li>

	<?php } else { ?>
		<li><a href="login.php" title="Login">Login</a></li>
	<?php } ?>
	</ul>
</nav>