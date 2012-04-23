$(document).ready(function() {

	//adds games
	var addGames = function(){
		$("#searchResults a").click(function() {
			$.ajax({
				url: "addgame.php?gtin=" + this.id,
				success: function(data){
					$("#searchResults").empty();				
					$(document.createElement("li")).append(data).appendTo("#searchResults").trigger("create");
					$("#searchResults").listview("refresh");
				}
				});
		});
	}
	
	//lists vendors
	$('.gamelink').live("click", function() {
		var gameGTIN = $(this).attr('id');
		$("#vendorListing").empty();
		$.ajax({
			url: "google.php?vendorgtin=" + gameGTIN,
			dataType: 'json',
			success: function(data){
				var titleStr = "string"
				var costStr = "cost";
				$.each(data.items, function() {		
					costStr = this.product.inventories[0].price;
					titleStr = this.product.title;
					
					$(document.createElement("li")).append("<a href=\""+this.product.link+"\" class ='gamelink'><img width=\"50\" src=\""+this.product.images[0].link+"\" />"+titleStr+ " - $"+costStr+"</a>").appendTo("#vendorListing").trigger("create");
				});
				$("#vendorListing").listview("refresh");
				$(".vendorH1").html("Vendors for "+titleStr);
			}	
		});
	});
	
	//for listing games automatically
	var listGames = function(){
		$.ajax({
			url: "listgames.php",
			dataType: "xml",
			success: function(xml) {
				var gameGTIN = "";
				$("#gameListing").empty();	
				$(xml).find('game').each(function(){
					gameGTIN = $(this).text();
					$.ajax({
						url: "google.php?gtin=" + gameGTIN,
						dataType: 'json',
						success: function(data){
							var titleStr = "string";
							var costStr = "cost";
							var gtinStr = "gtin";
							$.each(data.items, function() {		
								costStr = this.product.inventories[0].price;
								gtinStr = this.product.gtin;
								$(document.createElement("li")).append("<a href=\"#vendorList\" class='gamelink' id='"+gtinStr+"'><img width=\"50\" src=\""+this.product.images[0].link+"\" />"+this.product.title+ " - $"+costStr+"</a>").appendTo("#gameListing").trigger("create");
							});
						}
					});					
				});
				$("#gameListing").listview("refresh");
			}
		});
	}
	
	
	//displays search results
	$("#searchForm").submit(function(event) {
		$.ajax({
			url: "google.php?query=" + $("#searchBox").val(),
			dataType: 'json',
			success: function(data) {
				$("#searchResults").empty();
				var alreadyShown=new Array();
				var tester = 0;
				var gtinStr = "string";
				$.each(data.items, function() {
					gtinStr = this.product.gtin;
					tester = $.inArray(gtinStr, alreadyShown);
					if(tester == -1 && gtinStr != "undefined"){
						alreadyShown.push(gtinStr);
						$(document.createElement("li")).append("<a id=\""+gtinStr+"\" ><img src=\""+this.product.images[0].link+"\" />"+this.product.title+gtinStr+"</a>").appendTo("#searchResults").trigger("create");
					}
				});
				$("#searchResults").listview("refresh");
				addGames();
			}
		});
		return false;
	});
	
	//list games automatically
	listGames();
	//for listing games on "Games List" click
	$('.headerGames').click(function() {
		listGames();
	});
});