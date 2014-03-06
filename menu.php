<header>
	<div class="logo">
		<a href="index.php">
			<img class="logo_positivo" src="img/logo_positivo.png" alt="Salco Italia">
			<img class="logo_negativo" src="img/logo_negativo.png" alt="Salco Italia">
		</a>
	</div>
	<div class="contact">
		<p>Via G. Carducci, 6 - 50053 Empoli (Firenze) - Tel 0039 0571 72674 Fax 0039 0571 79891 - info@salcoitalia.it - www.salcoitalia.it - P.I. 03441360488</p>
	</div>
</header>

<nav>
	<ul>
		<li><a href="index.php">Clienti</a></li>
		<li><a href="users.php">Utenti</a></li>
		<li><a href="form.php">Reminder</a></li>
		<?php 
		  if (isset($_SESSION["user_logedIn"]) && $_SESSION["user_logedIn"] === true) {
		?>
		<li><a href="logout.php">Logout</a></li>
		<?php } ?>
	</ul>
</nav>