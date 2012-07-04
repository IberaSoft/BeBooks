<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr">
  <head>
    <title>Buscar </title>
    <!-- Contenido -->
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="Content-Language" content="es" />
    <meta http-equiv="last-modified" content="23/07/2009 20:58:21" />
    <meta http-equiv="Content-Type-Script" content="text/javascript" />
    <meta name="description" content="Un lugar donde podras publicar, vender y enterarte de novedades del mundo del libro..." />
    <meta name="keywords" content="libro novelas publicar comprar" />
    <!-- Posicionamiento -->
    <meta http-equiv="Expires" content="0" />
    <meta name="Resource-Type" content="document" />
    <meta name="Distribution" content="global" />
    <meta name="Robots" content="index, follow" />
    <meta name="Revisit-After" content="21 days" />
    <meta name="Rating" content="general" />
    <!-- RSS Feed -->
    <link rel="alternate" type="application/rss+xml" title="Noticias" href="http://www.bebooks.es/x5rssfeed.xml" />
    <!-- Otros -->
    <meta name="Author" content="IberaSoft" />
    <meta name="Generator" content="" />
    <meta http-equiv="ImageToolbar" content="False" />
    <meta name="MSSmartTagsPreventParsing" content="True" />
    <link rel="Shortcut Icon" href="favicon.ico" type="image/x-icon" />
    <!-- Mapa del Sitio -->
    <link rel="sitemap" href="sitemap.xml" title="Mapa general del sitio" />
    <!-- Resoluciones -->
    <script type="text/javascript" src="res/x5engine.js"></script>
    <link rel="stylesheet" type="text/css" href="res/styles.css" media="screen, print" />
    <link rel="stylesheet" type="text/css" href="res/template.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="res/print.css" media="print" />
    <!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="res/iebehavior.css" media="screen" /><![endif]-->
    <script type="text/javascript" src="res/x5cart.js"></script>
    <link rel="stylesheet" type="text/css" href="res/handheld.css" media="handheld" />
    <link rel="alternate stylesheet" title="Alto contraste - Accesibilidad" type="text/css" href="res/accessibility.css" media="screen" />
  </head>
  <body>
    <div id="imSite">
      <div id="imHeader">	 	<h1>BeBooks</h1>
        <div style="left: 737px; top: 82px; width: 224px; height: 21px; ">
          <form id="imSearch_01" action="imsearch.php" method="get" style="white-space: nowrap">
            <fieldset>
              <input type="text" name="search" value="" style="width: 145px; font: 11px Tahoma; color: #000000; background: #FFFFFF url('res/imsearch.gif') no-repeat 3px; padding: 3px 3px 3px 21px; border: 1px solid #000000; vertical-align: middle" />
              <span style="font: 11px Tahoma; color: #000000; background-color: #C0C0C0; padding: 3px 6px 3px 6px; border: 1px solid #000000; vertical-align: middle; cursor: pointer; " onclick="imGetLayer('imSearch_01').submit();" >Buscar
              </span>
              </fieldset>
          </form>
        </div>
        <div id="imMEObj_20" style="left: 898px; top: 34px; width: 22px; height: 32px;" onclick="imOpenLocation('javascript:window.external.AddFavorite(\'http://bebooks.es\',\'BeBooks\');')" >
        </div>
        <div id="imMEObj_30" style="left: 937px; top: 36px; width: 19px; height: 31px;" onclick="imOpenLocation('x5rssfeed.xml')" >
        </div>
      </div>
      <div class="imInvisible">
        <hr />
        <a href="#imGoToCont" title="Saltar el men� principal">Ir al Contenido</a>
      </div>
      <div id="imBody">
        <div >
          <!-- Menu START -->
          <a name="imGoToMenu"></a>
          <p class="imInvisible">Men� Principal:
          </p>
          <div id="imMnMn">
            <ul>	<li>
              <a href="home.html" title="">Principal</a></li><li>
              <a href="publi_libros.html" title="">Publicar</a></li><li>
              <a href="nosotros.html" title="">Nosotros</a></li>	<li>
              <a href="contacto.html" title="">Contacto</a></li>	<li>
              <a href="foro/index.php" title="">Foros</a></li>	<li>
              <a href="blog/index.php" title="">Blog</a></li><li>
              <a href="catalogo.html" title="">Catalogo</a></li>
            </ul>
          </div>
          <!-- Menu END -->
        </div>
        <hr class="imInvisible" />
        <a name="imGoToCont"></a>
        <div id="imContent">
<?php
$files = array("home.html","catalogo.html","foros.html","contacto.html","nosotros.html");
          ?>
          <div id="imSText">
<?php
	$domain = "";
	$search = trim($_GET['search']);
	$page = $_GET['page'];
	if($page == "")
		$page = 0;
	else
		$page--;
	if($search != "") {
		$queries = explode(" ",$search);
		foreach($files as $filename) {
			$count = 0;
			$weight = 0;
			$file_content = implode("\n",file($filename));
			$starttitle = strpos($file_content,"<title>") + 7;
			$endtitle = strpos($file_content,"</title>");
			if(($starttitle != false) && ($endtitle != false)) {
				foreach($queries as $query) {
					$title = substr($file_content,$starttitle,$endtitle-$starttitle);
					while (($title = stristr($title, $query)) !== false) {
						$weight += 4;
						$title = substr($title,strlen($query));
					}
				}
			}
			$page_pos = strpos($file_content,"<!-- Page START -->")+19;
			$page_end = strpos($file_content,"<!-- Page END -->");
			if($page_pos != false && $page_end != false)
				$file_content = substr($file_content,$page_pos, $page_end-$page_pos);
			$file_content = strip_tags($file_content);
			foreach($queries as $query) {
				$file = $file_content;
				while (($file = stristr($file, $query)) !== false) {
					$count++;
					$weight++;
					$file = substr($file,strlen($query));
				}
			}
			if($count > 0) {
				$found_count[$filename] = $count;
				$found_weight[$filename] = $weight;
			}
		}

		if($found_count != null) {
			arsort($found_weight);
			$i = 0;
			$pagine = ceil(count($found_count)/10);
			if(($page >= $pagine) || ($page < 0))
				$page = 0;
			echo "		<div class=\"imSLabel\"><div id=\"imSPageTitle\"><strong>Encontrado</strong> para <i>". $search ."</i></div><strong>" . ($page*10+1) . "-" . (count($found_count)<($page+1)*10? count($found_count):($page+1)*10) . "</strong> para <strong>"  . count($found_count) . "</strong></div>\n";
			foreach($found_weight as $name => $weight) {
				$count = $found_count[$name];
				$i++;
				if(($i > $page*10) && ($i <= ($page+1)*10)) {
					$file = implode(" ",file($name));
					$starttitle = strpos($file,"<title>") + 7;
					$endtitle = strpos($file,"</title>");
					if(($starttitle != false) && ($endtitle != false))
						$title = substr($file,$starttitle,$endtitle-$starttitle);
					else
						$title = $name;
					$page_pos = strpos($file,"<!-- Page START -->")+19;
					$page_end = strpos($file,"<!-- Page END -->");
					if($page_pos != false && $page_end != false)
						$file = substr($file,$page_pos, $page_end-$page_pos);
					$file = strip_tags($file);
					$ap = 0;
					$filelen = strlen($file);
					$text = "";
					for($j=0;$j<($count > 6 ? 6 : $count);$j++) {
						$minpos = $filelen;
						foreach($queries as $query) {
							if(($pos = strpos(strtoupper($file),strtoupper($query),$ap)) !== false) {
								if($pos < $minpos) {
									$minpos = $pos;
									$word = $query;
								}
							}
						}
						$prev = explode(" ",substr($file,$ap,$minpos-$ap));
						if(count($prev) > ($ap > 0 ? 9 : 8))
							$prev = ($ap > 0 ? implode(" ",array_slice($prev,0,8)) : "") . " ... " . implode(" ",array_slice($prev,-8));
						else
							$prev = implode(" ",$prev);
						$text .= $prev . "<strong>" . substr($file,$minpos,strlen($word)) . "</strong> ";
						$ap = $minpos + strlen($word);
					}
					$next = explode(" ",substr($file,$ap));
					if(count($next) > 9)
						$text .= implode(" ",array_slice($next,0,8)) . "...";
					else
						$text .= implode(" ",$next);
					echo "			<div class=\"imSTitle\"><a href=\"" . $name . "\">" . $title . "</a> <span class=\"imSCount\">(" . $count . " " . ($count > 1 ? "Resultados" : "Resultado") . ")</span></div>" . $text . "<div class=\"imSLink\"><a href=\"" . $name . "\">" . $domain . $name . "</a></div>\n";
				}
			}
			echo "  <div class=\"imSLabel\">&nbsp;</div>\n";
			if ($pagine > 1) {
				echo "			P�gina ";
				for($i = 1; $i <= $pagine; $i++)
					if($i != $page+1)
						echo "<a href=\"imsearch.php?search=" . $search . "&page=" . $i . "\">" . $i . "</a> ";
					else
						echo "<strong>" . $i . "</strong> ";
				echo "\n";
			}
		}
		else
			echo "  <div style=\"text-align: center; font-weight: bold; \"><strong>No encontrado</strong></div>\n";
	}
            ?>
          </div>
          <div id="imSBox">
            <form action="imsearch.php" method="get">
              <fieldset>
                <input type="text" name="search" value="<?php echo $_GET['search']; ?>"/>
                <input id="imSButton" type="submit" value="Buscar" />
                </fieldset>
            </form>
          </div><br />
        </div>
        <!-- Copiright -->
        <div id="imFooter" style="text-align:center;">&#169; Copyright 2009 | Juan Cruz | Dani | Rosa
        </div>
        <!-- Fin Copiright -->
      </div>
    </div>

    <div id="imToolTip">
<script type="text/javascript">var imt = new IMTip;</script>
    </div>
  </body>
</html>