var app = angular.module('myApp', ['ipCookie']);
app.controller('ServiceItemsController', ['$scope', 'ipCookie', function ($scope, ipCookie) {
    $scope.lan = $('#lan-val').val();

    $scope.changeLan = function () {
        if ($scope.lan === 'hu-hu'){
            window.location.href = window.location.pathname + '?l=hu-hu';
        } else {
            window.location.href = window.location.pathname + '?l=zh-CN';
        }

    };



}]);