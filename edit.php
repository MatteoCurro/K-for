<?php
session_start();
// visualizzo il contenuto della pagina solo se è stato effettuato il login
if ($_SESSION['login'] === true) {

require 'config.php';

?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title>Salco Italia - Modifica commissione</title>
	<meta charset="utf-8">
	<meta name="robots" content="index, follow" />
	
	<meta name="author" content="Matteo Currò - curromatteo@gmail.com">

	<!-- Dblin Core Metadata : http://dublincore.org/ -->
	<meta name="DC.title" content="Project Name">
	<meta name="DC.subject" content="What you're about.">
	<meta name="DC.creator" content="Matteo Currò - curromatteo@gmail.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <link rel="stylesheet" href="css/style.css">

	<!-- <link rel="stylesheet" href="css/style.css"> -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
<?php
include_once('menu.php');
?>
  <?php 
// varifico che sia stato un valore tramite get dell'id del cliente
if ( isset($_GET['id']) && !empty($_GET['id']) ) {
  $id = (int)htmlspecialchars($_GET['id']);
  ?>
<div class="wrapper">

  <?php
// effettuo una query per recuperare i dati relativi al cliente con l'id passato in get
  $clienti = query('SELECT * FROM clienti where id = :id LIMIT 1', array('id' => $id), $conn);
  if ($clienti) {
    // ciclo il cliente
    foreach ($clienti as $cliente) {
      // print_r($cliente);

      ?>
<form id="copia_commissione" action="process_update.php?id=<?php echo $cliente['id']; ?>" method="POST">
<fieldset class="normale">
  <legend>Cliente</legend>
  <ol>
    <li>
      <label for="name">Cliente / Buyer</label>
      <input id="name" name="name" type="text" placeholder="First and last name" autofocus value="<?php echo $cliente['nome']; ?>">
    </li>
    <li>
      <label for="indirizzo">Indirizzo / Address</label>
      <input id="indirizzo" name="indirizzo" type="text" placeholder="Via Roma 123" value="<?php echo $cliente['indirizzo']; ?>">
    </li>
    <li>
      <label for="tel">Telefono</label>
      <input id="tel" name="tel" type="text" placeholder="Eg. +39 04220000000" value="<?php echo $cliente['tel']; ?>">
    </li>
    <li>
      <label for="fax">Fax</label>
      <input id="fax" name="fax" type="text" placeholder="Eg. +39 04220000000" value="<?php echo $cliente['fax']; ?>">
    </li>
    <li>
      <label for="piva">P.IVA</label>
      <input id="piva" name="piva" type="text" placeholder="Eg. 1234567890" value="<?php echo $cliente['piva']; ?>">
    </li>
  </ol>
</fieldset>
 
<fieldset class="normale">
  <legend>Ordine</legend>
  <ol>
    <li>
      <label for="spedizione_mezzo">Spedizione a Mezzo / Delivery Throught</label>
      <input id="spedizione_mezzo" name="spedizione_mezzo" type="text" placeholder="" value="<?php echo $cliente['spedizione_mezzo']; ?>">
    </li>
    <li>
      <label for="pagamento">Pagamento / Payment</label>
      <input id="pagamento" name="pagamento" type="text" placeholder="Eg. Bonifico" value="<?php echo $cliente['pagamento']; ?>">
    </li>
    <li>
      <label for="banca">Banca / Bank</label>
      <input id="banca" name="banca" type="text" placeholder="Eg. Unicredit Banca - via Roma 123, Milano (MI)" value="<?php echo $cliente['banca']; ?>">
    </li>
    <li>
      <label for="abi">ABI</label>
      <input id="abi" name="abi" type="text" placeholder="Eg. 1234" value="<?php echo $cliente['abi']; ?>">
    </li>
    <li>
      <label for="cab">CAB</label>
      <input id="cab" name="cab" type="text" placeholder="Eg. 12345" value="<?php echo $cliente['cab']; ?>">
    </li>
    <li>
      <label for="porto">Porto / Carriage</label>
      <input id="porto" name="porto" type="text" placeholder="Eg. Genova" value="<?php echo $cliente['porto']; ?>">
    </li>
    <li>
      <label for="consegna_decorrenza">Consegna anticipata / Con decorrenza</label>
      <input id="consegna_decorrenza" name="consegna_decorrenza" type="text" placeholder="Eg. Maggio 2014" value="<?php echo $cliente['consegna_decorrenza']; ?>">
    </li>
  </ol>
</fieldset>
 
<fieldset class="normale">
  <legend>Altro</legend>
  <ol>
    <li>
      <label for="agente">Agente / Agent</label>
      <input id="agente" name="agente" type="text" placeholder="" value="<?php echo $cliente['agente']; ?>">
    </li>
    <li>
      <label for="note">Notes</label>
      <textarea id="note" name="note" type="text" placeholder=""><?php echo $cliente['note']; ?></textarea>
    </li>
    <li>
      <label for="data">Data</label>
      <input id="data" name="data" type="date" placeholder="" value="<?php echo $cliente['data']; ?>">
    </li>
    <li>
      <label for="numero">N</label>
      <input id="numero" name="numero" type="text" placeholder="" value="<?php echo $cliente['n']; ?>">
    </li>
  </ol>
</fieldset>

<?php 
    } 
// fine parte relativa al cliente
?>
<fieldset class="commissioni">
  <legend>Commissione</legend>
<?php
// effettuo una query utilizzando l'id cliente passato in get per recuperare tutte le commissioni a lui associate
  $commissioni = query('SELECT * FROM commissioni where id_cliente = :id', array('id' => $cliente['id']), $conn);
  if ($commissioni) {
    $id_commissione = 900;
    // ciclo le commissioni e stampo una riga della tabella per ciascuna commissione
    foreach ($commissioni as $commissione) {
      // print_r($commissione); ?>


  <ol class="clonedSection commissione" id="commissione_<?php echo $id_commissione++ ?>">
    <a href="#" class="remove_element">Rimuovi</a>
    <li>
      <label for="modello_<?php echo $id_commissione ?>">Modello / Model</label>
      <input id="modello_<?php echo $id_commissione ?>" name="modello_<?php echo $id_commissione ?>" type="text" placeholder="" value="<?php echo $commissione['modello'] ?>">
    </li>
    <li>
      <label for="tessuto_<?php echo $id_commissione ?>">Tessuto / Fabric</label>
      <input id="tessuto_<?php echo $id_commissione ?>" name="tessuto_<?php echo $id_commissione ?>" type="text" placeholder="" value="<?php echo $commissione['tessuto'] ?>">
    </li>
    <li>
      <label for="colore_<?php echo $id_commissione ?>">Colore / Colour</label>
      <input id="colore_<?php echo $id_commissione ?>" name="colore_<?php echo $id_commissione ?>" type="text" placeholder="" value="<?php echo $commissione['colore'] ?>">
    </li>
    <li>
      <label for="misura_<?php echo $id_commissione ?>">Misura / Size</label>
      <select name="misura_<?php echo $id_commissione ?>" >
        <option value="38" <?php if ($commissione['misura'] == "38"): ?> selected="selected"<?php endif; ?>>38</option>
        <option value="40" <?php if ($commissione['misura'] == "40"): ?> selected="selected"<?php endif; ?>>40</option>
        <option value="42" <?php if ($commissione['misura'] == "42"): ?> selected="selected"<?php endif; ?>>42</option>
        <option value="44" <?php if ($commissione['misura'] == "44"): ?> selected="selected"<?php endif; ?>>44</option>
        <option value="46" <?php if ($commissione['misura'] == "46"): ?> selected="selected"<?php endif; ?>>46</option>
        <option value="48" <?php if ($commissione['misura'] == "48"): ?> selected="selected"<?php endif; ?>>48</option>
        <option value="50" <?php if ($commissione['misura'] == "50"): ?> selected="selected"<?php endif; ?>>50</option>
        <option value="52" <?php if ($commissione['misura'] == "52"): ?> selected="selected"<?php endif; ?>>52</option>
        <option value="54" <?php if ($commissione['misura'] == "54"): ?> selected="selected"<?php endif; ?>>54</option>
      </select>
    </li>
    <li>
      <label for="totale_<?php echo $id_commissione ?>">Totate / Total</label>
      <input id="totale_<?php echo $id_commissione ?>" name="totale_<?php echo $id_commissione ?>" type="text" placeholder="" value="<?php echo $commissione['totale'] ?>">
    </li>
    <li>
      <label for="prezzo_<?php echo $id_commissione ?>">Prezzo / Price</label>
      &euro;<input id="prezzo_<?php echo $id_commissione ?>" name="prezzo_<?php echo $id_commissione ?>" type="text" placeholder="1000.00" value="<?php echo $commissione['prezzo'] ?>">
    </li>
  </ol>
<?php 
    } // fine foreach relativo alle commissioni
  } //fine if commissioni se la query è andata a buon fine
?>
  
</fieldset>
<div class="footer_nav">
  <button id="btnAdd">Aggiungi Elemento</button>
  <br><br>
  <button type="submit">Invia</button>
</div>
</form>	
<?php
    } // Fine if relativo all'id
    // else di sicurezza nel caso in cui l'id passato non sia valido o sia assente
  } else {
    echo "Nessun cliente trovato con l'id specificato.";
  }
?>
</div> <!--fine wrapper-->
<div class="risultato"></div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>

// console.log(array_commissioni);

// azioni all'invio del form
$('#copia_commissione').on('submit', function (e) {
  e.preventDefault();
  // creo nuovo array per i dati delle commissioni
  var array_commissioni = new Array();
  array_commissioni[0] = new Array();
  // ciclo le commizzioni e le aggiungo all'array
  $(".commissione").each(function(){
      array_commissioni[0].push( $(this).find('input, select').serializeArray() );
  });

  $(".normale").each(function(){
      array_commissioni.push( $(this).find('input, select, textarea').serializeArray() );
  });
  
  // effettuo la chiamata ajax
  $.ajax({
      type: 'POST',
      url: $('#copia_commissione').attr('action'),
      cache: false,
      // traditional: true,
      data: {
        commissioni: array_commissioni
      },
      success: function(data) {
        // $('.risultato').html(data);
         // window.location.href = 'process.php';
        $('.wrapper').fadeOut(400,function() {
          $(window).scrollTop(0);
          window.location.href = "single.php?id=<?php echo $_GET['id']; ?>"
        });
         return false;
      }
  });
        
});


$('.remove_element').on('click', function(e) {
          e.preventDefault();
          $(this).parent('ol').fadeOut(400, function() {
            $(this).remove();
          })
        });

var newNum = 0;
$('#btnAdd').click(function (e) {
        e.preventDefault();
        
        newNum++;

        $('.commissioni').append('<ol id="commissione_'+newNum+'" class="commissione"><a href="#" class="remove_element">Rimuovi</a><li>'+
      '<label for="modello_'+newNum+'">Modello / Model</label>'+
      '<input id="modello_'+newNum+'" name="modello_'+newNum+'" type="text" placeholder="">'+
    '</li>'+
    '<li>'+
      '<label for="tessuto_'+newNum+'">Tessuto / Fabric</label>'+
      '<input id="tessuto_'+newNum+'" name="tessuto_'+newNum+'" type="text" placeholder="">'+
    '</li>'+
    '<li>'+
      '<label for="colore_'+newNum+'">Colore / Colour</label>'+
      '<input id="colore_'+newNum+'" name="colore_'+newNum+'" type="text" placeholder="">'+
    '</li>'+
    '<li>'+
      '<label for="misura_'+newNum+'">Misura / Size</label>'+
      '<select name="misura_'+newNum+'" >'+
        '<option value="38" ">38</option>'+
        '<option value="40">40</option>'+
        '<option value="42">42</option>'+
        '<option value="44">44</option>'+
        '<option value="46">46</option>'+
        '<option value="48">48</option>'+
        '<option value="50">50</option>'+
        '<option value="52">52</option>'+
        '<option value="54">54</option>'+
      '</select>'+
    '</li>'+
    '<li>'+
      '<label for="totale_'+newNum+'">Totate / Total</label>'+
      '<input id="totale_'+newNum+'" name="totale_'+newNum+'" type="text" placeholder="">'+
    '</li>'+
    '<li>'+
      '<label for="prezzo_'+newNum+'">Prezzo / Price</label>'+
      '&euro;<input id="prezzo_'+newNum+'" name="prezzo_'+newNum+'" type="text" placeholder="1000.00">'+
    '</li>'+
  '</ol>');
        
        $('.remove_element').on('click', function(e) {
          e.preventDefault();
          $(this).parent('ol').fadeOut(400, function() {
            $(this).remove();
          })
        });

        // if (newNum == 5) $('#btnAdd').prop('disabled', 'disabled');
    });
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