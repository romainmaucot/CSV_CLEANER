Il faudrait qu’on puisse importer un CSV et qu’on ressorte un autre CSV propre.
 
Voilà les contrôle que je vois :
o	Réécriture des domaines les plus connus (ex. gmail.fr -> gmail.com) 
o	Function str_replace sur les gmil.com, outlouck, wanadou, aliseadsl,…
o	Je te ferrais une liste de ceux que je rencontre souvent
o	Uniformiser la case sur les prénoms et les noms 
o	Majuscule en début et minuscule pour le reste (en tenant compte des espaces et tirets)
o	Supprimer les caractères non tolérés sur l’email 
o	Remplacement des accents
o	Suppression des espaces ou tabulations
o	Suppression des ‘ et "
o	Remplacer les ; par des .
o	Remplacer les _ par des tirets dans les domaines
o	Créer une colonne type « a corriger » dans le csv pour les noter les lignes ou on retrouve des caractères spéciaux <, .., % , etc
-	Supprimer les doublons
-	Supprimer les lignes si pas d’adresse email
 
L’idée après traitement serait d’afficher le nombre d’adresse modifiée et le nombre d’adresse supprimée et enfin un bouton pour télécharger le nouveau fichier.
