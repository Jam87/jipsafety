<!--MODAL BANCOS-->
<div id="modalContacto" class="modal zoomIn" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden">
            <div class="modal-header bg-pattern p-3 headerRegister">
                <h4 class="card-title mb-0" id="titleModal">Nuevo Tipo de usuario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert alert-warning  rounded-0 mb-0">
                <i class="ri-alert-line me-3 align-middle"></i><b><?= $data['page_title_bold']; ?></b>
                <?= $data['descrption_modal1']; ?><span class="text-danger"> * </span><?= $data['descrption_modal2']; ?>
            </div>
            <div class="modal-body">
                <form method="post" id="formContacto" name="formContacto">

                    <input type="hidden" id="idContacto" name="idContacto" value="">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="Nombre" class="form-label">Descripción <span class="text-danger">*</span></label>
                                <select class="form-select mb-3" id="comboxContact" name="comboxContact">
                                    <option> --- seleccione ---</option>
                                    <option value="Celular claro"> Celular claro</option>
                                    <option value="Celular tigo">Celular tigo</option>
                                    <option value="Correo de trabajo">Correo de trabajo</option>
                                    <option value="Correo personal">Correo personal</option>
                                    <option value="Dirección de casa">Dirección de casa</option>
                                    <option value="Dirección de trabajo">Dirección de trabajo</option>
                                    <option value="Dirección de segundo trabajo">Dirección de segundo trabajo</option>
                                    <option value="Teléfono de casa">Teléfono de casa</option>
                                    <option value="Teléfono de trabajo">Teléfono de trabajo</option>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <div class="formulario__grupo" id="grupo__apellido">
                                    <label for="nombre">Teléfono <span class="text-danger">*</span></label>

                                    <select class="form-select mb-3" id="listTel" name="listTel" required>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                    </select>
                                </div><!-- Fin: apellido -->
                            </div>
                        </div>
                    </div><!-- Fin: grupo1 -->

                    <!-- GRUPO 2 -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="nombre">Correo <span class="text-danger">*</span></label>

                                <select class="form-select mb-3" id="listEmail" name="listEmail" required>
                                    <option value="1">Si</option>
                                    <option value="2">No</option>
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <label for="nombre">Url <span class="text-danger">*</span></label>

                                <select class="form-select mb-3" id="listUrl" name="listUrl" required>
                                    <option value="1">Si</option>
                                    <option value="2">No</option>
                                </select>

                            </div>

                            <div class="col-sm-4">
                                <label for="nombre">Url <span class="text-danger">*</span></label>

                                <select class="form-select mb-3" id="listStatus" name="listStatus" required>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>

                            </div>
                        </div>
                    </div><!-- Fin: grupo1 -->

                    <div class="text-end">
                        <button id="btnActionForm" class="btn-primary" type="submit" class="btn btn-form"><span id="btnText">Guardar</span></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->