<?php
$mysqli=new mysqli("localhost","root","","newsocial");
if($mysqli->connect_error)
{
	die("connect eror");
}
$users=$mysqli->query("select id,username,email,verified,role,status from users where role='moderator'");

if(isset($_POST['del']))
{
	$userid=$_POST['userid'];
	$mysqli->query("update users set role='user' where id=$userid");
}
$mysqli->close();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style>
	th{
	  border:1px solid black;
	}
	td{
		border:1px solid black;
	}
	</style>
</head>
<body>
  <nav class="navbar navbar-default hidden-xs navigation-clean">
            <div class="container">
                <div class="navbar-header"><a class="navbar-brand navbar-link" href="#"><i class="icon ion-ios-navigate"></i></a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav hidden-md hidden-lg navbar-right">
                        <li role="presentation"><a href="http://mysocmedia/index.php">Website</a></li>
                        <li role="presentation"><a href="./statistics.php">Statistics</a></li>
                        <li role="presentation"><a href="./accounts.php">Accounts</a></li>
						<li role="presentation"><a href="./moderators.php">Moderators</a></li>
						<li role="presentation"><a href="#">Warnings</a></li>
                    </ul>
                    <ul class="nav navbar-nav hidden-xs hidden-sm navbar-right">
					    <li role="presentation"><a href="http://mysocmedia/index.php">Website</a></li>
                        <li role="presentation"><a href="./statistics.php">Statistics</a></li>
						<li role="presentation"><a href="./accounts.php">Accounts</a></li>
						<li role="presentation"><a href="./moderators.php">Moderators</a></li>
						<li role="presentation"><a href="#">Warnings</a></li>
                        
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
		<h1>Moderators</h1>
		
		<table class="col-xs-11">
		   <tr>
		     <th class="col-xs-1">ID</th>
			 <th class="col-xs-1">Login</th>
			 <th class="col-xs-1">Email</th>
			 <th class="col-xs-1">Is Verified</th>
			 <th class="col-xs-1">Action</th>
		   </tr>
		 <?php  while($row=mysqli_fetch_array($users)){ ?>
		   <tr>
			    <td class="col-xs-1"><?php echo $row['id'] ?></td>
				<td class="col-xs-1"><?php echo $row['username'] ?></td>
				<td class="col-xs-1"><?php echo $row['email'] ?></td>
				<td class="col-xs-1"><?php echo $row['verified'] ?></td>
				<td class="col-xs-1">
				  <form name="update_user" action="http://mysocmedia/admin/moderators.php" method="post">
				     <input type="hidden" name="userid" value="<?= $row['id'] ?>">
					 <input type="submit" name="del" value="Delete"/>
				  </form>
				</td>
		   </tr>
		 <?php } ?>
		</table>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>