app.controller("WeddingFashionCtrl", function ($scope,$http) {
	
	
    $http.get("get-Wedding-Fashion.php",{ params: {'test':'test'}})
			.then(function (response) {
			console.log(response);
			$scope.fashions = response.data.fashions;
			}); 
   });