<!--
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="main.js"></script>
-->
<?php 
	$firstNames = array( "Valentin", "Pierre", "Roger", "Caroline", "Marie", "Louise", "Valentine", "Clément", "Clémence", "Estelle", "Mathieu", "Sébastien", "Nicolas", "Vincent", "Adrien", "Francis", "Michel", "Alexandre", "Thibault", "Alexis" );
	$lastNames = array( "Ollier", "Mestre", "Mollien", "David", "Cesari", "Malguy", "Belay", "Legall", "Barbaneau", "Fourastié", "Bechereau", "Tang", "Bascoul", "Balandras", "Noguera", "Dumontet", "Mongeot", "Fabre", "Langlois", "Taulelle" );
	$adresses = array( "93, rue Léon Dierx 59160 LOMME", "54, Chemin des Bateliers 20000 AJACCIO", "39, rue Ernest Renan 94600 CHOISY-LE-ROI", "71, Chemin Des Bateliers 16000 ANGOULÊME", "79, avenue de l'Amandier 41000 BLOIS", "87, avenue Voltaire 71000 MÂCON", "99, Faubourg Saint Honoré 64000 PAU", "8, place Stanislas 54100 NANCY", "6, Rue de la Pompe 13700 MARIGNANE", "24, rue Gontier-Patin 80100 ABBEVILLE", "52, avenue de Bouvines 97233 SCHOELCHER", "54, Avenue des Pr'es 57158 MONTIGNY-LÈS-METZ", "10, Rue Roussy 45000 ORLÉANS", "39, rue Sadi Carnot 93600 AULNAY-SOUS-BOIS", "37, rue Jean Vilar 24100 BERGERAC", "75, Rue de Verdun 93370 MONTFERMEIL", "73, Place du Jeu de Paume 91270 VIGNEUX-SUR-SEINE", "21, rue de Lille 92600 ASNIÈRES-SUR-SEINE", "6, rue de l'Aigle 59110 LA MADELEINE", "51, Rue de Verdun 93370 MONTFERMEIL" );
	$phones = array( "055539288940", "038566637289", "002234156378", "222345728000", "111232459728", "334665739900", "236479100009", "222341567211", "134523467781", "136739326573", "223151678345", "242956719980", "291235162212", "100000293857", "666890029778", "231116789333", "123192840726", "436891210021", "123177862211", "009990009990"	);

	$page = $_GET['page'];
	if(isset($page) && !empty($page)) {
		if($page > 500) {
			?>
			<div> You've looped through all the results </div>
			<?php
		} else {

			?>
			<table id="table">
				<caption> Table number <?php echo $page; ?> on 500 </caption>
				<tr>
					<th> First Name </th>
					<th> Last Name </th>
					<th> Adress </th>
					<th> Phone </th>
					<th> Email </th>
					<th> Age </th>
				</tr>
				
				<?php
				for($i = 0; $i < 20; $i++) {
					$firstName = $firstNames[rand(0, count($firstNames) - 1 )];
					$lastName = $lastNames[rand(0, count($lastNames) - 1 )];
					$adress = $adresses[rand(0, count($adresses) - 1 )];
					$phone = $phones[rand(0, count($phones) - 1 )];
					$email = $firstName . "." . $lastName . "@gmail.com";
					$age = rand(18, 66);
					$link = "table.php?page=" . ($page+1);
					?>
					<tr>
						<td> <?php echo $firstName; ?> </td>
						<td> <?php echo $lastName; ?> </td>
						<td> <?php echo $adress; ?> </td>
						<td> <?php echo $phone; ?> </td>
						<td> <?php echo $email; ?> </td>
						<td> <?php echo $age; ?> </td>
					</tr>
					<?php
				}
				?>
			
			</table>

			<a href="<?php echo $link; ?>"> Next </a>

			<div id="script-launcher"> Launch script </div>

			<?php
		}
	} else {
		echo "error, no page param provided";
	}
?>