var app = angular.module('myApp', ['ngAnimate', 'ui.bootstrap','ngRoute']);
app.controller('customersCtrl', function($scope, $http,$location) {
	$scope.category = '1';
	$scope.selctedStyle = [];
	$scope.selctedOutfit = '0';
	$scope.selctedOccasion = '0';
	$scope.selctedSeason = [];
	$scope.showGender = false;
	
	$scope.isStyleSelected = function(id) {
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
			if($scope.selctedStyle.indexOf($style) == -1) {
				$scope.selctedStyle.push($style);
			  }else {
				$scope.selctedStyle.splice($scope.selctedStyle.indexOf($style),1);
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
		// $scope.selctedSeason = $season;
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
   
   $scope.applyFilters(JSON.stringify([]),0,0,JSON.stringify([]),0,0); 
   
});

app.controller('lookBoardCtrl', function($scope,$routeParams, $http) {	
   $scope.selected=$routeParams.board;
   
   $http.get("get-design.php",{ params: { selected: $routeParams.board }})
   .then(function (response) {
	   $scope.design = response.data.design;
	   $scope.recommendations = response.data.recommendations;	  
   });
   console.log($scope.selected);
});


app.config(function ($routeProvider) {
$routeProvider.
	
	when('/', { 
		controller: 'customersCtrl', 
		templateUrl: 'search-design.html' 
	}).
	when('/look-board/:board?', { 
		controller: 'lookBoardCtrl', 
		templateUrl: 'look-board.html' 
	});
});

app.directive('skdslider', function () {

  return {
    link: function (scope, element, attrs) {	  
	  element.skdslider({'delay':0, 'animationSpeed':0,'showNextPrev':true,'showPlayButton':true,'autoSlide':false,'animationType':'fading'});
	  
    }
  }
});