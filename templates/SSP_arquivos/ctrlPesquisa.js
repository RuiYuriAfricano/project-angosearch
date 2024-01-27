angular.module('modPortal').controller('ctrlPesquisa', function ($scope, $http, $cookies, $window, $location, $uibModal, inMaintenance, toMaintenance, baseURL) {
    $scope.Pesquisa = function (texto) {
        $window.location.href = '/sis/ListaNoticia.aspx?s=' + texto;
    };
});