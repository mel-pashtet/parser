angular.module('ui.bootstrap.demo', ['ui.bootstrap']);
angular.module('ui.bootstrap.demo').controller('TabsDemoCtrl', function ($scope, $window) {
  // $scope.tabs = [
  //   { title:'Dynamic Title 1', content:'Dynamic content 1' },
  // ];

  $scope.alertMe = function() {
    setTimeout(function() {
      console.log($window.html('some'))
    });
  };
});