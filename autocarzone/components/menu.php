<?php

// $expiration = time() - 3600;
// $menu_html_cache = "cache/m-".$_SESSION['u']['utilisateur'].".html";

// if(file_exists($menu_html_cache) && filemtime($menu_html_cache) > $expiration) {
	// include($menu_html_cache);
// } else {
	// ob_start();
	// $menu_html = '<ul id="mainmenu" class="sf-menu">';
	// $menu_html .= '<li class="current"><a href="tableaudebord">Tableau de Bord</a></li>';
	// $m = new menu();
	// $topmenu = $m->getMenus();
	// foreach($topmenu as $tm) {
		// $menu_html .= "<li><a href=\"$tm->lienmenu\">$tm->titremenu</a>";
		// if($m->isParent($tm->id)) $menu_html .= $m->afficheMenus($tm->id); 
		// $menu_html .= '</li>';
	// }
	// $menu_html .= '</ul>';
	// echo($menu_html);
	// $menu_html = ob_get_contents();
	// ob_end_clean();
	// file_put_contents($menu_html_cache, $menu_html);
	// echo($menu_html);
//}
global $lang;
global $user;
global $app;


if($app->checkSession())
	if($user->isAdministrator()) {
	
	$autocar = new mdr;
	$nb = $autocar->getNbAutocariste();
?>
<?php
	$autoca = new mdr;
	$autocaristes = $autoca->getrecent();
	//$c = new mdr;
	//var_dump($autocaristes); die;
?>
<nav class="global">
	<ul class="clearfix">
		<li class="active"><a class="nav-icon icon-house" href="<?php echo $app->urlIndex; ?>">Overview</a></li>
		<li><a class="nav-icon icon-time" href="?view=activites">Derniere Activite</a></li>
		<li><a class="nav-icon icon-book" href="?view=autocaristes"><span><?php echo $nb; ?></span>Autocaristes</a></li>
		<li><a class="nav-icon icon-tick" href="?view=payements"><span>0</span>Payements</a></li>
		<li><a class="nav-icon icon-add" href="?view=forms">Ajouter</a></li>
		<!--<li><a class="nav-icon icon-note" href="notes.html">Notes</a></li>-->
	</ul>
</nav>

<nav class="subnav recent">
	<h4>Nouvelles inscriptions</h4>
	<ul class="clearfix">
	 <?php foreach($autocaristes as $a) { ?>
		<li>
			
			<a class="contact" href="?view=forms&id=<?php echo $a->mdr_id; ?>"><h5><?php echo $a->mdr_nom; ?></h5><h6><?php echo $a->mdr_adresse; ?></h6></a>
			<div class="tooltip left">
				<span class="avatar">
				</span>
				<h5><?php echo $a->mdr_nom; ?></h5>
				<h6><?php echo $a->mdr_presentation; ?></h6>
				<address><?php echo $a->mdr_email; ?></address>
			</div>
		</li>
			<?php } ?>
	</ul>
</nav>
<!--
<nav class="subnav">
	<h4>Style Templates</h4>
	<ul class="clearfix">
		<li><a href="layouts.html">Layouts</a></li>
		<li><a href="styles.html">Styles</a></li>
		<li><a href="forms.html">Forms</a></li>
		<li><a href="tables.html">Tables</a></li>
	</ul>
</nav>-->
<?php 
	} else {
	
	
	
	}
?>
                