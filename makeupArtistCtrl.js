app.controller("makeupArtistCtrl", function ($scope,$http,$location) {
	 $scope.errorNumber= '';
	
  /*  $http.get("get-makeup-artist.php",{ params: {'test':'test'}})
			.then(function (response) {
			console.log(response);
			$scope.artists = response.data.artists;
			}); */
			$scope.makeupartistdata = function () {
			$scope.error = false;
			  $scope.errorNumber= '';
			  $scope.successmessage='';
    var number_REGEXP = /^\d{0,9}(\.\d{1,9})?$/;
	if($scope.events=='') {
      $scope.errorNumber="Please enter number of events";
	  $scope.error = true;
    }
  if(!number_REGEXP.test($scope.events)) {
      $scope.errorNumber=" Number of events should contain only degits";
	  $scope.error = true;
    }
	
  if($scope.error==false){
	   console.log($scope.errorNumber);	
					
	$http.get("makeupartist_insert.php",{ params: {'location': $scope.location,'events':$scope.events,'budget':$scope.budget, 'additionalrequirement':$scope.additionalrequirement}})
	.then(function (response) {
			
        console.log($scope.location);
		console.log($scope.events);
		$scope.location = '';
		$scope.events = '';
		$scope.budget = '';
		$scope.additionalrequirement = '';
		$scope.successmessage='We have received your request and will respond to you within 24 hours';
	   // console.log($scope.location);
		//console.log($scope.events);
		//console.log($scope.budget);
		//console.log($scope.additionalrequirement);
	  $location.path("/makeup-artist");
	   
	}); 
	}
	};
   });
