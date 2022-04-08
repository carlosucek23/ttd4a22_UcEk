<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Conociendo el Framework Vue.js</title>
	<script src="{{asset('js/vue.js')}}" type="text/javascript"></script>
</head>
<body>
	<h1>Tecnologías de la información</h1>

	<!-- INICIO DE VUE -->
	<div id="prueba">
		@{{demo}}<br><br><br>

		<input type="text" placeholder="Escriba el nombre" v-model="nombre"><br>

		<input type="text" placeholder="Escriba el genero de la mascota" v-model="genero"><br>

		<input type="text" placeholder="Escriba la edad" v-model="edad"><br><br>

		<button v-on:click="incrementar()">Incrementar</button><br><br>
		<button @click="decrementar()">Decrementar</button>

		<hr>

		<table>
			<thead>
				<th>NOMBRE</th>
				<th>GENERO</th>
				<th>EDAD</th>
			</thead>
			
			<tbody>
				<tr v-for="m in mascotas">
					<td>@{{m.nombre}}</td>
					<td>@{{m.genero}}</td>
					<td>@{{m.edad}}</td>
				</tr>	
			</tbody>
		</table>

		<hr>
		<h3>Nombre: @{{nombre}}</h3>
		<h3>Genero: @{{genero}}</h3>
		<h3>Edad: @{{edad}}</h3>

	</div>
	<!-- FIN DE VUE -->
	
	<script type="text/javascript" src="{{asset('js/plantilla.js')}}"></script>
</body>
</html>