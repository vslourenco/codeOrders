angular.module('starter.controllers', [])

    .controller('LoginCtrl', ['$scope', '$http', '$state', 'OAuth', 'OAuthToken',
        function ($scope, $http, $state, OAuth, OAuthToken) {

            $scope.login = function(data){

                OAuth.getAccessToken(data).then(function () {
                    //console.log(OAuthToken.getToken());
                    $state.go('tabs.orders');
                }, function (data) {
                    $scope.error_login = "Usuário ou Senha inválidos";
                });

            }
        }
    ])
    .controller('OrdersCtrl', ['$scope', '$http', '$state',
        function ($scope, $http, $state) {

            $scope.getOrders = function() {
                $http.get('http://localhost:8080/orders').then(
                    function(data) {
                        $scope.orders = data.data._embedded.orders;
                        console.log($scope.orders);
                    }
                )
            }

            $scope.doRefresh = function () {
                $scope.getOrders();
                $scope.$broadcast('scroll.refreshComplete');
            }

            $scope.getOrders();
        }
    ])