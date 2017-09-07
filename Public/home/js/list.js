var app = angular.module('myApp', ['ipCookie']);
app.controller('ListController', ['$scope', 'ipCookie', '$location', function ($scope, ipCookie, $location) {
    var arr = $location.absUrl().split('=');
    $scope.p = 1;
    $scope.rent_price_min = {
        '10000': 'HUF 10000',
        '20000' :'HUF 20000',
        '50000' :'HUF 50000',
        '70000' :'HUF 70000',
        '80000' :'HUF 80000',
        '90000' :'HUF 90000',
        '100000' :'HUF 100000'
    };
    $scope.rent_price_max = {
        '10000': 'HUF 10000',
        '20000' :'HUF 20000',
        '50000' :'HUF 50000',
        '70000' :'HUF 70000',
        '80000' :'HUF 80000',
        '90000' :'HUF 90000',
        '100000' :'HUF 100000'
    };
    $scope.sale_price_min = {
        '100000': 'HUF 100000',
        '200000' :'HUF 200000',
        '500000' :'HUF 500000',
        '700000' :'HUF 700000',
        '800000' :'HUF 800000',
        '900000' :'HUF 900000',
        '1000000' :'HUF 1000000'
    };
    $scope.sale_price_max = {
        '100000': 'HUF 100000',
        '200000' :'HUF 200000',
        '500000' :'HUF 500000',
        '700000' :'HUF 700000',
        '800000' :'HUF 800000',
        '900000' :'HUF 900000',
        '1000000' :'HUF 1000000'
    };
    if(arr[(arr.length - 1)].substring(0, 5) === 'index') {
        $scope.location_area = ipCookie('location_area') ? ipCookie('location_area').toString() : null;
        $scope.type = ipCookie('type') ? ipCookie('type').toString() : null;
        $scope.bedrooms = ipCookie('bedrooms') ? ipCookie('bedrooms').toString() : null;
        $scope.bathrooms = ipCookie('bathrooms') ? ipCookie('bathrooms').toString() : null;
        $scope.min_area = ipCookie('min_area') ? ipCookie('min_area').toString() : null;
        $scope.max_area = ipCookie('max_area') ? ipCookie('max_area').toString() : null;
        $scope.min_price = ipCookie('min_price') ? ipCookie('min_price').toString() : null;
        $scope.max_price = ipCookie('max_price') ? ipCookie('max_price').toString() : null;
    } else {
        $scope.location_area = null;
        $scope.type = null;
        $scope.bedrooms = null;
        $scope.bathrooms = null;
        $scope.min_area = null;
        $scope.max_area = null;
        $scope.min_price = null;
        $scope.max_price = null;
    }
    $scope.lan = $('#lan-val').val();
    $scope.area_list = {};
    $scope.house_list = {};

    $scope.jumpToLists = function () {
        if ($scope.min_area > $scope.max_area) {
            if($scope.lan === 'hu-hu') {
                layer.msg('Kérjük, válasszon helyet helyesen');
            } else {
                layer.msg('请正确选择面积');
            }
            return false;
        }
        if ($scope.min_price > $scope.max_price) {
            if($scope.lan === 'hu-hu') {
                layer.msg('Kérjük, válassza ki a megfelelő árat');
            } else {
                layer.msg('请正确选择价格');
            }
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
            if($scope.lan === 'hu-hu') {
                layer.msg('Nem sikerült tájékozódási információt szerezni');
            } else {
                layer.msg('获取地区信息失败');
            }
        }
    });

    $scope.getList = function () {
        $.ajax({
            url: '/home/index/getList',
            data :{
                'p': $scope.p,
                'location_area' : $scope.location_area,
                'type': $scope.type,
                'bedrooms' : $scope.bedrooms,
                'bathrooms' : $scope.bathrooms,
                'min_area' : $scope.min_area,
                'max_area' : $scope.max_area,
                'min_price' : $scope.min_price,
                'max_price' : $scope.max_price
            },
            type: 'POST',
            dataType: 'json',
            success: function (res) {
                if (res.code === 200) {
                    $scope.house_list = res.data.content;
                    $scope.countHouse = res.data.count;
                    $scope.countPage = res.data.countPage;
                    $scope.$digest();
                } else layer.msg(res.msg);
            },
            error: function () {
                if($scope.lan === 'hu-hu') {
                    layer.msg('A rendelkezésre állás információk lekérése sikertelen');
                } else {
                    layer.msg('获取房源信息失败');
                }
            }
        });
    };
    $scope.getList();

    $scope.getMore = function (page) {
        $scope.p = page;
        $scope.getList();
        document.getElementById('titleHeader').scrollIntoView();
    };

    $scope.changeLan = function () {
        var url = window.location.href;
        if (url.indexOf('form=index')) {
            if ($scope.lan === 'hu-hu'){
                window.location.href = window.location.pathname + '?form=index&l=hu-hu';
            } else {
                window.location.href = window.location.pathname + '?form=index&l=zh-CN';
            }
        } else {
            if ($scope.lan === 'hu-hu'){
                window.location.href = url + '?l=hu-hu';
            } else {
                window.location.href = url + '?l=zh-CN';
            }
        }

    };

    $scope.choosePrice = function () {
        if($scope.type !== 'rent' || $scope.type !== 'sale') {
            if($scope.lan === 'hu-hu') {
                layer.msg('Nem választottál bérelni / eladni');
            } else {
                layer.msg('您未选择 出租/售卖');
            }

        }
    };


}]);