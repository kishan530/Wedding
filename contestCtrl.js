app.directive('fileModel', ['$parse', function ($parse) {
    return {
    restrict: 'A',
    link: function(scope, element, attrs) {
        var model = $parse(attrs.fileModel);
        var modelSetter = model.assign;

        element.bind('change', function(){
            scope.$apply(function(){
                modelSetter(scope, element[0].files[0]);
            });
        });
    }
   };
}]);

app.controller("contestCtrl", function ($scope,$http,$location,) {

	$scope.contest = function () { 
       var file = $scope.file;
 
              var uploadUrl = "contest.php";
             //  fileUpload.uploadFileToUrl(file, uploadUrl,$scope );
          $scope.uploadFileToUrl(file, uploadUrl,$scope);
         	 $location.path("/success");
	    console.log($scope.name);
        console.log($scope.email);
		console.log($scope.mobile);
		
		
	

	};
	
	$scope.uploadFileToUrl = function(file, uploadUrl, $scope){
         var fd = new FormData();
		// console.log('hello'+$scope.name);
         fd.append('file', file);
         fd.append('name', $scope.name);
		 fd.append('email', $scope.email);
		 fd.append('mobile', $scope.mobile);
		 
		 //console.log('form-data'+fd.name);
		// console.log(fd);
         $http.post(uploadUrl, fd, {
             transformRequest: angular.identity,
            // headers: {'Content-Type': "application/x-www-form-urlencoded"},
			  headers: {'Content-Type': undefined}
         })
         .then(function(){
          //  console.log("Success");
         });
         
     };
	
	});   

	










/*app.directive('fileModel', ['$parse', function ($parse) {
    return {
    restrict: 'A',
    link: function(scope, element, attrs) {
        var model = $parse(attrs.fileModel);
        var modelSetter = model.assign;

        element.bind('change', function(){
            scope.$apply(function(){
                modelSetter(scope, element[0].files[0]);
            });
        });
    }
   };
}]);

app.controller("contestCtrl", function ($scope,$http,$location,) {
//$eventsNames=[];
	$scope.contest = function () { 
       var file = $scope.file;
 
              var uploadUrl = "contest.php";
             //  fileUpload.uploadFileToUrl(file, uploadUrl,$scope );
          $scope.uploadFileToUrl(file, uploadUrl,$scope);
         	 $location.path("/success");
	    console.log($scope.name);
        console.log($scope.email);
		console.log($scope.mobile);
		console.log($scope.file);
		console.log($scope.location);
		console.log($scope.events);
		//console.log($scope.date);
		console.log($scope.message);
		//console.log($scope.day_or_night);
		
	

	};
	
	$scope.uploadFileToUrl = function(file, uploadUrl, $scope){
         var fd = new FormData();
		// console.log('hello'+$scope.name);
         fd.append('file', file);
         fd.append('name', $scope.name);
		 fd.append('email', $scope.email);
		 fd.append('mobile', $scope.mobile);
		 fd.append('file', $scope.file);
		 fd.append('file', $scope.location);
		 fd.append('message', $scope.message);
		 fd.append('date', $scope.date);
		 fd.append('events', $scope.events);
		 fd.append('day_or_night', $scope.day_or_night);
		 //console.log('form-data'+fd.name);
		// console.log(fd);
         $http.post(uploadUrl, fd, {
             transformRequest: angular.identity,
            // headers: {'Content-Type': "application/x-www-form-urlencoded"},
			  headers: {'Content-Type': undefined}
         })
         .then(function(){
          //  console.log("Success");
         });
         
     };
	
	});   

	









/*$http.get("get-contast.php",{ params: { 'test': 'test' }})
   .then(function (response) {
	   $scope.name = $scope.name;
	   $scope.email = $scope.email;
	   $scope.mobile = $scope.mobile;
	   $scope.file = $scope.file;
	   $scope.message = $scope.message;
	   //console.log(response.data);
	}); */
/*	app.controller("contestCtrl", function ($scope,$http,$location) {
	$scope.contest = function () {  
	 console.log($scope.name);
        console.log($scope.email);
		console.log($scope.mobile);
		console.log($scope.file);
		console.log($scope.message);
	
	$http.get("contest.php",{ params: {'name': $scope.name,'email':$scope.email,'mobile':$scope.mobile,'file':$scope.file, 'message':$scope.message}})
   .then(function (response) {
	   $location.path("/success");
	   //console.log(response.data);
	});
	};
	   
	});*/
	
	
	
	
 