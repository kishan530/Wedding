
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
	}).
	when('/Wedding-Fashion', { 
		controller: 'WeddingFashionCtrl', 
		templateUrl: 'Wedding-Fashion.html' 
	}).
	when('/Styling-Services', { 
		controller: 'StylingServicesCtrl', 
		templateUrl: 'Styling-Services.html' 
	}).
	when('/contact', { 
		controller: 'contactCtrl', 
		templateUrl: 'contact.html' 
	}); 
	
	
	
	
});





app.directive('skdslider', function () {

  return {
    link: function (scope, element, attrs) {	  
	  element.skdslider({'delay':0, 'animationSpeed':0,'showNextPrev':true,'showPlayButton':true,'autoSlide':false,'animationType':'fading'});
	  
    }
  }
});

app.directive('jqzoom', function () {

  return {
    link: function (scope, element, attrs) {	  
	  element.jqzoom({
			zoomType: 'innerzoom',
			lens:false,
			preloadImages: false,
			alwaysOn:false,
			zoomWidth:200,
			zoomHeight:300,
			xOffset:0,
			showEffect:'fadein',
			hideEffect:'fadeout'
	        });
	  
    }
  }
});

/*app.directive('imageZoom', function () {

  return {
    link: function (scope, element, attrs) {	  
	  new Drift(element(document.querySelector('.drift-demo-trigger')), {
        paneContainer: element(document.querySelector('.detail')),
        inlinePane: 900,
        inlineOffsetY: -85,
        containInline: true,
        hoverBoundingBox: true
      });
	  
    }
  }
});*/