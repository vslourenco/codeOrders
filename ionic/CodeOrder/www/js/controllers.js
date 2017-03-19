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

            $scope.show = function (order) {
                $state.go('tabs.show', {id: order.id});
            }

            $scope.doRefresh = function () {
                $scope.getOrders();
                $scope.$broadcast('scroll.refreshComplete');
            }

            $scope.onOrderDelete = function (order) {
                $http.delete('http://localhost:8080/orders/'+order.id);
                $scope.getOrders();
            }

            $scope.getOrders();
        }
    ])
    .controller('OrderShowCtrl', ['$scope', '$http', '$stateParams',
        function ($scope, $http, $stateParams) {

            $scope.getOrder = function(){
                $http.get('http://localhost:8080/orders/' + $stateParams.id).then(
                    function (data) {
                        $scope.order = data.data;

                    }
                )
            }

            $scope.getOrder();
        }
    ])
    .controller('OrdersNewCtrl', ['$scope', '$http', '$state',
        function ($scope, $http, $state) {

            $scope.clients = [];
            $scope.ptypes = [];
            $scope.products = [];
            $scope.statusList = ['Pendente', 'Processando', 'Entregue'];

            $scope.resetOrder = function () {
                $scope.order = {
                    client_id: '',
                    ptype_id: '',
                    item: []
                };
            };

            $scope.getClients = function () {
                $http.get('http://localhost:8080/clients').then(
                    function (data) {
                        $scope.clients = data.data._embedded.clients;
                    }
                )
            };

            $scope.getPtypes = function () {
                $http.get('http://localhost:8080/ptypes').then(
                    function (data) {
                        $scope.ptypes = data.data._embedded.ptypes;
                    }
                )
            };

            $scope.getProducts = function () {
                $http.get('http://localhost:8080/products').then(
                    function (data) {
                        $scope.products = data.data._embedded.products;
                    }
                )
            };

        }
    ])