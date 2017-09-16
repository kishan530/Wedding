app.controller("contactCtrl", function ($scope,$http) {
	
	 $scope.contactdata = function () {  
	
	 console.log($scope.Name);
	$http.get("contact_insert.php",{ params: {'Name': $scope.Name,'Email':$scope.Email,'PhoneNumber':$scope.PhoneNumber, 'Message':$scope.Message}})
	.then(function (response) {
	    
	 //  $location.path("/success");
	   console.log($scope.Name);
	}); 
	};
   /* $http.get("contact-insert.php",{ params: {'test':'test'}})
			.then(function (response) {
			console.log(response);
			$scope.contacts = response.data.contacts;
			$location.path("/success");
			}); */
   });