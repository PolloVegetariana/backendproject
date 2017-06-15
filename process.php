<?php

require_once('connection.php');
session_start();

if (isset($_POST['form_source']) && $_POST['form_source'] == 'registration') 
{
	registerUser();
} 
else if (isset($_POST['form_source']) && $_POST['form_source'] == 'login') 
{
	loginUser();
}

else if (isset($_POST['form_source']) && $_POST['form_source'] == 'tweet')
{
	postTweet();
}

else if (isset($_POST['form_source']) && $_POST['form_source'] == 'retweet') {
	processRetweet();
}


function registerUser() {
	$query = "INSERT INTO users (name, email, password) 
	VALUES ('{$_POST['name']}', '{$_POST['email']}', '{$_POST['password']}');";
    if(!preg_match('/^([A-Za-z]+)$/', $_POST['name'])) {
    	echo "Your username is inproperly formatted, no numbers. \n";
    }
    if (empty($_POST['email'])) {
    	echo "Email is required. \n";
 	} 
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      echo "Invalid email format. \n"; 
    }
	if(strlen($_POST['password']) < 6){
          Echo "Password must be more than 6 characters!";
	}
	else if (run_mysql_query($query)) {
		$_SESSION ['loggedin'] = TRUE;
		$_SESSION ['user'] = $_POST['email'];
		header('Location: http://localhost/twitter/home.php');
}
}

function loginUser() {
	$query = "SELECT * FROM users WHERE email = '{$_POST['email']}' AND password = '{$_POST['password']}'";
	$result = fetch_record($query);
	if($result) {
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['user'] = $_POST['email'];
		header('Location: http://localhost/twitter/home.php');
	} else {
		echo 'Incorrect email or password';	
	}
}

function postTweet() {
	$query = "INSERT INTO tweets (tweet, users_id) VALUES ('{$_POST['tweet']}', '{$_POST['users_id']}')";

	if(run_mysql_query($query)) {
		header('Location: http://localhost:80/twitter/home.php');
	} else {
		echo "Error adding post";
	}

}

function processRetweet() {
	$query = "SELECT tweets.tweet FROM tweets LEFT JOIN users ON tweets.users_id = users.id";
	$result = fetch_record($query);
	//echo $query;
	if (run_mysql_query($query)) {
		header('Location: http://localhost:80/twitter/home.php');
	} else {
		echo "Error retweeting, try again later";
	}
}