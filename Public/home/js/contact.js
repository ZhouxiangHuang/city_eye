var app = angular.module('myApp', ['ipCookie']);
app.controller('ContactController', ['$scope', 'ipCookie', function ($scope, ipCookie) {

    $scope.name = null;
    $scope.email = null;
    $scope.phone = null;
    $scope.subject = null;
    $scope.message = null;

    $scope.sendMail = function () {
        if ($scope.name === null || $scope.name === undefined || $scope.name === '' || $scope.email === null || $scope.email === undefined || $scope.email === '') {
            layer.msg('请填写完整必填信息');
            return false;
        } else {
            var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
            if (!myreg.test($scope.email)) {
                layer.msg('请填写正确的邮箱地址');
                return false;
            } else {
                $.ajax({
                    url: '/home/index/getMail',
                    data: {
                        name: $scope.name,
                        email: $scope.email,
                        phone: $scope.phone,
                        subject: $scope.subject,
                        message: $scope.message
                    },
                    dataType: 'JSON',
                    type: 'POST',
                    success: function (res) {
                        if(res.code === 200) {
                            layer.msg('发送邮件成功');
                        } else {
                            layer.msg(res.msg);
                        }
                    },
                    error: function (res) {
                        layer.msg('发送邮件失败');
                    }
                })
            }
        }
    };

}]);