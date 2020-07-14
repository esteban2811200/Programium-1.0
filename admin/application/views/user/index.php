 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Usuarios</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="<?= base_url('main') ?>">Inicio</a></li>
                         <li class="breadcrumb-item">Configuraciones</li>
                         <li class="breadcrumb-item">Catalogos</li>
                         <li class="breadcrumb-item active">Usuarios</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <!-- /.card-header -->
                         <div class="card-body">
                             <table id="tblUsers" class="table table-bordered table-striped">
                                 <thead>
                                     <tr>
                                         <th>Id</th>
                                         <th>Nombre</th>
                                         <th>Usuario</th>
                                         <th>Perfil</th>
                                         <th>Ocupación</th>
                                         <th>Pais</th>
                                         <th>Provincia</th>
                                         <th>Ciudad</th>
                                         <th>Estatus</th>
                                         <th>Avatar</th>
                                         <th class="text-right">
                                             <a href="#" id="nuevo" class="btn btn-primary nuevo"><i class="fa fa-plus"></i> Nuevo</a>
                                         </th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                        foreach ($users as $key => $value) {
                                        ?>
                                         <tr>
                                             <td><?= $value->id ?></td>
                                             <td><?= $value->name . ' ' . $value->last_name ?></td>
                                             <td><?= $value->username ?></td>
                                             <td><?= $value->role ?></td>
                                             <td><?= $value->ocupation ?></td>
                                             <td><?= $value->country ?></td>
                                             <td><?= $value->province ?></td>
                                             <td><?= $value->city ?></td>
                                             <td class="text-center">
                                                 <?php
                                                    if ($value->status) {
                                                    ?>
                                                     <span class="right badge badge-success">Activo</span>
                                                 <?php
                                                    } else {
                                                    ?>
                                                     <span class="right badge badge-danger">Inactivo</span>
                                                 <?php
                                                    }
                                                    ?>
                                             </td>
                                             <td class="text-center">
                                                 <img height="45" class="img-circle elevation-2" src="<?= !empty($value->avatar) ? $value->avatar : base_url('assets/dist/img/avatar5.png') ?>" alt="<?= $value->username ?>">
                                             </td>
                                             <td class="text-center">
                                                 <?php
                                                    if ($value->status) {
                                                    ?>
                                                     <a href="#" data-id="<?= $value->id ?>" class="btn btn-success edit"><i class="fa fa-edit"></i> Editar</a>
                                                     <a href="#" data-id="<?= $value->id ?>" class="btn btn-danger cancel"><i class="fa fa-trash"></i> Desactivar</a>
                                                 <?php
                                                    } else {
                                                    ?>
                                                     <a href="#" data-id="<?= $value->id ?>" class="btn btn-warning active"><i class="far fa-check-square"></i> Activar</a>
                                                 <?php
                                                    }
                                                    ?>
                                             </td>
                                         </tr>
                                     <?php
                                        }
                                        ?>
                                 </tbody>
                             </table>
                         </div>
                         <!-- /.card-body -->
                     </div>
                     <!-- /.card -->
                 </div>
                 <!-- /.col -->
             </div>
             <!-- /.row -->
         </div><!-- /.container-fluid -->
         <div class="modal fade" id="modal-default">
             <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h4 class="modal-title  title-modal"></h4>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <form id="UserForm" method="POST">
                         <div class="modal-body">
                             <input type="hidden" name="id" id="id" value="0">
                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label>Nombre</label>
                                         <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" required>
                                     </div>
                                     <!-- /.form-group -->
                                     <div class="form-group">
                                         <label>Usuario</label>
                                         <input type="email" class="form-control" id="email" name="email" placeholder="Usuario" required>
                                         <div class="text-muted hide_new">&nbsp;</div>
                                     </div>
                                     <!-- /.form-group -->
                                     <div class="form-group">
                                         <label>Pais</label>
                                         <input type="text" class="form-control" id="country" name="country" placeholder="País">
                                     </div>
                                     <!-- /.form-group -->
                                     <div class="form-group">
                                         <label>Ciudad</label>
                                         <input type="text" class="form-control" id="city" name="city" placeholder="Ciudad">
                                     </div>
                                     <!-- /.form-group -->
                                     <div class="form-group">
                                         <label>Fecha Nacimiento</label>
                                         <input type="date" class="form-control" id="birth_date" name="birth_date" placeholder="Fecha nacimiento">
                                     </div>
                                     <!-- /.form-group -->
                                 </div>
                                 <!-- /.col -->
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label>Apellidos</label>
                                         <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Apellidos">
                                     </div>
                                     <!-- /.form-group -->
                                     <div class="form-group">
                                         <label>Contraseña</label>
                                         <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña" autocomplete="off">
                                         <div class="text-muted hide_new">La contraseña solo se modificara si escribes algo.</div>
                                     </div>
                                     <!-- /.form-group -->
                                     <div class="form-group">
                                         <label>Estado/Provincia</label>
                                         <input type="text" class="form-control" id="province" name="province" placeholder="Estado/Provincia">
                                     </div>
                                     <!-- /.form-group -->
                                     <!-- /.form-group -->
                                     <div class="form-group">
                                         <label>Ocupación</label>
                                         <input type="text" class="form-control" id="ocupation" name="ocupation" placeholder="Ocupación">
                                     </div>
                                     <!-- /.form-group -->
                                     <div class="form-group">
                                         <label>Perfil</label>
                                         <select name="role" id="role" class="form-control" required placeholder="Select">
                                             <option value="" selected>Selecciona un perfil</option>
                                             <option value="Administrador">Administrador</option>
                                             <option value="Profesor">Profesor</option>
                                             <option value="Estudiante">Estudiante</option>
                                         </select>
                                     </div>
                                 </div>
                                 <!-- /.col -->
                             </div>
                             <!-- /.row -->
                         </div>
                         <div class="modal-footer justify-content-between">
                             <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                             <button id="btnSave" name="btnSave" value="btnSave" type="submit" class="btn btn-primary">Guardar</button>
                         </div>
                     </form>
                 </div>
                 <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
         </div>
         <!-- /.modal -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->
 <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
 <script>
     $(function() {
         $("#tblUsers").DataTable({
             language: {
                 "sProcessing": "Procesando...",
                 "sLengthMenu": "Mostrar _MENU_ registros",
                 "sZeroRecords": "No se encontraron resultados",
                 "sEmptyTable": "Ningún dato disponible en esta tabla",
                 "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                 "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                 "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                 "sInfoPostFix": "",
                 "sSearch": "Buscar:",
                 "sUrl": "",
                 "sInfoThousands": ",",
                 "sLoadingRecords": "Cargando...",
                 "oPaginate": {
                     "sFirst": "Primero",
                     "sLast": "Último",
                     "sNext": "Siguiente",
                     "sPrevious": "Anterior"
                 },
                 "oAria": {
                     "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                     "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                 },
                 "buttons": {
                     "copy": "Copiar",
                     "colvis": "Visibilidad"
                 }
             }
         });

         $('.edit').on('click', function(e) {
             e.preventDefault();
             let _id = $(this).data('id');
             $('.hide_new').show();
             getUser(_id).then(response => {
                 $('.title-modal').html('Editar usuario');
                 let r = JSON.parse(response)
                 $('#id').val(r.data.id);
                 $('#name').val(r.data.name)
                 $('#last_name').val(r.data.last_name)
                 $('#email').val(r.data.username)
                 $('#country').val(r.data.country)
                 $('#province').val(r.data.province)
                 $('#city').val(r.data.city)
                 $('#ocupation').val(r.data.ocupation)
                 $('#role').val(r.data.role).change();
                 if (r.data.birth_date) {
                     $('#birth_date').val(r.data.birth_date)
                 }
                 $('#modal-default').modal();
             }).catch(error => console.log(error))
         });

         $('.nuevo').on('click', function(e) {
             e.preventDefault();
             $('.title-modal').html('Nuevo usuario');
             $('.hide_new').hide();
             $('#id').val(0);
             $('#name').val('')
             $('#last_name').val('')
             $('#email').val('')
             $('#country').val('')
             $('#province').val('')
             $('#city').val('')
             $('#ocupation').val('')
             $('#role').val('').change();
             $('#birth_date').val(null)
             $('#password').prop('required', true)
             $('#modal-default').modal();
         });

         $('.cancel').on('click', function(e) {
             e.preventDefault();
             let _id = $(this).data('id');
             Swal.fire({
                 title: 'Estas seguro?',
                 text: "No podes revertir esto!",
                 type: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Si, Continuar!',
                 cancelButtonText: 'No, Cancelar!'
             }).then((result) => {
                 if (result.value) {
                     cancel(_id).then(response => {
                         let r = JSON.parse(response)
                         if (r.estatus) {
                             Swal.fire({
                                 title: 'Cancelado!',
                                 text: r.message,
                                 type: 'success'
                             }).then(() => {
                                 location.reload()
                             })
                         } else {
                             Swal.fire('error', r.message, r.type);
                         }
                     }).catch(error => console.log(error))

                 }
             })
         })

         $('.active').on('click', function(e) {
             e.preventDefault();
             let _id = $(this).data('id');
             Swal.fire({
                 title: 'Estas seguro?',
                 text: "No podes revertir esto!",
                 type: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Si, Continuar!',
                 cancelButtonText: 'No, Cancelar!'
             }).then((result) => {
                 if (result.value) {
                     active(_id).then(response => {
                         let r = JSON.parse(response)
                         if (r.estatus) {
                             Swal.fire({
                                 title: 'Activado!',
                                 text: r.message,
                                 type: 'success'
                             }).then(() => {
                                 location.reload()
                             })
                         } else {
                             Swal.fire('error', r.message, r.type);
                         }
                     }).catch(error => console.log(error))

                 }
             })
         })

         $('#UserForm').on('submit', function(e) {
             e.preventDefault();

             let _id = $('#id').val();
             let _data = $(this).serialize();
             if (_id == 0) { //is new
                 add(_data).then(response => {
                     let r = JSON.parse(response);
                     if (r.estatus) {
                         Swal.fire({
                             icon: 'success',
                             text: r.message,
                             type: r.type
                         }).then(() => {
                             window.location.reload();
                         });
                     } else {
                         Swal.fire('error', r.message, r.type);
                     }
                 }).catch(error => console.log(error))
             } else { // is edit
                 edit(_data).then(response => {
                     let r = JSON.parse(response);
                     if (r.estatus) {
                         Swal.fire({
                             icon: 'success',
                             text: r.message,
                             type: r.type
                         }).then(() => {
                             window.location.reload();
                         });
                     } else {
                         Swal.fire('error', r.message, r.type);
                     }
                 }).catch(error => console.log(error))
             }

         })

     });

     const add = function(data) {
         return new Promise((resolve, reject) => {
             $.ajax({
                 url: '<?= base_url('user/add') ?>',
                 method: 'post',
                 type: 'json',
                 data: data
             }).done(resolve).fail(reject)
         });
     }

     const cancel = function(id) {
         return new Promise((resolve, reject) => {
             $.ajax({
                 url: '<?= base_url('user/delete') ?>',
                 method: 'post',
                 type: 'json',
                 data: {
                     id: id
                 }
             }).done(resolve).fail(reject)
         });
     }

     const active = function(id) {
         return new Promise((resolve, reject) => {
             $.ajax({
                 url: '<?= base_url('user/active') ?>',
                 method: 'post',
                 type: 'json',
                 data: {
                     id: id
                 }
             }).done(resolve).fail(reject)
         });
     }

     const edit = function(data) {
         return new Promise((resolve, reject) => {
             $.ajax({
                 url: '<?= base_url('user/edit') ?>',
                 method: 'post',
                 type: 'json',
                 data: data
             }).done(resolve).fail(reject)
         });
     }
     const getUser = function(id) {
         return new Promise((resolve, reject) => {
             $.ajax({
                 url: '<?= base_url('user/finduser') ?>',
                 method: 'post',
                 type: 'json',
                 data: {
                     id: id
                 }
             }).done(resolve).fail(reject)
         });
     }
 </script>