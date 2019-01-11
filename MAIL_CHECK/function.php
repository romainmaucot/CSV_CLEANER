
<?
$str = 'a@a_com';
//check EMAIL
function Mailcheck($str) {
	$translit = array('Á'=>'A','À'=>'A','Â'=>'A','Ä'=>'A','Ã'=>'A','Å'=>'A','Ç'=>'C','É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E','Í'=>'I','Ï'=>'I','Î'=>'I','Ì'=>'I','Ñ'=>'N','Ó'=>'O','Ò'=>'O','Ô'=>'O','Ö'=>'O','Õ'=>'O','Ú'=>'U','Ù'=>'U','Û'=>'U','Ü'=>'U','Ý'=>'Y','á'=>'a','à'=>'a','â'=>'a','ä'=>'a','ã'=>'a','å'=>'a','ç'=>'c','é'=>'e','è'=>'e','ê'=>'e','ë'=>'e','í'=>'i','ì'=>'i','î'=>'i','ï'=>'i','ñ'=>'n','ó'=>'o','ò'=>'o','ô'=>'o','ö'=>'o','õ'=>'o','ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u','ý'=>'y','ÿ'=>'y');
	$str = strtr($str, $translit);
  $str  = str_replace("gmail.fr", "gmail.com", $str);
  $str  = str_replace("gamil.com", "gmail.com", $str);
  $str  = str_replace("gmil.com", "gmail.com", $str);
  $str  = str_replace("gmial.com", "gmail.com", $str);
  $str  = str_replace("gmai.com", "gmail.com", $str);
  $str  = str_replace("wanadoo.com", "wanadoo.fr", $str);
  $str  = str_replace("wanadou.fr", "wanadoo.fr", $str);
  $str  = str_replace("wannadoo.fr", "wanadoo.fr", $str);
  $str  = str_replace("wandoo.fr", "wanadoo.fr", $str);
  $str  = str_replace("wanaddo.fr", "wanadoo.fr", $str);
  $str  = str_replace("hotamil.com", "hotmail.com", $str);
  $str  = str_replace("hotmil.com", "hotmail.com", $str);
  $str  = str_replace("hotmail.com", "hotmail.com", $str);
  $str  = str_replace("hotmial.com", "hotmail.com", $str);
  $str  = str_replace("hotmai.com", "hotmail.com", $str);
  $str  = str_replace("hotlook.com", "outlook.com", $str);
  $str  = str_replace("hotmai.fr", "hotmail.fr", $str);
  $str  = str_replace("orage.fr", "orange.fr", $str);

  // Supprime retour chariot
  $str = str_replace("\n","",$str);
  $str = str_replace("\r","",$str);
  $str = str_replace("\t","",$str);

 // Affiche : @example.com
 $domain1 = strstr($str, '@');
 $domain2 = str_replace('_', '-', $domain1);
 $str = str_replace($domain1,$domain2, $str);
 $str = str_replace("'", '', $str);
 if ($domain2 === '@gmail.co'){
	 $str  = str_replace("gmail.co", "gmail.com", $str);
 }
  	return preg_replace('#[(\)\<\>\,\:\"\[\]\|\ç\%\ \&]#', '', $str);
    return preg_replace(';', '.', $str);
}



//check NOM & PRENOM
function Namecheck($str) {
  $str  = ucfirst(strtolower($str));
  $str = str_replace(';', '.', $str);
  $str = str_replace(' ', '', $str);
  $str = str_replace('"', '', $str);
  return $str;
}
?>
