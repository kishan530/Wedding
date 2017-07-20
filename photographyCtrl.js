app.controller("photographyCtrl", function ($scope,$http) {
	
	
    $http.get("get-photography.php",{ params: {'test':'test'}})
			.then(function (response) {
			console.log(response);
			$scope.albums = response.data.albums;
			});
   });