
var colors = ['#DB6946', '#C14543', '#445060', '#395953', '#6C8C80', '#829AB5', '#BF807A', '#BF0000', '#006BB7', '#EC732C', '#BF3D27', '#A6375F',
			'#8C6D46', '#326149', '#802B35', '#8A3842', '#366D73', '#4D6173', '#4A4659', '#C9D65B', '#F45552', '#F3CC5E', '#F29B88', '#D96941',
			'#484F73', '#C9AB81', '#F5655C', '#F0C480'];
//------------------------------------------------------------------------------				
function convertToNumeric(data){
	if(data instanceof Array){
		for(var index in data){
			data[index] = Number(data[index]);
		}
	} else{
		data = Number(data);
	}
	return data;
}
//------------------------------------------------------------------------------
function getRandomElementFromArray(array){
	var ranIndex = Math.floor(Math.random() * array.length);
	return array[ranIndex];
}
//------------------------------------------------------------------------------
function drawVisitsLineChart(visitsData){
	var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	var barChartData = {
		labels : visitsData.data.dates,
		datasets : [
			{
				label: "Visitors",
				barShowStroke: false,
				fillColor : "rgba(220,220,220,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : visitsData.data.visitors
			},
			{
				label: "Visits",
				barShowStroke: false,
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data : visitsData.data.visits
			}
		]

	}
	var ctx = document.getElementById("visitorsVisitsChart").getContext("2d");
	window.myBar = new Chart(ctx).Bar(barChartData, {
		responsive : true
	});
}
//------------------------------------------------------------------------------
function drawBrowsersBieChart(browsersData){
    var brsBieChartData = [];
    var container = jQuery('#browsersLegContainer');
    var html = '';
	if(browsersData.length == 0)
	{
	document.getElementById('browsersLegContainer').style.display = 'none';	
	}else{
	document.getElementById('browsersLegContainer').style.display = 'block';		
	}
    for(var i = 0; i < browsersData.length; i++){
        var color = getRandomElementFromArray(colors);
        var value = Number(browsersData[i].hits);
        brsBieChartData[i] = {label: browsersData[i].bsr_name, value: value, color: color};
        html += (isEmpty(value))? '' : '<div class="legend">' +
                    '<span class="color" style="background-color: ' + color + ';">&nbsp;&nbsp;</span>' +
                    '<span class="name">' + browsersData[i].bsr_name + '</span>' +
                    '<span class="value">' + value + '</span>' +
                '</div>';
    }
    html += '<div class="cleaner"></div>';
    container.html(html);
    var ctx = document.getElementById("brsBiechartContainer").getContext("2d");
    window.myPie = new Chart(ctx).Pie(brsBieChartData);
}
//------------------------------------------------------------------------------
function drawSrhEngVstLineChart(srhEngVisitsData){
    var srh_series = [];
    var container = jQuery('#srchEngLegContainer');
	
	document.getElementById('srchEngLegContainer').style.display = 'none';
    var html = '';
    for(var index in srhEngVisitsData.data.search_engines){
        var color = getRandomElementFromArray(colors);
        var value = countVisits(srhEngVisitsData.data.search_engines[index]);
		
		if(parseFloat(value) !=0)
		{
		document.getElementById('srchEngLegContainer').style.display = 'block';	
		}
		
        srh_series[srh_series.length] = {
                                        "label": index,
                                        "value": value,
                                        "color": color
                                        }
                                        
        html += (isEmpty(value))? '' : '<div class="legend">' +
                    '<span class="color" style="background-color: ' + color + ';">&nbsp;&nbsp;</span>' +
                    '<span class="name">' + index + '</span>' +
                    '<span class="value">' + value + '</span>' +
                '</div>';
    }
	
	


    html += '<div class="cleaner"></div>';
    container.html(html);
    var ctx = document.getElementById("srhEngBieChartContainer").getContext("2d");
    window.myPie = new Chart(ctx).Pie(srh_series);
}

function isEmpty(val){
    return (val == null || val == 0 || val == '' || val == '0');
}

//------------------------------------------------------------------------------
function countVisits(arr){
	var count = 0;
	for(var i = 0; i < arr.length; i++){
		count += Number(arr[i]);
	}
	return count;
}
//------------------------------------------------------------------------------


