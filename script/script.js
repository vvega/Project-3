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
	
	$('.removeGame').live("click", function() {
		var gameGTIN = $(this).attr('id');
		$.ajax({
			url: "addgame.php?exgtin=" + gameGTIN,
			success: function(data){
				$('#vendorListing').empty();			
				$(document.createElement("li")).append(data).appendTo("#vendorListing").trigger("create");
				$("#vendorListing").listview("refresh");
			}
		});
	});
	
	//lists vendors
	$('.gamelink').live("click", function() {
		var gameGTIN = $(this).attr('id');
		$('.removeGame').attr('id', gameGTIN);
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
					$(document.createElement("li")).append("<img width='40' src='"+this.product.images[0].link+"' /><a href=\""+this.product.link+"\" class='vendorlink' target='_blank'> $"+costStr+" - "+this.product.author.name+"</a>").appendTo("#vendorListing").trigger("create");
				});
				
				$('#vendorListing').listview("refresh");
				$('.vendorH1').html(titleStr+" Vendors");
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
								$(document.createElement("li")).append("<img width='50' src='"+this.product.images[0].link+"' /><a href=\"#vendorList\" class='gamelink' id='"+gtinStr+"'>"+this.product.title+ " - $"+costStr+"</a>").appendTo("#gameListing").trigger("create");
							});
							//added by Veronica to make the listview consistent
							$('#gameListing').listview("refresh");
						}
					});					
				});
			}
			,
			complete: function(){
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
				var gtinStr = "string";
				$.each(data.items, function() {
					gtinStr = this.product.gtin;
					if(gtinStr != undefined){
						$(document.createElement("li")).append("<a id=\""+gtinStr+"\" ><img width=\"80\" src=\""+this.product.images[0].link+"\" />"+this.product.title+"</a>").appendTo("#searchResults").trigger("create");
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