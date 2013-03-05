<!DOCTYPE html 
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="es">
  <head>
<meta http-equiv="content-type" content="text/html; charset=UTF8">
    <title>Listing calendar contents</title>
    <style>
    body {
      font-family: Verdana;
      background-color:#FFF7DB; 
      margin:0px;     
      padding:0px;
    }
    
    ul{
    width:400px;
    margin:0px auto
    }
    li {
      border: solid black 1px;      
      margin: 10px; 
      padding-left:210px;
      width: auto;
      padding-bottom: 20px;
      list-style-type:none;
      min-height: 111px;
      	zoom: 1;
		filter: alpha(opacity=90);
		opacity: 0.9;
    }
    h2 {
      color: red; 
      text-decoration: none;  
    }
    h1{
		font-family: 'Yanone Kaffeesatz', sans-serif;
		margin-top:0px;
		margin-bottom:5px;
		padding-left:35px;
		padding-bottom:10px;
		font-size:46px;
		color:#B271B5;
		text-align:center;
		background-color:#000000;
		
	}
    span.attr {
      font-weight: bolder;  
    }
    </style>   
    <link href='http://fonts.googleapis.com/css?family=Wendy+One' rel='stylesheet' type='text/css'> 
    <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700' rel='stylesheet' type='text/css'>
  </head>
  <body>
	  <div style="float:left;position:fixed;top:30px; right:5px; z-index:-1000"><img src="nub1.png"></div>
	  <div style="float:left;position:fixed;top:230px; right:905px; z-index:-1000"><img src="nub2.png"></div>
	  <div style="float:left;position:fixed;top:330px; right:1305px; z-index:-1000"><img src="nub2.png"></div>
	  <div style="float:left;position:fixed;top:90px; right:1005px; z-index:-1000"><img src="nub3.png"></div>
	  <div style="float:left;position:fixed;top:490px; right:805px; z-index:-1000"><img src="nub3.png"></div>
	  <div style="float:left;position:fixed;top:520px; right:1205px; z-index:-1000"><img src="nub4.png"></div>
	  <div style="float:left;position:fixed;top:10px; right:1405px; z-index:-1000"><img src="nub5.png"></div>
	  <div style="float:left;position:fixed;top:320px; right:205px; z-index:-1000"><img src="nub4.png"></div>
	 <div style="float:left;position:fixed;left:50%;top:50%;z-index:-1200;margin-top: -400px;margin-left: -450px;filter: alpha(opacity=50);opacity: 0.5;"><img src="sun.png"></div>
    <?php

    // build feed URL
    $feedURL = "http://www.google.com/calendar/feeds/admin%40fundaciolaroda.cat/public/full?orderby=starttime&sortorder=descending";
    
    // read feed into SimpleXML object
    $sxml = simplexml_load_file($feedURL);
    
    // get number of events

    ?>
    <h1><?php echo $sxml->title; ?></h1>
    <p/>
    <div style="width:960px;text-alig;margin:0px auto">
    <ol>
    <?php    
    // iterate over entries in category
    // print each entry's details content
   

    $count = 0;
    foreach ($sxml->entry as $entry) {
	$gd = $entry->children('http://schemas.google.com/g/2005');
      $title = stripslashes($entry->title);
      $summary = stripslashes($entry->content);
      $startTime = $entry->xpath('//gd:when/@startTime');    
      $end = $entry->xpath('//gd:when/@endTime');    
      $where = $entry->xpath('//gd:where/@valueString');  

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

else{$icon="null.png";}
      echo "<li style='background: #E4E2D6 url($icon) no-repeat left top;'>\n";

      echo "<h2>$title</h2>\n";
  
			$startTime = '';
            if ( $gd->when ) {
                $startTime = $gd->when->attributes()->startTime;
            } elseif ( $gd->recurrence ) {
                $startTime = $gd->recurrence->when->attributes()->startTime; 
            } 
			setlocale(LC_TIME,"es_ES.utf8");
            print date("d/m/Y h:i:s", strtotime( $startTime ) );
echo " <br> $summary";

      echo "</li>\n";
    }
    ?>
    </ol>
    </div>
  </body>
</html> 
