<?php 
session_start();
// visualizzo il contenuto della pagina solo se è stato effettuato il login
if ($_SESSION['login'] === true) {

require 'config.php'; 
?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title>Salco Italia - Commissione</title>
	<meta charset="utf-8">
	<meta name="robots" content="index, follow" />
	
	<meta name="author" content="Matteo Currò - curromatteo@gmail.com">

	<!-- Dublin Core Metadata : http://dublincore.org/ -->
	<meta name="DC.title" content="Project Name">
	<meta name="DC.subject" content="What you're about.">
	<meta name="DC.creator" content="Matteo Currò - curromatteo@gmail.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<link rel="stylesheet" href="css/style.css">
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>	
	<?php
include_once('menu.php');
?>
<div class="wrapper">
<?php 
// varifico che sia stato un valore tramite get dell'id del cliente
if ( isset($_GET['id']) && !empty($_GET['id']) ) {
	$id = (int)htmlspecialchars($_GET['id']);
	?>


<?php
// effettuo una query per recuperare i dati relativi al cliente con l'id passato in get
	$clienti = query('SELECT * FROM clienti where id = :id LIMIT 1', array('id' => $id), $conn);
	if ($clienti) {
		echo "<h2>Cliente</h2>";
		// ciclo il cliente
		foreach ($clienti as $cliente) {
			// print_r($cliente);
			?>
<!-- pulsante per la stampa -->
<a class="button" onClick="window.print()">Stampa</a>
<a href="edit.php?id=<?php echo $id; ?>" class="button">Modifica</a>


<ol class="single_view_client">
	<li><strong>Cliente:</strong> <?php echo $cliente['nome']; ?></li>
	<li><strong>Indirizzo:</strong> <?php echo $cliente['indirizzo']; ?></li>
	<li><strong>Telefono:</strong> <?php echo $cliente['tel']; ?></li>
	<li><strong>Fax:</strong> <?php echo $cliente['fax']; ?></li>
	<li><strong>Partita Iva:</strong> <?php echo $cliente['piva']; ?></li>
	<li><strong>Spedizione a mezzo:</strong> <?php echo $cliente['spedizione_mezzo']; ?></li>
	<li><strong>Pagamento:</strong> <?php echo $cliente['pagamento']; ?></li>
	<li><strong>Banca:</strong> <?php echo $cliente['banca']; ?></li>
	<li><strong>ABI:</strong> <?php echo $cliente['abi']; ?></li>
	<li><strong>CAB:</strong> <?php echo $cliente['cab']; ?></li>
	<li><strong>Porto:</strong> <?php echo $cliente['porto']; ?></li>
	<li><strong>Consegna anticipata / con decorrenza:</strong> <?php echo $cliente['consegna_decorrenza']; ?></li>
	<li><strong>Agente:</strong> <?php echo $cliente['agente']; ?></li>
	<li><strong>Note:</strong> <?php echo $cliente['note']; ?></li>
	<li><strong>Data:</strong> <?php echo $cliente['data']; ?></li>
	<li><strong>N:</strong> <?php echo $cliente['n']; ?></li>
</ol>
<!-- layout di stampa per la parte relativa al cliente, sono state inserite delle tabelle singole all'interno delle celle per permettere una larghezza variabile di celle che richiami il layout della versione in carta stampata della copia commissione -->
<table class="print_layout">
	<tr>
		<td class="container-td">
            <table>
                <tr>
					<td class="w-33"><span class="th">Cliente/Buyer</span>
						<?php echo $cliente['nome']; ?></td>
					<td class="w-33"><span class="th">Agente/Agent</span>
					<?php echo $cliente['agente']; ?>
					</td>
					<td class="w-11"><span class="th">Spedizione a mezzo/Delivery Throught</span>
					<?php echo $cliente['spedizione_mezzo']; ?></td>
					<td class="w-11"><span class="th">Data/Date</span>
					<?php echo date("d/m/Y", strtotime( $cliente['data'])); ?></td>
					<td class="w-11"><span class="th">N.</span>
					<?php echo $cliente['n']; ?></td>
				</tr>
            </table>
        </td>
	</tr>
	<tr>
		<td class="container-td">
            <table>
                <tr>
					<td class="w-50"><span class="th">Indirizzo/Address</span>
					<?php echo $cliente['indirizzo']; ?></td>
					<td class="w-50"><span class="th">Pagamento/Payement</span>
					<?php echo $cliente['pagamento']; ?></td>
				</tr>
            </table>
        </td>
	</tr>
	<tr>
		<td class="container-td">
            <table>
                <tr>
					<td><span class="th">Banca/Bank</span>
					<?php echo $cliente['banca']; ?></td>
				</tr>
            </table>
        </td>
	</tr>
	<tr>
		<td class="container-td">
            <table>
                <tr>
					<td class="w-25"><span class="th">Tel</span>
					<?php echo $cliente['tel']; ?></td>
					<td class="w-25"><span class="th">Fax</span>
					<?php echo $cliente['fax']; ?></td>
					<td class="w-12"><span class="th">ABI</span>
					<?php echo $cliente['abi']; ?></td>
					<td class="w-12"><span class="th">CAB</span>
					<?php echo $cliente['cab']; ?></td>
					<td class="w-12"><span class="th">Porto/Carriage</span>
					<?php echo $cliente['porto']; ?></td>
					<td class="w-12"><span class="th">Consegna Anticipata/Con decorrenza</span>
					<?php echo $cliente['consegna_decorrenza']; ?></td>
				</tr>
            </table>
        </td>
	</tr>
	<tr>
		<td class="container-td">
            <table>
                <tr>
		<td class="w-50"><span class="th">P.IVA</span>
		<?php echo $cliente['piva']; ?></td>
		<td class="w-50"><span class="th">Notes</span>
		<?php echo $cliente['note']; ?></td>
				</tr>
            </table>
        </td>
	</tr>
</table>
<!-- fine zona relativa al cliente -->
<br><br>

<!-- tabella relativa alle commissioni del singolo cliente -->
<table class="tabella_commissioni">
	<tr>
		<th>Modello / Model</th>
		<th>Tessuto / Fabric</th>
		<th>Colore / Colour</th>
		<th>Taglia / Size</th>
		<th>Totale / Total</th>
		<th>Prezzo / Price &euro;</th>
	</tr>
<?php
// effettuo una query utilizzando l'id cliente passato in get per recuperare tutte le commissioni a lui associate
	$commissioni = query('SELECT * FROM commissioni where id_cliente = :id', array('id' => $cliente['id']), $conn);
	if ($commissioni) {
		echo "<h2>Commissioni</h2>";
		// ciclo le commissioni e stampo una riga della tabella per ciascuna commissione
		foreach ($commissioni as $commissione) {
			// print_r($commissione); ?>
	<tr>
		<td><?php echo $commissione['modello'] ?></td>
		<td><?php echo $commissione['tessuto'] ?></td>
		<td><?php echo $commissione['colore'] ?></td>
		<td><?php echo $commissione['misura'] ?></td>
		<td><?php echo $commissione['totale'] ?></td>
		<td><?php echo $commissione['prezzo'] ?></td>
	</tr>

<?php 
		} // fine foreach relativo alle commissioni
	} //fine if commissioni se la query è andata a buon fine
?>
</table> <!-- fine tabella commissioni -->
<footer>
	<div class="left-50">
		La presente proposta d'ordine è da considerarsi conferita alle condizioni di vendita specificate sul retro ed è subordinata all'approvazione della casa.
	</div>
	<div class="left-25 border-bottom">Firma agente / Agent's signature</div>
	<div class="left-25 border-bottom">Firma cliente / Buyer's signature</div>
</footer>
<?php
		} // Fine if relativo all'id
		// else di sicurezza nel caso in cui l'id passato non sia valido o sia assente
	} else {
		echo "Nessun cliente trovato con l'id specificato.";
	}
?>





<?php } else {?>
<h1>Nessun elemento trovato</h1>
<?php } ?>

<?php
// fine verifica login
} else {
	// die();
	header('LOCATION:login.php'); 
    die();
}
?>

</div>
</body>

</html>