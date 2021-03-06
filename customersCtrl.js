app.controller('customersCtrl', function($scope, $http,$location,$timeout ) {
	
	$scope.category = '1';
	$scope.selctedStyle = [];
	$scope.selctedOutfit = '0';
	$scope.selctedOccasion = '0';
	$scope.selctedSeason = [];
	$scope.showGender = false;
    $scope.user = '';
	$scope.contestId = 0;
	$scope.couponCode = '';
	$scope.loginError = '';
	$scope.Message = '';
    $scope.email = '';
    $scope.nameerror= '';
    $scope.emailerror= '';
    $scope.PhoneNumbererror= '';
	$scope.showDialog = false;
	$scope.isStyleSelected = function(id) {
		 //console.log(id);
		// console.log($scope.selctedStyle.indexOf(id));
    if($scope.selctedStyle.indexOf(id) > -1) { return true; }else { return false; }
}
$scope.isSeasonSelected = function(id) {
    if($scope.selctedSeason.indexOf(id) > -1) { return true; }else { return false; }
}
	
	$scope.displayGender = function () {
		$scope.showGender = true;
	};
	
	$scope.applyFilters = function ($style,$outfit,$occasion,$season,$wad,$cc) {  
	//console.log($style);
$http.get("get-data.php",{ params: { category: $scope.category,  style: $style , outfit: $outfit, occasion: $occasion, season: $season,wad: $wad,cc: $cc }})
			.then(function (response) {
			//console.log(response);
			$scope.names = response.data.records;
			});
    };
	
	$scope.change = function () {
		if($scope.category!=3)
		$scope.showGender = false;
        $http.get("get-filters.php",{ params: { category: $scope.category }})
			.then(function (response) {
		$scope.outfits = response.data.filters.outfits;
		//$scope.styles = response.data.styles;
		//$scope.occassions = response.data.filters.occassions;
		//$scope.seasons = response.data.filters.seasons;
		});
		$scope.selctedStyle = [];
		 $scope.selctedOutfit = 0;
		 $scope.selctedOccasion = 0;
		 $scope.selctedSeason = [];
		  $scope.applyFilters(JSON.stringify([]),0,0,JSON.stringify([]),0,0); 
		//$scope.applyFilters(0,0,0,0);
    };
	
	$scope.selectGender = function () {
		$scope.showGender = false;	
		 $scope.applyFilters(JSON.stringify([]),0,0,JSON.stringify([]),0,0); 
		//$scope.applyFilters(0,0,0,0);
    };
	
	$scope.getDesigns = function ($style,$outfit,$occasion,$season,$wad,$cc) {
		//console.log($style);
		if($wad==1 || $cc==1){
			$scope.applyFilters(JSON.stringify([]),0,0,JSON.stringify([]),$wad,$cc); 
		}else{
		 if($style>0){
			 console.log($style);
			if($scope.selctedStyle.indexOf($style) == -1) {
				$scope.selctedStyle.push($style);
			  }else {
				  console.log($scope.selctedStyle.indexOf($style));
				 console.log($scope.selctedStyle);
				$scope.selctedStyle.splice($scope.selctedStyle.indexOf($style),1);
				 console.log($scope.selctedStyle);
			  }
			}
		if($season>0){
			if($scope.selctedSeason.indexOf($season) == -1) {
				$scope.selctedSeason.push($season);
			}else {
			$scope.selctedSeason.splice($scope.selctedSeason.indexOf($season),1);
			}
			}
		 $scope.selctedOutfit = $outfit;
		 $scope.selctedOccasion = $occasion;
		 //$scope.selctedSeason = $season;
		$scope.applyFilters(JSON.stringify($scope.selctedStyle),$outfit,$occasion,JSON.stringify($scope.selctedSeason),0,0);
		}
    };
	
	
	$http.get("get-filters.php",{ params: { category: $scope.category }})
   .then(function (response) {
	   $scope.outfits = response.data.filters.outfits;
	   $scope.styles = response.data.styles;
	   $scope.occasions = response.data.filters.occassions;
	   $scope.seasons = response.data.filters.seasons;
    //console.log(response.data.filters.occassions);
   });
    
    $scope.selectDesign=function(selected){
       $location.path("/look-board/"+selected);
    }; 
	
//<!--datastart-->
	$scope.doregister = function () {  
	$http.get("user-register.php",{ params: {'username': $scope.myusername,'email':$scope.email,'mobile':$scope.mobile, 'password':$scope.mypassword}})
	.then(function (response) {
	 if(response.data.success==true){
			$('#registerModal').modal('hide');
			$http.get("get-session.php",{ params: { 'test': 'test' }})
			   .then(function (response) {
				 localStorage.setItem("user", response.data);
				 
				});
			//$timeout(function () { $location.path("/booking"); }, 2000);
			$timeout(function () { $location.path("/contest"); }, 2000);
			}else{
			$scope.loginError = response.data.message;
		}
	}); 
	};
	
	
	 $scope.dologin = function () {  
	
	 console.log($scope.loginError);
	$http.get("login.php",{ params: {'username':$scope.username,'password':$scope.password}})
	.then(function (response) {
	  
		console.log(response);
		if(response.data.success==true){
			
			$('#myModal').modal('hide');
			$http.get("get-session.php",{ params: { 'test': 'test' }})
			   .then(function (response) {
				    localStorage.setItem("user", response.data);
				// $window.localStorage["user"] =  JSON.stringify(response.data);				 
				});
			//$timeout(function () { $location.path("/booking"); }, 2000);
			$timeout(function () { $location.path("/contest"); }, 2000);
			//$location.path("/booking");
			//$scope.dismiss();
		}else{
			$scope.loginError = response.data.message;
		}
			   
	}); 
	}; 
		
	
	$scope.booking=function(){
	
		if(!localStorage.getItem("user"))
			$('#myModal').modal('show');
		else
			//$location.path("/booking"); 
            $location.path("/contest");
    }; 
  // <!--dataend -->
  
  $scope.applyFilters(JSON.stringify([]),0,0,JSON.stringify([]),0,0); 
   
    $http.get("get-session.php",{ params: { 'test': 'test' }})
   .then(function (response) {
	   $scope.sessionVal = response.data;
	   $scope.user = response.data;  
	   console.log(response.data);
	   // $scope.sessionVal = response.data;
	 
	});
   $http.get("get-Wedding-Fashion.php",{ params: {'test':'test'}})
			.then(function (response) {
			console.log(response);
			$scope.fashions = response.data.fashions;
			}); 
	$http.get("get-articles.php",{ params: {'test':'test'}})
			.then(function (response) {
			console.log(response);
			$scope.articles = response.data.articles;
			}); 
	$http.get("get-banner.php",{ params: {'test':'test'}})
			.then(function (response) {
			console.log(response);
			$scope.banners = response.data.banners;
			});				
			
 



	$scope.contest = function () { 
	 $scope.error = false;
		  $scope.nameerror= '';
		  $scope.emailerror= '';
		  $scope.PhoneNumbererror= '';
		 
	
	 var fd = new FormData();
		// console.log('hello'+$scope.name);
         fd.append('name', $scope.name);
		 fd.append('email', $scope.email);
		 fd.append('mobile', $scope.mobile);
    /* var regx =/[a-zA-Z]+\\.?/;
	
	if($scope.name=='') {
      $scope.nameerror="please enter name";
	  $scope.error = true;
    }
	
	if(!regx .test($scope.name)) {
      $scope.nameerror="It allows only alphabits ";
	  $scope.error = true;
    }*/
	
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
	if($scope.email=='') {
      $scope.emailerror="please enter email address";
	  $scope.error = true;
    }
	
	if(!re.test($scope.email)) {
      $scope.emailerror="please enter here valide email address";
	  $scope.error = true;
    }
	var PHONE_REGEXP = /^[789]\d{9}$/;
	if($scope.mobile=='') {
      $scope.PhoneNumbererror="please enter mobilenumber";
	  $scope.error = true;
    }
  if(!PHONE_REGEXP.test($scope.mobile)) {
      $scope.PhoneNumbererror=" Invalid mobilenumber";
	  $scope.error = true;
    } 
     
		
	if($scope.error==false){
	 console.log($scope.nameerror);
	 console.log($scope.emailerror);
     console.log($scope.PhoneNumbererror);
     $http.get("contest.php",{ params: {'name': $scope.name,'email': $scope.email,'mobile': $scope.mobile}})
	.then(function (response) {
		 console.log(response);
	    console.log($scope.name);
		console.log($scope.email);
	    console.log($scope.mobile);
		
		//$scope.contestId = angular.fromJson(response.data).contestId;
		 console.log($scope.contestId);
	  $location.path("/Bride-Alert");
	   
	 }); 
    }
  };       
	
	
	
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
	 $scope.BrideAlert = function () {
        var file = $scope.file;
		var uploadUrl = "BrideAlert.php";
             //  fileUpload.uploadFileToUrl(file, uploadUrl,$scope );
          $scope.uploadFileToUrl(file, uploadUrl,$scope);
         	
	    console.log($scope.date);
        console.log($scope.city);
		console.log($scope.file);
		console.log($scope.file1);
	 };
	 $scope.uploadFileToUrl = function(file, uploadUrl, $scope){
		   console.log($scope.city);
		     console.log($scope.contestId);
			 console.log($scope.coupon_code);
         var fd = new FormData();
		// console.log('hello'+$scope.name);
         fd.append('date', $scope.date);
		 fd.append('city', $scope.city);
		 fd.append('file',$scope.file);
		 fd.append('file1',$scope.file1);
		 fd.append('contestId', $scope.contestId);
		 
		 //console.log('form-data'+fd.name);
		// console.log(fd);
         $http.post(uploadUrl, fd, {
             transformRequest: angular.identity,
            // headers: {'Content-Type': "application/x-www-form-urlencoded"},
			  headers: {'Content-Type': undefined}
         })
         .then(function(response){
			$scope.couponCode = response.data;
			  $location.path("/BrideAlert-Success").search({code: $scope.couponCode});;
			 console.log(response);
          //  console.log("Success");
         });
         
     };
	
	
    

});