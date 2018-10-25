  var BASE_URL = 'http://localhost/project/hris/api/';
  var BASE_URL2 = 'http://localhost/project/hris/';
  
   $.idleTimer(3300000);
	//localStorage.setItem("Token",'');
    $(document).bind("idle.idleTimer", function(){
   window.location.href = BASE_URL2+"index.html";localStorage.setItem("Token",''); 
});
    
if(!localStorage.getItem("Token") || (localStorage.getItem("Token")==='undefined' )){
window.location.href = BASE_URL2+"index.html";
}

