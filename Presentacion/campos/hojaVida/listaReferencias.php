<div class="divListId">

    <hr class="hr-separator">

    <br>

    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Nombre
                </label>
                <input type="text" class="form-control" id="nombreReferencia[]" name="nombreReferencia[]" required>
            </div>
        </div>
    </div>

    <br>


    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Teléfono
                </label>
                <input type="number" class="form-control" id="telefonoReferencia[]" name="telefonoReferencia[]" pattern="(\+57|0057|57)?[ -]*(3)[ -]*([0-9][ -]*){10}"
                                                                        title="Solo se permite el número del teléfono celular. Opcionalmente puede incluir el código de país en diferentes formatos si asi lo desea." required>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Cargo / Profesión
                </label>
                <input type="text" class="form-control" id="parentescoReferencia[]" name="parentescoReferencia[]" required>
            </div>
        </div>
    </div>

</div>