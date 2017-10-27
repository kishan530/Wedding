app.controller("StylingServicesCtrl", function ($scope,$http) {

	 $scope.stylingservicedata = function () {
	    $scope.successmessage='';
	 console.log($scope.timeerror);
        console.log($scope.date);
		console.log($scope.time);
		console.log($scope.message);	 
	$http.get("styling_service_insert.php",{ params: {'date': $scope.date,'time':$scope.time,'message':$scope.message}})
	.then(function (response) {
	   $scope.date = '';
		$scope.time = '';
		$scope.message = '';
		$scope.successmessage='We have received your request and will respond to you within 24 hours';
	  $location.path("/Styling-Services");
	   
	}); 
	
	};
	
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
	$http.get("get-banner.php",{ params: {'test':'test'}})
			.then(function (response) {
			console.log(response);
			$scope.banners = response.data.banners;
			});
   	
		
   });