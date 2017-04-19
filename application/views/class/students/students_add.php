<?php
$this->load->view('admin/datepicker');
if (isset($student)) {
  $NisValue = $student['student_nis'];
  $NameValue = $student['student_full_name'];
  $PhoneValue = $student['student_phone'];
  $ClassValue = $student['classes_class_id'];
  $ReligionValue = $student['student_religion'];
  $GenderValue = $student['student_gender'];
  $DobValue = $student['student_dob'];
  $PobValue= $student['student_pob'];
  $AddressValue = $student['student_address'];

} else {
  $NisValue = set_value('student_nis'); 
  $NameValue = set_value('student_full_name');
  $PhoneValue = set_value('student_phone');
  $ClassValue = set_value('classes_class_id');
  $ReligionValue = set_value('student_religion');
  $GenderValue = set_value('student_gender');
  $DobValue = set_value('student_dob');
  $PobValue= set_value('student_pob');
  $AddressValue = set_value('student_address');
  $ClassValue = set_value('classes_class_id');
}
?>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-list"></i> <?php echo $operation ?> Siswa</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <!-- /.col-lg-12 -->
      <?php echo validation_errors(); ?>
      <?php echo form_open_multipart(current_url()); ?>
      <div class="col-sm-9 col-md-9">
        <?php if (isset($student)): ?>
          <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>" />
        <?php endif; ?>
        <div class="form-group">
          <label >NIS *</label>
          <input name="student_nis" required="" placeholder="NIS" type="numeric" class="form-control" value="<?php echo $NisValue; ?>">
        </div>
        <div class="form-group">
          <label >Nama *</label>
          <input name="student_full_name" required="" placeholder="Nama" type="text" class="form-control" value="<?php echo $NameValue; ?>">
        </div>
        <div class="row">
          <div class="col-md-4 col-xs-12">
            <label >Tempat Lahir *</label>
            <input name="student_pob" required="" placeholder="Tempat Lahir" type="text" class="form-control" value="<?php echo $PobValue; ?>">
          </div>
          <div class="col-md-4 col-xs-12">
            <label >Tanggal Lahir *</label>
            <input name="student_dob" required="" placeholder="Tanggal Lahir" type="text" class="datepicker form-control f_mr_top" value="<?php echo $DobValue; ?>">
          </div>
          <div class="col-md-4 col-xs-12">
            <label >Gender</label>
            <div class="radio">
              <label class="radio-inline">
                <input type="radio" name="student_gender" value="L" <?php echo ($GenderValue == 'L') ? 'checked' : '' ?>> Laki-laki
              </label>
              <label class="radio-inline">
                <input type="radio" name="student_gender" value="P" <?php echo ($GenderValue == 'P') ? 'checked' : '' ?>> Perempuan
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label >Agama *</label>
          <select name="student_religion" class="form-control">
            <option value="">- Pilih Agama -</option>
            <option value="Islam" <?php echo ($ReligionValue == 'Islam') ? 'selected' : '' ?>>Islam</option>
            <option value="Kristen" <?php echo ($ReligionValue == 'Kristen') ? 'selected' : '' ?>>Kristen</option>
            <option value="Katolik" <?php echo ($ReligionValue == 'Katolik') ? 'selected' : '' ?>>Katolik</option>
            <option value="Hindu" <?php echo ($ReligionValue == 'Hindu') ? 'selected' : '' ?>>Hindu</option>
            <option value="Budha" <?php echo ($ReligionValue == 'Budha') ? 'selected' : '' ?>>Budha</option>
            <option value="Kongucu" <?php echo ($ReligionValue == 'Kongucu') ? 'selected' : '' ?>>Konghucu</option>
          </select>
        </div>
        <div calss="form-group">
         <label>Telephone </label>
         <input name="student_phone" placeholder="Telephone" type="numeric" maxlength="13" class="form-control" value="<?php echo $PhoneValue; ?>">
       </div>
        </div>
        <div class="form-group">
        <p class="text text-muted"><i>*) Field Wajib Diisi</i></p>
      </div>
      <div class="col-sm-9 col-md-3">
        <div class="form-group">
          <button type="submit" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button>
          <a href="<?php echo site_url('class/students'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>