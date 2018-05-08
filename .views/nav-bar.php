	<nav class="navbar navbar-default navbar-static-top" role="navigation">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="/">INB201 Children's Hospital</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
		  <!-- hiding for now
			<li><a href="#">Patients</a></li>
			<li><a href="#">Resources</a></li>
		  -->
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
		  <form class="navbar-form navbar-left" role="search" action="/search.php" method="get">
			<div class="form-group">
			  <input type="text" class="form-control" placeholder="Search" name="q">
			</div>
			<button type="submit" class="btn btn-default">Submit</button>
		  </form>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $staff->firstname?> <?php echo $staff->lastname?><b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li><a href="/profile.php">Profile</a></li>
				<!--<li><a href="/control-panel.php">Control Panel</a></li>-->
				<li class="divider"></li>
				<li><a href="/logout.php">Logout</a></li>
			  </ul>
			</li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>	
