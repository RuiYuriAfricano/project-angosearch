angular.module('modPortal').controller('ctrlHead', function ($scope, $http, $cookies, $window, $location, $uibModal, inMaintenance, toMaintenance, baseURL, og) {
    if (GetID()) {
        $scope.Url = $location.absUrl().replace("/Default.aspx", "/");
        $scope.OG = og;
    }
    else
    {
        $scope.Url = $location.absUrl().replace("/Default.aspx", "/");
        $scope.Url = $scope.url + "LeNoticia.aspx?ID=";
        $scope.OG = og;
        if (og.Noticia != null)
            $scope.Url = $scope.Url + $scope.OG.Noticia.ID;
        else
            $scope.Url = $scope.Url + "LeNoticia.aspx?ID=";
    }

    //$scope.GetID = function () {
    //    var queries = {};
    //    $.each(document.location.search.substr(1).split('&'), function (c, q) {
    //        var i = q.split('=');
    //        queries[i[0].toString()] = i[1].toString();
    //    });
    //    if (queries != null)
    //        return true;
    //    else
    //        return false;
    //    console.log(queries);
    //    alert("Teste");
    ////};
    function GetID () {
        var queries = {};
        $.each(document.location.search.substr(1).split('&'), function (c, q) {
            var i = q.split('=');
            if(i != "")
                queries[i[0].toString()] = i[1].toString();
        });
        if (queries != null)
            return true;
        else
            return false;
    };
});
