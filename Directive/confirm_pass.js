
angular.module("App").directive('passMatch', function() {
   return {
       require: 'ngModel',
       link: function(scope, elem, attr, ctrl) {
           var password = '#' + attr.passMatch;
           $(elem).add(password).on('keyup',function(){
                scope.$apply(function() {
                   ctrl.$setValidity('isMatch', elem.val() === $(password).val());
                });
           });
       }
   }
});