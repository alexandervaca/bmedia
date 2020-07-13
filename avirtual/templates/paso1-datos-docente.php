<!-- Datos Docente - Inicio -->
<legend>Datos del docente</legend>
<div class="form-group">
    <div class="col-lg-12">
        <div class="checkbox">
            <label>&nbsp;<input type="checkbox" name="checkDocente" id="checkDocente"> Marque si es docente y si su capacitaci&oacute;n es 
            abonada por convenio preestablecido</label>
        </div>
    </div>
</div>
<div class="form-group hide" id="docente-dato1">
    <div class="col-lg-6">
        <select class="form-control" id="provinciaDocente" name="provinciaDocente">
            <option value="">Seleccione una provincia</option>
            <?php
                // Crea los options de un select HTML, de una lista con elemento del tipo
                // array["codigo"],array["descripcion"]
                echo buildHTMLOptionsList($provinciasList);
            ?>
        </select>
        <span class="error">Debe seleccionar una provincia</span>
    </div>
    <div class="col-lg-6">
        <select class="form-control" id="municipio" name="municipio">
            <option value="">Seleccione un municipio</option>
            <?php
                // Crea los options de un select HTML, de una lista con elemento del tipo
                // array["codigo"],array["descripcion"]
                echo buildHTMLOptionsList($municipiosList);
            ?>
        </select>
        <span class="error">Debe seleccionar un municipio</span>
    </div>
</div>
<div class="form-group hide" id="docente-dato2">
    <div class="col-lg-6">
        <select class="form-control" id="nivel" name="nivel">
            <option value="">Seleccione un nivel</option>
            <option value="INIC">Inicial</option>
            <option value="PRIM">Primaria</option>
            <option value="SECU">Secundaria</option>
        </select>
        <span class="error">Debe seleccionar un nivel</span>
    </div>
    <div class="col-lg-6">
        <select class="form-control" id="area" name="area">
            <option value="">Seleccione un &aacute;rea</option>
            <option value="ARTE">Arte</option>
            <option value="CSNA">Ciencias naturales</option>
            <option value="CSSC">Ciencias sociales</option>
            <option value="IDEX">Idioma extranjero</option>
            <option value="LENG">Lengua</option>
            <option value="MATE">Matem&aacute;tica</option>
            <option value="TECN">Tecnolog&iacute;a</option>
        </select>
        <span class="error">Debe seleccionar un &aacute;rea</span>
    </div>
</div>
<div class="form-group hide" id="docente-dato3">
    <div class="col-lg-6">
        <select class="form-control" id="cargo" name="cargo">
            <option value="">Seleccione un cargo</option>
            <option value="COOR">Coordinador</option>
            <option value="DIRE">Director</option>
            <option value="DOCE">Docente</option>
        </select>
        <span class="error">Debe seleccionar un cargo</span>
    </div>
    <div class="col-lg-6">
        <input type="text" class="form-control" id="legajo" name="legajo" placeholder="Legajo*" maxlength="50">
        <span class="error">Completar este campo</span>
    </div>
</div>
<!-- Datos Docente - Fin -->