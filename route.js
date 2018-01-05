
app.config(function ($routeProvider) {
$routeProvider.
	
	when('/', { 
		controller: 'customersCtrl', 
		templateUrl: 'search-design.html' 
	}).
	when('/failure', { 
		controller: 'customersCtrl', 
		templateUrl: 'failure.html' 
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
	}).
	when('/contactsuccess', { 
		controller: 'contactCtrl', 
		templateUrl: 'contactsuccess.html' 
	}).
	when('/booking', { 
		controller: 'bookingCtrl', 
		templateUrl: 'registration.html' 
	}).
	when('/success', { 
		controller: 'successCtrl', 
		templateUrl: 'success.html' 
	}).
	when('/contest', { 
		controller: 'contestCtrl', 
		templateUrl: 'contest.html' 
	});
	
	
});





app.directive('skdslider', function () {

  return {
    link: function (scope, element, attrs) {	  
	  element.skdslider({'delay':0, 'animationSpeed':0,'showNextPrev':true,'showPlayButton':true,'autoSlide':false,'animationType':'fading'});
	  
    }
  }
});

app.directive('services', function () {

  return {
    link: function (scope, element, attrs) {	  
	  element.flexisel({
									visibleItems: 4,
									animationSpeed: 1000,
									autoPlay: false,
									autoPlaySpeed: 3000,    		
									pauseOnHover: true,
									enableResponsiveBreakpoints: true,
									responsiveBreakpoints: { 
										portrait: { 
											changePoint:480,
											visibleItems: 1
										}, 
										landscape: { 
											changePoint:640,
											visibleItems:2
										},
										tablet: { 
											changePoint:768,
											visibleItems: 3
										}
									}
								});
	  
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

app.directive('myModal', function() {
   return {
     restrict: 'A',
     link: function(scope, element, attr) {
       scope.dismiss = function() {
           element.modal('hide');
       };
     }
   } 
});

app.directive("modalShow", function () {
    return {
        restrict: "A",
        scope: {
            modalVisible: "="
        },
        link: function (scope, element, attrs) {

            //Hide or show the modal
            scope.showModal = function (visible) {
                if (visible)
                {
                    element.modal("show");
                }
                else
                {
                    element.modal("hide");
                }
            }

            //Check to see if the modal-visible attribute exists
            if (!attrs.modalVisible)
            {

                //The attribute isn't defined, show the modal by default
                scope.showModal(true);

            }
            else
            {

                //Watch for changes to the modal-visible attribute
                scope.$watch("modalVisible", function (newValue, oldValue) {
                    scope.showModal(newValue);
                });

                //Update the visible value when the dialog is closed through UI actions (Ok, cancel, etc.)
                element.bind("hide.bs.modal", function () {
                    scope.modalVisible = false;
                    if (!scope.$$phase && !scope.$root.$$phase)
                        scope.$apply();
                });

            }

        }
    };

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