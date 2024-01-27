/***** CONFIGURAÇÕES GLOBAIS ANGULAR *****/

/***inMaintenance***/
//true - exibe um modal com mensagens de problemas técnicos
//false - não exibe a modal
/******/

/***toMaintenance***/
//true - redireciona automaticamente para uma página quando a página está em problemas e não pode ser carregada
//false - não redireciona para a página
/******/

/***Endereço base dos serviços (baseURL)***/
//DESENVOLVIMENTO - http://localhost:2160/
//TESTE - http://ssp16/portalssp_dev/
//HOMOLOGAÇÃO - http://ssp16/portalssp_2/
//PRODUÇÃO - http://www.ssp.sp.gov.br/
/******/

/**********/

angular.module('modConfig', [])
    .constant('inMaintenance', false)
    .constant('toMaintenance', false)
    .constant('baseURL', 'http://10.24.4.201/portalssp_2/');
angular.module('modPortal', ['ui.bootstrap', 'ngCookies', 'youtube-embed', 'slidePushMenu', 'modConfig', 'seo', '720kb.socialshare'])
.filter('unsafe', function ($sce) {
    return function (val) {
        return $sce.trustAsHtml(val);
    };
}).config(function ($httpProvider) {
    $httpProvider.defaults.headers.post = {};
    $httpProvider.defaults.headers.post["Content-Type"] = "application/json; charset=utf-8";
}).factory('og', function () {
    var Noticia = function (objeto) {
        return objeto;
    }
    return Noticia;
});
