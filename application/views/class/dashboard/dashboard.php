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
<div class="x_content">
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
                <th class="controls" align="center">NIP</th>
                <th class="controls" align="center">NAMA</th>
                <th class="controls" align="center">KETERANGAN <span ng-show="animate" class="fa fa-spin fa-spinner"></span></th>
            </tr>
        </thead>
        <tbody>
          <tr ng-repeat="item in presents">
              <td>{{$index + 1}}</td>
              <td>{{item.student_nip}}</td>
              <td>{{item.student_full_name}}</td>
              <td>
              <button ng-disabled="item.desc" class="btn btn-xs btn-info">Izin</button>
              <button class="btn btn-xs btn-warning">Sakit</button>
              <button class="btn btn-xs btn-danger">Alfa</button>
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