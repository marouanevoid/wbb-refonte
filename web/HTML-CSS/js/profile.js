$(document).ready(function(){
	alert("This is a Test");
	$('.form-checkbox').iCheck({
		checkboxClass: 'icheckbox_minimal-red',
		radioClass: 'iradio_minimal-red',
		increaseArea: '20%' // optional
	});
});