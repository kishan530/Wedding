app.controller("contactCtrl", function ($scope,$http,$location) {
	
	 $scope.contactdata = function () {  
	$http.get("contact_insert.php",{ params: {'Name': $scope.Name,'Email':$scope.Email,'PhoneNumber':$scope.PhoneNumber, 'Message':$scope.Message}})
	.then(function (response) {
	    console.log($scope.Name);
		console.log($scope.Email);
		console.log($scope.PhoneNumber);
		console.log($scope.Message);
	  $location.path("/contactsuccess");
	   
	}); 
	};
   
   });