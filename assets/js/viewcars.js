$(document).ready(function(){
	 $('#list').click(function(event){
	 	event.preventDefault();
	 	$('#products .item').addClass('list-group-item');
	 });
    $('#grid').click(function(event){
    	event.preventDefault();
    	$('#products .item').removeClass('list-group-item');
    	$('#products .item').addClass('grid-group-item');
    });
	

	var applyfilterbtn = $("#apply-filter");
	applyfilterbtn.hide();

	var lhfilter = $("#lh-filter");
	var hlfilter = $("#hl-filter");

	lhfilter.change(function(){
		applyfilterbtn.hide();
		console.log(lhfilter.val());
		applyfilterbtn.show();
	});

	hlfilter.change(function(){
		applyfilterbtn.hide();
		console.log(hlfilter.val());
		applyfilterbtn.show();
	});

});