
<script type="text/javascript"> 
$(document).ready(function(){

/**
 * Modal Dialog Boxes Setup
 */

    var triggers = $(".modalInput").overlay({

        // some mask tweaks suitable for modal dialogs
        mask: {
            color: '#ebecff',
            loadSpeed: 200,
            opacity: 0.7
        },

        closeOnClick: false
    });

    /* Simple Modal Box */
    var buttons1 = $("#simpledialog button").click(function(e) {
	
        // get user input
        var yes = buttons1.index(this) === 0;

        if (yes) {
            // do the processing here
        }
    });

    /* Yes/No Modal Box */
    var buttons2 = $("#yesno button").click(function(e) {
	
        // get user input
        var yes = buttons2.index(this) === 0;

        // do something with the answer
        triggers.eq(1).html("You clicked " + (yes ? "yes" : "no"));
    });

    /* User Input Prompt Modal Box */
    $("#prompt form").submit(function(e) {

        // close the overlay
        triggers.eq(2).overlay().close();

        // get user input
        var input = $("input", this).val();

        // do something with the answer
        if (input) triggers.eq(2).html(input);

        // do not submit the form
        return e.preventDefault();
    });
});
</script> 
<?php
	 
		@session_start();
		require_once 'config.php';
		require_once 'lib/library.php';
		require_once 'camertic/classes/bd.class.php';
		require_once 'lib/classes/entity.class.php';
		require_once 'lib/classes/mdr.class.php';

	   $c = new mdr;
	if(isset($_GET['id'])){
		$en = $c->getRecord($_GET['id']);
	} else {
		$en = new mdr;
		$vars = $en->getAllFields();
		foreach($vars as $var)
			$en->$var = '';
	}
?>

    
    <div id="wrapper" >
        
        
        <section>
            <div class="container_8 clearfix">


                <section class="main-section grid_7">

                    <div class="main-content">
                        <header>
                            <ul class="action-buttons clearfix fr">
                                <li><a href="documentation/index.html" class="button button-gray no-text help" rel="#overlay"><span class="help"></span></a></li>
                            </ul>
                            <h2 class="new">
                                Autocariste
                            </h2>
                        </header>
                        <section class="container_6 clearfix">
                            

                            <form id="form" class="form grid_6" method="post" action="">
                                <fieldset>
                                   <!-- <legend>HTML5 form with validation</legend>-->
                                    <label>Nom </label><input type="text" name="mdr_nom"  id="mdr_nom" value="<?php echo ($en->mdr_nom); ?>"  />
									<label>Comptes</label><input type="text" name="mdr_comptes"  id="mdr_comptes" value="<?php echo ($en->mdr_comptes); ?>"  />
                                    <label>Nom compl </label><input type="text" name="mdr_complement_nom"  id="mdr_complement_nom" value="<?php echo ($en->mdr_complement_nom); ?>"  />
									<label>Adresse</label><input type="text" name="mdr_adresse"  id="mdr_adresse" value="<?php echo ($en->mdr_adresse); ?>"  />
                                    <label>code postal</label><input type="text" name="mdr_cp"  id="mdr_cp" value="<?php echo ($en->mdr_cp); ?>"/>
                                    <label>Ville</label><input type="text" name="mdr_ville"  id="mdr_ville" value="<?php echo ($en->mdr_ville); ?>"  maxlength="12" />
									<label>Ville ced</label><input type="text" name="mdr_ville_ced"  id="mdr_ville_ced" value="<?php echo ($en->mdr_ville_ced); ?>"  maxlength="12" />
                                    <label>Departement</label><input type="text" name="mdr_dep"  id="mdr_dep" maxlength="30" value="<?php echo ($en->mdr_dep); ?>"/>
                                    <label>Telephone</label><input type="text" name="mdr_tel"  id="mdr_tel" maxlength="30" value="<?php echo ($en->mdr_tel); ?>"/>
                                    <label>Fax</label><input type="text" name="mdr_fax"  id="mdr_fax"  value="<?php echo ($en->mdr_fax); ?>"/>
									<label>Categorie</label><input type="text" name="mdr_categorie"  id="mdr_categorie" value="<?php echo ($en->mdr_categorie); ?>"/>
                                    <label>Ville geo lat</label><input type="text" name="mdr_ville_geo_lat"  id="mdr_ville_geo_lat" maxlength="30" value="<?php echo ($en->mdr_ville_geo_lat); ?>"/>
                                    <label>Ville geo long</label><input type="text" name="mdr_ville_geo_long"  id="mdr_ville_geo_long" maxlength="30" value="<?php echo ($en->mdr_ville_geo_long); ?>"/>
									<label>Ville geo num</label><input type="text"  name="mdr_ville_geo_num"  id="mdr_ville_geo_num"  maxlength="30" value="<?php echo ($en->mdr_ville_geo_num); ?>"/>
									<label>Isdeleted</label><input type="text"  name="_isdeleted"  id="_isdeleted"  maxlength="30" value="<?php echo ($en->_isdeleted); ?>"/>
									<label>Etat</label><input type="text" name="etat"  id="etat"  maxlength="30" value="<?php echo ($en->membership); ?>"/>
									<label>Valid</label><input type="text" name="valid"  id="valid"  maxlength="30" value="<?php echo ($en->valid); ?>"/>
									
									<div class="action" style="margin-left: 270px;">
									    <?php if(isset($_GET['id'])) { ?><input type="hidden" name="mdr_id" value="<?php echo $_GET['id']; ?>" id="mdr_id" /><?php } ?>
                                        <button class="green " type="button" <?php if(isset($_GET['id'])) { ?> onclick="updateEn(<?php echo $_GET['id']; ?>);" <?php } else { ?>onclick="addEn();"<?php } ?>><span >VALIDER</span></button>
                                        <!--<button class="button button-gray" type="reset">Reset</button>-->
                                    </div>
                                </fieldset>
                            </form>

                        <div id="message " style="display : none;">
				<div id="response" class="messages green" style="margin: 0px 0px 1px;">
					<span></span>
					This is a successful placed text message.
				</div>
			</div> 
                        </section>
                    </div>

                </section>

                <!-- Main Section End -->

            </div>
            <div id="push"></div>
        </section>
    </div>
  

    

    

	  


<script type="text/javascript" src="js/mdr.js"></script>

