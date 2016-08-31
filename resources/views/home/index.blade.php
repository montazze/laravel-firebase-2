<!DOCTYPE html>
<html>
<head>
    <title>Firebase App</title>
    <link rel="stylesheet" href="{{ (asset(PREFIX_WEB.'/css/bootstrap.min.css')) }}">
    <link rel="stylesheet" href="{{ (asset(PREFIX_WEB.'/css/style.css')) }}">
     <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script><!-- AngularJS -->
    <script src="https://cdn.firebase.com/libs/angularfire/0.9.0/angularfire.min.js"></script><!-- AngularFire -->
    <script src="{{ (asset(PREFIX_WEB.'/js/app.js')) }}"></script><!-- AngularFire -->
</head>
<body ng-app="chatApp">
    {{--<div ng-controller="chatController" >--}}
     {{--<p>Nome : <input type="text" ng-model="newmessage.user"></p>--}}
     {{--<p>Messaggio :<input type="text" ng-model="newmessage.text"></p>--}}
     {{--<button ng-click="inserisci(newmessage)">Invia</button>--}}

      	{{--<ul>--}}
      		{{--<li ng-repeat="message in messages">--}}
      			{{--@{{message.user}} dice :@{{message.text}}--}}
      		{{--</li>--}}
      	{{--</ul>--}}
    {{--</div>--}}
<div class="container">
    <header class="bs-docs-nav navbar navbar-static-top" id="top">
        <div class="container">
            <div class="navbar-header">
                <button aria-controls="bs-navbar" aria-expanded="false" class="collapsed navbar-toggle"
                        data-target="#bs-navbar" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
                <a href="../" class="navbar-brand">My Blog</a></div>
            <nav class="collapse navbar-collapse" id="bs-navbar">
                <ul class="nav navbar-nav">
                    <li><a href="../php/">PHP</a></li>
                    <li><a href="../css/">HTML & CSS</a></li>
                    <li><a href="../javascript/">JavaScript</a></li>
                    <li><a href="https://www.linkedin.com/in/anh-nguyen-86bb51110?trk=hp-identity-photo">About Me</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                </ul>
            </nav>
        </div>
    </header>
    <div class="page-header">
        <h1>Chat</h1>
    </div>
    <div class="row" ng-controller="chatController">
        <div class="col-md-9">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Chat
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon glyphicon-minus"></span>
                        </button>
                        <ul class="dropdown-menu slidedown">
                            <li><a href="#" onclick="window.location.reload"><span class="glyphicon glyphicon-refresh">
                            </span>Refresh</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <ul class="chat">
                        <li class="left clearfix" ng-repeat="msg in messages">
                            <span class="chat-img pull-left">
                            <img src="img/u.png" alt="User Avatar" class="img-circle"/>
                            </span>

                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font" ng-bind="msg.user"></strong>
                                    <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago
                                    </small>
                                </div>
                                <p ng-bind="msg.text"></p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <form class="form-inline" ng-submit="inserisci(newmessage)">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" ng-model="newmessage.user" ng-change="setName()"
                                   placeholder="Your Name">
                        </div>
                        <div class="input-group">
                            <input id="btn-input" type="text" class="form-control input-sm" ng-model="newmessage.text"
                                   placeholder="Type your message here..."/>
                            <span class="input-group-btn">
                                <input type="submit" class="btn btn-warning btn-sm" id="btn-chat" value="Send">
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{ (asset(PREFIX_WEB.'/js/jquery.min.js')) }}"></script>
<script src="{{ (asset(PREFIX_WEB.'/js/bootstrap.min.js')) }}"></script>
</html>