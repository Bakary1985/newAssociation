// Select an exhibitor in searchbox
function selectExhibitor(exhibitorId, position,hall_id) {
	currentHall = $("#currentHall").val();
	if(hall_id == currentHall){
//	var exhibitor = JSON.parse(unescape(exhibitorId.target.dataset.exhibitor));
	// Display marker
	showMarker (position);
	
	$.ajax({
		type: "POST",
		url: "index.php",
		data:'controler=Exhibitor&action=AjaxGetDetails&id='+exhibitorId,
		success: function(response){
			// Display exhibitor details
			$("#divMark .ajaxExhibitors").html(response);
		},
		fail: function(xhr, status, error) {
			console.log("Ajax request failed to " + url + "<br>Status: " + xhr.status + " (" + status + "), Error: " + error);
		}
	});
	}
	else{
		
		$.ajax({
			type: "GET",
			url: "index.php",
			data:'controler=Exhibitor&action=AjaxGetExhibitorDetails&id='+exhibitorId,
			success: function(response){
				// Display exhibitor details
				$("#stand_hall_info-box").html(response);
			},
			fail: function(xhr, status, error) {
				console.log("Ajax request failed to " + url + "<br>Status: " + xhr.status + " (" + status + "), Error: " + error);
			}
		});
		$("#divMark").hide();
		$("#stand_hall_info").show();
		
	}

	// Close suggestion box
	$("#suggestions").hide();
	// Close suggestion box
	$("#suggestionsListExhibitors").hide();
}

function isInsideSearchBox(el){
	$obj = $(el);

	while (!$obj.hasClass('search') && !$obj.hasClass('container')) {
		$obj = $obj.parent();
	}
	if ($obj.hasClass('search')){
		return true;
	}
	return false;
}
// The user click on an area (stand)
function clickOnArea(event) {
	console.log('clickOnArea');
	//$("#divMark").hide();
	// Get list of exhibitors
	getExhibitors(event);
	// Show the marker
	showMarker(event.target.dataset.position);
	
	return false;
}

// Display a marker on the area selected
function showMarker(datasetPos) {
	// Get position from data-position in area
	var position = datasetPos.split(",");
	var mark = document.getElementById('divMark');
	var image = mark.getElementsByTagName('img')[0];
	
	// Set marker position
	var left = position[0] - image.width/2;
	var top  = position[1] - image.height;
	mark.style.top =  top +'px';
	mark.style.left = left +'px';
	mark.style.display = "block";
	
	//set dialog position 
	var map = document.getElementsByName('plan_img')[0];
	var map_width = map.width;
	var map_height = map.height;
	var ajaxExhibitors_top;
	var ajaxExhibitors_left ;
	console.log('map_width');
	console.log(map_width);
	console.log('map_width/2');
	console.log(map_width/2);
	console.log('left');
	console.log(left);
	if(left>(map_width/2) ){
		if(left>640){
			ajaxExhibitors_left = ' -550px';
		}else{
			ajaxExhibitors_left = ' -100px';
		}
	}else{
		if(left>320){
			ajaxExhibitors_left = ' 100px';
		}else{
			
			ajaxExhibitors_left = ' 100px';
		}
	}
	console.log(top);
	//if(top>(map_height/2) ){
	if(top>750 ){
		ajaxExhibitors_top = ' -475px';
	}else{
		ajaxExhibitors_top = ' 120px';
	}
	var dialogue = document.getElementById('ajaxExhibitors');

	
	dialogue.style.position = "absolute";
	dialogue.style.top =  ajaxExhibitors_top ;
	dialogue.style.left = ajaxExhibitors_left ;
	dialogue.style.zIndex  = 1500;
	

}

// Close exhibitor detail box
function closeDetails() {
	$("#divMark").hide();
}

// Call autocomplete if more than 3 characters
function callAutoComplete(value) {
	var currentHall = $('#currentHall').val();
	if (value.length < 3) {
		$("#suggestions").hide();
	}
	else {	// Autocomplete 
		
		$.ajax({
			type: "POST",
			url: "index.php",
			data:'controler=Exhibitor&action=AjaxAutoComplete&currentHall='+currentHall+'&pattern='+value,
			success: function(response) {
				// Display list of exhibitors
				showExhibitorsList(response);
			}
		});
	}
}

// Show exhibitor list (search engine)
// response : Json response
// letter : letter selected
function showExhibitorsList(response, letter = null,elementId = '#suggestions',elementContentId='#suggestion-box') {
	response = $.parseJSON(response);
	if (!response || 0 === response.length && !letter) {
		$(elementId).hide();
	}
	else {
		var data = '<div class="letter">' + (letter ? "<span>" + letter + "</span>" : '') + '</div>';
		if(elementId=="#ListExhibitors")
			var data = '' 
		
		if (!response || 0 === response.length) {
			data += "Aucun exposant trouvé";
		}
		else {
			data += "<ul class='exhibitor-list'>";
			$.each(response, function (i, item) {
				var execptionStand="";
				var codeStand = item.vch_code;
				if(codeStand!=null && (codeStand.indexOf('S')==0 || codeStand.indexOf('s')==0) )
					execptionStand = 'execptionStand';
				data += '<li class="'+execptionStand+'" onClick="selectExhibitor(' + item.i_id + ',\'' + item.vch_position + '\',\'' + item.hall_id + '\');"><span class="stand_name">' + item.vch_name + '</span><span class="stand_label">' + item.vch_code + '</span></li>';
			});
			data += "</ul>";
		}

		// Add data
		$(elementContentId).html(data);
		// Calculate top position
		var topSuggestionList = $(".search").position().top - $(elementId).height()/2 - 106;
		if(elementId!="#ListExhibitors")
		// Show result list
		$(elementId).css({ top: topSuggestionList + 'px' });
		$(elementId).show();
	}
}

//get list of all exhiborts
function showListExposants(){
	// Make event cross browser


	var url = "index.php?controler=Exhibitor&action=AjaxGetExhibitors";

	if (!url) {
		return true;
	}


	//alert('call showListExposants');
	$.ajax({
		url: url,
		dataType: "html",
		type: "GET",
		success: function(data) {
			$('#autocomplete').val('');
			if (data) {
				//alert('call showExhibitorsList  AJAX');
				showExhibitorsList(data, null,"#ListExhibitors","#ListExhibitors-box");
				var topSuggestionList =1080;

			}
			else {
				
			}
		},
		fail: function(xhr, status, error) {
			//alert("Ajax request failed to " + url + "<br>Status: " + xhr.status + " (" + status + "), Error: " + error);
			console.log("Ajax request failed to " + url + "<br>Status: " + xhr.status + " (" + status + "), Error: " + error);
		}
	});

	return false;
}
// Get list of exhibitors for a stand
function getExhibitors(event) {
	// Make event cross browser
	event = event || window.event;
	event.target = event.target || event.srcElement;
	event.preventDefault = event.preventDefault || function() {
		this.returnValue = false;
	};

	var url = event.target.dataset.href;

	if (!url) {
		return true;
	}

	event.preventDefault();
	//alert('call getExhibitors');
//	console.log("Make Ajax request to " + url);

	$.ajax({
		url: url,
		dataType: "html",
		type: "GET",
		success: function(data) {
			//alert('call getExhibitors AJAX');
			// Display exhibitor details
			$("#divMark .ajaxExhibitors").html(data);
		},
		fail: function(xhr, status, error) {
			//alert("Ajax request failed to " + url + "<br>Status: " + xhr.status + " (" + status + "), Error: " + error);
				console.log("Ajax request failed to " + url + "<br>Status: " + xhr.status + " (" + status + "), Error: " + error);
		}
	});
}

// Get list of exhibitors starts with a letter
function getExhibitorList(event) {
	// Make event cross browser
	event = event || window.event;
	event.target = event.target || event.srcElement;
	event.preventDefault = event.preventDefault || function() {
		this.returnValue = false;
	};

	var url = event.currentTarget.href;

	if (!url) {
		return true;
	}

	event.preventDefault();


	$.ajax({
		url: url,
		dataType: "html",
		type: "GET",
		success: function(data) {
//			console.log (data);
			// Empty search box input
			$('#autocomplete').val('');
			if (data) {
				//alert("call getExhibitorList  AJAX");
				showExhibitorsList(data, event.target.text);
			}
			else {
				
			}
		},
		fail: function(xhr, status, error) {
			//alert("Ajax request failed to " + url + "<br>Status: " + xhr.status + " (" + status + "), Error: " + error);
			console.log("Ajax request failed to " + url + "<br>Status: " + xhr.status + " (" + status + "), Error: " + error);
		}
	});

	return false;
}

function refresh_page() {
	if (new Date().getTime() - time_reload_page >= ReloadPageInterval)
		window.location = "/?controler=Map&action=index&clean=1";
	else
		setTimeout(refresh_page, 30000);
}

function show_screen_saver() {

	if (new Date().getTime() - time_screen_saver >= screenSaverInterval)
		show_screen_saver_animation();
	
	setTimeout(show_screen_saver, 10000);
	
}

function reload_video() {
	if (new Date().getTime() - time_reload_video >= ReloadVideoInterval){
		video_playList = [];
		currentObj = null ;
		
		video = new Videos('http://bsnm.s3.amazonaws.com/vivatechnology2018livedata/4594089ca6ad1844622bd5fd352cd37e',1);
	
		time_reload_video = new Date().getTime();
	}
	setTimeout(reload_video, 30000);
}

function show_screen_saver_animation(){
	hide_screen_saver_animation();
	$("#suggestions").hide();
	$("#suggestionsListExhibitors").hide();
	$("#stand_hall_info").hide();
	$("#dialogScreenSaver").show();
	
	$("#screen_saver1").delay(10).fadeIn("slow");
	
	$("#screen_saver2").delay(1800).fadeIn("slow");
	
	$("#screen_saver3").delay(3200).fadeIn("slow");
	$("#screen_saver3").delay(5000).fadeOut();
	
	$("#screen_saver3").delay(5000).fadeOut(300);
	$("#screen_saver2").delay(5000).fadeOut(500);
	$("#screen_saver1").delay(5000).fadeOut(700);
	
}

function hide_screen_saver_animation(){
	$("#screen_saver1").hide();
	$("#screen_saver2").hide();
	$("#screen_saver3").hide();
	$("#dialogScreenSaver").hide();
}

function hide_popup() {
	if (new Date().getTime() - time_hide_popup >= hidePopupInterval){
		$("#divMark").hide();
		$("#stand_hall_info").hide();
		// Close suggestion box
		$("#suggestions").hide();
		// Close suggestion box
		$("#suggestionsListExhibitors").hide();
	//	$("#virtualKeyboard_").hide();
	}else
		setTimeout(hide_popup, 10000);
}

