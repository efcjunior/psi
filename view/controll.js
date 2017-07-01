/*
* Carrega Ocorrencias agrupadas por Mes Ano
* */

$.extend({
    loadGrupoMesAno: function(startDate,endDate) {

        var objData ={
            "action": "grupoMesAno",
            "startDate": startDate,
            "endDate": endDate
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

/*
 * Carrega Ocorrencias agrupadas por Mes Ano Dia
 * */

$.extend({
    loadGrupoMesDia: function(grupo, data) {

        var objData ={
            "action": "grupoMesDia",
            "grupo": grupo,
            "data": data,
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

/*
 * Carrega Ocorrencias agrupadas por Origem e Data.
 * */

$.extend({
    loadOrigemData: function(grupo, data) {

        var objData ={
            "action": "origemData",
            "grupo": grupo,
            "data": data,
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

/*
 * Carrega Ocorrencias agrupadas por SRs e Grupo
 * */

$.extend({
    loadAreaGrupo: function(startDate, endDate) {

        var objData ={
            "action": "areaGrupo",
            "startDate": startDate,
            "endDate": endDate
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


/*
 * Export XLS
 * */

$.extend({
    exportToXls: function() {

        var objData ={
            "action": "exportToXls"
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


function loadLabels(data,isMesAno,isDate){
    var labels = [];

    jQuery.each(data, function( key, value ) {
        if(isDate){
            if(isMesAno){
                labels.push(value.anomes);
            }else{
                labels.push(value.dt_ocorrencia);
            }
        }else{
            console.log(value);
            labels.push(value.sr);
        }

    });

    return Array.from(new Set(labels));
}

function loadGrupoDataChart(startDate, endDate){
    data = $.loadGrupoMesAno(startDate,endDate);

    labels = loadLabels(data,true,true);

    chartData = getChartDataTotalizadorBy(data,'grupo',labels);

    loadChart(chartData,'bar',"barChartGrupoData");
}

function loadAreaGrupoChart(startDate, endDate){
    data = $.loadAreaGrupo(startDate, endDate);

    labels = loadLabels(data,false,false);

    chartData = getChartDataTotalizadorBy(data,'grupo',labels);

    loadChart(chartData,'bar',"barChartAreaGrupo");
}

function getChartDataTotalizadorBy(data,label,labels){
    chartData = new ChartData(labels);

    jQuery.each(data, function( key, value ) {
        var chartDataSet = new ChartDataSet();
        chartDataSet.label = value[label];
        chartDataSet.data.push(value.total);

        chartData.addChartDataSet(chartDataSet);
    });

    return chartData;

}


function loadOrigemDataChart(event, array){
    $('#totOcorrenciaOrigemDataChart').load('view/totOcorrenciaOrigemDataChart.php', function () {
        data = $.loadOrigemData(array[0]._model.datasetLabel,array[0]._model.label);
        console.log(event);
        labels = loadLabels(data,false,true);

        chartData = getChartDataTotalizadorBy(data,'origem',labels);

        loadChart(chartData,'bar',"barChartOrigemData");
    });
}


function loadChart(chartData, typeBar, selectorId){

    var canvas =  document.getElementById(selectorId);
    var ctx = canvas.getContext("2d");

    var chart = new Chart(ctx, {
        type: typeBar,
        data:chartData,
        options:{
            onClick: loadOrigemDataChart
        }
    });
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

