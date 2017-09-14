var app = angular.module('myApp', ['ngAnimate', 'ui.bootstrap','ngRoute']);



app.controller("mainCtrl", function ($scope,$http) {
	
	
	$scope.sessionVal = '';
	
	    $http.get("get-session.php",{ params: { 'test': 'test' }})
   .then(function (response) {
	   $scope.user = response.data;  
	   $scope.sessionVal = $scope.user;
	   console.log(response.data);
	  
	 
	});
	
	
	$scope.logout = function (){
			
		$http.get("logout.php",{ params: {'logout':'logout'}})
			.then(function (response) {
				$scope.sessionVal = '';
				 $location.path("/");
			}); 
		};
});