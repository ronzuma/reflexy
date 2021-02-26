<!DOCTYPE html>
<html>
<head>
	<?php include('include/head.php'); ?>
</head>
<body>
	<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="login-box bg-white box-shadow pd-30 border-radius-5">
			<img src="<?php echo config_item('assets'); ?>vendors/images/login-img.png" alt="login" class="login-img">
			<h2 class="text-center mb-30">Login</h2>
			<?php echo form_open('secure', array('id' => 'FormLogin')); ?>
			<form>
				<div class="input-group custom input-group-lg">
					<?php 
						echo form_input(array(
							'name' => 'username', 
							'class' => 'form-control', 
							'autocomplete' => 'off', 
							'autofocus' => 'autofocus',
							'placeholder' => 'Username'
						)); 
					?>
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="input-group custom input-group-lg">
					<?php 
						echo form_password(array(
							'name' => 'password', 
							'class' => 'form-control', 
							'id' => 'InputPassword',
							'placeholder' => 'Password'
						)); 
					?>
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="input-group">
							<button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
						</div>
					</div>
				</div>
			</form>
			<?php echo form_close(); ?>
			<div id='ResponseInput'></div>
		</div>
	</div>
	<?php include('include/script.php'); ?>
	<script>
	$(function(){
		//------------------------Proses Login Ajax-------------------------//
		$('#FormLogin').submit(function(e){
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: "POST",
				cache: false,
				data: $(this).serialize(),
				dataType:'json',
				success: function(json){
					//response dari json_encode di controller

					if(json.status == 1){ window.location.href = json.url_home; }
					if(json.status == 0){ $('#ResponseInput').html(json.pesan); }
					if(json.status == 2){
						$('#ResponseInput').html(json.pesan);
						$('#InputPassword').val('');
					}
				}
			});
		});

		//-----------------------Ketika Tombol Reset Diklik-----------------//
		$('#ResetData').click(function(){
			$('#ResponseInput').html('');
		});
	});
	</script>
</body>
</html>