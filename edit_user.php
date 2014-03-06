<?php
session_start();
// visualizzo il contenuto della pagina solo se è stato effettuato il login
if (isset($_SESSION["user_logedIn"]) && $_SESSION["user_logedIn"] == true) {

require("header.php");
require 'config.php';

// varifico che sia stato un valore tramite get dell'id del cliente
if ( isset($_GET['id']) && !empty($_GET['id']) ) {
  $id = (int)htmlspecialchars($_GET['id']);
}
  ?>
<div class="wrapper">

  <?php
// effettuo una query per recuperare i dati relativi al cliente con l'id passato in get
  $utenti = query('SELECT * FROM utenti where id = :id LIMIT 1', array('id' => $id), $conn);
  if ($utenti) {
    // ciclo il cliente
    foreach ($utenti as $utente) {
      // print_r($utente);

      ?>

<h1>Aggiungi utente</h1>
<form id="copia_commissione" action="process_edit_user.php?id=<?php echo $utente['id']; ?>" method="POST">
<fieldset class="normale">
  <legend>Cliente</legend>
  <ol>
    <li>
      <label for="nome">Nome</label>
      <input id="nome" name="nome" type="text" placeholder="Es. Mario" autofocus required x-moz-errormessage="Inserisci il nome" value="<?php echo $utente['nome']; ?>">
    </li>
    <li>
      <label for="cognome">Cognome</label>
      <input id="cognome" name="cognome" type="text" placeholder="Es. Rossi" required x-moz-errormessage="Inserisci il cognome" value="<?php echo $utente['cognome']; ?>">
    </li>
    <li>
      <label for="email">E-mail</label>
      <input id="email" name="email" type="email" placeholder="Es. mrossi@gmail.com" required x-moz-errormessage="Inserisci l'e-mail" value="<?php echo $utente['email']; ?>">
    </li>

    <br><br>

    <li>
      <label for="username">Username</label>
      <input id="username" name="username" type="text" placeholder="Es. mrossi" required x-moz-errormessage="Inserisci l'username (verrà usato per l'accesso)" value="<?php echo $utente['username']; ?>">
    </li>
    <li>
      <label for="password">Nuova Password</label>
      <input type='password' id='p1' name="password" x-moz-errormessage="Inserisci la password" placeholder="Lasciare vuoto per non modificare">

      <label for="password">Conferma Password</label>
      <input type='password' onfocus="validatePass(document.getElementById('p1'), this);" oninput="validatePass(document.getElementById('p1'), this);" x-moz-errormessage="Inserisci nuovamente la password" placeholder="Lasciare vuoto per non modificare">
    </li>
    <li>
      <label for="livello">Ruolo</label>
      <select name="livello" required x-moz-errormessage="Inserisci il ruolo">
        <option value="1" <?php if ($utente['livello'] == "1"): ?> selected="selected"<?php endif; ?>>Admin</option>
        <option value="2" <?php if ($utente['livello'] == "2"): ?> selected="selected"<?php endif; ?>>Agente</option>
        <option value="3" <?php if ($utente['livello'] == "3"): ?> selected="selected"<?php endif; ?>>Insegnante</option>
      </select>
    </li>
  </ol>
</fieldset>

<div class="footer_nav">
  <button type="submit">Invia</button>
</div>

</form>	
<?php 
    } 
  }
?>
</div> <!--fine wrapper-->
<div class="risultato"></div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
function validatePass(p1, p2) {
    if (p1.value != p2.value || p1.value == '' || p2.value == '') {
        p2.setCustomValidity('Password non corretta!');
    } else {
        p2.setCustomValidity('');
    }
}

</script>

</body>

</html>

<?php
// fine verifica login
} else {
  // die();
  header('LOCATION:login.php'); 
  die();
}
?>