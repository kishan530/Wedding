var app = angular.module('myApp', ['ngAnimate', 'ui.bootstrap','ngRoute']);


app.run(function(Session) {}); //bootstrap session;

app.factory('Session', function($http) {
  var Session = {
    data: '',
    saveSession: function(value) { /* save session data to db */ Session.data=value },
	deleteSession: function() { /* save session data to db */ Session.data='' },
    updateSession: function() { 
      /* load data from db */
     // $http.get('session.json').then(function(r) { return Session.data = r.data;});
    }
  };
  Session.updateSession();
  return Session; 
});

app.run(function($rootScope){
$rootScope.Session = '';
});



app.controller("mainCtrl", function ($scope,$http,$location,Session) {
	
	// Session.data.user = '';
	  Session.saveSession('');
	$scope.sessionVal = '';
	console.log(Session.data);
	    $http.get("get-session.php",{ params: { 'test': 'test' }})
   .then(function (response) {
	   $scope.user = response.data;  
		localStorage.setItem("user", response.data);	  	 
	});
	
	
		$scope.getUser = function (){
				if(!localStorage.getItem("user")){
					return false;
				}else{
					return true;
				}
		};
	
	
	$scope.logout = function (){
		// console.log(Session.data.user);
		//Session.data.user = '';
		console.log(Session.data.user);
		$http.get("logout.php",{ params: {'logout':'logout'}})
			.then(function (response) {
				localStorage.removeItem("user");
				 $location.path("/");
			}); 
		};
});