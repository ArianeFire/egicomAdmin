var app = angular.module("app", []);

app.factory('DataSource', ['$http',function($http){
    return {
        delete : function(url, callback){
                    $http({
                            method: 'DELETE',
                            url: url
                    }).
                        success(function(data, status) {
                            //console.log("Extract : "+status, data);
                            callback(data, status);
                        }).error(function(data, status) {
                            callback(data, status);
                            console.log("delete code error " + status);
                        });
        }
    };
}]);


app.controller("appCtrl", function($scope, DataSource, $location){

    $scope.title = "";
    $scope.description = "";
    $scope.url = "";

    $scope.showModal = function(title, description, url){
        $scope.title = title;
        $scope.description = description;
        $scope.url = url;
        $('#myModal').modal('show');
        console.log('ShowModal called');
    };

    $scope.delete = function(){
        DataSource.delete($scope.url, function(data, state){
            $('#myModal').modal('hide');
            window.location.reload(false);
        });
    };
});


