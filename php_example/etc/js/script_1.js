
// ############ jQuery  ############

$(document).ready(function(){
	
// logout	
	$("#aLogout").click(function(event){
		var x = confirm("Có chắc là bạn muốn thoát?");
		if (!x){			 
			event.preventDefault();
		}
	
	});
	
});