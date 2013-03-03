<?php
	
	require_once('define.php');
		
	$follow = new followmgt();
	
	if (!$follow->carryOn()){
		echo "ERROR";
	}
	
	$followers = $follow->getFollowers();
	$following = $follow->getFollowing();
	
	$diff_followers = array_diff_key($followers, $following);
	$diff_following = array_diff_key($following, $followers);
	$intersec = array_intersect_key($followers, $following);

	$user_name = $follow->getBlogData();
?>
<html>
	<head>
		<title>followMGT</title>
		<script src='js/jquery-1.9.1.js'
			language='javascript'></script>
		<script src='js/jquery-ui-1.10.1.custom.min.js'
			language='javascript'></script>
		<script src='functions.js' language='javascript'></script>
		<script src='actions.js' language='javascript'></script>
		<link rel="shortcut icon" href="http://felisatti.com.ar/anita/followMGT/icon_small.png" />
		<style>
      			body {
        			background-color: rgb(56,87,115);
				font-family: Lucida Sans Unicode;
      			}
			.extcontainer {
				border-radius: 10px;
				box-shadow: 5px 5px 2px #333;
			}
      			.container {
        			border-radius: 4px;
        			box-shadow: 5px 5px 2px #333;
      			}
			.blog {
				margin-right:120px;
			}
			.url {
				margin-left: 102px;
				height: 22px;
			}
			.url_f {
				margin-left: 102px;
				height: 22px;
			}
      			.unfollow {
				background-color: rgb(158,158,157);
				border-color: rgb(150,150,150);
        			border-style: solid;
				border-width: 2px;
				border-radius: 4px;
				color: white;
				text-align: center;
				font-size: 12px;
				height: 14px;
				width: 95px;
				opacity: 0.8;
				visibility: hidden;
      			}
      			.unfollow:hover {
        			cursor: pointer;
				opacity: 0.6;
      			}
			.follow {
				background-color: rgb(158,158,157);
				border-color: rgb(150, 150, 150);
        			border-style: solid;
				border-width: 2px;
				border-radius: 4px;
				color: white;
				text-align: center;
				font-size: 12px;
				height: 14px;
				width: 95px;
				opacity: 0.8;
				visibility: hidden;	
      			}
			.follow:hover {
        			cursor: pointer;
				opacity: 0.6;
      			}
			.unfollow_n {
				background-color: rgb(158,158,157);
				border-color: rgb(150,150,150);
        			border-style: solid;
				border-width: 2px;
				border-radius: 4px;
				color: white;
				text-align: center;
				font-size: 12px;
				height: 14px;
				width: 95px;
				opacity: 0.8;
				visibility: hidden;
      			}
      			.unfollow_n:hover {
        			cursor: pointer;
				opacity: 0.6;
      			}
			.follow_n {
				background-color: rgb(158,158,157);
				border-color: rgb(150, 150, 150);
        			border-style: solid;
				border-width: 2px;
				border-radius: 4px;
				color: white;
				text-align: center;
				font-size: 12px;
				height: 14px;
				width: 95px;
				opacity: 0.8;
				visibility: hidden;	
      			}
			.follow_n:hover {
        			cursor: pointer;
				opacity: 0.6;
      			}

			h2 {
				position: relative;
				margin-left: 39px;
			}
			h2#unflist {
				visibility: hidden;
			}
			h2#flist {
				visibility: hidden;
			}
			h3 {
				height: 25px;
			}
			a {
				color: black;
				text-decoration: none;
			}
			a:hover {
				cursor: pointer;
				text-decoration: underline;
				color: blue;
			}
			.logout {
				position: fixed;
				width: 80px;
				top: 10px;
				right: 23px;
				text-align: center;
				color: white;
				opacity: 0.6;
			}
			.logout:hover {
				opacity: 1.0;
				cursor: pointer;
			}
</style>
	</head>
	<body>
		<span style="height: 100px;"></span>
		<div class="logout"><b>Log Out</b></div>
		<h1 style="background-color: #385773; height: 173px;">
			<div style="margin-left: 100px;">
				<img src="http://felisatti.com.ar/anita/followMGT/logo.png">
				<span style="color: white; margin-left:50px;"><span style="font-family: Lucida Sans Unicode;">Welcome, <? echo $user_name; ?>!</span></span>
			</div>
			
		</h1>
		<span style="font-family: Lucida Sans Unicode; height: 100px;"> </span>
		<div style="background-color: rgb(44,71,98); margin-bottom: 100px; margin-left: 126px; margin-right: 126px;" class="extcontainer">
			<h3>&nbsp</h3>
    			<div style="background-color: white; margin-top: 25px; margin-bottom: 25px; margin-left: 50px; margin-right: 50px;" class="container">
				<h3>&nbsp</h3>
				<h2> Blogs following back: <? echo count($intersec); ?> </h2>
				<? foreach ($intersec as $name => $url) { ?>
					<span class="blog" id="<? echo $name ?>"><div class="url"><a href="<? echo $url; ?>"><? echo $name; ?></a> &nbsp <span class="unfollow" id="<? echo $name ?>">&nbsp unfollow &nbsp</span><br></div></span>
				<? } ?>
				<h2 > Blogs not following back: <? echo count($diff_following); ?> </h2>
				<? foreach ($diff_following as $name => $url) { ?>
					<span class="blog" id="<? echo $name ?>"><div class="url"><a href="<? echo $url; ?>"><? echo $name; ?></a> &nbsp <span class="unfollow" id="<? echo $name ?>"> &nbsp unfollow &nbsp</span><br></div></span>
				<? } ?>
				<h2> Followers not followed back: <? echo count($diff_followers); ?> </h2>
				<? foreach ($diff_followers as $name => $url) { ?>
					<span class="blog" id="<? echo $name ?>"><div class="url_f"><a href="<? echo $url; ?>"><? echo $name; ?></a> &nbsp <span class="follow" id="<? echo $name ?>"> &nbsp follow &nbsp</span><br></div></span>
				<? } ?>
				<h2 id="unflist"> Blogs recently unfollowed: </h2>
				<span class="runfollow"></span>
				<h2 id="flist"> Blogs recently followed: </h2>
				<span class="rfollow"></span>
			</div>
			<h3>&nbsp</h3>
		</div>
	</body>
</html>