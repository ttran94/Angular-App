angular.module("App").directive('fadeAway', function() {
    return {
        restrict: 'A',
        link: function(scope, elem, attr) {
            scope.$watch(attr.fadeAway, function(value){
                if(value) {
                    $(elem).delay(value).fadeOut('slow');
                    
                }
            });
        }
    };
});