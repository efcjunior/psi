<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Ocorrências - SR e Grupo</h3>
        <div class="box-tools pull-right">
            <button id="exportAreaGrupo" onclick="exportXls('sr','#selectSR')" type="button" class="btn btn-box-tool"><i class="fa fa-file-excel-o"></i>
            </button>
        </div>
    <div class="box-body">
        <div class="form-group">
            <label>SR</label>
            <select id="selectSR" class="form-control select2" multiple="multiple" data-placeholder="Selecione SR's" style="width: 40%;">
                <option></option>
            </select>
        </div>
        <div class="chart">
            <canvas id="barChartAreaGrupo" style="height:230px"></canvas>
        </div>
    </div>
</div>