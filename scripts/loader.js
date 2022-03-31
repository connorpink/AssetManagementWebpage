//get and format table from php to javascript object.
var dataElement = document.getElementById('data');
var htmlString = dataElement.innerHTML;
htmlString = htmlString.replace(/~([^~]*)$/, '$1');
var fetchData = htmlString.split("~");
var newdata = new Array();
//newdata[0] = ['Item', 'Count', 'Threshold'];
function GetProperCount(threshold, count){
    newThreshold = parseInt(threshold, 10);
    newCount = parseInt(count, 10);
	if (newThreshold >= newCount){

		return count;
	}
	else{
		newCount = count-threshold;
		return newCount;
	}
}
function GetProperColor(threshold, count){
    newThreshold = parseInt(threshold, 10);
    newCount = parseInt(count, 10);
	if (newThreshold >= newCount){
		color = 'color: #B00020'
		return color;
	}
	else{
		color = 'color: #4682B4'
		return color;
	}
}
for (var i = 0; i < fetchData.length; i = i + 1) {
	index = fetchData[i].split(",");
	newCount = GetProperCount(index[2],index[1]);
	color = GetProperColor(index[2],index[1]);
	//console.log("item: "+index[0]+"  threshold: "+index[2]+"  count: "+index[1]+"  newCount: " +newCount)
	tooltip = index[0] + "\nCount: "+ parseInt(index[1]);
	
	newdata[i] = [index[0], parseInt(index[2]), color, parseInt(newCount), tooltip ];
}

//setup google charts data
google.charts.load('current', {packages: ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

//function to draw chart
function drawChart() {
	var displaydata = new google.visualization.DataTable();
	displaydata.addColumn('string', 'Item');
	displaydata.addColumn('number', 'Threshold');
	displaydata.addColumn({type: 'string', role: 'style'});
	displaydata.addColumn('number', 'Count');
	displaydata.addColumn({type: 'string', role: 'tooltip'});
	

	//add rows of data to table
	for (row of newdata) {
		//console.log(row);
		displaydata.addRows([row]);
	}

	//get display category info from url variable passed from php
	var parts = window.location.search.substr(1).split("&");
	var $_GET = {};
	for (var i = 0; i < parts.length; i++) {
		var temp = parts[i].split("=");
		$_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
	}
	titleAdd = ''
	if ($_GET['category'] != null){
		titleAdd = ' for Category '+$_GET['category'];
	}
	else{
		titleAdd = ' for all Categories';
	}

	var options = {
		
		title: 'Inventory Level'+titleAdd,
			
		bar: {
			groupWidth: '90%'
		},
		backgroundColor: '#27323b',
		chartArea: {
			backgroundColor: '#27323b'
		},
		isStacked: true,
		colors: ['#4682B4','#ADD8E6'],
		tooltip: {
			textStyle:{
				bold: true
			},
			isHtml: true
		},
		vAxis: {
			textStyle:{
				fontSize: '12',
				bold: false,
				italic: true
			}
		},
		hAxis: {
			textStyle:{
				fontSize: '10'
			}
		}
		
	};

	var chart = new google.visualization.BarChart(document.getElementById('barchart_material'));

	chart.draw(displaydata, options);

}