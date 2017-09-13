app.controller("bookingCtrl", function ($scope,$http) {
	
	
    $http.get("get-slots.php",{ params: {'test':'test'}})
			.then(function (response) {
			//console.log(response);
			$scope.slots = response.data.slots;
			});
   });