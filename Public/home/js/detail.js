var app = angular.module('myApp', ['ipCookie']);
app.controller('DetailController', ['$scope', 'ipCookie', function ($scope, ipCookie) {
    $scope.location_area = null;
    $scope.type = 'sale';
    $scope.bedrooms = null;
    $scope.bathrooms = null;
    $scope.min_area = null;
    $scope.max_area = null;
    $scope.min_price = null;
    $scope.max_price = null;
    $scope.lan = $('#lan-val').val();
    $scope.area_list = {};
    $.ajax({
        url: '/home/index/getAreaList',
        data: {},
        type: 'POST',
        dataType: 'json',
        success: function (res) {
            if (res.code === 200) {
                $scope.area_list = res.data;
                $scope.$digest();
            } else layer.msg(res.msg);
        },
        error: function () {
            layer.msg('获取地区信息失败');
        }
    });

    $scope.jumpToLists = function () {
        if ($scope.min_area > $scope.max_area) {
            layer.msg('请正确选择面积');
            return false;
        }
        if ($scope.min_price > $scope.max_price) {
            layer.msg('请正确选择价格');
            return false;
        }
        ipCookie('location_area', $scope.location_area, { path: '/home/index/lists' });
        ipCookie('type', $scope.type, { path: '/home/index/lists' });
        ipCookie('bedrooms', $scope.bedrooms, { path: '/home/index/lists' });
        ipCookie('bathrooms', $scope.bathrooms, { path: '/home/index/lists' });
        ipCookie('min_area', $scope.min_area, { path: '/home/index/lists' });
        ipCookie('max_area', $scope.max_area, { path: '/home/index/lists' });
        ipCookie('min_price', $scope.min_price, { path: '/home/index/lists' });
        ipCookie('max_price', $scope.max_price, { path: '/home/index/lists' });
        window.location.href = '/home/index/lists?form=index';
    };

    $scope.changeToRent = function (d) {
        $scope.type = d;
    };

    $scope.changeLan = function () {
        if ($scope.lan === 'hu-hu'){
            window.location.href = window.location.pathname + '?l=hu-hu';
        } else {
            window.location.href = window.location.pathname + '?l=zh-CN';
        }

    };



}]);