<?php
	 
		@session_start();
		require_once '../config.php';
		require_once '../lib/library.php';
		require_once '../camertic/classes/bd.class.php';
		require_once '../lib/classes/entity.class.php';
		require_once '../lib/classes/mdr.class.php';
		require_once '../lib/classes/users.class.php';
		//$C = new CamerticConfig;
		//$p = new mdr; 
		//$p->saveRecord($_POST);

	// $s= new users; 
	 $c = new mdr;
	if(isset($_GET['id'])){
		$en = $c->getRecord($_GET['id']);
		//$st=$s->getStatut($_GET['id']);
	} else {
		$en = new mdr;
		$vars = $en->getAllFields();
		foreach($vars as $var)
			$en->$var = '';
	}
?>
<div id="message " style="display : none;">
				<div id="response" class="messages green" style="margin: 0px 0px 1px;">
					<span></span>
					This is a successful placed text message.
				</div>
</div>
			<h4 style= "color: #0066FF; font-weight:bold;"><?php echo ($en->mdr_nom); ?> </h4>
<hr />

</div>

<form  id="form"  method="post" action="">
	<ul class="profile-info">
		
		<li >
		<span >Nom Comp</span>
		<?php echo ($en->mdr_complement_nom); ?>
		&nbsp;
		</li>
		<li >
		<span>Adresse</span>
		<?php echo ($en->mdr_adresse); ?>
		&nbsp;
		</li>
		<li >
		<span>Code Postal</span>
		<?php echo ($en->mdr_cp); ?>
		&nbsp;
		</li>
	</ul>

	<ul class="profile-info">
		<li >
		<span>Ville</span>
		<?php echo ($en->mdr_ville); ?>
		&nbsp;
		</li>
		<li>
		<span>Departement</span>
		<?php echo ($en->mdr_dep); ?>
		&nbsp;
		</li>
		<li >
		<span>Telephone</span>
		<?php echo ($en->mdr_tel); ?>
		&nbsp;
		</li>
		<li >
		<span>Categorie</span>
		<?php echo ($en->mdr_categorie); ?>
		&nbsp;
		</li>
		<li >
		<span>Lattitude</span>
		<?php echo ($en->mdr_ville_geo_lat); ?>
		&nbsp;
		</li>
		<li >
		<span>Longitude</span>
		<?php echo ($en->mdr_ville_geo_long); ?>
		&nbsp;
		</li>
		<li>
		<span id="1">Statut</span>
		<?php echo ($en->membership); ?>
		</li>
		&nbsp;&nbsp;
		<hr />
		<div style="float:right;">
		<input type="hidden" name="mdr_id" value="<?php echo $_GET['id']; ?>" id="mdr_id" />
		<input type="hidden" name="valid" value="<?php echo $en->valid; ?>" id="valid" />
		<!--<input type="hidden" name="membership" value="<?php echo $en->membership; ?>" id="membership" />-->
		<button type="button" id="actif" class="green "  onclick="active('<?php echo  $_GET['id']; ?>')"><span>Activer</span></button>
		<button type="button" id="inactif" class="red" onclick="active('<?php echo  $_GET['id']; ?>')"><span>Desactiver</span></button>
		<!--<button type="button" id="free" onclick="active('<?php echo  $_GET['id']; ?>')"><span>free</span></button>
		<button type="button" id="premium" onclick="active('<?php echo  $_GET['id']; ?>')"><span>premium</span></button>-->
		</div>
		<div style="float:left;">
	    <a  href="?view=forms&id=<?php echo $en->mdr_id; ?>">Editer</a>
	    </div>
	</ul>
   </form>
	
	   
	
	
	
	
  <script type="text/javascript">
  var etat=<?php echo ($en->valid); ?>;
  if(etat==1)
		{
		jQuery('#actif').hide("slow");}
        
        
		else if (etat==0){
		jQuery('#inactif').hide("slow");}
		
		
	</script>
	
	<script type="text/javascript" src="js/mdr.js"></script>