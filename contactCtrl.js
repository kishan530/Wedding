app.controller("contactCtrl", function ($scope,$http,$location) {
 $scope.Message = '';
 $scope.Email = '';
 $scope.nameerror= '';
 $scope.emailerror= '';
 $scope.PhoneNumbererror= '';
	 $scope.contactdata = function () {
		 $scope.error = false;
		  $scope.nameerror= '';
		  $scope.emailerror= '';
		  $scope.PhoneNumbererror= '';
		 var regx =/[a-zA-Z]+\\.?/;
	
	if($scope.NAME=='') {
      $scope.nameerror="please enter name";
	  $scope.error = true;
    }
	
	if(!regx .test($scope.NAME)) {
      $scope.nameerror="It allows only alphabits ";
	  $scope.error = true;
    }
	
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
	if($scope.Email=='') {
      $scope.emailerror="please enter email address";
	  $scope.error = true;
    }
	
	if(!re.test($scope.Email)) {
      $scope.emailerror="please enter here valide email address";
	  $scope.error = true;
    }
	var PHONE_REGEXP = /^[789]\d{9}$/;
	if($scope.PhoneNumber=='') {
      $scope.PhoneNumbererror="please enter mobilenumber";
	  $scope.error = true;
    }
  if(!PHONE_REGEXP.test($scope.PhoneNumber)) {
      $scope.PhoneNumbererror=" Invalid mobilenumber";
	  $scope.error = true;
    }
	
	if($scope.error==false){
	 console.log($scope.nameerror);
	 console.log($scope.emailerror);
     console.log($scope.PhoneNumbererror);	 
	$http.get("contact_insert.php",{ params: {'Name': $scope.Name,'Email':$scope.Email,'PhoneNumber':$scope.PhoneNumber, 'Message':$scope.Message,'Message':$scope.Message}})
	.then(function (response) {
		//console.log(response);
		
	    console.log($scope.Name);
		console.log($scope.Email);
		console.log($scope.PhoneNumber);
		console.log($scope.Message);
	 $location.path("/contactsuccess");
	   
	});
	}

	};
	 
   });
   
   
   
   
   
   
  