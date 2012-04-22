$("#myGames").live("pageinit",function() {

	//adds games
	var bindIt = function(){
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
				bindIt();
			}
		});
		return false;
	});
	
	//lists games - right now I have this as click; if you can get it to work so it displays automatically, that'd be awesome
	$('a').click(function() {
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
							$.each(data.items, function() {		
							costStr = this.product.inventories[0].price;
							$(document.createElement("li")).append("<a href=\"#vendorList\"><img width=\"50\" src=\""+this.product.images[0].link+"\" />"+this.product.title+ " $"+costStr+"</a>").appendTo("#gameListing").trigger("create");
							});
						}
					});
					
				});
				$("#gameListing").listview("refresh");
			}
		});
	});
	
});