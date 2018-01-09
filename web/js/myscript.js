//// Raccourci pour $( document ).ready()

$( document ).ready(function(){
    $('#sansTri').click(function(){
        $('.Rouge').hide("slow");
        $('.Rosé').hide("slow");
        $(".Blanc").hide("slow");
            
        $(".Rouge").delay( 400 ).show("slow");
        $(".Blanc").delay( 400 ).show("slow");
        $(".Rosé").delay( 400 ).show("slow");
    });

    $('#triRouge').click(function(){
        $(".Rouge").hide("slow");
        $(".Blanc").hide("slow");
        $(".Rosé").hide("slow");

        $(".Rouge").delay( 400 ).show("slow");
    });

    $('#triBlanc').click(function(){
        $(".Rouge").hide("slow");
        $(".Blanc").hide("slow");
        $(".Rosé").hide("slow");

        $(".Blanc").delay( 400 ).show("slow");
    });

    $('#triRose').click(function(){
        $(".Rouge").hide("slow");
        $(".Blanc").hide("slow");
        $(".Rosé").hide("slow");

        $(".Rosé").delay( 400 ).show("slow");
    });

    $('.edit-email').hide();
    $('.edit-tel').hide();
    
    $('.btn-edit-email').click(function(){
        if($('.edit-email').is(':visible')){
            $('.edit-email').hide();
        }
        else{
            $('.edit-email').show();
        }
    });

    $('.btn-edit-tel').click(function(){
        if($('.edit-tel').is(':visible')){
            $('.edit-tel').hide();
        }
        else{
            $('.edit-tel').show();
        }
        
    });


    $('.btn-send-edit-email').click(function(){
        var parametre = $("#newEmail").val();
        var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        
        if(emailReg.test(parametre)){
                    // Je définis ma requête ajax
                $.ajax({
                    // Adresse à laquelle la requête est envoyée
                    url: '/compte/edit/email/' + parametre,
    
                    // Le délai maximun en millisecondes de traitement de la demande
                    timeout: 5000,
    
                    // La fonction à apeller si la requête aboutie
                    success: function (data) {
                        alert('Adresse email modifié.');
                    },
    
                    // La fonction à appeler si la requête n'a pas abouti
                    error: function() {
                    }
                });
        }
        else{
            alert('Adresse email incorrect.')
        }       
    });


    $('.btn-send-edit-tel').click(function(){
        var parametre = $("#newTel").val();
        var telReg = /^[0-9]{6,14}$/;
                
        if(telReg.test(parametre)){
                    // Je définis ma requête ajax
                $.ajax({
                    // Adresse à laquelle la requête est envoyée
                    url: '/compte/edit/tel/' + parametre,
    
                    // Le délai maximun en millisecondes de traitement de la demande
                    timeout: 5000,
    
                    // La fonction à apeller si la requête aboutie
                    success: function (data) {
                        alert('Numéro de téléphone modifié.');
                    },
    
                    // La fonction à appeler si la requête n'a pas abouti
                    error: function() {
                    }
                });
        }
        else{
            alert('Numéro de téléphone incorrect.')
        }       
    });

   
    $('#tab-compte a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
      });



});