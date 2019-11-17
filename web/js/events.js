// prevent event when the modal is about to hide
var intervalREF, intervalReload;
if(localStorage.getItem('click')=='true'){
    $('#videoPlayer').hide();
}
if(localStorage.getItem('click')=='false'){
    $('#videoPlayer').show();
}

function setKeyboards (obj, identifiant, type='azeri'){
    console.log(identifiant);
    $('.kyebord-number').removeClass('active')
    $('.kyebord-email').removeClass('active')
    $(identifiant).jkeyboard({
        input: obj,
        layout :  type
    });
    $(identifiant).addClass('active')
    $(identifiant+' .jkeyboard-close').click(function () {
        $(identifiant).removeClass('active')
    })
}

function vidHide() {
    $('#videoPlayer').hide();
}
//vidHide();
//stop refresch of page
$('body').click(function(e) {
    console.log('body ...........')
    initReload();
});
function initReload() {
    clearInterval(intervalReload);
    intervalReload = setInterval(ReloadMyPage, 240000);//240000
    console.log('initReload ...........')
}
initReload();
function ReloadMyPage(){

    console.log('rrrrrrrrrrrrrrrr');
    localStorage.setItem("click", false);
    document.location.reload(true);
    $('.resultat #videoPlayer').hide();
}

setTimeout(vidHide, 12000)
