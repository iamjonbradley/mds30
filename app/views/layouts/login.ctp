<html>
<head>
  <title>Login | MDS 3.0</title>
  <link rel="stylesheet" type="text/css" href="/css/login.css" />
  <meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
  <meta name="ROBOTS" content="NONE" />
  <meta NAME="GOOGLEBOT" content="NOARCHIVE" />
</head>
  <div id="container">
    
    <div id="login">
    
      <div id="header">
        <img src="/img/logo-login.png" alt="MDS 3.0" />
      </div>
      
      <div id="content">  
        <?php 
        echo $this->Session->flash();
        echo $content_for_layout; 
        ?>  
      </div>
      
      <div id="footer">
		    v3.1.0 <br />
        <?php 
        if ($_SERVER['SERVER_ADDR'] == '192.168.50.12' || $_SERVER['SERVER_ADDR'] == '127.0.0.1')
          echo 'DEVELOPMENT SERVER - NOT FOR PRODUCTION USE';
        ?>
      </div>
      
    </div>
  
  </div>

</html>