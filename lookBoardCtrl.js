app.controller('lookBoardCtrl', function($scope,$routeParams, $http) {	
   $scope.selected=$routeParams.board;
   $scope.likes = 0;
   
   $http.get("get-design.php",{ params: { selected: $routeParams.board }})
   .then(function (response) {
	   $scope.design = response.data.design;
	    $scope.likes = $scope.design.likes;
	   $scope.recommendations = response.data.recommendations;	  
   });
   
   $scope.updateLikes = function () {
	   // console.log($scope.likes);
			$http.get("setLike.php",{ params: { id:$scope.design.id,like:$scope.likes  }})
		   .then(function (response) {
				$scope.likes = response.data;  
				// console.log($scope.likes);
		   });
   };
   
   
   
});