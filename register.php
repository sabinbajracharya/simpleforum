<html>
<title>Register for an Account!</title>
<head>
	<link rel="stylesheet" href="css/header.css"/>
	<link rel="stylesheet" href="css/register.css"/>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
		function accregister(){
			var form = $('#regform')[0];
			form.submit();	
		}
		
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
    	<div class="register">
        	<div class="userpic">
				<img src="images/user.png" height="80" width="80" />	
			</div>
            <div class="registerform">
                	<table>
                    	<form method="post" action="db_functions/register.function.php" id="regform">
                    	<tr>
                        	<td>Name </td>
                            <td><input type="text" name="regname" required /></td>
                        </tr>
                        <tr>
                        	<td>Email </td>
                            <td><input type="email" name="regemail" required /></td>
                        </tr>
                        <tr>
                        	<td>User Name </td>
                            <td><input type="text" name="regusername" required /></td>
                        </tr>
                        <tr>
                        	<td>Password </td>
                            <td><input type="password" name="regpswd" required /></td>
                        </tr>
                        <tr>
                        	<td>Re-Password </td>
                            <td><input type="password" name="regcpswd" required /></td>
                        </tr>
                        <tr>
                        	<td colspan="2" style="text-align:center;" class="registerbtn" onClick="accregister()">
                            	Register
                             </td>
                           
                        </tr>
                        </form>
                    </table>
            </div> <!-- registerform ends -->
        </div><!-- register ends -->
    </div> <!-- container ends -->
    
</body>
</html>
