jQuery(function($){

				
    $.datepicker.regional['fr-CH'] = {
        closeText: 'Fermer',
        prevText: 'Mois précédent',
        nextText: 'Mois suivant',
        currentText: 'Courant',
        monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
        'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
        monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
        'Jul','Aoû','Sep','Oct','Nov','Déc'],
        dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
        dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
        dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
		//color: "#134B84",
        showMonthAfterYear: false,
        yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['fr-CH']);
});

    $.datepicker.setDefaults({
    yearRange: '1927:2030',
	//color: "#134B84",
   // defaultDate: -365*20  
	});

$(function() {
        $( "#from" ).datepicker({
            changeYear: true  // afficher un selecteur d'année
        });
		$( "#to" ).datepicker({
            changeYear: true  // afficher un selecteur d'année
        });
		$( "#date_transaction" ).datepicker({
            changeYear: true  // afficher un selecteur d'année
        });
		$( "#date_reception" ).datepicker({
            changeYear: true  // afficher un selecteur d'année
        });
		$( "#date_vente" ).datepicker({
            changeYear: true  // afficher un selecteur d'année
        });
    $( "#datenais" ).datepicker({
        changeYear: true  // afficher un selecteur d'année
    });
    });   

/*
 $(function() {
 $( "#from" ).datepicker({
 defaultDate: "+1w",
 changeMonth: true,
 numberOfMonths: 1,
 onClose: function( selectedDate ) {
 $( "#to" ).datepicker( "option", "minDate", selectedDate );
 }
 });
 $( "#to" ).datepicker({
 defaultDate: "+1w",
 changeMonth: true,
 numberOfMonths: 1,
 onClose: function( selectedDate ) {
 $( "#from" ).datepicker( "option", "maxDate", selectedDate );
 }
 });
 });



$(document).ready(function () {
	
	jQuery.validator.addMethod("phone2", function (phone, element) {
        phone = phone.replace(/\s+/g, "");
        return this.optional(element) || phone.length > 9 &&
              phone.match(/^\(?[\d\s]{2}-[\d\s]{3}-[\d\s]{2}-[\d\s]{2}$/);
    }, "invalide format(77-777-77-77)");
			  
	jQuery.validator.addMethod("cni", function (identite, element) {
        identite = identite.replace(/\s+/g, "");
        return this.optional(element) || identite.length > 9 &&
              identite.match(/^\(?[\d\s]{13}$/);
    }, "numero invalide (13 chiffres)");
			  
	jQuery.validator.addMethod("nombre_enfants", function (enfants, element) {
        enfants = enfants.replace(/\s+/g, "");
        return this.optional(element) || enfants.match(/^\(?[\d\s]$/);
    }, "tapez un chiffre");
			  
    $('#form1').validate({ //initialize the plugin
        rules: {
            phone_number: {
				required: true,
                phone2: true
            },
			phone_number2: {
                phone2: true
            },
			identite: {
				required: true,
                cni: true
            },
			enfants: {
                nombre_enfants: true
            },
			validate: {
				required: true
            }
        }
    });
	

$("#validate").keyup(function(){

        var email = $("#validate").val();

        if(email != 0)
        {
            if(isValidEmailAddress(email))
            {
                $("#validEmail").css({
                    "background-image": "url('images/ok.png')"
                });
            } else {
                $("#validEmail").css({
                    "background-image": "url('images/no.png')"
                });
            }
        } else {
            $("#validEmail").css({
                "background-image": "none"
            });         
        }

    });

		
	    $(".progress").hide();
		$("#error").hide();	
		$("#error2").hide();	
		$("#succes").hide();
		$("#loader").hide();

});

 
function isValidEmailAddress($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( $email ) ) {
    return false;
  } else {
    return true;
  }
}*/

