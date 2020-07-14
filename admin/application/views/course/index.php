 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Cursos</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="<?= base_url('main') ?>">Inicio</a></li>
                         <li class="breadcrumb-item">Configuraciones</li>
                         <li class="breadcrumb-item">Catalogos</li>
                         <li class="breadcrumb-item active">Cursos</li>
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
                             <table id="tblCourses" class="table table-bordered table-striped">
                                 <thead>
                                     <tr>
                                         <th>Id</th>
                                         <th>Nombre</th>
                                         <th>Descripción</th>
                                         <th>Profesor</th>
                                         <th>Tema</th>
                                         <th>Nivel</th>
                                         <th>Estatus</th>
                                         <th width="250px" class="text-right">
                                             <a href="#" id="nuevo" class="btn btn-primary nuevo"><i class="fa fa-plus"></i> Nuevo</a>
                                         </th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                        foreach ($courses as $key => $value) {
                                        ?>
                                         <tr>
                                             <td><?= $value->id ?></td>
                                             <td><?= $value->name ?></td>
                                             <td><?= $value->description ?></td>
                                             <td><?= $value->teacher . ' ' . $value->last_name ?></td>
                                             <td><?= $value->theme ?></td>
                                             <td><?= $value->nivel ?></td>
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
                     <form id="CourseForm" method="POST">
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
                                         <label>Nivel</label>
                                         <select class="form-control" name="nivel" id="nivel" required>
                                             <option value="">Seleccione un nivel</option>
                                             <option value="Basico">Basico</option>
                                             <option value="Intermedio">Intermedio</option>
                                             <option value="Avanzado">Avanzado</option>
                                         </select>
                                     </div>
                                     <!-- /.form-group -->
                                     <div class="form-group">
                                         <label>Tema</label>
                                         <select class="form-control" name="theme" id="theme">
                                             <option value="" selected disabled>Seleccione un tema</option>
                                             <?php
                                                foreach ($themes as $key => $value) {
                                                ?>
                                                 <option value="<?= $value->id ?>"><?= $value->name ?></option>
                                             <?php
                                                }
                                                ?>
                                         </select>
                                     </div>
                                     <!-- /.form-group -->
                                 </div>
                                 <!-- /.col -->
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label>Descripción</label>
                                         <input type="text" name="description" id="description" class="form-control" placeholder="Descripción">
                                     </div>
                                     <!-- /.form-group -->
                                     <div class="form-group">
                                         <label>Instructor</label>
                                         <select class="form-control" name="teacher" id="teacher">
                                             <option value="" selected disabled>Seleccione un instructor</option>
                                             <?php
                                                foreach ($docentes as $key => $value) {
                                                ?>
                                                 <option value="<?= $value->id ?>"><?= $value->name . ' ' . $value->last_name ?></option>
                                             <?php
                                                }
                                                ?>
                                         </select>
                                     </div>
                                     <!-- /.form-group -->
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
         $("#tblCourses").DataTable({
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
             getCourse(_id).then(response => {
                 $('.title-modal').html('Editar Curso');
                 let r = JSON.parse(response)
                 $('#id').val(r.data.id);
                 $('#name').val(r.data.name)
                 $('#description').val(r.data.description)
                 $('#nivel').val(r.data.nivel)
                 $('#teacher').val(r.data.instructor).change();
                 $('#theme').val(r.data.theme_id).change();

                 $('#modal-default').modal();
             }).catch(error => console.log(error))
         });

         $('.nuevo').on('click', function(e) {
             e.preventDefault();
             $('.title-modal').html('Nuevo courso');
             $('#id').val(0);
             $('#name').val('')
             $('#description').val('')
             $('#nivel').val('')
             $('#teacher').val('').change();
             $('#theme').val('').change();

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

         $('#CourseForm').on('submit', function(e) {
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
                 url: '<?= base_url('course/addcourse') ?>',
                 method: 'post',
                 type: 'json',
                 data: data
             }).done(resolve).fail(reject)
         });
     }

     const cancel = function(id) {
         return new Promise((resolve, reject) => {
             $.ajax({
                 url: '<?= base_url('course/deletecourse') ?>',
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
                 url: '<?= base_url('course/activecourse') ?>',
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
                 url: '<?= base_url('course/editcourse') ?>',
                 method: 'post',
                 type: 'json',
                 data: data
             }).done(resolve).fail(reject)
         });
     }
     const getCourse = function(id) {
         return new Promise((resolve, reject) => {
             $.ajax({
                 url: '<?= base_url('course/findcourse') ?>',
                 method: 'post',
                 type: 'json',
                 data: {
                     id: id
                 }
             }).done(resolve).fail(reject)
         });
     }
 </script>