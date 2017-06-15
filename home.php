<?php 
	require_once('connection.php');
	session_start();
	$query = "SELECT * FROM users WHERE email = '{$_SESSION['user']}'";
	$user = fetch_record($query);

	$get_tweets = "SELECT * FROM tweets 
					LEFT JOIN users
					ON users.id = tweets.users_id
					ORDER BY tweets.created_at DESC";

	$tweets = fetch_all($get_tweets);
	// var_dump($tweets);die;
?>
<!DOCTYPE html>
<html>
<head>
	<title> Timeline for the Real Estate Investor App!! Yay! 3</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
	<h3>YOLO I LIKE CATS</h3>
	<p class="right"><?php echo $user['name'] ?></p>
	<a href="logout.php">Logout</a>
</div>
	<div class="post"> 
		<h3> Post a tweet</h3>
		<form action="process.php" method="POST">
		<textarea name="tweet" placeholder="send tweet"></textarea>
		<input type="hidden" name="form_source" value="tweet">
		<input type="hidden" name="users_id" value="<?= $user['id'] ?>">
		<input type="submit" value="Post a tweet">
		</form>
	</div>
			<?php foreach ($tweets as $tweet) { ?>
		<div class="tweet">
			<h4><?= $tweet['name'] ?> - <?= $tweet['created_at']?></h4>
			<p><?=$tweet['tweet']?></p>

			<form action="process.php" method="POST">
				<input type="hidden" name="form_source" value="retweet">
				<!-- <input type="hidden" name="user_id" value="<?= $user['id'] ?>"> -->
				<input type="hidden" name="tweet-id" value="<?= $tweet['id'] ?>">
				<input name="retweet" type="submit" value="Retweet">
			</form>
		</div> 
			<?php } ?>
</body>
</html>