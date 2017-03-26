<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-list"></i> Detail Kelas</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="btn btn-info" href="<?php echo site_url('admin/classes') ?>"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
        </li>
        <li><a class="btn btn-success" href="<?php echo site_url('admin/classes/edit/' . $class['class_id']) ?>"><i class="fa fa-edit"></i>&nbsp; Edit</a>
        </li>
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>Kelas</td>
            <td>:</td>
            <td><?php echo $class['class_level'] . ' ' . $class['class_name'] ?></td>
          </tr>
          <tr>
            <td>Wali Kelas</td>
            <td>:</td>
            <td><?php echo $class['teacher_name'] ?></td>
          </tr>
          <tr>
            <td>Tahun</td>
            <td>:</td>
            <td><?php echo $class['class_years'] ?></td>
          </tr>
          <tr>
            <td>Username</td>
            <td>:</td>
            <td><?php echo $class['username'] ?></td>
          </tr>
          <tr>
            <td>Penulis</td>
            <td>:</td>
            <td><?php echo $class['user_full_name']; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-users"></i> Daftar Siswa</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>&nbsp; Tambah</button>
        </li>
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Total Absensi / Bulan</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Daftar Siswa</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Diagram / Bulan</a>
          </li>
        </ul>
        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th class="controls" align="center">NAMA SISWA</th>
                    <th class="controls" align="center">NIP</th>
                    <th class="controls" align="center">KELAS</th>
                    <th class="controls" align="center">IZIN</th>
                    <th class="controls" align="center">SAKIT</th>
                    <th class="controls" align="center">ALFA</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i = 0;
                  $s = 0;
                  $a = 0;
                  $x = 0;
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
                        <td><a href="<?php echo site_url('admin/students/'.$key['student_id']) ?>">
                          <b><?php echo $key['student_full_name'] ?></b></a></td>
                          <td><?php echo $key['student_nip'] ?></td>
                          <td><?php echo $key['class_level'].' '.$key['class_name'] ?></td>
                          <td><?php echo $i ?></td>
                          <td><?php echo $s ?></td>
                          <td><?php echo $a ?></td>
                        </tr>
                        <?php 
                        $varStudents[$x] = $key['student_full_name'];
                        $varIzin[$x] = $i;
                        $varSakit[$x] = $s;
                        $varAlfa[$x] = $a;
                        $i = 0;
                        $s = 0;
                        $a = 0;
                        $x++;
                        endforeach;
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th class="controls" align="center">NAMA SISWA</th>
                          <th class="controls" align="center">NIS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($students as $student): ?>
                          <tr>
                            <td>
                              <a href="<?php echo site_url('admin/students/'.$key['student_id']) ?>">
                                <b><?php echo $student['student_full_name'] ?></b>
                              </a>
                            </td>
                            <td>
                              <?php echo $student['student_nip'] ?>
                            </td>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                  <canvas id="canvas_bar"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="myModal">
        <div class="modal-dialog">
          <?php echo form_open('admin/classes/addStudent/' . $class['class_id']); ?>
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><b><span class="fa fa-users"></span> Tambah Siswa</b></h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label >NIP *</label>
                <input name="student_nip" required="" placeholder="NIP" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label >Nama *</label>
                <input name="student_full_name" required="" placeholder="Nama" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label >No. Telepon</label>
                <input name="student_phone" required="" placeholder="Phone" type="number" class="form-control">
              </div>
              <p class="text text-muted"><i>*) Field Wajib Diisi</i></p>
            </div>

            <div class="modal-footer">
              <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Batal</button></a>

              <button type="submit" class="btn btn-success"> Submit</button>
            </div>
            <?php echo form_close(); ?>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

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

        var ctx = document.getElementById("canvas_bar");
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: [<?php foreach ($varStudents as $key => $value) {
              echo '"'.$value.'",';
            }  ?>],
            datasets: [
            {
                    label:'Izin',
                    backgroundColor: "#26B99A", //rgba(220,220,220,0.5)
                    strokeColor: "#26B99A", //rgba(220,220,220,0.8)
                    highlightFill: "#36CAAB", //rgba(220,220,220,0.75)
                    highlightStroke: "#36CAAB", //rgba(220,220,220,1)
                    data: [<?php foreach ($varIzin as $key => $value) {
              echo '"'.$value.'",';
            }  ?>]
                  },
                  {
                    label:'Sakit',
                    backgroundColor: "#f39c12", //rgba(151,187,205,0.5)
                    strokeColor: "#03586A", //rgba(151,187,205,0.8)
                    highlightFill: "#066477", //rgba(151,187,205,0.75)
                    highlightStroke: "#066477", //rgba(151,187,205,1)
                    data: [<?php foreach ($varSakit as $key => $value) {
              echo '"'.$value.'",';
            }  ?>]
                  },
                  {
                    label:'Alfa',
                    backgroundColor: "#e74c3c", //rgba(151,187,205,0.5)
                    strokeColor: "#03586A", //rgba(151,187,205,0.8)
                    highlightFill: "#066477", //rgba(151,187,205,0.75)
                    highlightStroke: "#066477", //rgba(151,187,205,1)
                    data: [<?php foreach ($varAlfa as $key => $value) {
              echo '"'.$value.'",';
            }  ?>]
                  }
                  ]
                },
                options: {
                  responsive:true,
                  scales: {
                    yAxes: [{
                      ticks: {
                        beginAtZero:true
                      }
                    }]
                  }
                }
              });
            </script>
