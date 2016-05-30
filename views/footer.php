	<footer class="footer">
		<div class="container">
			<p>&copy; myWebsite 2016</p>
		</div>
	</footer>
	
	<!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
	
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
			<h4 class="modal-title" id="optionTitle">Login</h4>
		  </div>
		  <div class="modal-body">
			<div class="alert alert-danger" id="optionAlert"></div>
			<form>
				<input type="hidden" id="optionActive" value="1" />
			  <fieldset class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" placeholder="Email address">
			  </fieldset>
			  <fieldset class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" placeholder="Password">
			  </fieldset>
			</form>
		  </div>
		  <div class="modal-footer">
			<a id="toggleSignupLogin">Sign up</a>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" id="optionBtn" class="btn btn-primary">Login</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<script>
		$("#toggleSignupLogin").on("click", function() {
			
			if ($("#optionActive").val() == "1") {
				$("#optionActive").val("0");
				$("#optionTitle").html("Sign up");
				$("#optionBtn").html("Sign up");
				$("#toggleSignupLogin").html("Login");
				
			} else {
				$("#optionActive").val("1");
				$("#optionTitle").html("Login");
				$("#optionBtn").html("Login");
				$("#toggleSignupLogin").html("Sign up");
			}
		});
		
		$("#optionBtn").on("click", function() {
			
			$.ajax({
				type: "post",
				url: "actions.php?action=loginSignup",
				data: "email=" + $("#email").val() + "&password=" + $("#password").val() + "&optionActive=" + $("#optionActive").val(),
				success: function(result) {
					if (result == "1") {
						window.location.assign("http://localhost/arnuga3/mvc-php/");
					} else {
						$("#optionAlert").html(result).show();
					}
				}
				
			});
		});
		
	</script>
	
  </body>
</html>