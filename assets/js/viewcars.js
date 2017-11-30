$(document).ready(function(){
	var output,i;
	//car-view
	var carlistdiv = $("#car-list");
	//car details
	var carname, carcost, cartype, carimage, carcapacity;
	$.ajax({
		url: '../php/viewcars.php',
		type: 'POST',
		data: {
			'admincontrol':''
		},
		success: function(output){
			output = JSON.parse(output);
			for(i=0;i<output.length;i++){
				carname = output[i]['name'];
				cartype = output[i]['type'];
				carcost = output[i]['cost_per_hour'];
				carcapacity = output[i]['capacity'];
				carimage = output[i]['image'];
				
				carlistdiv.append(
					"<a href='#' class='list-group-item'>"+
					"<img class='img-thumbnail' src='../../public/images/uploads/"+carimage+"' alt='"+carname+"'>"+
					"<div class='car-details'>"+
					"<h4>"+carname+"<span class='pull-right'><button class='btn btn-success'>Add to cart</button></span></h4>"+
					"<p>Type: "+cartype+"</p>"+
					"<p><span class='glyphicon glyphicon-usd'></span>"+carcost+"/hr.</p>"+
					"<p><span class='glyphicon glyphicon-user'></span>"+carcapacity+"</p>"+
					"</div></a>");
			}
		},
		error: function(err){
			console.log('error=',err);
		}
	});
});