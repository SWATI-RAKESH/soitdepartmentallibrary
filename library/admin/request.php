<?php
  include "connection.php";
  include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Books</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		.srch
		{
			padding-left: 1216px;
		}

				body {
		font-family: "Lato", sans-serif;
		transition: background-color .5s;
		}

		.sidenav {
		height: 100%;
		margin-top: 50px;
		width: 0;
		position: fixed;
		z-index: 1;
		top: 0;
		left: 0;
		background-color: #222;
		overflow-x: hidden;
		transition: 0.5s;
		padding-top: 60px;
		}

		.sidenav a {
		padding: 8px 8px 8px 32px;
		text-decoration: none;
		font-size: 25px;
		color: #818181;
		display: block;
		transition: 0.3s;
		}

		.sidenav a:hover {
		color: #f1f1f1;
		}

		.sidenav .closebtn {
		position: absolute;
		top: 0;
		right: 25px;
		font-size: 36px;
		margin-left: 50px;
		}

		#main {
		transition: margin-left .5s;
		padding: 16px;
		}

		@media screen and (max-height: 450px) {
		.sidenav {padding-top: 15px;}
		.sidenav a {font-size: 18px;}
		}
		.img-circle
		{
			margin-left: 20px;
		}
		.container{
			height: 700px;
			background-color: black;
			opacity: .7;
			color: white;
		}
		.header-container {
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding: 10px;
    align-items: center;
    margin-top: -50px;
}
.srch {
    padding-left: 988px;
}

	</style>
</head>
<body>

			<!--_________________sidenav_______________-->
	
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

					<div style="color: white; margin-left: 60px; font-size: 20px;">

						<?php
							if(isset($_SESSION['login_user'])){
								echo "<img class='img-circle profile_img' height=120 width=120 src='images/".$_SESSION['pic']."'>";
								echo "</br></br>";
								echo "Welcome ".$_SESSION['login_user']; 
						
							}
						?>
					</div>
					<a href="AddBook.php">Add Book</a>
		<a href="request.php">Request Book</a>
		<a href="issue_info.php">Issue Book</a>
        <a href="expired_info.php">Overdue Book</a>
	</div>

	<div id="main">
		
		<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>


		<script>
		function openNav() {
		document.getElementById("mySidenav").style.width = "300px";
		document.getElementById("main").style.marginLeft = "300px";
		document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
		}

		function closeNav() {
		document.getElementById("mySidenav").style.width = "0";
		document.getElementById("main").style.marginLeft= "0";
		document.body.style.backgroundColor = "white";
		}
		</script>

		<br><br>

		



			<div class="header-container">
        <h2 style="margin-top:0px;margin-bottom:0px;"> Book Request </h2>
        <div class="srch" id="srch">
           <form method="post" action="" name="form1">
				<input type="text" name="username" class="form-control" placeholder="Username" required=""><br>
				<input type="text" name="bid" class="form-control" placeholder="BID" required=""><br>
				<button class="btn btn-default" name="submit" type="submit" style="background-color: #6db6b9e6;">Submit</button><br>
			</form>
        </div>    
    </div>
			<?php

				if(isset($_SESSION['login_user']))
				{
					$sql="SELECT student.username,first,last,books.bid,name,authors,edition,status FROM student inner join  issue_book  ON student.username=issue_book.username  inner join books ON issue_book.bid=books.bid where issue_book.approve=''";
					$res=mysqli_query($db,$sql);
					if(mysqli_num_rows($res)==0)
					{
						echo "No pending request";
					}else{
						echo "<table class='table table-bordered table-hover' >";
						echo "<tr style='background-color: #6db6b9e6;'>";
							//Table header
							echo "<th>"; echo "Student Username";	echo "</th>";
							echo "<th>"; echo "First Name";	echo "</th>";
							echo "<th>"; echo "Last Name";	echo "</th>";
							echo "<th>"; echo "Book ID";	echo "</th>";
							echo "<th>"; echo "Book Name";	echo "</th>";
							echo "<th>"; echo "Authors Name";	echo "</th>";
							echo "<th>"; echo "Edition";	echo "</th>";
							echo "<th>"; echo "Status";  echo "</th>";
							// echo "<th>"; echo "Issue Date";  echo "</th>";
							// echo "<th>"; echo "Return Date";  echo "</th>";
						echo "</tr>";	

						while($row=mysqli_fetch_assoc($res))
						{
							echo "<tr>";
							echo "<td>"; echo $row['username']; echo "</td>";
							echo "<td>"; echo $row['first']; echo "</td>";
							echo "<td>"; echo $row['last']; echo "</td>";
							echo "<td>"; echo $row['bid']; echo "</td>"; 
							echo "<td>"; echo $row['name']; echo "</td>"; 
							echo "<td>"; echo $row['authors']; echo "</td>"; 
							echo "<td>"; echo $row['edition']; echo "</td>"; 
							echo "<td>"; echo $row['status']; echo "</td>"; 
							echo "</tr>";
						}
						echo "</table>";
					}
				}else
				{
					?>
					<br>
						<h4 style="text-align: center;color: yellow;">You need to login to see the request.</h4>
						
					<?php
				}
			
				if(isset($_POST['submit']))
				{
					$_SESSION['name']=$_POST['username'];
					$_SESSION['bid']=$_POST['bid'];
			
					?>
						<script type="text/javascript">
							window.location="approve.php"
						</script>
					<?php
				}
			
				?>		
	   <!-- </div> -->
       
	</div>
</body>
</html>