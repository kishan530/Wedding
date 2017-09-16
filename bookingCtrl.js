app.controller("bookingCtrl", function ($scope,$http,$location) {
	
	$scope.name = '';
    $http.get("get-slots.php",{ params: {'test':'test'}})
			.then(function (response) {
			console.log(response);
			$scope.slots = response.data.slots;
			});
	$http.get("get-session.php",{ params: { 'test': 'test' }})
   .then(function (response) {
	   $scope.user = response.data;
	   $scope.name = $scope.user.name;
	   $scope.email = $scope.user.email;
	   $scope.mobile = $scope.user.mobile;
	   //console.log(response.data);
	});
   	
	
	
	$scope.bookSlot = function ($selectedTime) {  
	
	console.log($selectedTime);
	$http.get("booking-insert.php",{ params: { 'name': $scope.name,'email':$scope.email,'mobile':$scope.mobile, 'selectedTime':$selectedTime }})
   .then(function (response) {
	   $location.path("/success");
	   //console.log(response.data);
	});
	};
			
   });