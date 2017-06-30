$.extend({
    loadLabelData: function() {

        var objData ={
            "action": "labelData",
            "mesano": "true"
        };

        var resposta = [];

        $.ajax({
            url: "dashboard/functions.php",
            method: 'post',
            contentType: 'application/json',
            data: JSON.stringify(objData),
            async: false,
            success: function (response) {
                jQuery.each(response, function( key, value ) {
                    resposta.push(value.anomes);
                });
            }
        });
        return resposta;
    }
});

$.extend({
    loadGrupoMesAno: function() {

        var objData ={
            "action": "grupoMesAno",
        };

        var resposta = null;

        $.ajax({
            url: "dashboard/functions.php",
            method: 'post',
            contentType: 'application/json',
            data: JSON.stringify(objData),
            async: false,
            success: function (response) {
                resposta = response;
            }
        });
        return resposta;
    }
});

function loadDashboard() {
    data = $.loadGrupoMesAno()
    labels = $.loadLabelData();
    chartData = new ChartData(labels);


    jQuery.each(data, function( key, value ) {
        var chartDataSet = new ChartDataSet();
        chartDataSet.label = value.grupo;
        chartDataSet.data.push(value.total);

        chartData.addChartDataSet(chartDataSet);
    });

    loadChart(chartData);
}

function loadChart(chartData){

    console.log(chartData);

    var ctx = $("#barChart");

    var chart = new Chart(ctx, {
        type: 'bar',
        data:chartData,
        options: {
            // events: ['click']
            onClick:graphClickEvent
        }

    });


//     console.log(areaChartData.datasets);
//
//     //-------------
//     //- BAR CHART -
//     //-------------
//     var barChartCanvas = $("#barChart").get(0).getContext("2d");
//     var barChart = new Chart(barChartCanvas);
//     var barChartData = areaChartData;
//     barChartData.datasets[1].fillColor = "#00a65a";
//     barChartData.datasets[1].strokeColor = "#00a65a";
//     barChartData.datasets[1].pointColor = "#00a65a";
//     var barChartOptions = {
//         //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
//         scaleBeginAtZero: true,
//         //Boolean - Whether grid lines are shown across the chart
//         scaleShowGridLines: true,
//         //String - Colour of the grid lines
//         scaleGridLineColor: "rgba(0,0,0,.05)",
//         //Number - Width of the grid lines
//         scaleGridLineWidth: 1,
//         //Boolean - Whether to show horizontal lines (except X axis)
//         scaleShowHorizontalLines: true,
//         //Boolean - Whether to show vertical lines (except Y axis)
//         scaleShowVerticalLines: true,
//         //Boolean - If there is a stroke on each bar
//         barShowStroke: true,
//         //Number - Pixel width of the bar stroke
//         barStrokeWidth: 2,
//         //Number - Spacing between each of the X value sets
//         barValueSpacing: 5,
//         //Number - Spacing between data sets within X values
//         barDatasetSpacing: 1,
//         //String - A legend template
//         legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
//         //Boolean - whether to make the chart responsive
//         responsive: true,
//         maintainAspectRatio: true,
//         onClick: graphClickEvent
//     };
//
//     barChartOptions.datasetFill = false;
//     barChart.Bar(barChartData, barChartOptions);
}

function getRandomColor() {
    var color = '';
    while (!color.match(/(#[c-e].)([e-f][a-f])([9-c].)/)) {
        color = '#' + Math.floor(Math.random() * (Math.pow(16,6))).toString(16);
    }
    return color;
}

function getColorSimilarityIndex(c1, c2) {
    var index = 0;
    for (i = 1; i <= 6; i++) {
        if (i == 1 || i == 5) {
            if (c1.substring(i, i + 1) === c2.substring(i, i + 1)) {
                index++;
            }
        }
    }
    return index;
}

function ChartData(labels){
    this.labels = labels;
    this.datasets = [];
    this.addChartDataSet = function (chartDataSet){
        found = false;
        loop:
        for(i = 0; i < this.datasets.length; i++){
            if(this.datasets[i].label == chartDataSet.label){
                this.datasets[i].data.push(chartDataSet.data[0]);
                found = true;
                break loop;
            }
        }

        if(!found){
            this.datasets.push(chartDataSet);
        }
    };
}

function ChartDataSet() {
    this.label = null;
    this.data = [];
}

function graphClickEvent(event, array){
    console.log("fajskdfjaskjfkasjfkas");
    if(array[0]){
    }
}