<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Ocorrências - Grupo e Data</h3>
        <div class="box-tools pull-right">
            <button id="exportGrupoData" type="button" class="btn btn-box-tool"><i class="fa fa-file-excel-o"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>Grupo</label>
            <select id="selectGrupo" class="form-control select2" multiple="multiple" data-placeholder="Selecione Grupo's" style="width: 30%;">
                <option></option>
            </select>
        </div>
        <div class="chart">
            <canvas id="barChartGrupoData" style="height:230px"></canvas>
        </div>
    </div>
</div>
<!-- /.box -->
