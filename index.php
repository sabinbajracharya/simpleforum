<html>
<title>Just Ask About It!</title>
<head>
<link rel="stylesheet" href="css/header.css"/>
<link rel="stylesheet" href="css/home.css"/>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

	function fxnsubmit(e){
			if(e.keyCode == 13){
				var login = $('#login_form')[0];
				login.submit();
			}
		}

	$(document).ready(function(e) {
        $('.login-btn').click(function(){
				var form = $('#login_form')[0];
				form.submit();
		});
		
		$('.ask').click(function(e) {
			$(this).closest('form').attr('action','db_functions/newpost.function.php');
			$(this).closest('form').attr('method','POST');
			var form = $('#searchpost')[0];
			form.submit();
        });
		
		$('.search').click(function(e) {
    		var form = $('#searchpost')[0];
			form.submit();
        });		
		
		
    });
	
</script>

</head>
<body>
 <div class = outercontainer>
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
                        <li><input type="password" name="password" size="16" placeholder="password" onKeyDown="fxnsubmit(event)"/></li>
                        <li><div class="login-btn">Login</div></li>
                    </form>
                <?php
					}
				?>
            </ul>
        </div>
    </div> <!-- header ends -->
    <div class="container">
    	
      <div class="searchbar">
      	<span>Search Technical Topic Related to this Forum</span>
        <form action="search.php" method="GET" id="searchpost">
	      	<input type="text" name="value" placeholder="ask about something...."/> 
        
		<table style="margin-left:210px; margin-top:20px;">
        	<tr>
            	<td style="text-align:center;"><span class="search-btn ask">ask</span></td>
                <td style="text-align:center;"><span class="search-btn search">search</span></td>
            </tr>
        </table>
        </form>
      </div>  
      
		<div class="wrapper">        
          <div class="newposts">
                <span class="postheader">Recent Posts</span>
               

                  <?php 
				  	include_once('classes/connection.class.php');
					include_once('classes/user.class.php');
					$obj = new User();
					$arrayData = $obj->getRecentPost(0,5);
				  	foreach($arrayData as $data){ 
					?>
                    	<li><a href="post.php?id=<?php echo $data['postid']; ?>">
								<?php 
									$title = $data['title'];
									$truncTitle = strlen($title)>48?substr($title,0,48) . '...':$title;
									echo $truncTitle;
								 ?>
                            </a>
                       	</li>
                   <?php } ?>
                   
                   <div class="more"><a href="recentposts.php">more...</a></div>
               
            </div> <!-- new post ends -->
            
            <div class="popularposts">
                <span class="postheader">Popular Posts</span>

                    <?php
						$arrayData = $obj->getPopularPost(0,5);
						foreach($arrayData as $data){
					?>
                        <li><a href="post.php?id=<?php echo $data['postid']; ?>">
								<?php 
									$title = $data['title'];
									$truncTitle = strlen($title)>48?substr($title,0,48) . '...':$title;
									echo $truncTitle;
								 ?>
                             </a>
                        </li>
                    <?php } ?>

               	 <div class="more"><a href="popularposts.php">more...</a></div>
            </div>
        </div>
       </div> <!-- container ends -->
       
    <div class="bottom">
    	<table style="margin-left:auto;font-size:12px; font-family:Roboto-Regular;">
        	<tr>
            	<td><a href="">About Me &nbsp; </a>| </td>
            	<td><a href="">&nbsp; Contact Me &nbsp;</a> |</td>                
            	<td><a href="">&nbsp; Blog &nbsp;</a> |</td>               
               	<td><a href="register.php">&nbsp; Register &nbsp;</a></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>