<?
	class followmgt {
		var $autho = NULL;
		var $blog_url = '';
		var $screen_name = '';
	
		function begin(){
			$tum_oauth = new TumblrOAuth(APP_KEY, APP_SECRET);
			// Ask Tumblr for a Request Token.  Specify the Callback URL here too (although this should be optional)
			$request_token = $tum_oauth->getRequestToken(CALLBACK);

			// Store the request token and Request Token Secret as out callback.php script will need this
			$_SESSION['request_token'] = $token = $request_token['oauth_token'];
			$_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];

			// Check the HTTP Code.  It should be a 200 (OK), if it's anything else then something didn't work.
			switch ($tum_oauth->http_code) {
  				case 200:
    					// Ask Tumblr to give us a special address to their login page
    					$url = $tum_oauth->getAuthorizeURL($token);
        
        				// Redirect the user to the login URL given to us by Tumblr
    					header('Location: ' . $url);
        
        				// That's it for our side.  The user is sent to a Tumblr Login page and
        				// asked to authroize our app.  After that, Tumblr sends the user back to
        				// our Callback URL (callback.php) along with some information we need to get
        				// an access token.
        
    					break;
				default:
    					// Give an error message
    					echo 'Could not connect to Tumblr. Refresh the page or try again later.';
			}
			exit();		
		}
		function carryOn(){
			$this->autho = new TumblrOAuth(APP_KEY, APP_SECRET, $_SESSION['token']['oauth_token'], $_SESSION['token']['oauth_token_secret']);
			
			return true;
		}
		function callback(){
			// It'll need our Consumer Key and Secret as well as our Request Token and Secret
			$tum_oauth = new TumblrOAuth(APP_KEY, APP_SECRET, 
				$_SESSION['request_token'], $_SESSION['request_token_secret']);

			// Ok, let's get an Access Token. We'll need to pass along our oauth_verifier which was given to us in the URL. 
			$access_token = $tum_oauth->getAccessToken($_REQUEST['oauth_verifier']);

			// We're done with the Request Token and Secret so let's remove those.
			unset($_SESSION['request_token']);
			unset($_SESSION['request_token_secret']);

			// Make sure nothing went wrong.
			if (200 != $tum_oauth->http_code) {
				return $this->error('Unable to authenticate');
			}
			
			//Saves the auth token in the session!
			$_SESSION['token'] = array("oauth_token" => $access_token["oauth_token"],
					"oauth_token_secret" => $access_token["oauth_token_secret"]);
			return true;
		}
		function getBlogData(){
			$userinfo = $this->autho->get('http://api.tumblr.com/v2/user/info');
			if (200 == $this->autho->http_code) {
				$screen_name = $userinfo->response->user->name;
				
				return $screen_name;
			} else {
				die('Unable to get info.');
			}
		}
		function getFollowers(){
			$userinfo = $this->autho->get('http://api.tumblr.com/v2/user/info');
			if (200 == $this->autho->http_code) {
				$screen_name = $userinfo->response->user->name;
				$blog_url = $screen_name.'.tumblr.com';
				//echo $screen_name;
				//echo $blog_url;
			} else {
				die('Unable to get info.');
			}
			//echo $screen_name;
			$furl = 'http://api.tumblr.com/v2/blog/'.$blog_url.'/followers';
			//echo $furl;
			$params = array('limit' => 20, 'offset' => 0);
			$res = array();
			$followers = $this->autho->get($furl, $params);
			if (200 == $this->autho->http_code) {
				//header('Location: index.php');
				$total = $followers->response->total_users;
			} else {
				die('Unable to get followers.');
			}

			$users = array();
			while ($params['offset']<$total) {
				$followers = $this->autho->get($furl, $params);
				if (200 == $this->autho->http_code){
					$users = $followers->response->users;
					foreach ($users as $user){
						$res[$user->name] = $user->url;
					}
					$params['offset'] = $params['offset'] + 20;
				} else {
					echo "error ";
				}
			}
			return $res;
		}
		function getFollowing(){
			$furl = 'http://api.tumblr.com/v2/user/following';
			$params = array('limit' => 20, 'offset' => 0);
			$res = array();
			$following = $this->autho->get($furl, $params);
			if (200 == $this->autho->http_code) {
				$total = $following->response->total_blogs;
			} else {
				die('Unable to get following.');
			}
			$blogs = array();
			while ($params['offset']<$total) {
				$following = $this->autho->get($furl, $params);
				if (200 == $this->autho->http_code){
					$blogs = $following->response->blogs;
					foreach ($blogs as $blog){
						$res[$blog->name] = $blog->url;
					}
					$params['offset'] = $params['offset'] + 20;
				} else{
					echo "error ";
				}
			}
			return $res;
		}
		function unfollow($user) {
			$furl = 'http://api.tumblr.com/v2/user/unfollow';
			$params = array('url' => $user);
			$res = $this->autho->post($furl, $params);
			if (200 == $this->autho->http_code) {
				return true;
			} else {
				if (404 == $this->autho->http_code) {
					return false;
				} else {
					echo "Error unfollowing.";
				}
			}
		}
		function follow($user) {
			$furl = 'http://api.tumblr.com/v2/user/follow';
			$params = array('url' => $user);
			$res = $this->autho->post($furl, $params);
			if (200 == $this->autho->http_code) {
				return true;
			} else {
				if (404 == $this->autho->http_code) {
					return false;
				} else {
					echo "Error unfollowing.";
				}
			}
		}
		function error($str){
			return false;
		}
	}

?>