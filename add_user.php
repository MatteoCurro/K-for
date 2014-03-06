<?php
session_start();
// visualizzo il contenuto della pagina solo se è stato effettuato il login
if (isset($_SESSION["user_logedIn"]) && $_SESSION["user_logedIn"] == true) {

require("header.php");

?>

<div class="wrapper">

<h1>Aggiungi utente</h1>
<form id="copia_commissione" action="process_add_user.php" method="POST">
<fieldset class="normale">
  <legend>Cliente</legend>
  <ol>
    <li>
      <label for="nome">Nome</label>
      <input id="nome" name="nome" type="text" placeholder="Es. Mario" autofocus required x-moz-errormessage="Inserisci il nome">
    </li>
    <li>
      <label for="cognome">Cognome</label>
      <input id="cognome" name="cognome" type="text" placeholder="Es. Rossi" required x-moz-errormessage="Inserisci il cognome">
    </li>
    <li>
      <label for="email">E-mail</label>
      <input id="email" name="email" type="email" placeholder="Es. mrossi@gmail.com" required x-moz-errormessage="Inserisci l'e-mail">
    </li>

    <br><br>

    <li>
      <label for="username">Username</label>
      <input id="username" name="username" type="text" placeholder="Es. mrossi" required x-moz-errormessage="Inserisci l'username (verrà usato per l'accesso)">
    </li>
    <li>
      <label for="password">Password</label>
      <input type='password' id='p1' name="password" required x-moz-errormessage="Inserisci la password">

      <label for="password">Confirm Password</label>
      <input type='password' onfocus="validatePass(document.getElementById('p1'), this);" oninput="validatePass(document.getElementById('p1'), this);" required x-moz-errormessage="Inserisci nuovamente la password">
    </li>
    <li>
      <label for="livello">Ruolo</label>
      <select name="livello" required x-moz-errormessage="Inserisci il ruolo">
        <option value="1" selected="selected">Admin</option>
        <option value="2">Agente</option>
        <option value="3">Insegnante</option>
      </select>
    </li>
  </ol>
</fieldset>

<div class="footer_nav">
  <button type="submit">Invia</button>
</div>

</form>	
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