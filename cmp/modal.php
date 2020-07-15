<!-- Modals -->
<!-- Add Modal-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar nova foto</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user">
                    <div class="form-group">
                        <input id="titulo_add" type="text" class="form-control form-control-user" placeholder="Nome"/>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input id="foto_add" name="foto_add" type="file" class="form-control form-control-user" placeholder="Foto" accept=".jpg,.jpeg,.png"/>
                    </div>
                    <hr />
                    <div id="adicionar_state" class="" role="alert">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-success" href="javascript:adicionar()">Adicionar</a>
            </div>
        </div>
    </div>
</div>
<!-- Upd Modal-->
<div class="modal fade" id="updModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alterar foto</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user">
                    <div class="form-group">
                        <input id="id_upd" type="hidden" class="form-control form-control-user" />
                    </div>
                    <div class="form-group">
                        <label>Nome</label>
                        <input id="titulo_upd" type="text" class="form-control form-control-user" />
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input id="foto_upd" name="foto_upd" type="file" class="form-control form-control-user" accept=".jpg,.jpeg,.png"/>
                    </div>
                    <hr />
                    <div id="modificar_state" class="" role="alert">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-success" href="javascript:modificarAsync()">Alterar</a>
            </div>
        </div>
    </div>
</div>
<!-- Del Modal-->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar foto</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div id="delModalBody" class="modal-body"></div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-success" href="javascript:eliminarAsync()">Eliminar</a>
            </div>
        </div>
    </div>
</div>