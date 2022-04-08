@extends('layouts.master')
@section('titulo','CRUD PRODUCTOS')
@section('contenido')
	
	<!-- INICIA VUE -->
	<div id="producto">

	

 <div class="row">
 	<div class="col-md-8">
 		
 	</div>
 </div>

		<div class="row">
			<div class="col-md-12">
				<div class="card card-warning"> 
					<div class="card-header">
						<h3>CRUD PRODUCTOS 
						<span class="btn btn-sm btn-primary" @click="mostrarModal()">
							<i class="fas fa-plus"></i>

						</span>
						</h3> 

						<div class="col-md-6">
						<input type="text" placeholder="Escriba el nombre o clave del producto" class="form-control" v-model="buscar">
						</div>
					</div>

					<div class="card-body">
						
							<!-- INICIO DE LA TABLA -->
				<table class="table table-bordered table-striped">
					<thead>
						<th hidden="">ID MASCOTA</th>
						<th>SKU</th>
						<th>PRODUCTO</th>
						<th>PRECIO</th>
						<th>CANTIDAD</th>

					</thead>

					<tbody>
						<tr v-for="producto in filtroProductos">
							<th>@{{producto.sku}}</th>
							<td>@{{producto.nombre}}</td>
							<td>@{{producto.precio}}</td>
							<td>@{{producto.cantidad}}</td>
							<td>
								<button class="btn btn-sm" @click="editandoProducto(producto.sku)">
									<i class="fas fa-pen"></i>
								</button>

								<button class="btn btn-sm" @click="eliminarProducto(producto.sku)">
									<i class="fas fa-trash"></i>
								</button>
							</td>
						</tr>
					</tbody>
				</table>
				<!-- FIN DE LA TABLA -->

					</div>
				
					
				</div>
			</div>  
			<!-- FIN DE COL-MD-12 -->
		</div>	

<!-- INICIA VENTANA MODAL -->
<div class="modal fade" id="modalMascota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true">AGREGANDO PRODUCTO</h5>
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==false">EDITANDO PRODUCTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" class="form-control" placeholder="Escriba el sku" v-model="sku"><br>
        <input type="text" class="form-control" placeholder="Nombre del producto" v-model="nombre"><br>
        <input type="number" class="form-control" placeholder="Escriba precio" v-model="precio"><br>
        <input type="number" class="form-control" placeholder="Escriba la cantidad" v-model="cantidad"><br>

        <!-- <h5>Especie elegida: @{{id_especie}}</h5> -->


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="guardarProducto()" v-if="agregando==true">Guardar</button>

        <button type="button" class="btn btn-primary" @click="actualizarProducto()" v-if="agregando==false">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- FIN MODAL -->


	</div>
	<!-- TERMINA VUE -->

	
@endsection

@push('scripts')
	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiProducto.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">