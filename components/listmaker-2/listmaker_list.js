
var intoolstd = "";

$(document).ready(function(){
	//
	// mouse over effect on TR
	$('.tools-td').on("mouseenter", function(){
		intoolstd = "in";
		console.log(intoolstd);
	});
	$('.tools-td').on("mouseleave", function(){
		intoolstd = "out";
		console.log(intoolstd);
	});
})


