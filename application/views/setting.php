<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Halaman Awal</a></li> 
  <li class="active">Pengaturan</li>
</ol>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
		  	<div class="panel-heading">
		    	<h3 class="panel-title">Pengaturan</h3>
		  	</div>
		  	<div class="panel-body">
		  		<div class="col-md-6">
		  			<div id="update-profile-message"></div>
		  			<form action="users/updateProfile" method="post" id="updateProfileForm">
		  			<fieldset>
			    		<legend>User</legend>
					    <div class="form-group">
					      <label for="username">Username : </label>
					      <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?php echo $userData['username'] ?>">
					    </div>
					    <div class="form-group">
					      <label for="fname">Nama Depan : </label>
					      <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name" value="<?php echo $userData['fname'] ?>">
					    </div>
					    <div class="form-group">
					      <label for="lname">Nama Belakang : </label>
					      <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name" value="<?php echo $userData['lname'] ?>">
					    </div>
					    <div class="form-group">
					      <label for="email">Email : </label>
					      <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo $userData['email'] ?>">
					    </div>
					    
					    <button type="submit" class="btn btn-primary">Simpan</button>
					  </fieldset>
					  </form>
		  		</div>
			    <div class="col-md-6">
			    	<div id="change-password-message"></div>
			    	<form action="users/changePassword" method="post" id="changePasswordForm">
		  			<fieldset>
			    		<legend>Rubah Password</legend>
					    <div class="form-group">
					      	<label for="currentPassword">Password Sekarang : </label>
					      	<input type="password" id="currentPassword" name="currentPassword" class="form-control" placeholder="Password Sekarang" />
					    </div>
					    <div class="form-group">
					      	<label for="newPassword">Password Baru : </label>
					      	<input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="Password Baru" />
					    </div>
					    <div class="form-group">
					      	<label for="confirmPassword">Konfirmasi Password : </label>
					      	<input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Konfirmasi Password" />
					    </div>
					    <button type="submit" class="btn btn-primary">Simpan</button>
					  </fieldset>
				  	</form>
		  		</div>	
		  	</div>
		</div>
	</div>	
</div>

<script type="text/javascript">
	$("#updateProfileForm").unbind('submit').bind('submit', function() {
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		$.ajax({
			url: url,
			type: type,
			data: form.serialize(),
			dataType: 'json',
			success:function(response) {
				if(response.success == true) {					
					$("#change-password-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  response.messages + 
					'</div>');					
										
					$(".form-group").removeClass('has-error').removeClass('has-success');
					$(".text-danger").remove();						
				}
				else {
					$.each(response.messages, function(index, value) {
						var key = $("#" + index);

						key.closest('.form-group')
						.removeClass('has-error')
						.removeClass('has-success')
						.addClass(value.length > 0 ? 'has-error' : 'has-success')
						.find('.text-danger').remove();							

						key.after(value);

					});
				}
			} // /.success
		}); // /ajax

		return false;
	});


	$("#changePasswordForm").unbind('submit').bind('submit', function() {
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		$.ajax({
			url: url,
			type: type,
			data: form.serialize(),
			dataType: 'json',
			success:function(response) {
				if(response.success == true) {					
					$("#update-profile-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  response.messages + 
					'</div>');					
										
					$(".form-group").removeClass('has-error').removeClass('has-success');
					$(".text-danger").remove();						
				}
				else {
					$.each(response.messages, function(index, value) {
						var key = $("#" + index);

						key.closest('.form-group')
						.removeClass('has-error')
						.removeClass('has-success')
						.addClass(value.length > 0 ? 'has-error' : 'has-success')
						.find('.text-danger').remove();							

						key.after(value);

					});
				}
			} // /.success
		}); // /ajax

		return false;
	});
</script>