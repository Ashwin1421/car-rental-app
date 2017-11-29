$(document).ready(function(){
	var output,i;
	//car-view
	var carlistdiv = $("#car-list");
	//car details
	var carname, carcost, cartype, carimage;
	$.ajax({
		url: '../php/viewcars.php',
		type: 'POST',
		data: {
			'carlist':'carlist'
		},
		success: function(output){
			output = JSON.parse(output);
			for(i=0;i<output.length;i++){
				carname = output[i]['name'];
				carcost = output[i]['cost_per_mile'];
				cartype = output[i]['type'];
				carimage = output[i]['image'];
				
				var cardiv = carlistdiv.append("<a href='#' class='list-group-item'>");
				cardiv.append("<img class='img-thumbnail' src='../../public/images/uploads/"+carimage+"' alt='"+carname+"'>");
				var cardetails = cardiv.append("<div class='car-details'>");
				cardetails.append("<h4>"+carname+"</h4>");
				cardetails.append("<p>"+cartype+"</p>");
				cardetails.append("<p>$"+carcost+"</p></div></a>");
			}
		},
		error: function(err){
			console.log('error=',err);
		}
	});
});