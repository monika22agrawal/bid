<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Property Approval Email</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	</head>
	<body style="font-family: 'Roboto', sans-serif; padding:0; margin:0;">
		<table style="max-width: 750px; margin: 0px auto; width: 100% ! important; background: #F3F3F3; padding: 30px 30px 30px 30px;" width="100% !important" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td style="background:#fff; padding:15px; text-align: center;"><img style="max-width: 125px; width: 100%;padding: 10px;" src="<?php echo base_url().FRONT_THEME;?>img/logo.png"></td>
			</tr>
			<tr>
				<td style="text-align: center; background: #62a0b9;">
					<table width="100%" border="0" cellpadding="30" cellspacing="0">
						<tr>
							<td>
								<h2 style="color: #fff; margin: 0 0 5px; text-transform: capitalize; font-size: 35px; font-weight: normal;">Welcome to  <span style="color: #fff;">Bid Home</span></h2>
								<p style="color: #fff; font-size: 16px; line-height: 28px;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="text-align: center;">
					<table width="100%" border="0" cellpadding="30" cellspacing="0" bgcolor="#fff">
						<tr>
							<td>
								<!-- <div><img style="max-width: 100px; width: 100%; margin-bottom:10px;" src="<?php echo base_url().FRONT_THEME;?>img/key.png"></div> -->
								<h3 style="color: #333; font-size: 28px; font-weight: normal; margin: 0; text-transform: capitalize;"><?php echo ucfirst($name);?></h3>
								<p style="color: #333; font-size: 16px; line-height: 28px;"><?php echo ucfirst($content);?></p>
								<a style="background: #62a0b9; color: #fff; margin: 15px 0 5px; font-size: 30px; display: inline-block; font-weight: normal; padding: 10px 15px;" href="<?php echo base_url('../buyer/viewProperty/').$id;?>">View Property</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
			 	<td style="text-align: center;">
				 	<table width="100%" border="0" cellpadding="30" cellspacing="0" bgcolor="#fff">
					  	<tr>
					  		<td style="padding: 10px;background: #62a0b9;color: #fff;">Copyright@Bidhome</td>
					  	</tr>
				 	</table>
			 	</td>
			</tr>
		</table>
	</body>
</html>