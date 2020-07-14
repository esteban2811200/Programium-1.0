 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Perfil Usuario</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="<?= base_url('main') ?>">Inicio</a></li>
                         <li class="breadcrumb-item active">Perfil usuario</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">
             <?php
                $attributes = array('class' => 'form-vertical', 'id' => 'ProfileForm', 'role' => 'form');
                echo form_open_multipart('/main/profile', $attributes);
                ?>
             <div class="row">
                 <div class="col-md-3">
                     <!-- Profile Image -->
                     <div class="card card-primary card-outline">
                         <div class="card-body box-profile">
                             <div class="text-center">
                                 <?php
                                    $img = !empty($this->session->userdata('avatar')) ? base_url($this->session->userdata('avatar')) : base_url('assets/dist/img/avatar5.png');
                                    ?>
                                 <img id="inputProfile" class="profile-user-img img-fluid img-circle" src="<?= $img ?>" alt="User profile picture">
                             </div>
                             <h3 class="profile-username text-center"><?= $this->session->userdata('name') ?></h3>
                             <p class="text-muted text-center"><?= $this->session->userdata('role') ?></p>
                             <input type="file" name="inputAvatar" id="inputAvatar" class="btn btn-primary btn-block">
                         </div>
                         <!-- /.card-body -->
                     </div>
                     <!-- /.card -->
                 </div>
                 <!-- /.col -->
                 <div class="col-md-9">
                     <div class="card">
                         <div class="card-header p-2">
                             <ul class="nav nav-pills">
                                 <!-- <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                                 <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> -->
                                 <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Configuración</a></li>
                             </ul>
                         </div><!-- /.card-header -->
                         <div class="card-body">
                             <div class="tab-content">
                                 <div class="tab-pane active" id="settings">

                                     <div class="row">
                                         <div class="col-6">
                                             <div class="form-group row">
                                                 <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                                                 <div class="col-sm-10">
                                                     <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nombre" required value="<?= $this->session->userdata('name') ?>">
                                                 </div>
                                             </div>
                                             <div class="form-group row">
                                                 <label for="inputEmail" class="col-sm-2 col-form-label">Usuario</label>
                                                 <div class="col-sm-10">
                                                     <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Usuario" value="<?= $this->session->userdata('username') ?>">
                                                 </div>
                                             </div>
                                             <div class="form-group row">
                                                 <label for="inputPassword" class="col-sm-2 control-label">Contraseña</label>
                                                 <div class="col-sm-10">
                                                     <input id="inputPassword" name="inputPassword" type="password" class="form-control" placeholder="Contraseña" autocomplete="off">
                                                     <div class="text-muted">La contraseña solo se modificara si escribes algo. Recuerda que una vez se cambie la contraseña se cierra la sesión actúal.</div>
                                                 </div>
                                             </div>
                                             <div class="form-group row">
                                                 <label for="inputRole" class="col-sm-2 col-form-label">Perfil</label>
                                                 <div class="col-sm-10">
                                                     <select name="inputRole" id="inputRole" class="form-control" required>
                                                         <option value="0" disabled>Selecciona un perfil</option>
                                                         <option value="Administrator" <?= ($this->session->userdata('role') === 'Administrador') ? 'selected' : '' ?>>Administrador</option>
                                                         <option value="Profesor" <?= ($this->session->userdata('role') === 'Profesor') ? 'selected' : '' ?>>Profesor</option>
                                                         <option value="Estudiante" <?= ($this->session->userdata('role') === 'Estudiante') ? 'selected' : '' ?>>Estudiante</option>
                                                     </select>
                                                 </div>
                                             </div>
                                             <div class="form-group row">
                                                 <div class="offset-sm-2 col-sm-10">
                                                     <button id="saveProfile" name="saveProfile" value="saveProfile" type="submit" class="btn btn-danger">Guardar</button>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>

                                 </div>
                                 <!-- /.tab-pane -->
                             </div>
                             <!-- /.tab-content -->
                         </div><!-- /.card-body -->
                     </div>
                     <!-- /.nav-tabs-custom -->
                 </div>
                 <!-- /.col -->
             </div>
             <!-- /.row -->
             <?php echo form_close(); ?>
             <?php echo $this->session->flashdata('msg'); ?>
         </div><!-- /.container-fluid -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 <script>
     $(function() {
        const profile = function(data) {
             return new Promise((resolve, reject) => {
                 $.ajax({
                     url: '<?= base_url('main/profile') ?>',
                     method: 'post',
                     type: 'json',
                     processData: false,
                     contentType: false,
                     cache: false,
                     async: false,
                     data: data
                 }).done(resolve).fail(reject)
             })
         }

         const logout = function() {
             return new Promise((resolve, reject) => {
                 $.ajax({
                     url: '<?= base_url('main/logout') ?>',
                     method: 'post',
                     type: 'json',
                 }).done(resolve).fail(reject)
             })
         }


         function readURL(input) {
             if (input.files && input.files[0]) {
                 var reader = new FileReader();

                 reader.onload = function(e) {
                     $('#inputProfile').attr('src', e.target.result);
                 }

                 reader.readAsDataURL(input.files[0]); // convert to base64 string
             }
         }

         $("#inputAvatar").change(function() {
             readURL(this);
         });

         $('#ProfileForm').on('submit', function(e) {
             e.preventDefault();
             let _data = new FormData(this) //$(this).serialize();
             profile(_data).then(response => {
                 let r = JSON.parse(response);
                 if (r.estatus) {
                     Swal.fire({
                         icon: 'success',
                         text: r.message,
                         type: r.type
                     }).then(() => {
                         if (r.change_password !== undefined && r.change_password) {
                            logout().then( () => {
                                window.location.href = "<?=base_url('login')?>";
                            }).catch(error => console.log(error));
                         } else {
                            window.location.reload();
                         }
                         
                     });
                 } else {
                     Swal.fire('error', r.message, r.type);
                 }
             }).catch(error => {
                 console.log(error);
                 return false;
             })
         })
     });
 </script>