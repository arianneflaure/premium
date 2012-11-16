var ajax = '_ajax/';
function updateEn(user) {
	var data = $('#form').serialize();
	//alert(data);
	jQuery.ajax({
		type: "POST",
		url: ajax+"addmdr.php",
		data: data,
		cache: false,
		success: function(html){
		
			if(html==""){
				jQuery('#response').html('<span></span>Modification terminée.');
				jQuery('#message').fadeIn("slow");
				//alert('fin');
				setTimeout(function() {
				
					jQuery('#response').fadeOut("slow");
				}, 2000);	
			}
		}
	});
}

function addEn() {
	//var cat = jQuery('#categoria').val();
	//if($('#nombre').val() == ''){
	//	alert('Please fill the name');
	//	return false;
	//}
	//if(cat == '') {
	//	alert('Please select the Category');
	//	return false;
	//}
	var data = $('#form').serialize();
	//alert(data);

	jQuery.ajax({
		type: "POST",
		url: ajax+"addmdr.php",
		data: data,
		cache: false,
		success: function(html){
			if(html==""){
				jQuery('#response').html('<span></span>Ajout terminée.');
				jQuery('#message').fadeIn("slow");
				setTimeout(function() {
					jQuery('#response').fadeOut("slow");
				}, 2000);	
			}
		}
	});
	resetForm($('#form'));	
}

function resetForm(ele) {
	
    $(ele).find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });

}
function deleteEn(id) {
	if (confirm("Voulez vous vraiment supprimer cet enregistrement")) {
		
		jQuery.ajax({
		  type: "POST",
		  url: ajax+"delmdr.php",
		  data: "mdr_id="+id,
		 
		  cache: false,
		  success: function(html){
		    
			//alert('succesfully');
			if(html==""){
				jQuery('#response').html('<span></span>Suppression terminée.');
				jQuery('#message').fadeIn("slow");
				jQuery('#'+id).fadeOut("slow");
				setTimeout(function() {
					$('#'+id).remove();
					//window.location='dashboard.php'
				}, 1000);
			}
		  }
		});	
	} else {
			//alert('Non je supprime pas');
	}
}


function active(id) {
	//if (confirm("Voulez vous vraiment supprimer cet enregistrement")) {
		
		jQuery.ajax({
		  type: "POST",
		  url: ajax+"activemdr.php",
		  data: "mdr_id="+id,//"valid="+valid +","+"
		  
		  cache: false,
		  success: function(html){
		    
			//alert(data);
			if(html==""){
				jQuery('#response').html('<span></span>activation terminée.');
				jQuery('#message').fadeIn("slow");
				/**jQuery('#'+id).fadeOut("slow");
				setTimeout(function() {
					$('#'+id).remove();
					//window.location='dashboard.php'
				}, 1000);**/
			}
		  }
		});	
	//} 
	//else {
			//alert('Non je supprime pas');
	//}
}
