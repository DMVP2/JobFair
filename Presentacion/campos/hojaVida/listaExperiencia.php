<div class="divListId">

    <hr class="hr-separator">

    <br>

    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Cargo
                </label>
                <input type="text" class="form-control" id="cargoExperiencia[]" name="cargoExperiencia[]" required>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Empresa
                </label>
                <input type="text" class="form-control" id="empresaExperiencia[]" name="empresaExperiencia[]" required>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-group">
                    <label class="bmd-label-floating">
                        Descripción</label>
                    <textarea class="form-control" maxlength="950" rows="6" id="descripcionExperiencia[]"
                        name="descripcionExperiencia[]" required></textarea>
                </div>
            </div>
        </div>
    </div>




    <br><br>


    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Año de inicio
                </label>
                <input type="number" class="form-control" min="1970" max="3000" step="1" value="2016"
                    onchange="maximoAño(this)" id="añoInicio" name="añoInicio" required>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Año final
                </label>
                <input type="number" class="form-control" min="1970" max="3000" step="1" value="2016"
                    onchange="maximoAño(this)" id="añoSalida" name="añoSalida" required>
            </div>
        </div>
    </div>

</div>