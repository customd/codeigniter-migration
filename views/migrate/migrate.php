<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title; ?></title>
<style type="text/css">

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
}

span{
	color: #B0B0B0;
}

p {
	margin: 12px 15px 12px 15px;
}

input {
	font-size: 13px;
}
</style>
</head>
<body>
	<div id="container">
		<h1><?php echo $title; ?></h1>
		<p><?php echo $message; ?></p>
		
		<form method="POST" action="#" id="goto">
			<p>
				<label for="version">Migrate to version</label>:
				<input type="number" id="version" onchange="document.getElementById('goto').setAttribute('action','<?php echo site_url('/migrate/to/'); ?>/'+this.value+'/');"/>
				<input type="submit" value="Go"/>
			</p>
		</form>
		
		<p>
		<?php if( $current > 0 ){ ?>
			<a href="<?php echo site_url('/migrate/to/'.($current-1)); ?>" title="set to: <?php echo ($current-1); ?>" class="prev">Previous</a>&nbsp;|&nbsp;
		<?php } else { ?>
			<span class="prev" title="There are no migrations before this version">Previous</span>&nbsp;|&nbsp;
		<?php } ?>
		<?php if( $ideal != $current ){ ?>
			<a href="<?php echo site_url('/migrate/to/'.$ideal); ?>" title="set to: <?php echo $ideal; ?>" class="ideal">Config</a>&nbsp;|&nbsp;
		<?php } else { ?>
			<span class="ideal" title="The database is alread at this version">Config</span>&nbsp;|&nbsp;
		<?php } ?>
		<?php if( $ideal > $current ){ ?>
			<a href="<?php echo site_url('/migrate/to/'.($current+1)); ?>" title="set to: <?php echo ($current+1); ?>" class="next">Next</a>
		<?php } else { ?>
			<span class="next" title="There are no migrations beyond this version">Next</span>
		<?php } ?>
		</p>
	</div>
</body>
</html>