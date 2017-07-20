
app.config(function ($routeProvider) {
$routeProvider.
	
	when('/', { 
		controller: 'customersCtrl', 
		templateUrl: 'search-design.html' 
	}).
	when('/look-board/:board?', { 
		controller: 'lookBoardCtrl', 
		templateUrl: 'look-board.html' 
	}).
	when('/photography', { 
		controller: 'photographyCtrl', 
		templateUrl: 'photography.html' 
	}).
	when('/makeup-artist', { 
		controller: 'makeupArtistCtrl', 
		templateUrl: 'makeup-artist.html' 
	});
});

app.directive('skdslider', function () {

  return {
    link: function (scope, element, attrs) {	  
	  element.skdslider({'delay':0, 'animationSpeed':0,'showNextPrev':true,'showPlayButton':true,'autoSlide':false,'animationType':'fading'});
	  
    }
  }
});