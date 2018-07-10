$(function(){
    var base_url = window.location.origin;
	$.getJSON(base_url+"/backadmin/chartjs-topreviewer-dashboard", function (result) {
		var labels = [],data=[];
		for (var i = 0; i < result.length; i++) {
			labels.push(result[i].user.name);
			data.push(result[i].count);
		}
		var buyerData = {
			labels : labels,
			datasets : [
				{
					fillColor : "#ee9a20",
					strokeColor : "#ee9a20",
					pointColor : "#ee9a20",
					pointStrokeColor : "#ee9a20",
					data : data
				}
			]
		};
		var buyers = document.getElementById('topreviewer').getContext('2d');
		new Chart(buyers).Bar(buyerData, {
		bezierCurve : true
		});
	});
	$.getJSON(base_url+"/backadmin/chartjs-toptrandingtopic-dashboard", function (result) {
		var labels = [],data=[];
		for (var i = 0; i < result.length; i++) {
			labels.push(result[i].food.title);
			data.push(result[i].count);
		}
		var buyerData = {
			labels : labels,
			datasets : [
				{
					fillColor : "#ee9a20",
					strokeColor : "#ee9a20",
					pointColor : "#ee9a20",
					pointStrokeColor : "#ee9a20",
					data : data
				}
			]
		};
		var buyers = document.getElementById('toptrandingtopic').getContext('2d');
		new Chart(buyers).Bar(buyerData, {
		bezierCurve : true
		});
	});
	$.getJSON(base_url+"/backadmin/chartjs-toprating-dashboard", function (result) {
		var labels = [],data=[];
		for (var i = 0; i < result.length; i++) {
			labels.push(result[i].title);
			data.push(result[i].rating);
		}
		var buyerData = {
			labels : labels,
			datasets : [
				{
					fillColor : "#ee9a20",
					strokeColor : "#ee9a20",
					pointColor : "#ee9a20",
					pointStrokeColor : "#ee9a20",
					data : data
				}
			]
		};
		var buyers = document.getElementById('toprating').getContext('2d');
		new Chart(buyers).Line(buyerData, {
		bezierCurve : true
		});
	});

});