var video_playList = [];
var currentObj ;
var refreshIntervalId='' ;
var refreshIntervalNotifyId='';
class Videos {
	
  constructor(url,type) {
	  if(refreshIntervalId!=''){
		  clearInterval(refreshIntervalId);
		  clearInterval(refreshIntervalNotifyId);

	  }
	  console.log('OKKK');
	  currentObj = this;
	  currentObj.url = url;
	  currentObj.type = type;// 1 : XML ; 2:JSON
	  currentObj.playList = [];
	  currentObj.loadPlayList();
	  currentObj.el = $('#pub');
	  currentObj.timerElement = $('#pubTimer');
	  currentObj.notifyTime = 0;
	 
	  var vid = document.getElementById("videoPlayer");
	  vid.onended = function() {
			$('#pubTimer').hide(); 
			$('#pub').hide(); 
		};
  }
  notifyVideo(){
	  console.log(currentObj.notifyTime);
	  if(currentObj.notifyTime>0){
		  
		  $('#pubTimer').show(); 
		  $('#pubTimerValue').html(currentObj.notifyTime); 
		  currentObj.notifyTime --;
	  }else
		  $('#pubTimer').hide(); 
		  
  }
  checkVideo(){
	
	  //check if there is a video
	   if(currentObj.playList.length==0)
		   return;
	   var video=currentObj.playList[0];
	   var videoDate =  new Date(video.time);
	   var d = new Date();
		var videoTime = Math.round(videoDate.getTime() / 1000);
		var currentTime =  Math.round(d.getTime() / 1000)
		
		if(videoTime < currentTime){
			window.location.reload(true);
		}
		
		var startVideo = (videoTime === currentTime);
		var notifyTime = videoTime - 30;
		console.log(d);
		console.log(videoDate);
		var notifyToBeStarted = ( currentTime === notifyTime )
		if(startVideo)
			currentObj.loadVideo(video);
		if(notifyToBeStarted)
			currentObj.notifyTime = 30;


	   
  }
  loadVideo(videoItem){
	  $('#pub').show();
	  var vid = document.getElementById("videoPlayer");
	  vid.src = videoItem['link'];
	  vid.play();
	  
	  currentObj.playList.splice(0, 1);
	  $('#pubTimer').hide(); 
  }
  sortPlayListByDate(){
	  if(currentObj.playList.length==0)
		  return;
	  

	  currentObj.playList.sort(function(a, b) {
		  var aDate = new Date(a['time']);
		  var bDate = new Date(b['time']);
		  var val1 = Math.round(aDate.getTime() / 1000);
		  var val2 = Math.round(bDate.getTime() / 1000);
	      return val1 - val2;
	  });
	  
  }
  loadPlayList(){
	  console.log(this.url);
	  if(currentObj.url!='')
		  if(currentObj.type == 1){
			// load from XML
			  $.ajax( {
		            type: "GET",
		            url: currentObj.url,
		            dataType: "xml",
		            success: function(xml) { 
		            	console.log('LOAD');
		            	var video_data_item = $(xml).find('item').each( function(){ 
		            	
		            		var pubDate = $(this).find('title').text();
		            		var link = $(this).find('link').text();
		            		var desc = $(this).find('description').text();
		            		pubDate = pubDate.substring(0,19);
		            		pubDate = pubDate.replace(/_/g,':');
		            		console.log(pubDate);
		            		var videoDate = new Date(pubDate.substring(0,19));
		            		var d = new Date();
		            		
		            		var isToday = (d.toDateString() === videoDate.toDateString() 
		            				&& ( d.getHours() < videoDate.getHours() ||
		            				( d.getHours() == videoDate.getHours() && d.getMinutes() < videoDate.getMinutes() ) )
		            				 
		            				);
		            		// call setHours to take the time out of the comparison
		            		if(isToday) {
		            			var video_data = {
			            				'link': link,
			            				'desc':desc,
			            				'time':pubDate.substring(0,19)
			            				
			            		};
		            			console.log(video_data);
			            		video_playList.push(video_data);
		            		}
		            	} );
		            	currentObj.playList = video_playList;
		            	currentObj.sortPlayListByDate();
		            	if(video_playList.length){
		            		refreshIntervalId = setInterval(currentObj.notifyVideo, 1000);
		            		refreshIntervalNotifyId = setInterval(currentObj.checkVideo, 1000);
		            		console.log(refreshIntervalNotifyId);
		            	}
		           	  
		            }
		        }

          		
		      ); 
			  
		  }else if(this.type == 2){
			  // load from json
			  $.ajax(
						{
						url : currentObj.url,
						beforeSend : function(xhr) {
							xhr.overrideMimeType("text/plain; charset=x-user-defined");
						}
						})
						.done(function(data) {
						 console.log(data);
						}).fail(function(xhr, status, error) {
							// alert("error"+error+"\n"+xhr+"\n"+status);
						});
		  }
	  
  }

  
}
