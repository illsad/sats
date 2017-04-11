<?php
$this->load->view('admin/datepicker');
if (isset($class)) {
  $NameValue = $class['class_name'];
  $LevelValue = $class['class_level'];
  $TeacherValue = $class['teacher_name'];
  $UsernameValue = $class['username'];
} else {
  $NameValue = set_value('class_name');
  $LevelValue = set_value('class_level');
  $TeacherValue = set_value('teacher_name');
  $UsernameValue = set_value('username');
}
?>
<div class="col-md-12 col-sm-12 col-xs-12" ng-controller="classCtrl">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-list"></i> <?php echo $operation ?> Kelas</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <!-- /.col-lg-12 -->
      <?php echo validation_errors(); ?>
      <?php echo form_open_multipart(current_url()); ?>
      <div class="col-sm-9 col-md-9">
        <?php if (isset($class)): ?>
          <input type="hidden" name="class_id" value="<?php echo $class['class_id']; ?>" />
        <?php endif; ?>
        <div class="form-group">
          <label >Jenjang  <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
          <select name="class_level" required="" class="form-control">
            <option value="">- Pilih Jenjang -</option>
            <option value="X" <?php echo $LevelValue == 'X' ? 'selected' : '' ?>>X</option>
            <option value="XI" <?php echo $LevelValue == 'XI' ? 'selected' : '' ?>>XI</option>
            <option value="XII" <?php echo $LevelValue == 'XII' ? 'selected' : '' ?>>XII</option>
          </select>
        </div>
        <div class="form-group">
          <label >Nama Kelas *</label>
          <input name="class_name" required="" placeholder="Nama Kelas" type="text" class="form-control" value="<?php echo $NameValue; ?>">
        </div>
        <div class="form-group">
          <label >Wali Kelas *</label>
          <select class="select2_single form-control" name="teacher_id">
            <option value="">= Pilih Guru =</option>
            <option ng-repeat="item in teachers" value="{{ item.teacher_id}}">{{ item.teacher_name }}</option>
          </select>
          <a href="#myModal" data-toggle="modal" ><i class="fa fa-plus-circle"></i> Tambah Guru</a>
        </div>
        <div class="form-group">
          <label >Username *</label>
          <input name="username" required="" placeholder="Username" type="text" class="form-control" value="<?php echo $UsernameValue; ?>">
        </div>
        <?php if (!isset($class)): ?>
          <div class="form-group">
            <label >Password *</label>
            <input name="password" required="" placeholder="Password" type="password" class="form-control" >
          </div>
          <div class="form-group">
            <label >Konfirmasi Password *</label>
            <input name="passconf" required="" placeholder="Password" type="password" class="form-control" >
          </div>
        <?php endif ?>
        <p class="text text-muted"><i>*) Field Wajib Diisi</i></p>
      </div>
      <div class="col-sm-9 col-md-3">
        <div class="form-group">
          <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button>
          <a href="<?php echo site_url('admin/classes'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a>
          <?php if (isset($class)): ?>
            <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#confirm-del"><i class="fa fa-trash"></i> Hapus</button>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
  
  <!-- Modal -->
  <div class="modal fade modal-info" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <ng-form name="teacherForm">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Tambah Guru</h4>
          </div>
          <div class="modal-body">
            <div class="col-sm-12 col-md-12">
              <div class="form-group"> 
                <label >NIK  <i data-toggle="tooltip" title="Wajib diisi">*</i></label>
                <input name="teacher_nik" ng-model="teacher.nik" required="" placeholder="NIK" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label >NUPTK </label>
                <input name="teacher_nuptk" ng-model="teacher.nuptk" placeholder="NUPTK" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label >Nama *</label>
                <input name="teacher_name" ng-model="teacher.name" required="" placeholder="Nama" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label >Alamat  </label>
                <input name="teacher_address" ng-model="teacher.address" placeholder="Alamat" type="text" class="form-control">
              </div>
              <div class="row">
                <div class="col-md-4 col-xs-12">
                  <label >Tempat Lahir *</label>
                  <input name="teacher_pob" ng-model="teacher.pob" required="" placeholder="Tempat Lahir" type="text" class="form-control">
                </div>
                <div class="col-md-4 col-xs-12">
                  <label >Tanggal Lahir *</label>
                  <input name="teacher_dob" ng-model="teacher.dob" required="" placeholder="Tanggal Lahir" type="text" class="datepicker form-control f_mr_top">
                </div>
                <div class="col-md-4 col-xs-12">
                  <label >Gender *</label>
                  <div class="radio">
                    <label class="radio-inline">
                      <input type="radio" ng-model="teacher.gender" required=""  name="teacher_gender" value="L"> Laki-laki
                    </label>
                    <label class="radio-inline">
                      <input type="radio" ng-model="teacher.gender" required="" name="teacher_gender" value="P"> Perempuan
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label >Agama *</label>
                <select name="teacher_religion" ng-model="teacher.religion" required=""  class="form-control">
                  <option value="">- Pilih Agama -</option>
                  <option value="Islam">Islam</option>
                  <option value="Kristen">Kristen</option>
                  <option value="Katolik">Katolik</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Budha">Budha</option>
                  <option value="Kongucu">Konghucu</option>
                </select>
              </div>
              <div calss="form-group">
               <label>Telephone </label>
               <input name="teacher_phone" ng-model="teacher.phone" placeholder="Telephone" type="text" class="form-control">
             </div>
           </div>
           <div class="form-group">
            <p class="text text-muted"><i>*) Field Wajib Diisi</i></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="button" ng-disabled="teacherForm.$invalid" ng-click="addTeacher(teacher)" class="btn btn-primary">Simpan</button>
        </div>
      </ng-form>
    </div>
  </div>
</div>
</div>


<script>
  var BASEURL = '<?php echo site_url(); ?>';
  var app = angular.module("satsApp", []);
  app.controller('classCtrl', function ($scope, $http) {
    $scope.teachers = [];
    $scope.getTeacher = function () {

      var url = BASEURL + 'api/getTeacher';
      $http.get(url).then(function (response) {
        $scope.teachers = response.data;
        $scope.teacherModel = '<?php echo $TeacherValue ?>';
      })
    };
    $scope.addTeacher = function (data) {
      console.log(data);
      var postData = $.param({
        teacher_nik: data.nik,
        teacher_nuptk: data.nuptk,
        teacher_name: data.name,
        teacher_address: data.address,
        teacher_pob: data.pob,
        teacher_dob: data.dob,
        teacher_gender: data.gender,
        teacher_religion: data.religion,
        teacher_phone: data.phone
      });
      $.ajax({
        method: "POST",
        url: BASEURL + "admin/teachers/add",
        data: postData,
        success: function (response) {
          $('#myModal').modal('toggle');
          $scope.getTeacher();
          $scope.teacherModel = response;
          $scope.teacher = null;
        }
      });
    };

    angular.element(document).ready(function () {
      $scope.getTeacher();
    });
  });
</script>

<?php if (isset($class)): ?>
  <!-- Delete Confirmation -->
  <div class="modal fade" id="confirm-del">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><b><span class="fa fa-warning"></span> Konfirmasi Penghapusan</b></h4>
        </div>
        <div class="modal-body">
          <p>Data yang dipilih akan dihapus oleh sistem, apakah anda yakin?;</p>
        </div>
        <?php echo form_open('admin/classes/delete/' . $class['class_id']); ?>
        <div class="modal-footer">
          <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
          <input type="hidden" name="del_name" value="<?php echo $class['class_name'] ?>" />
          <button type="submit" class="btn btn-danger"> Ya</button>
        </div>
        <?php echo form_close(); ?>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endif; ?>
