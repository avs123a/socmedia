<?php
     include('./classes/DB.php');
     if (isset($_POST['searchbox'])) {
        $tosearch = explode(" ", $_POST['searchbox']);
        if (count($tosearch) == 1) {
                $tosearch = str_split($tosearch[0], 2);
        }
        $whereclause = "";
        $paramsarray = array(':username'=>'%'.$_POST['searchbox'].'%');
        for ($i = 0; $i < count($tosearch); $i++) {
                $whereclause .= " OR username LIKE :u$i ";
                $paramsarray[":u$i"] = $tosearch[$i];
        }
        $usernames = DB::query('SELECT users.username FROM users WHERE users.username LIKE :username '.$whereclause.'', $paramsarray)[0]['username'];
		$usersid = DB::query('SELECT users.username FROM users WHERE users.username LIKE :username '.$whereclause.'', $paramsarray)[0]['username'];
        $whereclause = "";
        $paramsarray = array(':body'=>'%'.$_POST['searchbox'].'%');
        for ($i = 0; $i < count($tosearch); $i++) {
                if ($i % 2) {
                $whereclause .= " OR body LIKE :p$i ";
                $paramsarray[":p$i"] = $tosearch[$i];
                }
        }
        $posts = DB::query('SELECT posts.body FROM posts WHERE posts.body LIKE :body '.$whereclause.'', $paramsarray);
        //echo '<pre>';
        //print_r($posts);
        //echo '</pre>';
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Network</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/Highlight-Clean.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean1.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body>
    <header class="hidden-sm hidden-md hidden-lg">
        <div class="searchbox">
            <form>
                <h1 class="text-left">Social Network</h1>
                <div class="searchbox"><i class="glyphicon glyphicon-search"></i>
                    <input class="form-control" type="text">
                </div>
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button">MENU <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li role="presentation"><a href="/profile.php?username=<?php echo $usn ?>">My Profile</a></li>
                        <li class="divider" role="presentation"></li>
                        <li role="presentation"><a href="/index.php">Timeline </a></li>
                        <li role="presentation"><a href="/my-messages.php">Messages </a></li>
                        <li role="presentation"><a href="/notify.php">Notifications </a></li>
                        <li role="presentation"><a href="#">My Account</a></li>
                        <li role="presentation"><a href="/logout.php">Logout </a></li>
                    </ul>
                </div>
            </form>
        </div>
        <hr>
    </header>
	<div>
	<nav class="navbar navbar-default hidden-xs navigation-clean">
            <div class="container">
                <div class="navbar-header"><a class="navbar-brand navbar-link" href="#"><i class="icon ion-ios-navigate"></i></a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <form class="navbar-form navbar-left">
                        <div class="searchbox"><i class="glyphicon glyphicon-search"></i>
                            <input class="form-control" type="text">
                        </div>
                    </form>
                    <ul class="nav navbar-nav hidden-md hidden-lg navbar-right">
                        <li role="presentation"><a href="#">My Timeline</a></li>
                        <li class="dropdown open"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">User <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li role="presentation"><a href="/profile.php?username=<?php echo $usn ?>">My Profile</a></li>
                        <li class="divider" role="presentation"></li>
                        <li role="presentation"><a href="/index.php">Timeline </a></li>
                        <li role="presentation"><a href="/my-messages.php">Messages </a></li>
                        <li role="presentation"><a href="/notify.php">Notifications </a></li>
                        <li role="presentation"><a href="#">My Account</a></li>
                        <li role="presentation"><a href="/logout.php">Logout </a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav hidden-xs hidden-sm navbar-right">
                        <li role="presentation"><a href="#">My Timeline</a></li>
                        <li class="dropdown open"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">User <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li role="presentation"><a href="/profile.php?username=<?php echo $usn ?>">My Profile</a></li>
                        <li class="divider" role="presentation"></li>
                        <li role="presentation"><a href="/index.php">Timeline </a></li>
                        <li role="presentation"><a href="/my-messages.php">Messages </a></li>
                        <li role="presentation"><a href="/notify.php">Notifications </a></li>
                        <li role="presentation"><a href="#">My Account</a></li>
                        <li role="presentation"><a href="/logout.php">Logout </a></li>
                            </ul>
                        </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
	<div>
	</div>
	   <?php echo "$usernames.<br>.$usersid" ?>
	</div>
</body>
</html>