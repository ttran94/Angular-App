<!DOCTYPE html>
<!--Angular ToApp -->
<html ng-app="App">
<head>
   <style>

   </style>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-route.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-animate.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="style/index.css">
    <script src="Controllers/auth.js"></script>
    <script src="Services/Authentication.js"></script>
    <script src="Controllers/switch.js"></script>
    <script src="Directive/confirm_pass.js"></script>
    <script src="Services/Registration.js"></script>
    <script src="Services/AddTask.js"></script>
    <script src="Services/getTask.js"></script>
    <script src="Services/DeleteTask.js"></script>
</head>

<body class="bg-primary">

 <div ng-view class="animate"></div>

</body>
</html>
