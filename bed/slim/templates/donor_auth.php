<?php
//AUTH DONOR Page
$info = $data['Auth_Party_Resp']['Party_Info']['Party_Find_By_User_Resp']['ROW'];
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
      
        <table class="table clear-fix table-responsive">
          <thead>
            <tr>
              <th>Name</th>
              <th>Account</th>
              <th>Type</th>
              <th>Number</th>
            </tr>
          </thead>        
          <tbody id="donor_list">
              <tr class="donor">
                    <td><?php echo $info['PERSON_FIRST_NAME'] . ' ' . $info['PERSON_LAST_NAME'];?></td>
                    <td><?php echo $info['USER_ACCOUNT'];?></td>
                    <td><?php echo $info['PARTY_TYPE'];?></td>
                    <td><?php echo $info['PRIMARY_DEDUP_PARTY_NUMBER'];?></td>
              </tr>     
          </tbody>        
        </table>

      </div>      
    </div>
  </div>
</div>

</body>
</html>