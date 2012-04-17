$("#search").live("pageinit",function() {
	$("#searchForm").submit(function(event) {
		$.ajax({
			url: "giantBomb.php?query=" + $("#searchBox").val(),
			dataType: 'json',
			success: function(response) {
				console.log(response);
				$("#searchResults").empty();
				$.each(response.results, function() {
					console.log(this.image.icon_url);
					$(document.createElement("li")).append("<img src=\""+this.image.icon_url+"\" />").append(this.name).appendTo("#searchResults").trigger("create");
				});
				$("#searchResults").listview("refresh");
			}
		});
		return false;
	});
});