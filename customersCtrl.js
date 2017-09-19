app.controller('customersCtrl', function($scope, $http,$location,$timeout,Session, ) {
	$scope.category = '1';
	$scope.selctedStyle = [];
	$scope.selctedOutfit = '0';
	$scope.selctedOccasion = '0';
	$scope.selctedSeason = [];
	$scope.showGender = false;
    $scope.user = '';
    $scope.sessionVal = '';
	$scope.loginError = '';
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
	
	$scope.doregister = function () {  
	$http.get("user-register.php",{ params: {'username': $scope.myusername,'email':$scope.email,'mobile':$scope.mobile, 'password':$scope.mypassword}})
	.then(function (response) {
		console.log($scope.myusername);
		console.log($scope.email);
		console.log($scope.mobile);
		console.log($scope.mypassword);
		console.log(response);
	 if(response.data.success==true){
			$('#registerModal').modal('hide');
			$http.get("get-session.php",{ params: { 'test': 'test' }})
			   .then(function (response) {
				   $scope.sessionVal = response.data;
				   $scope.user = response.data;  
				  $scope.Session = Session.data;
				   console.log(response.data);
				   // $scope.sessionVal = response.data;
				 
				});
			$timeout(function () { $location.path("/booking"); }, 2000);
			
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
				   $scope.sessionVal = response.data;
				   $scope.user = response.data;  
				    Session.saveSession(response.data);
				  $scope.Session = Session.data;
				   console.log(response.data);
				   // $scope.sessionVal = response.data;
				 
				});
			$timeout(function () { $location.path("/booking"); }, 2000);
			//$location.path("/booking");
			//$scope.dismiss();
		}else{
			$scope.loginError = response.data.message;
		}
		
		//console.log($scope.loginError);
	   
	}); 
	};
	
	
	//$scope.popupdemo = function ($scope, $dialog,event) {
	//event.preventDefault();	
	  //$timeout(function(){
		//$dialog.dialog({}).open('modalContent.html');  
	//  }, 3000); 
   // console.log($scope.popupdemo);	  
	//};
	
	 $scope.open = function () {
            $scope.showModal = true;
        };

        $scope.ok = function () {
            $scope.showModal = false;
        };

        $scope.cancel = function () {
            $scope.showModal = false;
        };
	
	
	$scope.booking=function(){
		console.log('booking');
		//$('#myModal').modal('show');
		$scope.Session = Session.data;
		//console.log($scope.showDialog);
		if($scope.Session =='')
			$('#myModal').modal('show');
		else
			$location.path("/booking"); 
    };
   
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
   
});