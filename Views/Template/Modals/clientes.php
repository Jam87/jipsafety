<!--MODAL DE CLIENTES-->
<div id="modalClientes" class="modal zoomIn" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 overflow-hidden" style="background: #F2F2F2 !Important;">
            <div class="modal-header bg-pattern p-3 headerRegister">
                <h4 class="card-title mb-0" id="titleModal">Nuevo usuario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert alert-warning  rounded-0 mb-0">
                <i class="ri-alert-line me-3 align-middle"></i><b><?= $data['page_title_bold']; ?></b>
                <?= $data['descrption_modal1']; ?><span class="text-danger"> * </span><?= $data['descrption_modal2']; ?>
            </div>
            <div class="modal-body">
                <!-- TODO: Formulario de Mantenimiento -->
                <form method="post" id="formClientes" name="formClientes">
                    <input type="hidden" id="idClientes" name="idClientes" value="">
                    <div class="modal-body">

                        <div class="row">
                            <div class="">
                                <div class="card pag-title-box">
                                    <div class="pag-title-box">
                                        <h4 class="card-title mb-0 flex-grow-1">Datos generales</h4>
                                        <div>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="p-3 col-xl-12">
                                        <div>
                                            <div>
                                                <!--GRUPO 1-->
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-border" name="nombre" id="nombre" placeholder="Escriba el nombre" autocomplete="off" required>
                                                        </div><!--Nombre-->

                                                        <div class="col-sm-4">
                                                            <label for="nombre">Ruc <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-border" name="ruc" id="ruc" placeholder="Digite el ruc" autocomplete="off" required>
                                                        </div><!--Ruc-->

                                                        <div class="col-sm-4">
                                                            <label for="pais">Pais<span class="text-danger">*</span></label>
                                                            <select class="form-select mb-3" id="comboxPais" name="comboxPais">

                                                            </select>
                                                        </div><!--Pais-->
                                                    </div>
                                                </div>

                                                <!--GRUPO 2-->
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label for="pais">Persona ontacto<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-border" name="personaContacto" id="personaContacto" placeholder="Escriba el contacto" autocomplete="off" required>
                                                        </div><!--Contacto-->

                                                        <div class="col-sm-4">
                                                            <label for="pais">Forma de pago<span class="text-danger">*</span></label>
                                                            <select class="form-select mb-3" id="comboxPago" name="comboxPago">

                                                            </select>
                                                        </div><!--Forma pago-->

                                                        <div class="col-sm-4">
                                                            <label for="Excento">Excento impuesto <span class="text-danger">*</span></label>

                                                            <select class="form-select mb-3" id="statusImpuesto" name="statusImpuesto" required>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                            </select>
                                                        </div>


                                                    </div>
                                                </div><!-- Fin: grupo2 -->

                                                <!--GRUPO 3-->
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label for="nombre">Estado <span class="text-danger">*</span></label>
                                                            <select class="form-select mb-3" id="lStatus" name="lStatus" required>
                                                                <option value="1">Activo</option>
                                                                <option value="2">Inactivo</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div><!-- Fin: grupo3 -->

                                            </div>

                                            <!--end col-->
                                        </div>
                                    </div><!-- end card header -->


                                </div><!-- end card -->
                            </div><!-- end col -->
                            <!-- end col -->
                        </div><!--Fin: 1 card-->

                        <div class="row">
                            <div class="">
                                <div class="card pag-title-box2">
                                    <div class="pag-title-box2">
                                        <h4 class="card-title mb-0 flex-grow-1">Datos contacto</h4>
                                        <div>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="row">
                                        <div class="col-xxl-6">

                                            <!--SELECT CONTACTO-->
                                            <div>


                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="formulario__grupo" id="grupo__apellido">
                                                                <label for="nombre">Contacto <span class="text-danger">*</span></label>
                                                                <!--<select class="form-select mb-3" id="comboxContacto" name="comboxContacto">

                                                                                   </select>-->
                                                                <select class="form-select mb-3" id="comboxContact" name="comboxContact">
                                                                    <option> --- seleccione ---</option>
                                                                    <option value="Celular-claro"> Celular claro</option>
                                                                    <option value="Celular tigo">Celular tigo</option>
                                                                    <option value="Correo de trabajo">Correo de trabajo</option>
                                                                    <option value="Correo personal">Correo personal</option>
                                                                    <option value="Dirección de casa">Dirección de casa</option>
                                                                    <option value="Dirección de trabajo">Dirección de trabajo</option>
                                                                    <option value="Dirección de segundo trabajo">Dirección de segundo trabajo</option>
                                                                    <option value="Teléfono de casa">Teléfono de casa</option>
                                                                    <option value="Teléfono de trabajo">Teléfono de trabajo</option>
                                                                </select>
                                                            </div><!-- Fin: password-->
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="formulario__grupo" id="grupo__nombre">
                                                                <label for="nombre">Descripción <span class="text-danger">*</span></label>

                                                                <div class="formulario__grupo-input">
                                                                    <input type="text" class="form-border" name="Descripcion" id="Descripcion" placeholder="Teléfono, Correo, Dirección" autocomplete="off">
                                                                </div>

                                                            </div><!-- Fin: nombre -->
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="formulario__grupo" id="grupo__apellido">
                                                                <label for="nombre">Extensión <span class="text-danger">*</span></label>

                                                            </div><!-- Fin: apellido -->
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="Extension" id="Extension" placeholder="Digite la extensión">
                                                                <!--<button id="btnAd" type="button" class="btn btn-success">Button</button>-->

                                                                <button id="btnAdd" type="button" class="btn btn-success">
                                                                    <span>
                                                                        <i class="ri-add-fill"></i>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div><!-- Fin: grupo1 -->

                                                <!--<div class="control">
                                                    <button id="btnSave" type="button" class="button is-info">
                                                        Guardar
                                                    </button>
                                                </div>-->



                                                <!--Div donde se pone el resultado-->
                                                <div id="divElements">

                                                </div>

                                            </div>

                                        </div>
                                        <!--end col-->


                                    </div>


                                </div><!-- end card -->
                            </div><!-- end col -->
                            <!-- end col -->
                        </div> <!--Fin: 2 card-->


                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" id="btnActionForm" name="action" value="add" class="btn btn-primary "><span id="btnText">Guardar</span></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->