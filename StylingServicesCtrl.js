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
   });