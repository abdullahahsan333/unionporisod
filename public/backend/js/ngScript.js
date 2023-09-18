var app = angular.module("myApp", []);

var url = window.location.origin + "/ajax/";
var siteurl = window.location.origin + "/";



app.constant("select2Options", "allowClear:true");

// custom filter in Angular js
app.filter("removeUnderScore", function () {
  return function (input) {
    return input.replace(/_/gi, " ");
  };
});

app.filter("textToLower", function () {
  return function (input) {
    return input.replace(/_/gi, " ").toLowerCase();
  };
});

//remove underscore and ucwords
app.filter("textBeautify", function () {
  return function (str) {
    var str = str.replace(/_/gi, " ").toLowerCase(),
      txt = str.replace(/\b[a-z]/g, function (letter) {
        return letter.toUpperCase();
      });

    return txt;
  };
});

//remove dash and ucwords
app.filter("removeDash", function () {
  return function (str) {
    var str = str.replace(/-/gi, " ").toLowerCase();
    txt = str.replace(/\b[a-z]/g, function (letter) {
      return letter.toUpperCase();
    });
    return txt;
  };
});

app.filter("join", function () {
  return function (input) {
    console.log(typeof input);
    return typeof input === "object" ? "" : input.join();
  };
});

app.filter("fNumber", function () {
  return function (input) {
    var myNum = new Intl.NumberFormat("en-IN").format(input);
    return myNum;
  };
});

//SMS Controller
app.controller("customSMSCtrl", [
  "$scope",
  "$log",
  function ($scope, $log) {
    $scope.msgContant = "";
    $scope.totalChar = 0;
    $scope.msgSize = 1;

    $scope.$watch(function () {
      var charLength = $scope.msgContant.length,
        message = $scope.msgContant,
        messLen = 0;

      var english = /^[~!@#$%^&*(){},.:/-_=+A-Za-z0-9 ]*$/;

      if (english.test(message)) {
        if (charLength <= 160) {
          messLen = 1;
        } else if (charLength <= 306) {
          messLen = 2;
        } else if (charLength <= 459) {
          messLen = 3;
        } else if (charLength <= 612) {
          messLen = 4;
        } else if (charLength <= 765) {
          messLen = 5;
        } else if (charLength <= 918) {
          messLen = 6;
        } else if (charLength <= 1071) {
          messLen = 7;
        } else if (charLength <= 1080) {
          messLen = 8;
        } else {
          messLen = "Equal to an MMS!";
        }
      } else {
        if (charLength <= 63) {
          messLen = 1;
        } else if (charLength <= 126) {
          messLen = 2;
        } else if (charLength <= 189) {
          messLen = 3;
        } else if (charLength <= 252) {
          messLen = 4;
        } else if (charLength <= 315) {
          messLen = 5;
        } else if (charLength <= 378) {
          messLen = 6;
        } else if (charLength <= 441) {
          messLen = 7;
        } else if (charLength <= 504) {
          messLen = 8;
        } else {
          messLen = "Equal to an MMS!";
        }
      }

      $scope.totalChar = charLength;
      $scope.msgSize = messLen;
    });
  },
]);
