<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Popular Posts</title>
<link rel="stylesheet" href="css/header.css"/>
<link rel="stylesheet" href="css/search.css"/>
<link rel="stylesheet" href="css/paging.css"/>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
	function fxnsubmit(e){
			if(e.keyCode == 13){
				var login = $('#login_form')[0];
				login.submit();
			}
		}
</script>

</head>

<body>
<div class="header">
    	<div class="left">
        	<ul>
				<li><a href="index.php">askAbout<span>.tk</span></a></li>		
            </ul>
        </div>
    	<div class="right">
        	<ul>
            	<?php
					session_start();
					if(isset($_SESSION['username'])){
						
				?>
						<li>Welcome <?php echo $_SESSION['username']; ?></li>							
                <?php
					}else{
						
					
				?>
                	<form method="post" action="db_functions/login.function.php" id="login_form">
                        <li><input type="text" name="username" size="16" placeholder="username" /> </li>
                        <li><input type="password" name="password" size="16" placeholder="password" onKeyDown="fxnsubmit(event)" /></li>
                        <li><div class="login-btn">Login</div></li>
                    </form>
                <?php
					}
				?>
            </ul>
        </div>
    </div> <!-- header ends -->
    
    <div class="container">
    
    		<div class="search_header">
    			<p>Popular Posts ...  <span> <!-- HEADER GOES HERE --></span></p>
		    </div>
		
        	<?php include('popularpaging.php'); ?>
     	
    </div><!-- Class container ends -->

</body>
</html>