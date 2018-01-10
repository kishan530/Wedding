app.controller("BrideAlert-SuccessCtrl", function ($scope,$http,$location) {
	
	$scope.code = $location.search().code; 
	
	 console.log($scope.code);
	
	});