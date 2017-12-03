$(document).ready(function(){
	var loginbtn = $("#log-in");
	var logoutbtn = $("#log-out");
	var signupbtn = $("#sign-up");
	var btnlist = $("#btn-list");

	var pickupdate = $("#pick-up-date");
	var dropoffdate = $("#drop-off-date");
	//pick-up-date
	$("#pick-up-date").datepicker();
	var selected_pickup_date;
	//drop-off-date
	$("#drop-off-date").datepicker();
	var selected_dropoff_date;

	//pick-up-location
	var pickup_location = $("#pick-up-location");
	var selected_pickup_location;
	var cartype = $("#car-type");
	var selected_cartype;

	//search button
	var carsearchbtn = $("#car-search");
	carsearchbtn.attr("disabled","disabled");
	//reset button
	var resetbtn = $("#reset");
	var diff, days;
	

	pickupdate.change(function(){
		selected_pickup_date = new Date(pickupdate.val());
		
		diff = new Date(selected_dropoff_date - selected_pickup_date);
		days = diff/1000/60/60/24;
		console.log("diff",days);


		if( (days>0) && 
			selected_pickup_location && 
			selected_pickup_date && 
			selected_dropoff_date && cartype){

			carsearchbtn.removeAttr("disabled");
		}else{
			carsearchbtn.attr("disabled", "disabled");
		}
	});

	dropoffdate.change(function(){
		selected_dropoff_date = new Date(dropoffdate.val());
		
		diff = new Date(selected_dropoff_date - selected_pickup_date);
		days = diff/1000/60/60/24;
		console.log("diff",days);
		
		if( (days>0) && 
			selected_pickup_location && 
			selected_pickup_date && 
			selected_dropoff_date && cartype){

			carsearchbtn.removeAttr("disabled");
		}else{
			carsearchbtn.attr("disabled", "disabled");
		}
	});


	pickup_location.change(function(){
		selected_pickup_location = pickup_location.val();
		diff = new Date(selected_dropoff_date - selected_pickup_date);
		days = diff/1000/60/60/24;
		console.log("diff",days);
		if( (days>0) && 
			selected_pickup_location && 
			selected_pickup_date && 
			selected_dropoff_date && cartype){

			carsearchbtn.removeAttr("disabled");
		}else{
			carsearchbtn.attr("disabled", "disabled");
		}
	});

	cartype.change(function(){
		selected_cartype = cartype.val();
		diff = new Date(selected_dropoff_date - selected_pickup_date);
		days = diff/1000/60/60/24;
		console.log("diff",days);
		if( (days>0) && 
			selected_pickup_location && 
			selected_pickup_date && 
			selected_dropoff_date && cartype){

			carsearchbtn.removeAttr("disabled");
		}else{
			carsearchbtn.attr("disabled", "disabled");
		}
	});

	resetbtn.click(function(){
		carsearchbtn.attr("disabled", "disabled");
	});
	
});