<?php
header('Content-type: application/xml');
//set_include_path(get_include_path(). PATH_SEPARATOR . 'C:\Zend\library'); 
$codigo='http://www.google.com/calendar/feeds/admin%40fundaciolaroda.cat/public/full?alt=jsonc&max-results=10&sortorder=ascending';
$inicurl = curl_init($codigo);
curl_setopt($inicurl,CURLOPT_RETURNTRANSFER, TRUE);
$inicurl = curl_exec($inicurl);
$getwhen = json_decode($inicurl,true);//con true devuelve en array y con false lo devuelve como objeto

$archivo='<?xml version="1.0" encoding="UTF-8"?><feed xmlns="http://www.w3.org/2005/Atom" xmlns:openSearch="http://a9.com/-/spec/opensearchrss/1.0/" xmlns:gCal="http://schemas.google.com/gCal/2005" xmlns:gd="http://schemas.google.com/g/2005">';
for($n=0;$n<count($getwhen['data']['items']);$n++){
	$start=$getwhen['data']['items'][$n]['when'][0]['start'];
	$end=$getwhen['data']['items'][$n]['when'][0]['end'];
	$horaverdadera=substr($start,11,2)-2;//Las horas tienen un formato que salen 2 horas adelantadas asi que saco la hora y le resto 2
	if($horaverdadera==-1)
		$horaverdadera=23;
	$fecha=substr($start,0,10);
	$hora=$horaverdadera.substr($start,13,3);
	$dia=substr($fecha,8,2);
	$mes=substr($fecha,5,2);
	$any=substr($fecha,0,4);
	$fecha=$dia.'/'.$mes.'/'.$any;	
	$evento=$getwhen['data']['items'][$n]['title'].' <br/>[ '.$fecha.' a les '.$hora.' ]';
	$getwhen['data']['items'][$n]['when']=array();
	$getwhen['data']['items'][$n]["evento"]=$evento;//creo un campo evento que contiene el nombre del evento y su horario
	$getwhen['data']['items'][$n]['when']["fecha"]=$fecha;//añado igualmente la fecha del evento
	$getwhen['data']['items'][$n]['when']["hora"]=$hora;
	$getwhen['data']['items'][$n]["descripcio"]='<h1>'.$getwhen['data']['items'][$n]['title'].'</h1><br/><br/>'.$getwhen['data']['items'][$n]['details'].'<br/><br/><h4>L\'event tindrà lloc a:'.$getwhen['data']['items'][$n]['location'].'</h4><br/><a href="'.$getwhen['data']['items'][$n]['alternateLink'].'">Mes informació</a>';
	$pos=strpos($getwhen['data']['items'][$n]['details'],'us convid');
	$grup=substr($getwhen['data']['items'][$n]['details'],0,$pos);
	$datos='<entry><titulo>'.$getwhen['data']['items'][$n]['title'].'</titulo><descripcion>'.$getwhen['data']['items'][$n]['details'].'</descripcion><lugar>'.$getwhen['data']['items'][$n]['location'].'</lugar><enlace>'.$getwhen['data']['items'][$n]['alternateLink'].'</enlace><fecha>'.$getwhen['data']['items'][$n]['when']["fecha"].'</fecha><hora>'.$getwhen['data']['items'][$n]['when']["hora"]=$hora.'</hora><grupo>'.$grup.'</grupo></entry>';
	$archivo=substr_replace($archivo, $datos, strlen($archivo), 0);
	
}
	$archivo=substr_replace($archivo,'</feed>', strlen($archivo), 0);
	echo $archivo;

/*
  if($resultado = strpos($title, "Barcelona")){$icon = "barcelona.jpg";}
elseif($resultado = strpos($title, "Sant Pere de Ribes")){$icon = "santpereribes.jpg";}
elseif($resultado = strpos($title, "Manresa")){$icon = "manresa.jpg";}
elseif($resultado = strpos($title, "Sant Joan Despí")){$icon = "santjoandespi.jpg";}

elseif($resultado = strpos($title, "Sant Joan Despí")){$icon = "hospitalet.jpg";}

elseif($resultado = strpos($title, "Martorell")){$icon = "martorell.jpg";}

elseif($resultado = strpos($title, "Terrassa")){$icon = "terrassa.jpg";}

elseif($resultado = strpos($title, "Hospitalet")){$icon = "hospitalet.jpg";}

elseif($resultado = strpos($title, "Badalona")){$icon = "badalona.jpg";}

elseif($resultado = strpos($title, "Sallent")){$icon = "sallent.jpg";}

elseif($resultado = strpos($title, "Sentmenat")){$icon = "sentmenat.jpg";}

elseif($resultado = strpos($title, "Masquefa")){$icon = "masquefa.jpg";}

elseif($resultado = strpos($title, "Sant Boi del Llobregat")){$icon = "santyboillobregat.jpg";}

elseif($resultado = strpos($title, "Puig-Reig")){$icon = "puifreig.jpg";}
 */
?>
