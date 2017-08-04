<?php
include('./classes/DB.php');
include('./classes/Login.php');
if (Login::isLoggedIn()) {
        $userid = Login::isLoggedIn();
} else {
        die('Not logged in');
}

if (isset($_GET['mid'])) {
        $message = DB::query('SELECT * FROM messages WHERE id=:mid AND (receiver=:receiver OR sender=:sender)', array(':mid'=>$_GET['mid'], ':receiver'=>$userid, ':sender'=>$userid))[0];
        echo '<h1>View Message</h1>';
        echo htmlspecialchars($message['body']);
        echo '<hr />';

        if ($message['sender'] == $userid) {
                $id = $message['receiver'];
        } else {
                $id = $message['sender'];
        }
        DB::query('UPDATE messages SET `read`=1 WHERE id=:mid', array (':mid'=>$_GET['mid']));
        ?>
       <!-- <form action="send-message.php?receiver=<?php echo $id; ?>" method="post">
                <textarea name="body" rows="8" cols="80"></textarea>
                <input type="submit" name="send" value="Send Message">
        </form> -->
        <?php
} else {

?>
<!-- <h1>My Messages</h1> -->
<?php
$messages = DB::query('SELECT messages.*, users.username FROM messages, users WHERE receiver=:receiver OR sender=:sender AND users.id = messages.sender', array(':receiver'=>$userid, ':sender'=>$userid));
foreach ($messages as $message) {

        if (strlen($message['body']) > 10) {
                $m = substr($message['body'], 0, 10)." ...";
        } else {
                $m = $message['body'];
        }

        if ($message['read'] == 0) {
                echo "<a href='my-messages.php?mid=".$message['id']."'><strong>".$m."</strong></a> sent by ".$message['username'].'<hr />';
        } else {
                echo "<a href='my-messages.php?mid=".$message['id']."'>".$m."</a> sent by ".$message['username'].'<hr />';
        }

}
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
 </body>
</html>
