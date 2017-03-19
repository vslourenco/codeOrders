// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter', ['ionic', 'starter.controllers', 'angular-oauth2'])

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    if(window.cordova && window.cordova.plugins.Keyboard) {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

      // Don't remove this line unless you know what you are doing. It stops the viewport
      // from snapping when text inputs are focused. Ionic handles this internally for
      // a much nicer keyboard experience.
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
})

.config(function ($stateProvider, $urlRouterProvider, OAuthProvider, OAuthTokenProvider) {

    OAuthProvider.configure({
        baseUrl: 'http://localhost:8080',
        clientId: 'testclient',
        clientSecret: 'testpass', // optional
        grantPath: '/oauth',
        revokePath: '/oauth'
    });

    OAuthTokenProvider.configure({
        name: 'token',
        options: {
            secure: false
        }
    });

    $stateProvider
        .state('tabs', {
            url: '/t',
            abstract: true,
            templateUrl: 'templates/tabs.html'
        })
        .state('tabs.orders', {
            url: '/orders',
            views: {
                'orders-tab': {
                    templateUrl: 'templates/orders.html',
                    controller: 'OrdersCtrl'
                }
            }
        })
        .state('tabs.create', {
            url: '/create',
            views: {
                'create-tab': {
                    templateUrl: 'templates/create.html',
                    controller: 'OrdersNewCtrl'
                }
            }
        })
        .state('tabs.show', {
            url: '/orders/:id',
            views: {
                'orders-tab': {
                    templateUrl: 'templates/order-show.html',
                    controller: 'OrderShowCtrl'
                }
            }
        })

        .state('login', {
            url: '/login',
            templateUrl: 'templates/login.html',
            controller: 'LoginCtrl'
        })

    $urlRouterProvider.otherwise('/login');
})
