	var unfollowed = false;
	var followed = false;
	$(document).ready(
		function() {
			setEvents();
			$(".logout").click(function() {			
				var decision = confirm("Are you sure you want to log out of followMGT?");
				if (decision == true) {
					$.ajax({
    						type: "POST",
    						url: "logout.php",
    						success: function() {
       					alert("You have been successfully logged out.");
       					window.location.href = "index.php";
    						},
    						error: function() {
        						alert("Error: Something unexpected happened.");
    						}
					});
					return false;
				}		
			});

	});