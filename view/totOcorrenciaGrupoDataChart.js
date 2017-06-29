function loadDashboard() {

    var objData ={
        "action": "index"
    }

    $.ajax({
        url: "dashboard/functions.php",
        method: 'post',
        contentType: 'application/json',
        data: JSON.stringify(objData),
        success: function (data) {
            console.log(data);
        }
    });

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

function loadChart(){
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var areaChart = new Chart(areaChartCanvas);

    x = getRandomColor();
    y = getRandomColor();
    z = getRandomColor();

    var areaChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "Digital Goods",
                fillColor: x,
                strokeColor: x,
                pointColor: x,
                pointStrokeColor: x,
                pointHighlightFill: x,
                pointHighlightStroke: x,
                data: [50, 300, 40, 19, 86, 27, 90]
            },
            {
                label: "xxx Goods",
                fillColor: y,
                strokeColor: y,
                pointColor: y,
                pointStrokeColor: y,
                pointHighlightFill: y,
                pointHighlightStroke: y,
                data: [100, 9, 500, 10, 86, 27, 300]
            }
            ,
            {
                label: "xxx dfasfdsa",
                fillColor: z,
                strokeColor: z,
                pointColor: z,
                pointStrokeColor: z,
                pointHighlightFill: z,
                pointHighlightStroke: z,
                data: [150, 9, 60, 90, 70, 27, 300]
            }
        ]
    };

    var areaChartOptions = {
        //Boolean - If we should show the scale at all
        showScale: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: false,
        //String - Colour of the grid lines
        scaleGridLineColototOcorrenciaGrupoDataChartr: "rgba(0,0,0,.05)",
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - Whether the line is curved between points
        bezierCurve: true,
        //Number - Tension of the bezier curve between points
        bezierCurveTension: 0.3,
        //Boolean - Whether to show a dot for each point
        pointDot: false,
        //Number - Radius of each point dot in pixels
        pointDotRadius: 4,
        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth: 1,
        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius: 20,
        //Boolean - Whether to show a stroke for datasets
        datasetStroke: true,
        //Number - Pixel width of dataset stroke
        datasetStrokeWidth: 2,
        //Boolean - Whether to fill the dataset with a color
        datasetFill: true,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true
    };

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions);
}

// $(document ).ready(function() {
//    loadChart();
// });