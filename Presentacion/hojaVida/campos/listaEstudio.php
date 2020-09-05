<div class="divListId">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Estudio</label>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Área</label>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <select class="form-control ">
                    <option value="Administración">Administración</option>
                    <option value="Bellas Artes">Bellas Artes</option>
                    <option value="Ciencias">Ciencias</option>
                    <option value="Ciencias de la Salud">Ciencias de la Salud</option>
                    <option value="Ciencias Sociales">Ciencias Sociales</option>
                    <option value="Deportes">Deportes</option>
                    <option value="Diseño">Diseño</option>
                    <option value="Educación">Educación</option>
                    <option value="Humanidades">Humanidades</option>
                    <option value="Ingeniería">Ingeniería</option>
                </select>

            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Institución
                </label>
                <input type="text" class="form-control">
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
                    onchange="maximoAño(this)" />
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label class="bmd-label-floating">
                    Año final
                </label>
                <input type="number" class="form-control" min="1970" max="3000" step="1" value="2016"
                    onchange="maximoAño(this)" />
            </div>
        </div>
    </div>

</div>