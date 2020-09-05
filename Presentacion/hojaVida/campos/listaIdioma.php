<?php
if (isset($_GET['op'])) {
?>


<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            <input type="text" class="form-control" name="otros[]" />

        </div>
    </div>

</div>


<?php

} else {


?>
<div class="divListId">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <select class="form-control" name="idiomas[]" onchange="verificarOtroIdioma(this)">
                    <option value="Español">Español</option>
                    <option value="Inglés">Inglés</option>
                    <option value="Francés">Francés</option>
                    <option value="Portugués">Portugués</option>
                    <option value="Italiano">Italiano</option>
                    <option value="Alemán">Alemán</option>
                    <option value="Japonés">Japonés</option>
                    <option value="Coreano">Coreano</option>
                    <option value="Ruso">Ruso</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">

                <select class="form-control" name="niveles[]">
                    <option value="Básico" selected>Básico</option>
                    <option value="Intermedio">Intermedio
                    </option>
                    <option value="Avanzado">Avanzado</option>
                    <option value="Nativo">Nativo</option>
                </select>
            </div>
        </div>
    </div>
</div>


<?php
}
?>