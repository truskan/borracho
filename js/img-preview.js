$(document).ready(function(){

	function readURL(input) {
    	if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $('#foto-preview').attr('src', e.target.result);
	        }
		    	reader.readAsDataURL(input.files[0]);
		}
	}
	//$(".foto-preview").hide();
	$("#foto").change(function() {
		$(".foto-preview").show();
	    readURL(this);
	});

});