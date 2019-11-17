var timeIntervalForm;

function setFilter(filter) {
    var theme=filter.replace('filtre', '')
    console.log(theme);
    var myfiltre = "bat" + filter
    console.log(myfiltre);
    $(".voteItem").hide();
    $(".menusalon").hide();
    $(".container-fluid").addClass(myfiltre);
    $(".container-fluid").addClass('ficheProduit');
    $(".container-fluid").removeClass('batimat');
    $(".batimat_top5").hide();
    $(".interclima_top5").hide();
    $(".ideobain_top5").hide();
    $(".batima_body").show();
    $(".topProduit").show();
    $("." + filter).show();
    localStorage.setItem("status", false);
    localStorage.setItem("filter", filter);
    if (filter=='filtre1'){
        $('.carousel-inner').html('<div class="carousel-item bat1_plan1 active"></div><div class="carousel-item bat1_plan2"></div><div class="carousel-item bat1_plan3"></div>');
        $('.container_animate').addClass('video1');
    }
    if (filter=='filtre2'){
        $('.carousel-inner').html('<div class="carousel-item bat2_plan1 active"></div><div class="carousel-item bat2_plan2"></div>');
        $('.container_animate').addClass('video2');
    }
    if (filter=='filtre3'){
        $('.carousel-inner').html('<div class="carousel-item bat3_plan1 active"></div><div class="carousel-item bat3_plan2"></div>');
        $('.container_animate').addClass('video3');
    }
    if (filter=='filtre4'){
        $('.carousel-inner').html('<div class="carousel-item bat4_plan1 active"></div>');
        $('.container_animate').addClass('video4');
    }
    if (filter=='filtre5'){
        $('.carousel-inner').html('<div class="carousel-item bat5_plan1 active"></div><div class="carousel-item bat5_plan2"></div>');
        $('.container_animate').addClass('video5');
    }
    if (filter=='filtre6'){
        $('.carousel-inner').html('<div class="carousel-item bat6_plan1 active"></div><div class="carousel-item bat6_plan2"></div>');
        $('.container_animate').addClass('video6');
    }
    if (filter=='filtre7'){
        $('.carousel-inner').html('<div class="carousel-item bat7_plan1 active"></div><div class="carousel-item bat7_plan2"></div><div class="carousel-item bat7_plan3"></div>');
        $('.container_animate').addClass('video7');
    }
    if (filter=='filtre8'){
        $('.carousel-inner').html('<div class="carousel-item bat8_plan1 active"></div><div class="carousel-item bat8_plan2"></div>');
        $('.container_animate').addClass('video8');
    }
    if (filter=='filtre9'){
        $('.carousel-inner').html('<div class="carousel-item bat9_plan1 active"></div>');
        $('.container_animate').addClass('video9');
    }
    if (filter=='filtre10'){
        $('.carousel-inner').html('<div class="carousel-item bat10_plan1 active"></div>');
        $('.container_animate').addClass('video10');
    }
    if (filter=='filtre11'){
        $('.carousel-inner').html('<div class="carousel-item bat11_plan1 active"></div>');
        $('.container_animate').addClass('video11');
    }
    if (filter=='filtre12'){
        $('.carousel-inner').html('<div class="carousel-item bat12_plan1 active"></div><div class="carousel-item bat12_plan2"></div>');
        $('.container_animate').addClass('video12');
    }
    if (filter=='filtre13'){
        $('.carousel-inner').html('<div class="carousel-item bat13_plan1 active"></div><div class="carousel-item bat13_plan2"></div>');
        $('.container_animate').addClass('video13');
    }
    if (filter=='filtre14'){
        $('.carousel-inner').html('<div class="carousel-item bat14_plan1 active"></div>');
        $('.container_animate').addClass('video14');
    }
    if (filter=='filtre15'){
        $('.carousel-inner').html('<div class="carousel-item bat15_plan1 active"></div><div class="carousel-item bat15_plan2"></div>');
        $('.container_animate').addClass('video15');
    }
    if (filter=='filtre16'){
        $('.carousel-inner').html('<div class="carousel-item bat16_plan1 active"></div><div class="carousel-item bat16_plan2"></div>');
        $('.container_animate').addClass('video16');
    }
    if (filter=='filtre17'){
        $('.carousel-inner').html('<div class="carousel-item bat17_plan1 active"></div><div class="carousel-item bat17_plan2"></div>');
        $('.container_animate').addClass('video17');
    }
    if (filter=='filtre18'){
        $('.carousel-inner').html('<div class="carousel-item bat18_plan1 active"></div><div class="carousel-item bat18_plan2"></div>');
        $('.container_animate').addClass('video18');
    }

    //STATES ENVOIE AJAX
    var format = {
        'theme': theme,
    };
    $.ajax({
        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url: 'http://batimat.napsy.com/web/states', // the url where we want to POST
        data: format, // our data object
        dataType: 'json', // what type of data do we expect back from the server
        encode: true,
        success: function (response) {
            console.log(response);

        },
        fail: function (xhr, status, error) {
            print_debug("Ajax request failed to " + url + "<br>Status: " + xhr.status + " (" + status + "), Error: " + error);

        }
    });
}

function initFilter() {
    localStorage.setItem("click", true);
    document.location.reload(true);
    // vidHide();
}
function mapFilter() {
    $(".body_maps").show();

    var filter =localStorage.getItem("filter")

    var mapfiltre = "map" + filter;
   // var myfiltre = "bat" + filter
    //console.log(myfiltre);

    $("#myModalMap").addClass(mapfiltre);
    /*

    $(".container-fluid").addClass('fichemap');
    $(".container-fluid").removeClass(myfiltre);
    $(".topMap").hide();
    $(".topCalendar").hide();
    $(".batima_body").hide();

    $(".carousel-item").addClass('mapback');
*/
    //STATES ENVOIE AJAX
    var format = {
        'map': 'map',
    };
    $.ajax({
        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url: 'http://batimat.napsy.com/web/states', // the url where we want to POST
        data: format, // our data object
        dataType: 'json', // what type of data do we expect back from the server
        encode: true,
        success: function (response) {
            console.log(response);

        },
        fail: function (xhr, status, error) {
            print_debug("Ajax request failed to " + url + "<br>Status: " + xhr.status + " (" + status + "), Error: " + error);

        }
    });
}
function calendartFilter() {
    // $('#myModalCal').show();
    var filter =localStorage.getItem("filter")
    var mapfiltre = "cal" + filter;
    var myfiltre = "bat" + filter
    console.log(myfiltre);
    $("#myModalCal").addClass(mapfiltre);
   /// $(".container-fluid").addClass('fichecalendar');
    //$(".container-fluid").removeClass(myfiltre);
   // $(".topMap").hide();
    ///$(".topCalendar").hide();
    //$(".batima_body").hide();

//STATES ENVOIE AJAX
    var format = {
        'calendrier': 'calendrier',
    };
    $.ajax({
        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url: 'http://batimat.napsy.com/web/states', // the url where we want to POST
        data: format, // our data object
        dataType: 'json', // what type of data do we expect back from the server
        encode: true,
        success: function (response) {
            console.log(response);

        },
        fail: function (xhr, status, error) {
            print_debug("Ajax request failed to " + url + "<br>Status: " + xhr.status + " (" + status + "), Error: " + error);

        }
    });
}
function showBox(id,produit) {
    console.log('produit '+produit);
    console.log('btn_voteFiche_'+id);
    console.log('btn_voteFiche_'+produit);
    // console.log(p.replace('dog', 'monkey'));
    // $('.btn_voteFiche_'+id).show();
    //nomenclature
    var t=$('#modalimg_'+id).show();
    var nomenclature=t.attr("src");
    //societe
    var titre_prod=$('#titre_'+id);
    //produit
    var m=$('#prod_'+id);
    var produit_img=m.attr("src");
    var nom  = $('#nom_'+id).html();
    var rendufr  = $('#rendufr_'+id).html();
    var renduen  = $('#renduen_'+id).html();
    //horaires
    var myimage = "loreat" + produit;
    //description du produit
    $('#descriptionFR_'+id).show();
    $('.descriptionFR_').show();
    $('#descriptionEN_'+id).show();
    $('#descriptionEN_'+id).show();
    var descFR= $('#descriptionFR_'+id).html();
    var descEN= $('#descriptionEN_'+id).html();
    //console.log(descFR)
    //nom contact
    var nom_contact  = $('#nom_contact_'+id).html();

    var stand  = $('#stand_'+id).html();
    var tel  = $('#tel_'+id).html();
    var email  = $('#email_'+id).html();

    $('#myModal .modal-body .image_produit').html('<img class="image0" src="'+nomenclature+'" />');
    $('#myModal .modal-body .modalTitreProduit').html('<p class="titre_'+produit+'">'+nom+'</p>');
    //$('#program-modal .modal-body .nom').html('<img class="image0" src="'+nomenclature+'" />');
    $('#myModal .modal-body .rendufr').html(rendufr);
    $('#myModal .modal-body .renduen').html(renduen);
    $('#myModal .modal-body .image_loral').addClass(myimage);
    $('#myModal .modal-body .produit_img').html('<img class="image0" src="'+produit_img+'" />');
    $('#myModal .modal-body #btn_vote').html("<img class='ok' onclick='onEnvoie("+id+")' src='../web/images/grille/fiches/bt_ok.png' />");
    $('#myModal .modal-body .produit_descfr').html(descFR);
    $('#myModal .modal-body .produit_descen').html(descEN);
    $('#myModal .modal-body .titre_produits').html(titre_prod);
    $('#myModal .modal-body .stand').html(stand);
    $('#myModal .modal-body .nom_prenom_contact').html(nom_contact);
    $('#myModal .modal-body .tel_contact').html(tel);
    $('#myModal .modal-body .email_contact').html(email);

    //recacher
    $('#modalimg_'+id).hide();
    $('#descriptionFR_'+id).hide();
    $('#descriptionEN_'+id).hide();
    $('.desctop').hide();


    //STATES ENVOIE AJAX
    var format = {
        'produit': id,
    };
    $.ajax({
        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url: 'http://batimat.napsy.com/web/states', // the url where we want to POST
        data: format, // our data object
        dataType: 'json', // what type of data do we expect back from the server
        encode: true,
        success: function (response) {
            console.log(response);

        },
        fail: function (xhr, status, error) {
            print_debug("Ajax request failed to " + url + "<br>Status: " + xhr.status + " (" + status + "), Error: " + error);

        }
    });
}
function onFicheFr() {
    localStorage.setItem("fiche", "fr");
    $('#ficheLien').show();
    $('#en').hide();
    $('#vote').hide();
    $('#label_en').hide();
    $('.en_label1').hide();
    $('.votes').hide();
    $('#fr').show();
    $('.email_doc').show();
    $('#label_bk').show();
    $('.fr_label1').show();
    $('.doc').show();
    $('.description_et_img').hide();
    $('#label_').hide();
}
function onFicheEn() {
    localStorage.setItem("fiche", "en");
    $('#ficheLien').show();
    $('#fr').hide();
    $('#vote').hide();
    $('#label_en').hide();
    $('.votes').hide();

    $('#en').show();
    $('.email_doc').show();
    $('#label_bk').hide();
    $('.fr_label1').hide();

    $('.en_label1').show();
    $('.doc').show();
    $('.description_et_img').hide();
    $('#label_').hide();
}
function onVote() {
    localStorage.setItem("fiche", "vote");
    $('#ficheLien').show();
    $('#fr').hide();
    $('#en').hide();
    $('.email_doc').hide();
    $('.doc').hide();
    $('.fr_label1').hide();
    $('.en_label1').hide();

    $('#vote').show();
    $('.votes').show();
    $('.description_et_img').hide();
    $('#label_bk').hide();
    $('#label_en').show();
}
function onretour() {
    $('.description_et_img').show();
    $('#ficheLien').hide();
}
function onEnvoie (id) {
    if (timeIntervalForm) {
        clearTimeout(timeIntervalForm);
    }
    //VOTE
    if(localStorage.getItem('fiche')=='vote') {

        var phone = $('input.percour-phone').val();
        phone = phone.trim();
        console.log('phone ' + phone.length)
        console.log('id ' + id)
        if (!phone || phone.length !== 10) {
            $('#messages').html('<p class="text-danger">Telephone number required!</p>')

            return false;
        } else {
            $('#ficheLien').html('<div class="container merci"><p class="m1">MERCI !</p><p class="m2">THANK YOU!</p></div>');
            setTimeout(function () {
                localStorage.setItem("click", true);
                document.location.reload(true);
            }, 3000);
        }


        var format = {
            'id': id,
            'phone': phone,
        }
        // var url = config.services.sendPercours +phone;

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: 'http://batimat.napsy.com/web/vote'+phone, // the url where we want to POST
            data: format, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true,
            success: function (response) {

            },
            fail: function (xhr, status, error) {
                print_debug("Ajax request failed to " + url + "<br>Status: " + xhr.status + " (" + status + "), Error: " + error);

            }
        });
    }else {
        var phone = $('input.telephone').val();
        var emailtmp = $('input.email').val();
        console.log('phone ' + phone);
        console.log('emailtmp ' + emailtmp);
        phone = phone.trim();
        var email = emailtmp.trim();
        console.log('phone ' + phone);
        console.log('email ' + email);
        console.log('id ' + id)
        if (!phone && !email) {
            $('#messageDoc').html('<p class="text-danger">Telephone number or Email required!</p>')

            return false;
        } else {
            $('#ficheLien').html('<div class="container merci"><p class="m1">MERCI !</p><p class="m2">THANK YOU!</p></div>');
            setTimeout(function () {
                localStorage.setItem("click", true);
                document.location.reload(true);
            }, 3000);
        }
        var format =[];
        if(localStorage.getItem('fiche')=='fr') {
            format = {
                'id': id,
                'phone': phone,
                'email': email,
                'fr': 'fr',
            }
        }
        if(localStorage.getItem('fiche')=='en') {
            format = {
                'id': id,
                'phone': phone,
                'email': email,
                'en': 'en',
            }
        }
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: 'http://batimat.napsy.com/web/document', // the url where we want to POST
            data: format, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true,
            success: function (response) {
                console.log(response);

            },
            fail: function (xhr, status, error) {
                print_debug("Ajax request failed to " + url + "<br>Status: " + xhr.status + " (" + status + "), Error: " + error);

            }
        });
    }
}
function fermerture(){
    $('.description_et_img').show();
    $('#ficheLien').hide();
    document.getElementById('email').value='';
    document.getElementById('exampleInputtel1').value='';
    document.getElementById('exampleInputPassword1').value='';
    $('.kyebord-number').removeClass('active');
    $('.kyebord-email').removeClass('active');
    $('.kyebord-number1').removeClass('active');
};
function onTop(e) {
    $(".body_top5").show();
    $(".topButton").show();
    $(".topButton").addClass('topReturn');
    $(".topButtonone").hide();
    console.log(e);
    var top = 'top_'+e;
    if (e=='batimat'){
        $(".container-fluid").removeClass('batimat');
        $(".container-fluid").addClass(top);
        $(".menusalon").hide();

    }
    if (e=='ideobain'){
        $(".container-fluid").removeClass('ideobain');
        $(".container-fluid").addClass(top);
        $(".menusalon").hide();
        //$(".ideobain_top5").hide();
    }
    if (e=='interclima'){
        $(".container-fluid").removeClass('interclima');
        $(".container-fluid").addClass(top);
        $(".menusalon").hide();
        //$(".interclima_top5").hide();
    }
}
