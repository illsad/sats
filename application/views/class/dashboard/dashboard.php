<div class="col-md-12 col-sm-12 col-xs-12" ng-controller="presentCtrl">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-list"></i> Dashboard</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content table-responsive">
    <div ng-hide="presents.length > 0" class="alert alert-warning">
        <center>
            <h5 class="text text-warning">Hari ini belum input absensi!</h5>
            <span><button class="btn btn-success" data-toggle="modal" data-target="#myModal"><span class="fa fa-edit"></span> Input Absensi</button></span>
        </center>
    </div>
    <table ng-show="presents.length > 0" class="table table-striped">
        <thead>
            <tr>
                <th class="controls" align="center">NO</th>
                <th class="controls hidden-xs" align="center">NIS</th>
                <th class="controls" align="center">NAMA</th>
                <th class="controls" align="center">KETERANGAN <span ng-show="animate" class="fa fa-spin fa-spinner"></span></th>
            </tr>
        </thead>
        <tbody>
          <tr ng-repeat="item in presents">
              <td>{{$index + 1}}</td>
              <td class="hidden-xs">{{item.student_nis}}</td>
              <td>{{item.student_full_name}}</td>
              <td>
              <?php if( (date('H') >= 7) && (date('H') < 9) ){ ?>
              <select class="form-control" ng-class="[item.present_type]" ng-model="presentInput" ng-init="presentInput = item.present_type" ng-change="inputType(presentInput, item.present_id)">
                <option value="Hadir">Hadir</option>
                <option value="Izin">Izin</option>
                <option value="Sakit">Sakit</option>
                <option value="Alfa">Alfa</option>
              </select>
              <?php }else{ ?>
              <span class="btn btn-default btn-xs" disabled="">{{item.present_type}}</span>
              <?php } ?>
              </td>
          </tr>
      </tbody>
  </table>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
    </div>
    <div class="modal-body">
        Apakah anda yakin ingin membuat absensi hari ini?
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">TIDAK</button>
        <button type="button" class="btn btn-primary" ng-click="makePresent(<?php echo $class['class_id'] ?>)">YA</button>
    </div>
</div>
</div>
</div>
</div>

<script>
    var BASEURL = '<?php echo site_url(); ?>';
    var app = angular.module("satsApp", []);
    app.controller('presentCtrl', function ($scope, $http) {
        $scope.presents = [];

        $scope.inputType = function (type, id) {
            var postData = $.param({
                present_id: id,
                present_type: type,
            });
            $.ajax({
                method: "POST",
                url: BASEURL + "api/inputType",
                data: postData,
                success: function (response) {
                  console.log(response);
                    $scope.getPresentToday();
                }
            });
        }

        $scope.makePresent = function (id) {
            var postData = $.param({
                class_id: id,
            });
            $.ajax({
                method: "POST",
                url: BASEURL + "api/makePresentToday",
                data: postData,
                success: function (response) {
                    $('#myModal').modal('toggle');
                    $scope.getPresentToday();
                }
            });
        }

        $scope.getPresentToday = function () {

            var url = BASEURL + 'api/getPresentToday/<?php echo $class['class_id'] ?>';
            $http.get(url).then(function (response) {
                $scope.presents = response.data;
            });
        }

        angular.element(document).ready(function () {
            $scope.getPresentToday();
        });
    });
</script>