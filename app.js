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
	   $scope.sessionVal = $scope.user;
	   Session.saveSession(response.data);
	    $scope.Session = Session.data;  
	   console.log(Session.data);
	   console.log(response.data);
	  
	 
	});
	
	
	$scope.logout = function (){
		// console.log(Session.data.user);
		//Session.data.user = '';
		console.log(Session.data.user);
		$http.get("logout.php",{ params: {'logout':'logout'}})
			.then(function (response) {
				$scope.sessionVal = '';
				  Session.deleteSession();
				  $scope.Session = Session.data;
				   console.log(Session.data);
				 $location.path("/");
			}); 
		};
});