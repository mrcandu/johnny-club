<!DOCTYPE html">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $this->page_title; ?></title>       
		<script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="<?php echo $this->page_path; ?>incfiles/js_admin.js"></script>
       	<link href="<?php echo $this->page_path; ?>style/main.css" rel="stylesheet" type="text/css">

	</head>
	<body>		
    	<div class="mar_20 grey">
        	<div class="pad_20">       
				<h1>Admin User - Reset Password</h1>
				<?php if (isset($this->error)): ?>
					<p class="red"><?php echo $this->error; ?></p>
				<?php endif; ?>	
				<div class="col">
					<div class="pad_10">
						<form method="post">
    						<div><?php echo $this->user_pass; ?></div>
                            <div><?php echo $this->user_pass_check; ?></div>
							<div><?php echo $this->frm_submit_btn1; ?></div>
						</form>
					</div>
				</div>
				<div class="clear"></div>
        	</div>
		</div>
	</body>
</html>