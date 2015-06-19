
		function changePage(){
			//var selectedNav = x.title;
			var request = createRequest();
			if(request==null){
				alert("Unable to create request");
				return;
			}
			
			request.onreadystatechange = showPage;
			request.open("GET","index.html",true); //true เป็นการเชื่อมต่อแบบ asynchronus
			request.send();
		}

		function createRequest() {
		  try {
		    request = new XMLHttpRequest();
		  } catch (tryMS) {
		    try {
		      request = new ActiveXObject("Msxml2.XMLHTTP");
		    } catch (otherMS) {
		      try {
		        request = new ActiveXObject("Microsoft.XMLHTTP");
		      } catch (failed) {
		        request = null;
		      }
		    }
		  }	
		  return request;
		}
		function showPage(){
			if(request.readyState == 4){
				if(request.status==200){
					document.getElementById('content').innerHTML = request.responseText;
				}
			}
		}