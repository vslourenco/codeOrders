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
                        //console.log($scope.orders);
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
                    status: '',
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

            $scope.addItem = function () {
                $scope.order.item.push({
                    product_id:'',
                    quantity: '',
                    price: 0,
                    total: 0
                });
            };

            $scope.setPrice = function (index) {
                var product_id = $scope.order.item[index].product_id;
                for(var i in $scope.products){
                    if($scope.products.hasOwnProperty(i) && $scope.products[i].id == product_id){
                        $scope.order.item[index].price = $scope.products[i].price;
                        break;
                    }
                }

                $scope.calculateTotalRow(index);
            }

            $scope.calculateTotalRow = function(index){
                $scope.order.item[index].total = $scope.order.item[index].quantity * $scope.order.item[index].price;
                calculateTotal();
            }

            calculateTotal = function () {
                $scope.order.total = 0;
                for(var i in $scope.order.item){
                    if($scope.order.item.hasOwnProperty(i)){
                        $scope.order.total += $scope.order.item[i].total;
                    }
                }
            }

            $scope.save = function () {
              $http.post("http://localhost:8080/orders", $scope.order).then(
                  function (data) {
                      $scope.resetOrder();
                      $state.go('tabs.orders');
                  }
              )
            };

            $scope.resetOrder();
            $scope.getClients();
            $scope.getPtypes();
            $scope.getProducts();

        }
    ])
    .controller('LogoutCtrl', ['$scope', 'logout',
        function ($scope, logout) {

            $scope.logout = function(){
                logout.logout();
                $state.go('login');
            }
        }
    ])
    .controller("RefeshModalCtrl", ['$rootScope', '$scope', 'OAuth', 'authService', '$timeout', '$state', 'logout', function($rootScope, $scope, OAuth, authService, $timeout, $state, logout){

        function destroyModal() {
            if($rootScope.modal){
                $rootScope.modal.hide();
                $rootScope.modal = false;
            }
        }

        $scope.$on('event:auth-loginConfirmed', function () {
            destroyModal();
        });

        $scope.$on('event:auth-loginCancelled', function () {
            destroyModal();
            logout.logout();
        });

        $scope.$on('$stateChangeStart', function (event) {
            if($rootScope.modal) {
                authService.loginCancelled();
                event.preventDefault();
                $state.go('login');
            }
        });

        OAuth.getRefreshToken().then(function () {
            $timeout(function () {
                authService.loginConfirmed();
            },10000);
        }, function () {
            authService.loginCancelled();
            $state.go('login');
        });
    }])