<div class="divListId">

    <hr class="hr-separator">

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Nombre
                </label>
                <input type="text" class="form-control" id="nombreRepresentante[]" name="nombreRepresentante[]">
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Correo
                </label>
                <input type="text" class="form-control" id="correoRepresentante[]" name="correoRepresentante[]" require>
            </div>
        </div>
    </div>

    <br>


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Cargo
                </label>
                <input type="text" class="form-control" id="cargoRepresentante[]" name="cargoRepresentante[]" require />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Teléfono
                </label>
                <input type="number" class="form-control" id="telefonoRepresentante[]" name="telefonoRepresentante[]"
                    pattern="(\+57|0057|57)?[ -]*(3)[ -]*([0-9][ -]*){10}" require />
            </div>
        </div>
    </div>

</div>