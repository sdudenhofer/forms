<!DOCTYPE html>
<html>
<title>Pyxis Request Form Page</title>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="http://code.jquery.com/<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<div class="navbar navbar-light">
    <h2>Pyxis Request Login</h2>
</div>
<body>
    <div class="container">
        <div class="card">
        <div class="form-container">
       <form method="post">
           <h4>User your windows username/password to log in</h4>
         <?php
        if(isset($error)){
          ?>
          <div class="alert alert-danger">
            <i class="glyphicon glyphicon-warning-sign"></i><?php echo $error; ?>
          </div>
          <?php
        }
        ?>
        <div class="form-group">
          User Name: <input type="text" class="form-control" name="txt_uname" placeholder="Your Username" required />
        </div><br>
        <div class="form-group">
          Password: <input type="password" class="form-control" name="txt_password" placeholder="Your Password" required />
        </div>
        <div class="clearfix"></div>
        <div class="form-group"><br>
          <button type="submit" name="btn-login" class="btn btn-block btn-primary">
            <i class="glyphicon glyphicon-log-in"></i>&nbsp;Sign In
          </button>
        </div>
        </div>
    </div>
</body>
<?php
  
  if(isset($_POST['btn-login'])){
    $uname = $_POST['txt_uname'];
    $upass = $_POST['txt_password'];
    
    //Setting up LDAP Connection to allow user logon
    $dn = 'DC=QHCUS,DC=COM';
    $host = '10.26.88.140';
    $ldap = ldap_connect($host);

    $username="qhcus\\" . $uname;
    ldap_start_tls($ldap);
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS,0);
    if($bind = ldap_bind($ldap, "qhcus\\" .$uname, $upass)){
        
        $groupArray = array(); //array to store group list
        $filter = "(|(displayname=$uname*)(givenname=$uname*)(cn=$uname*)(userprincipalname=$uname*))";
        //search for user and gather groups user is member of
        $search = ldap_search($ldap, $dn, $filter);
        $data = ldap_get_entries($ldap, $search);
        $groupTotal = @$data[0]['memberof']['count'];
        for($x = 0; $x < $groupTotal; $x++){
            $group = @$data[0]['memberof'][$x];
            $group = substr($group, 0, strpos($group, ","));
            $group = str_replace("CN=", "", $group);
            array_push($groupArray, $group);
        }
        if(in_array("OR1706_MWMC All MGMT_SUPV", $groupArray, true)){
          session_start();
          setcookie('pyxisrequest', $uname, time()+3600); //expire in an hour
          $session_id = session_create_id('pyxisreq_'); //generates session_id
          setcookie('pyxisrequest_id', $session_id, time()+3600);
          $time = date("Y-m-d H:i:s");
          try{
            $connect = new PDO("mysql:host=$hostname; dbname=logs", $usern, $pword);
          }catch(PDOException $e){
            echo $e->getMessage();
          }
          $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $query = "INSERT INTO user_log ('username', 'session_id', 'timestamp', 'action') VALUES ('$uname', '$session_id', '$time', 'LOGIN')";
          $connect->query($query);
          $connect = null;
          header("Location: pyxis-request.php");
        }elseif(in_array("OR1706_Info Tech Dept_", $groupArray, true)){
          session_start();
          setcookie('pyxisrequest', $uname, time()+3600); //expire in an hour
          $session_id = session_create_id('pyxisreq_'); //generates session_id
          setcookie('pyxisrequest_id', $session_id, time()+3600);
          $time = date("Y-m-d H:i:s");
          try{
            $connect = new PDO("mysql:host=$hostname; dbname=logs", $usern, $pword);
          }catch(PDOException $e){
            echo $e->getMessage();
          }
          $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $query = "INSERT INTO user_log ('username', 'session_id', 'timestamp') VALUES ('$uname', '$session_id', '$time')";
          $connect->query($query);
          $connect = null;
          header("Location: pyxis-request.php");
        }else{
            $error = "User not authorized";
            echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span>". $error . "</div>";
        }
    }else{
        print($username." did not login");
    }

    ldap_close($ldap);
  }
?>