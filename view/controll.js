/*
* Carrega Ocorrencias agrupadas por Mes Ano
* */

$.extend({
    loadGrupoMesAno: function(startDate,endDate,grupo) {

        var objData ={
            "action": "grupoMesAno",
            "startDate": startDate,
            "endDate": endDate,
            "grupo":grupo
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
    loadAreaGrupo: function(startDate, endDate, sr) {

        var objData ={
            "action": "areaGrupo",
            "startDate": startDate,
            "endDate": endDate,
            "sr": sr
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
    exportToXls: function(startDate,endDate,noAgrupador,valorAgrupador) {

        var objData ={
            "action": "exportToXls",
            "startDate": startDate,
            "endDate": endDate,
            "noAgrupador": noAgrupador,
            "valorAgrupador": valorAgrupador
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


$.extend({
    loadLabelsBy: function(startDate,endDate,nomeCampo) {

        var objData ={
            "action": "labelByCampo",
            "startDate": startDate,
            "endDate": endDate,
            "nomeCampo": nomeCampo
        };

        var resposta = null;

        $.ajax({
            url: "dashboard/functions.php",
            method: 'post',
            contentType: 'application/json',
            data: JSON.stringify(objData),
            async: false,
            success: function (response) {
                console.log(nomeCampo);
                resposta = loadLabels(response,nomeCampo);
            }
        });
        return resposta;
    }
});

function loadLabels(data,nomeCampo){
    var labels = [];

    jQuery.each(data, function( key, value ) {
        console.log(nomeCampo);
        labels.push(value[nomeCampo]);

    });

    return Array.from(new Set(labels));
}

function loadGrupoDataChart(startDate, endDate, grupo){
    data = $.loadGrupoMesAno(startDate,endDate,grupo);

    labels = loadLabels(data,'anomes');

    chartData = getChartDataTotalizadorBy(data,'grupo',labels);

    var options ={
        onClick: loadOrigemDataChart
    };

    loadChart(chartData,'bar',"barChartGrupoData",options);
}

function loadAreaGrupoChart(startDate, endDate, sr){
    console.log(startDate);

    data = $.loadAreaGrupo(startDate, endDate, sr);

    labels = loadLabels(data,'sr');

    chartData = getChartDataTotalizadorBy(data,'grupo',labels);

    loadChart(chartData,'bar',"barChartAreaGrupo");

}

function loadSelect(startDate, endDate, idSelect, label){

    var options = $.loadLabelsBy(startDate,endDate,label);

    $(idSelect).find('option').remove();

    $.each(options, function(key, value) {
        $('<option>').val(value).text(value).appendTo(idSelect);
    });

    $(idSelect).select2();

    $(idSelect).change(function(e) {
        var startDate = getStartDatePesquisa();
        var dateEnd = getEndDatePesquisa();
        var valorLabel = $(e.target).val();

        switch (label){
            case "sr":
                loadAreaGrupoChart(startDate,dateEnd,valorLabel);
                break;
            case "grupo":
                loadGrupoDataChart(startDate,endDate,valorLabel);
                break;
        }
    });
}

function exportXls(noAgrupador,idChartSelect) {
    // var startDate = getStartDatePesquisa();
    // var endDate = getEndDatePesquisa();
    // var valorAgrupador = $(idChartSelect).val();
    // console.log(startDate);
    // console.log(endDate);
    // console.log(noAgrupador);
    // console.log(idChartSelect);
    // console.log(valorAgrupador);
    //
    // var objData ={
    //     "action": "exportToXls",
    //     "startDate": startDate,
    //     "endDate": endDate,
    //     "noAgrupador": noAgrupador,
    //     "valorAgrupador": valorAgrupador
    // };
    //
    // $.ajax({
    //     url: "dashboard/functions.php",
    //     method: 'post',
    //     contentType: 'application/json',
    //     data: JSON.stringify(objData),
    //     async:false,
    //     success: function (response) {
    //
    //


    //
    //         // var blob=new Blob([response]);
    //         // var link=document.createElement('a');
    //         // link.href=window.URL.createObjectURL(blob);
    //         // link.download="example.xml";
    //         // link.click();
    //         // window.location = 'dashboard/functions.php?filename=example.xml';
    //     }
    // });


    // $.exportToXls(startDate,endDate,noAgrupador,valorAgrupador);

}

function getStartDatePesquisa(){
    return getPeriodoPesquisa().split('-')[0].trim();
}

function getEndDatePesquisa(){
    return getPeriodoPesquisa().split('-')[1].trim();
}

function getPeriodoPesquisa(){
    return $('#pesquisa').val();
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
        labels = loadLabels(data,'dt_ocorrencia');

        chartData = getChartDataTotalizadorBy(data,'origem',labels);

        loadChart(chartData,'bar',"barChartOrigemData");
    });
}

function loadChart(chartData, typeBar, selectorId, options){

    var canvas =  document.getElementById(selectorId);
    var ctx = canvas.getContext("2d");

    var chart = new Chart(ctx, {
        type: typeBar,
        data:chartData,
        options:options
    });

    console.log(chart);
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