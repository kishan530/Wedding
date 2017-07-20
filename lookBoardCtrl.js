app.controller('lookBoardCtrl', function($scope,$routeParams, $http) {	
   $scope.selected=$routeParams.board;
   
   $http.get("get-design.php",{ params: { selected: $routeParams.board }})
   .then(function (response) {
	   $scope.design = response.data.design;
	   $scope.recommendations = response.data.recommendations;	  
   });
   console.log($scope.selected);
});