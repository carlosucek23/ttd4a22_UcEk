@extends('layouts.master')
@section('titulo','Interface de ventas')
@section('contenido')
	
<div id="apiVenta">
	
	
		<div class="row">
			<div class="col-md-4">

				<div class="input-group mb-4">
	  					<input type="text" class="form-control" placeholder="Escriba el codigo del producto" aria-label="Recipient's username" aria-describedby="basic-addon2" v-model="sku"
	  					v-on:keyup.enter="buscarProducto()">
	  				<div class="input-group-append">
	   					 <button class="btn btn-primary" type="button" @click="buscarProducto()">Añadir</button>

	  				</div>
	  				<div class="input-group-append">
	  					<button class="btn btn-success" type="button" @click="mostrarCobro()">Cobrar</button>
	  				</div>
	  				<div class="col">
	  					<button class="btn btn-success" type="button" @click="mostrarBusqueda()">Buscar</button>
	  				</div>

				</div>

			
				<!-- <h1>@{{prueba}}</h1> -->

			</div>
	</div>
	



	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">

					<p :align=alineacion>Folio: @{{folio}}</p>

					<table class="table table-bordered">
						<thead>
							<th style="background: #ffff66">SKU</th>
							<th style="background: #ffff66">PRODUCTO</th>
							<th style="background: #ffff66">OPER.</th>
							<th style="background: #ffff66">PRECIO</th>
							<th style="background: #ffff66">CANTIDAD</th>
							<th style="background: #ffff66">TOTAL</th>
						</thead>

						<tbody>
							<tr v-for="(v,index) in ventas">
								<td>@{{v.sku}}</td>
								<td>@{{v.nombre}}
									<img v-bind:src=v.foto width="70" height="60"></td>
								<td>
									<button class="btn btn-default btn-sm" @click="eliminarProducto(index)">
										<i class="fas fa-trash"></i>
									</button>
								</td>
								<td>@{{v.precio}}</td>
								<td><input type="number" v-model.number="cantidades[index]"></td>
								<td>@{{totalProducto(index)}}</td>
							</tr>
						</tbody>
					</table>

				</div>

			</div>
			<!--  FIN DEL ROW  -->
	</div> 
	<!-- FIN DEL CARD BODY -->
</div>
<!-- FIN DEL CARD -->

@{{cantidades}}
<hr>
@{{ventas}}




<div class="row">
	<div class="col-md-8"></div>
	

	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				
					<table class="table table-bordered table-condensed">
					 	<tr>
					 		<th style="background: #ffff66">Subtotal</th>
					 		<td>$ @{{subTotal}}</td>
					 	</tr>

					 	<tr>
					 		<th style="background: #ffff66">IVA</th>
					 		<td> $ @{{iva}}</td>
					 	</tr>

					 	<tr>
					 		<th style="background: #ffff66">TOTAL</th>
					 		<td><b>$ @{{granTotal}}</b></td>
					 	</tr>
						
						<tr>
							<th style="background: #ffff66">Articulos :</th>
							<td>@{{noArticulos}}</td>
						</tr>
					</table>
				
			</div>
			<!-- FIN DEL CARD BODY -->
		</div> 
		<!-- FIN DEL CARD -->
	</div>
			<!-- FIN DEL COL-MD-4 -->
</div>

<!-- Modal para el formulario del registro de los moovimientos -->
<div class="modal fade" id="modalCobro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Aqui Titulo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-row">
            <div class="col">
              <label for="inputfolio">Total</label>
              <input type="number" class="form-control" disabled="" :value="granTotal">
            </div>
            <div class="col">
              <label for="inputfolio">Paga con</label>
              <input type="number" class="form-control" v-model='pagara_con'>
            </div>
            <div class="col">
              <label for="inputEmail4">Cambio</label>
              <input type="number" class="form-control" disabled="" :value="cambio">
            </div>
          </div>
          
             
        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="vender()">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->
<!-- Modal para la busqueda de productos -->
<div class="modal fade" id="modalBusqueda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Aqui Titulo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-row">

          	<div class="col-md-6">
						<input type="text" placeholder="Escriba el nombre o clave del producto" class="form-control" v-model="buscar">
						</div><br>

            <table class="table table-bordered table-striped">
					<thead>
						
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
          </div>
          
             
        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="buscarProducto()">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->



<!--{{-- FIN DE VENTANA MODAL --}}-->


</div>

	
@endsection

@push('scripts')
	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiVenta.js"></script>
	<script type="text/javascript" src="js/moment-with-locales.min.js"></script>
@endpush


<input type="hidden" name="route" value="{{url('/')}}">