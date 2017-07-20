app.controller("makeupArtistCtrl", function ($scope,$http) {
	
	
    $http.get("get-makeup-artist.php",{ params: {'test':'test'}})
			.then(function (response) {
			console.log(response);
			$scope.artists = response.data.artists;
			});
   });
