<?php
	require_once('../login/auth.php');
?>
<html>
	<head>
		<title>Disply</title>
		<meta charset='utf-8'>
   		<meta name='viewport' content='width=device-width, initial-scale=1'>
  		<link rel='stylesheet' href='../bootstrap-3.3.5-dist/css/bootstrap.min.css'>
		<script src='../bootstrap-3.3.5-dist/jquery.min.js'></script>
  		<script src='../bootstrap-3.3.5-dist/js/bootstrap.min.js'></script>
	</head>
	
	<nav class="navbar navbar-inverse navbar-fixed-top">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand" href="" target="">Our Note</a>
    		</div>
    		<div>
      			<ul class="nav navbar-nav">
        			<li><a href="../home.php">Home</a></li>
					<li class="active" class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							Create <span class="caret"></span>	
						</a>
						<ul class="dropdown-menu">
            				<li><a href="create_note.php">Note</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="create_chk.php">Check Box</a></li>
          				</ul>
					</li>
        			<li><a href="../display/disp.php">Display</a></li>
      			</ul>
				<ul class="nav navbar-nav navbar-right">
        			<li><a href='../index.php'><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
      			</ul>
    		</div>
  		</div>
	</nav>
<?php
	echo('<br><br><br>');
	$group=$_POST['group'];
	$imp=$_POST['imp'];
	$dtr=$_POST['dtr'];
	$ttr=$_POST['ttr'];
	$title=$_POST['title'];
	$clr_code=$_POST['clr_code'];
	$note=$_POST['note'];
	$comp=0;

	$user_id=$_SESSION['SESS_MEMBER_ID'];
	echo $user_id;
	$created=date("Y-m-d");
	$modified=$created;
	
	$connect=mysqli_connect("localhost","root","");
	if (mysqli_connect_errno()) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$c="USE dbms_pro;";
	$c1=mysqli_query($connect,$c);

	$q1="INSERT INTO Note(user_id,notes,title,n_group,clr_code,imp,comp) VALUES
	(
		'$user_id',
		'$note',
		'$title',
		'$group',
		'$clr_code',
		'$imp',
		'$comp'
	);";

	if(!mysqli_query($connect,$q1))
	{
		echo("Error description 1: " . mysqli_error($connect));
		echo('<br><br>');
	}

	$q1="SELECT * FROM Note;";
	$w=mysqli_query($connect,$q1);
	if(!$w)
	{
		echo("Error description 3: " . mysqli_error($connect));
		echo('<br><br>');
	}
	if(mysqli_num_rows($w) > 0) 
    {
		while ($row = mysqli_fetch_array($w))
    	{
    		$note_id = $row['note_id'];
    	}
	}
	$q1="INSERT INTO Date_N VALUES
	(
		'$user_id',
		'$note_id',
		'$dtr',
		'$ttr',
		'$created',
		'$modified'
	);";	

	if(!mysqli_query($connect,$q1))
	{
		echo("Error description 2: " . mysqli_error($connect));
		echo('<br><br>');
	}
	echo("<br><br><br>");
	mysqli_close($connect);
?>
<html>
	<meta http-equiv="refresh" content="0; URL=../display/disp.php">
	<meta name="keywords" content="automatic redirection">
</html>