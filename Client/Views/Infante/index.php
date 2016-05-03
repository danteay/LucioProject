
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link href='https://fonts.googleapis.com/css?family=Patrick+Hand' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../../vendor/Materialize/dist/css/materialize.min.css">	
	<link rel="stylesheet" href="../../css/all.css">
	<script type="text/javascript" src="../../js/sesion.js"></script>
	<script type="text/javascript" src="../../js/ajax.js"></script>
	<script type="text/javascript" src="../../js/infante.js"></script>
</head>
<body>

	<div class="row red darken-3 top-bar">
		<div class="container">
			<nav class="transparent">
				<div class="nav-wrapper">
					<a href="#!" class="brand-logo">Logo</a>
					<ul class="right hide-on-med-and-down">
						<li class="cont-inline mid padd-h-10 disable">
							<i class="material-icons">face</i>
							<h5 id="username"></h5>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<main class="fondo-img">
		<div class="container section">
			<div class="row">
				<div class="col m4">
					<h4 class="red-text text-lighten-3">Cursos</h4>
					<div class="collection" id="lista-cursos">
						<a href="#!" class="collection-item">Curso 1 <span class="new badge blue">4</span></a>
						<a href="#!" class="collection-item active blue darken-4">Curso 2 <span class="new badge amber darken-2 brown-text text-darken-3">4</span></a>
						<a href="#!" class="collection-item">Curso 3 <span class="new badge blue">4</span></a>
						<a href="#!" class="collection-item">Curso 4 <span class="new badge blue">4</span></a>
					</div>
				</div>
				<div class="col m8">
					<div class="row">
						<div class="col s12">
							<ul class="tabs">
								<li class="tab col l3" onclick="Materialize.showStaggeredList('#test1 ul')">
									<a class="active" href="#test1">
										<i class="material-icons">insert_drive_file</i> 
										<p>Documentos</p>
									</a>
								</li>
								<li class="tab col l3" onclick="Materialize.showStaggeredList('#test2 ul')">
									<a href="#test2">
										<i class="material-icons">theaters</i>
										<p>Videos</p>
									</a>
								</li>
								<li class="tab col l3 " onclick="Materialize.showStaggeredList('#test3 ul')">
									<a href="#test3">
										<i class="material-icons">videogame_asset</i>
										<p>Juegos</p>
									</a>
								</li>
							</ul>
						</div>
						<div id="test1" class="col s12">
							<ul class="collection">
								<li>
									<a class="collection-item avatar waves-effect waves-purple">
									<i class="material-icons circle indigo darken-4">description</i>
									<span class="title">Title</span>
									<p>First Line <br>
										Second Line
									</p>					
								<a>
								</li>
								<li>
									<a class="collection-item avatar waves-effect waves-purple">
									<i class="material-icons circle indigo darken-4">description</i>
									<span class="title">Title</span>
									<p>First Line <br>
										Second Line
									</p>					
								<a>
								</li>
								<li>
									<a class="collection-item avatar waves-effect waves-purple">
									<i class="material-icons circle indigo darken-4">description</i>
									<span class="title">Title</span>
									<p>First Line <br>
										Second Line
									</p>					
								<a>
								</li>
								<li>
									<a class="collection-item avatar waves-effect waves-purple">
									<i class="material-icons circle indigo darken-4">description</i>
									<span class="title">Title</span>
									<p>First Line <br>
										Second Line
									</p>					
								<a>
								</li>
							</ul>
						</div>
						<div id="test2" class="col s12">
							<ul class="collection">
								<li>
									<a class="collection-item avatar waves-effect waves-purple">
								<i class="material-icons circle indigo darken-4">movie</i>
									<span class="title">Title</span>
									<p>First Line <br>
										Second Line
									</p>
								</a>
								</li>
								<li>
									<a class="collection-item avatar waves-effect waves-purple">
								<i class="material-icons circle indigo darken-4">movie</i>
									<span class="title">Title</span>
									<p>First Line <br>
										Second Line
									</p>
								</a>
								</li>
								<li>
									<a class="collection-item avatar waves-effect waves-purple">
								<i class="material-icons circle indigo darken-4">movie</i>
									<span class="title">Title</span>
									<p>First Line <br>
										Second Line
									</p>
								</a>
								</li>
								<li>
									<a class="collection-item avatar waves-effect waves-purple">
								<i class="material-icons circle indigo darken-4">movie</i>
									<span class="title">Title</span>
									<p>First Line <br>
										Second Line
									</p>
								</a>
								</li>
							</ul>
						</div>
						<div id="test3" class="col s12">
							<ul class="collection">
								<li>
									<a class="collection-item avatar waves-effect waves-purple">
									<i class="material-icons circle indigo darken-4">games</i>
									<span class="title">Title</span>
									<p>First Line <br>
										Second Line
									</p>
								</a>
								</li>
								<li>
									<a class="collection-item avatar waves-effect waves-purple">
									<i class="material-icons circle indigo darken-4">games</i>
									<span class="title">Title</span>
									<p>First Line <br>
										Second Line
									</p>
								</a>
								</li>
								<li>
									<a class="collection-item avatar waves-effect waves-purple">
									<i class="material-icons circle indigo darken-4">games</i>
									<span class="title">Title</span>
									<p>First Line <br>
										Second Line
									</p>
								</a>
								</li>
								<li>
									<a class="collection-item avatar waves-effect waves-purple">
									<i class="material-icons circle indigo darken-4">games</i>
									<span class="title">Title</span>
									<p>First Line <br>
										Second Line
									</p>
								</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<footer class="page-footer blue darken-3">
	  <div class="container">
	    <div class="row">
	      <div class="col l6 s12">
	        <h5 class="white-text">Footer Content</h5>
	        <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
	      </div>
	      <div class="col l4 offset-l2 s12">
	        <h5 class="white-text">Links</h5>
	        <ul>
	          <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
	          <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
	          <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
	          <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
	        </ul>
	      </div>
	    </div>
	  </div>
	  <div class="footer-copyright blue darken-4">
	    <div class="container">
	    © 2014 Copyright Text
	    <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
	    </div>
	  </div>
	</footer>
	<script type="text/javascript" src="../../vendor/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="../../vendor/Materialize/dist/js/materialize.min.js"></script>
</body>
</html>
