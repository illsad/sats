<?php $this->load->view('admin/datepicker') ?>
<div class="col-md-12 col-sm-12 col-xs-12" ng-controller="reportCtrl">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-list"></i> Daftar Kehadiran</h2>
      <ul class="nav navbar-right panel_toolbox">
      </li>
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>

  <div class="x_content">
    <div class="row">
      <?php echo form_open(current_url(), array('method' => 'get')) ?> 
      <div class="col-md-2">
        <select ng-change="loadClass(level_id)" ng-model="level_id" class="form-control">
          <option value="">- Pilih Jenjang -</option>
          <option value="X">X</option>
          <option value="XI">XI</option>
          <option value="XII">XII</option>
        </select>
      </div>
      <div class="col-md-2">
        <select name="c" ng-model="class_id" ng-readonly="classes.length < 1" class="form-control">
          <option value="">- Pilih Kelas -</option>
          <option value="{{class.class_id}}" ng-repeat="class in classes">{{class.class_level}} {{class.class_name}}</option>
        </select>
      </div>
      <div class="col-md-2">
        <input type="text" name="ds" <?php echo (isset($q['ds'])) ? 'value="'.$q['ds'].'"' : '' ?> class="datepicker form-control f_mr_top" placeholder="Tanggal Mulai">
      </div>
      <div class="col-md-2">
        <input type="text" name="de" <?php echo (isset($q['de'])) ? 'value="'.$q['de'].'"' : '' ?> class="datepicker form-control f_mr_top" placeholder="Tanggal Akhir">
      </div>
      <div class="col-md-1">
        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-filter"></i> Filter</button>
      </div>
      <div class="col-md-1">
        <a class="btn btn-sm btn-success" target="_blank" href="<?php echo site_url('admin/report/export_excel' . '/?' . http_build_query($q)) ?>" ><i class="fa fa-file-excel-o"></i> Eksport Excel</a>
      </div>
      <?php echo form_close() ?>
    </div>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="controls" align="center">NAMA SISWA</th>
            <th class="controls" align="center">NIS</th>
            <th class="controls" align="center">KELAS</th>
            <th class="controls" align="center">IZIN</th>
            <th class="controls" align="center">SAKIT</th>
            <th class="controls" align="center">ALFA</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(isset($q) AND count($q) > 0){
            $i = 0;
            $s = 0;
            $a = 0;
            foreach ($students as $key):
              foreach ($reports as $row): 
                if($key['student_id'] == $row['students_student_id']){
                  switch ($row['present_type']) {
                    case 'Izin':
                    $i++;
                    break;

                    case 'Sakit':
                    $s++;
                    break;

                    case 'Alfa':
                    $a++;
                    break;
                  }
                }
                endforeach;
                ?>
                <tr>
                  <td><?php echo $key['student_full_name'] ?></td>
                  <td><?php echo $key['student_nis'] ?></td>
                  <td><?php echo $key['class_level'].' '.$key['class_name'] ?></td>
                  <td><?php echo $i ?></td>
                  <td><?php echo $s ?></td>
                  <td><?php echo $a ?></td>
                </tr>
                <?php 
                $i = 0;
                $s = 0;
                $a = 0;
                endforeach;
              };
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    var app = angular.module("satsApp", []);
    app.controller('reportCtrl', function ($scope, $http) {
      $scope.base_url = "<?php echo site_url(); ?>";

      $scope.classes = [];

      $scope.loadClass = function(id) {
            // Get Classes by level
            var url = $scope.base_url + 'api/getClassByLevel/' + id;
            $http.get(url).then(function(response) {
              if (response.data != 'false') {
                $scope.classes = response.data;
              } else {
                $scope.classes = null;
              }
            });

          }

        });
    app.directive('integer', function(){
      return {
        require: 'ngModel',
        link: function(scope, ele, attr, ctrl){
          ctrl.$parsers.unshift(function(viewValue){
            return parseInt(viewValue, 10);
          });
        }
      };
    });
  </script>