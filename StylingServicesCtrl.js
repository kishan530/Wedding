app.controller("StylingServicesCtrl", function ($scope,$http) {
	
	
    $http.get("get-Styling-Services.php",{ params: {'test':'test'}})
			.then(function (response) {
			console.log(response);
			$scope.services = response.data.services;
			console.log(response.data.services);
			}); 
   });