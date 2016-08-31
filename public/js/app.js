/**
 * Created by ANH on 8/31/2016.
 */
var app =  angular.module('chatApp', ['firebase']);

app.controller('chatController', ['$scope','Message', function($scope,Message){

    $scope.name = "Anh Nguyen";
    $scope.messages= Message.all;
    console.log($scope.messages);
}]);

app.factory('Message', [function() {

    var messages = [{'name':'Mr.Anh','text':'Hello'},
        {'name':'Mrs.Rose','text':'Hello'},
        {'name':'Mr.Anh','text':'how are you ?'},
        {'name':'Mrs.Rose','text':'fine thanks'},
        {'name':'Mr.Anh','text':'Bye'},
        {'name':'Mrs.Rose','text':'Bye'}];

    var Message = {
        all: messages
    };

    return Message;

}]);
app.factory('Message', ['$firebase',
    function($firebase) {
        var ref = new Firebase('https://myproject-f2f21.firebaseio.com/chat');
        var messages = $firebase(ref.child('messages')).$asArray();

        var Message = {
            all: messages,
            create: function (message) {
                return messages.$add(message);
            },
            get: function (messageId) {
                return $firebase(ref.child('messages').child(messageId)).$asObject();
            },
            delete: function (message) {
                return messages.$remove(message);
            }
        };

        return Message;

    }
]);
app.controller('chatController', ['$scope','Message', function($scope,Message){
    $scope.user = "Anh Nguyen";
    $scope.messages= Message.all;
    $scope.inserisci = function(message){
        var now = new Date();
        message.time = now;
        console.log(message);
        Message.create(message);
    };
    $scope.setName = function(name){
        console.log(1);
    }
}]);