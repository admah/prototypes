<?php
//Login Page
;?>

<!DOCTYPE html>
<html class="wvusUikit">
<head>
<title>Prototype Test App</title>

<!-- CSS -->
<link href="templates/uikit/css/wvus.uikit.min.css" rel="stylesheet" />

<!-- JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="templates/uikit/js/jquery.min.js"></script>
<script src="templates/uikit/js/wvus.uikit.min.js"></script>

<style>
.wvusUikit body {
  padding: 20px;
  background: #f0f0f0;
}

.wvusUikit .app {
  background: #fff;
  -webkit-box-shadow: 0px 0px 10px 1px rgba(102,102,102,0.5);
  -moz-box-shadow: 0px 0px 10px 1px rgba(102,102,102,0.5);
  box-shadow: 0px 0px 10px 1px rgba(102,102,102,0.5);
}

.protofisch img {
  float: left;
  height: 75px;
  width: 75px;
  margin: 0 5px;
  display: block;
  padding: 3px;
  border: 2px solid #000;
  -webkit-border-radius: 50px;
  -moz-border-radius: 50px;
  border-radius: 50px;
  background-color: orange;
}

.protofisch h1 {
  font-size: 42px;
  height: 75px;
  line-height: 75px;
}
</style>
</head>

<body>

<div class="wrapper">
  <div class="row">
    <div class="app col-md-8  panel panel-default col-md-offset-2 col-xs-12">
      <div class="panel-body">
        <div class="protofisch">
          <img src="templates/images/fisch-icon.png" height="75">
          <h1>Proto-Fisch</h1>
        </div>

        <p>Please login to see some amazing data.</p>

        <div class="controls pull-left">
          <button class="btn btn-primary" data-toggle="modal" data-target="#login">Login</button>
        </div>

        <!-- Hidden Modal -->
        <div class="modal fade in" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <form id="slim-login" action="/authn">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Edit Donor Data</h4>
                </div>
      
                <div class="modal-body">
                  <label>Username</label><br>
                  <input type="text" name="user" width="60"><br>
                  <label>Password</label><br>
                  <input type="password" name="pass" width="60"><br>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary" id="login-button">Login</button>
                </div>
              </div>
            </div>
          </form>
        </div>

      </div>      
    </div>
  </div>
</div>
<script>
(function($){
  $(document).ready(function(){
    $('#login-button').click(function(){
      $('form#slim-login').submit();
    });
  });
}(jQuery));
</script>

</body>
</html>