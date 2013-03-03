	function setEvents(){
		$(".url").mouseenter(function(ev) {
			var unfollow = ev.currentTarget.children[1].id;
			$(".unfollow#" + unfollow).css("visibility","visible");
		});
		$(".url").mouseleave(function(ev) {
			var unfollow = ev.currentTarget.children[1].id;
			$(".unfollow#" + unfollow).css("visibility","hidden");
		});
		$(".url_f").mouseenter(function(ev) {
			var follow = ev.currentTarget.children[1].id;
			$(".follow#" + follow).css("visibility","visible");
		});
		$(".url_f").mouseleave(function(ev) {
			var follow = ev.currentTarget.children[1].id;
			$(".follow#" + follow).css("visibility","hidden");
		});
		$(".unfollow").click(function(ev) {
			var name = this.id;
			var elem = "http://" + name + ".tumblr.com";
			var decision = confirm("Are you sure you want to unfollow " + name + "?");
			if (decision == true) {
				$.ajax("http://felisatti.com.ar/anita/followMGT/unfollow.php", {
					dataType: 'json',
					data: {'elem': elem},
					success: function(data) {
						if (data == 0) {
							alert("Blog not found.");
						} else {
							var blog = elem;
							var burl = blog.replace("http://","");
							var user = burl.replace(".tumblr.com","");
							if (!unfollowed) {
								$("#unflist").css("visibility","visible");
								unfollowed = true;
							}
							$(".blog#" + name).remove();
							$(".runfollow").append("<span class='blog' id='" + user + "'><div class='url_f'><a href='" + elem + "'>" + user + "</a> &nbsp <span class='follow_n' id='" + user + "'>&nbsp follow &nbsp</span><br></div><span>");
							// Ouch! This seems to "work" though. To be fixed later.
							setNewEvents();
							alert("Blog successfully unfollowed.");
						}
					},
					error: function() {
						alert("There was an error unfollowing the blog.");
					}
				});
			} else {
				
			}
		});
		$(".follow").click(function(ev) {
			var name = this.id
			var elem = "http://" + name + ".tumblr.com";
			var decision = confirm("Are you sure you want to follow " + name + "?");
			if (decision == true) {
				$.ajax("http://felisatti.com.ar/anita/followMGT/follow.php", {
					dataType: 'json',
					data: {'elem': elem},
					success: function(data) {
						if (data == false) {
							alert("Blog not found.");
						} else {
							var blog = elem;
							var burl = blog.replace("http://","");
							var user = burl.replace(".tumblr.com","");
							if (!followed) {
								$("#flist").css("visibility","visible");
								followed = true;
							}
							$(".blog#" + name).remove();
							$(".rfollow").append("<span class='blog' id='" + user + "'><div class='url'><a href='" + elem + "'>" + user + "</a> &nbsp <span class='unfollow_n' id='" + user + "'>&nbsp unfollow &nbsp</span><br></div><span>");
							// Ouch! This seems to "work" though. To be fixed later.
							setNewEvents();
							alert("Blog successfully followed.");
						}
					},
					error: function() {
						alert("There was an error following the blog.");
					}
				});
			} else {

			}
		});

	}
	function setNewEvents(){
		$(".url").mouseenter(function(ev) {
			var unfollow = ev.currentTarget.children[1].id;
			$(".unfollow_n#" + unfollow).css("visibility","visible");
		});
		$(".url").mouseleave(function(ev) {
			var unfollow = ev.currentTarget.children[1].id;
			$(".unfollow_n#" + unfollow).css("visibility","hidden");
		});
		$(".url_f").mouseenter(function(ev) {
			var follow = ev.currentTarget.children[1].id;
			$(".follow_n#" + follow).css("visibility","visible");
		});
		$(".url_f").mouseleave(function(ev) {
			var follow = ev.currentTarget.children[1].id;
			$(".follow_n#" + follow).css("visibility","hidden");
		});
		$(".unfollow_n").click(function(ev) {
			var name = this.id;
			var elem = "http://" + name + ".tumblr.com";
			var decision = confirm("Are you sure you want to unfollow " + name + "?");
			if (decision == true) {
				$.ajax("http://felisatti.com.ar/anita/followMGT/unfollow.php", {
					dataType: 'json',
					data: {'elem': elem},
					success: function(data) {
						if (data == 0) {
							alert("Blog not found.");
						} else {
							var blog = elem;
							var burl = blog.replace("http://","");
							var user = burl.replace(".tumblr.com","");
							if (!unfollowed) {
								$("#unflist").css("visibility","visible");
								unfollowed = true;
							}
							$(".blog#" + name).remove();
							$(".runfollow").append("<span class='blog' id='" + user + "'><div class='url_f'><a href='" + elem + "'>" + user + "</a> &nbsp <span class='follow' id='" + user + "'>&nbsp follow &nbsp</span><br></div><span>");
							// Ouch! This seems to "work" though. To be fixed later.
							setEvents();
							alert("Blog successfully unfollowed.");
						}
					},
					error: function() {
						alert("There was an error unfollowing the blog.");
					}
				});
			} else {

			}
		});
		$(".follow_n").click(function(ev) {
			var name = this.id
			var elem = "http://" + name + ".tumblr.com";
			var decision = confirm("Are you sure you want to follow " + name + "?");
			if (decision == true) {
				$.ajax("http://felisatti.com.ar/anita/followMGT/follow.php", {
					dataType: 'json',
					data: {'elem': elem},
					success: function(data) {
						if (data == false) {
							alert("Blog not found.");
						} else {
							var blog = elem;
							var burl = blog.replace("http://","");
							var user = burl.replace(".tumblr.com","");
							if (!followed) {
								$("#flist").css("visibility","visible");
								followed = true;
							}
							$(".blog#" + name).remove();
							$(".rfollow").append("<span class='blog' id='" + user + "'><div class='url'><a href='" + elem + "'>" + user + "</a> &nbsp <span class='unfollow' id='" + user + "'>&nbsp unfollow &nbsp</span><br></div><span>");
							// Ouch! This seems to "work" though. To be fixed later.
							setEvents();
							alert("Blog successfully followed.");
						}
					},
					error: function() {
						alert("There was an error following the blog.");
					}
				});
			} else {

			}
		});

	}