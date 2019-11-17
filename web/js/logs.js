class logs {
	
  constructor() {
	  this.url = "http://forumlabo.napsy.com/?controler=log";
	  this.key = "FORUMLABO-LOG";
	  this.queryData = "";
  }
  log(){
	  console.log(this.queryData);
	  if(this.queryData!='')
	  $.ajax(
		{
		url : this.url+ this.queryData,
		beforeSend : function(xhr) {
			xhr.overrideMimeType("text/plain; charset=x-user-defined");
		}
		})
		.done(function(data) {
		//	console.log("log added:"+queryData);
		}).fail(function(xhr, status, error) {
			//alert("error"+error+"\n"+xhr+"\n"+status);
		});
  }
  setQueryData(val){
	  this.queryData = encodeURI("&key="+this.key+"&value="+val);
  }
  parseObject(obj){
	  try {
		this.queryData = ""; 
		   //check if obj to be logged contains data-log attribute 
	  //console.log("check if obj to be logged contains data-log attribute ");
	  //console.log(obj);
	  if(obj && obj.dataset.log==="true" && obj.dataset.logValue!=""){
		  this.queryData = encodeURI("&key="+this.key+"&value="+obj.dataset.logValue);
		  //console.log(this.queryData);
	  }
	  else{
		  if($(obj).parent())
			  this.parseObject($(obj).parent()[0])
			  else
		  this.queryData = ""; 
	  }
	  } catch (error) {
		  
	  }
	 
  }
}