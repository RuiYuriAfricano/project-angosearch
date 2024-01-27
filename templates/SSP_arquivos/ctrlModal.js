angular.module('modPortal').controller('ctrlModal', function ($scope, $uibModal) {

    //Função para abrir um modal na página
    $scope.openModal = function (size, template) {
        $uibModal.open({
            animation: true,
            templateUrl: template,
            controller: 'ctrlModals',
            size: size
        });
    }

});

angular.module('modPortal').controller('ctrlModals', function ($scope, $uibModalInstance) {

    $scope.closeModal = function () {
        $uibModalInstance.close();
    }

});