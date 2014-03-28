<div class="search clearfix">
	<form action="" method="get">
		<div class="left-50">
		<label for="nome">Nome</label>
		<input type="text" name="nome" placeholder="Nome"><br>
		<label for="cognome">Cognome</label>
		<input type="text" name="cognome" placeholder="Cognome">
		<label for="codice">Codice</label>
		<input type="text" name="codice" placeholder="Codice">
		</div>

		<div class="left-50">
		<label for="citta">Citt&agrave;</label>
		<select name="citta" id="">
			<option value="">-Seleziona Citt&agrave;-</option>
		<?php
		// effettuo una query per recuperare i dati relativi ai clienti
			$clienti = query('SELECT DISTINCT citta FROM clienti ORDER BY citta ASC', array(), $conn);
			if ($clienti) {
				foreach ($clienti as $cliente) { ?>
					<option value="<?php echo $cliente['citta']; ?>"><?php echo $cliente['citta']; ?></option>
				<?php }
			} ?>
		</select><br>
		<?php if (isset($_SESSION["livello"]) && $_SESSION["livello"] == 1) { ?>
		<label for="user_id">Utente</label>
		<select name="user_id" id="">
			<option value="">-Seleziona Utente-</option>
		<?php
		// effettuo una query per recuperare i dati relativi ai clienti
			$utenti = query('SELECT id, nome, cognome FROM utenti ORDER BY cognome ASC', array(), $conn);
			if ($utenti) {
				foreach ($utenti as $utente) { ?>
					<option value="<?php echo $utente['id']; ?>"><?php echo $utente['cognome'].' '.$utente['nome']; ?></option>
				<?php }
			} ?>
		</select><br>
		<label for="recall">Recall</label>
		<input name="recall" type="checkbox" value="1">
		<?php } ?>
		</div>
		<button type="submit">Cerca</button>
	</form>
</div>