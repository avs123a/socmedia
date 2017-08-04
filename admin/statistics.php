<?php
$mysqli=new mysqli("localhost","root","","newsocial");
if($mysqli->connect_error)
{
	die("connect eror");
}
$users=$mysqli->query("select COUNT(id) as usrc from users where status='active'");
$banned=$mysqli->query("select COUNT(users.id) as busrc from users where status='banned'");
$posts=$mysqli->query("select COUNT(posts.id) as postc from posts");
$comments=$mysqli->query("select COUNT(comments.id) as cmnc from comments");
$messages=$mysqli->query("select COUNT(messages.id) as msgc from messages");
$usr=mysqli_fetch_assoc($users);
$bnu=mysqli_fetch_assoc($banned);
$pst=mysqli_fetch_assoc($posts);
$msgs=mysqli_fetch_assoc($messages);
$cmt=mysqli_fetch_assoc($comments);
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
		<h1>Statistics</h1>
		<table class="col-xs-10">
		  <tr>
		    <th>Active Users</th>
			<th>Banned Users</th>
			<th>Posts</th>
			<th>Messages</th>
			<th>Comments</th>
		  </tr>
		  <tr>
		  <?php  ?>
		    <td><?=$usr['usrc']; ?></td>
			<td><?=$bnu['busrc']; ?></td>
			<td><?=$pst['postc']; ?></td>
			<td><?=$msgs['msgc']; ?></td>
			<td><?=$cmt['cmnc']; ?></td>
		  <?php  ?>
		  </tr>
		</table>
		
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>