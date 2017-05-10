<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Flot Examples: Real-time updates</title>
		<link href="examples.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!-- <button onclick="addItem()">Adicionar Informação</button> -->
		<!-- <input type="text" id="5" class="item" /><br /> -->
		<input type="button" value="Parar Adição de Informações" id="post">

		<!-- display the posted items value -->
		<!-- <b>Posted Items:</b> -->
		<div id="postedItems"></div>

		<div id="header">
			<h2>Real-time updates</h2>
		</div>
		<div id="content">
			<div class="demo-container">
				<div id="placeholder" class="demo-placeholder"></div>
			</div>
			<p>You can update a chart periodically to get a real-time effect by using a timer to insert the new data in the plot and redraw it.</p>
			<p>Time between updates: <input id="updateInterval" type="text" value="" style="text-align: right; width:5em"> milliseconds</p>
		</div>
		<div id="footer">
			Copyright &copy; 2007 - 2014 IOLA and Ole Laursen
		</div>


		<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->
		<script type="text/javascript" src="jquery.min.js"></script>
		<script type="text/javascript" src="jquery.flot.js"></script>
		<script type="text/javascript" src="jquery.flot.time.js"></script> <!-- Para exibição de label com formato de tempo -->
		<script type="text/javascript" src="date.js"></script>
		<script type="text/javascript" src="jquery.flot.resize.js"></script> <!-- Para responsividade -->
		<script type="text/javascript" src="jquery.flot.canvas.js"></script>
    <script type="text/javascript" src="strftime.js"></script>
		<script type="text/javascript" src="app4.js"></script>

	</body>
</html>
