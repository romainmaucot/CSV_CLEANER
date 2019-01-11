<?php
include 'function.php';

if(isset($_FILES['csv'])){
	ini_set('display_errors', TRUE);
	$server = $_SERVER['DOCUMENT_ROOT'].'/MAIL_CHECK';
	$dossier = $server.'/upload/';
	$fichier = basename($_FILES['csv']['name']);
	if(move_uploaded_file($_FILES['csv']['tmp_name'], $dossier.$fichier)) {

		// Si la fonction renvoie TRUE, c'est que ça a fonctionné...
		$resultat = '<p>Fichier uploadé !</p><br><br>';
		$download = '<a href="/MAIL_CHECK/correct/'.$_FILES['csv']['name'].'" download class="upload">	Télécharger le csv propre</button></a><br><br>';
		$lignessupp = 'Adresses supprimées : ';
		$lignemodif = 'Adresses modifiées : ';


		// Paramétrage de l'écriture du futur fichier CSV
		// mettre $serveur + $file
		$chemin = $_SERVER['DOCUMENT_ROOT'].'/MAIL_CHECK/correct/'.$_FILES['csv']['name'];
		$delimiteur = ','; // Pour une tabulation, utiliser $delimiteur = "t";

		// Création du fichier csv (le fichier est vide pour le moment)
		// w+ : consulter http://php.net/manual/fr/function.fopen.php
		$fichier_csv = fopen($chemin, 'x+');
		// Si votre fichier a vocation a être importé dans Excel,
		// vous devez impérativement utiliser la ligne ci-dessous pour corriger
		// les problèmes d'affichage des caractères internationaux (les accents par exemple)

		fprintf($fichier_csv, chr(0xEF).chr(0xBB).chr(0xBF));
		?>
		<?
	}else{
		// Sinon (la fonction renvoie FALSE).
		$resultat = '<p class="alert">Echec de l\'upload !</p>';
	}

	//Le chemin d'acces a ton fichier sur le serveur
	$fichier = fopen($dossier.$_FILES['csv']['name'], "r");
	$dossier.$_FILES['csv']['name'];
	//tant qu'on est pas a la fin du fichier :
	$i=1;
	$a=0; // compte le nombre de lignes supprimées
	$b=0; // compte le nombre d'email modifié
	$uneLigne = fgets($fichier);
	$tableauValeurs = explode(",", $uneLigne);
	$nbcol = count($tableauValeurs);

	$c = 0;
  $var = array();

	for ($c = 0; $c <= $nbcol; ++$c) {
$col = $tableauValeurs[$c];
$var[$c] = $c;
echo $var[$c].'<br>';
echo $col.'<br>';
switch ($col) {
	case "id":
			echo "ID col :".$c;
			break;
    case "email":
        echo "Mail col :".$c;
				$nume = $c;
        break;
    case "prenom":
        echo "PRENOM col :".$c;
				$nump = $c;
        break;
    case "nom":
        echo "NOM col:".$c;
				$numn = $c;
        break;
}
}
rewind($fichier);
	while (!feof($fichier)){
		// On récupère toute la ligne
	//	$uneLigne       = addslashes(fgets($fichier));
	$uneLigne = fgets($fichier);
		// On met dans un tableau les différentes valeurs trouvés (ici séparées par un ',')
		$tableauValeurs = explode(",", $uneLigne);

		// Supression des lignes sans email
		if(trim($tableauValeurs[$nume]) == '') {
				$tableauValeurs = '';
			$a++;
		}
		else{

//Suppression accent & caractère spéciaux & Remplacer certains domaines definis
$email = $tableauValeurs[$nume];
$tableauValeurs[$nume] = Mailcheck($tableauValeurs[$nume]);
/// $tableauValeurs[$nume].'<br>';
// Mettre les prénoms et les noms avec première lettre en Majuscule
$tableauValeurs[$nump] = Namecheck($tableauValeurs[$nump]);
//echo $tableauValeurs[$nump].'<br>';
$tableauValeurs[$numn] = Namecheck($tableauValeurs[$numn]);
//echo $tableauValeurs[$numn].'<br>'.'<br>';


	// compte nombre d'email modifiés et ajout d'une colonne dans le csv
$nbcol1 = $nbcol - 1;
if( $email != $tableauValeurs[$nume]){
	$tableauValeurs[$nbcol1] = 'Modif : '.$email."\r";
	$b++;
}
elseif ($i == 1) {
	$z='';
	$tableauValeurs[$nbcol1] = 'Modif'.$z."\r";
}
else {
	$tableauValeurs[$nbcol1] = "\r";
}
//récupères les infos dans un tableau
$lignes = array();
for ($l = 0; $l <= $nbcol1; ++$l) {
    $lignes[] = $tableauValeurs[$l];
}
		print_r($lignes)."<br />";


	fputcsv($fichier_csv, $lignes, $delimiteur);

}

unset($lignes[$i]);
	$i++;
}
}
// fermeture du fichier csv
fclose($fichier_csv);
fclose($fichier);
//Remplacement des '*' en ''
$replace = str_replace('"', "", file_get_contents($chemin) );
file_put_contents($chemin, $replace);

?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Email contrôle</title>

		<!-- CSS -->
		<link rel="stylesheet" href="css/style.css" type="text/css">

		<!-- JS -->
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
		<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="js/reunion-script.js"></script>
	</head>

	<body class="body-general">
		<main>
			<section>
				<article>
					<div class="titre_td">Verification du fichier</div>
					<?php echo $resultat;
					echo $lignessupp; echo $a.'<br>';
					echo $lignemodif; echo $b.'<br><br>';
					echo $download;?>
					<form action="<?=$_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" class="upload">
						<br>
						<input type="file" name="csv" class="upload" required>
						<br/>
						<input type="hidden" name="MAX_FILE_SIZE" value="20000">
						<p class="upload">
							<br>
							<img src="img/upload.png">
							<br>Drag & drop votre fichier ici.
						</p>
						<button type="submit" class="upload">Envoyer le fichier</button>
					</form><br>
				</article>
			</section>
		</main>
	</body>
</html>
