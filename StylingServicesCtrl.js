app.controller("StylingServicesCtrl", function ($scope,$http) {
	
	
    $http.get("get-styletype.php",{ params: {styleType:'style board'}})
			.then(function (response) {
			console.log(response);
			$scope.services = response.data.services;
			console.log(response.data.services);
			}); 
			
		$scope.serviceclick = function (styleType){
			
		$http.get("get-styletype.php",{ params: {styleType:styleType}})
			.then(function (response) {
			console.log(response);
			$scope.services = response.data.services;
			console.log(response.data.services);
			}); 
		};
		
		$scope.name = '';
		$scope.greeting = 'Hello';

	$http.get("get-session.php",{ params: { 'test': 'test' }})
   .then(function (response) {
	   $scope.greeting = 'Hi';
	   $scope.user = response.data;
	   $scope.name = $scope.user.name;
	   $scope.email = $scope.user.email;
	   $scope.mobile = $scope.user.mobile;
	   //console.log(response.data);
	});
		
		
   });