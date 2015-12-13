///    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.0-beta.2/angular.min.js"></script>

angular.module('mplotkin.directives', [])
.directive('mpAlert', function () {
    return {
        controller: function(alert, $scope){
            $scope.vm = alert;
        },
        templateUrl: 'directives/panel.html'
    };
}).service('alert', function(){
        var self = this;
        self.msg = null;
        self.show = function(msg){
            self.msg = msg;
             alert(msg);
            
        }
})
