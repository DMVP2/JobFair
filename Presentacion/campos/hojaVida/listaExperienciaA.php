<div class="divListId">

    <hr class="hr-separator">

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Experiencia académica
                </label>
                <input type="text" class="form-control" id="expAcademica[]" name="expAcademica[]">
            </div>
        </div>
    </div>

    <br><br>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-group">
                    <label class="bmd-label-floating">
                        Descripción</label>
                    <textarea class="form-control" maxlength="950" rows="6" name="descripcionExp[]"
                        id="descripcionExp[]"></textarea>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Institución
                </label>
                <input type="text" class="form-control" id="institucionExpA[]" name="institucionExpA[]">
            </div>
        </div>
    </div>

    <br><br>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Año de inicio
                </label>
                <input type="number" class="form-control" min="1970" max="3000" step="1" value="2016"
                    onchange="maximoAño(this)" id="añoExpAcademica[]" name="añoExpAcademica[]" />
            </div>
        </div>
    </div>

</div>