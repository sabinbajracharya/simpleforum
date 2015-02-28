<?php 
	session_start(); 
	if(!isset($_GET['id'])){
		header('Location:index.php');	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/header.css"/>
<link rel="stylesheet" href="css/post.css"/>
<link rel="stylesheet" href="css/paging.css"/>
<title>Just Ask About It!</title>
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
    	<div class="question">
        	<table>
            	<tr>
                	<?php
						include_once('classes/connection.class.php');
						include_once('classes/user.class.php');
						$obj = new User();
						$data = $obj->getPostById($_GET['id']);
					 ?>
                	<td style="vertical-align:top;"><img src="images/user.png" height="60" width="60" /></td>
                    <td>
                    	<?php echo $data['title']; ?>
                    </td>
                    
                </tr>
            </table>
        </div><!-- Class question ends -->
        <div class="answerbox">
        	<form action="db_functions/reply.function.php" method="post">
            	<input type="hidden" value="<?php echo $_GET['id']; ?>" name="temppostid" />
	        	<input type="text" placeholder="Answer this question...." name="reply"/>
            </form>
        </div><!-- Class answerbox ends -->
        
        <div class="reply">
        	<?php include('replypaging.php'); ?>
        </div><!-- Class reply ends -->
    </div><!-- Class container ends -->
    
</body>
</html>