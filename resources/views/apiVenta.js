var ruta = document.querySelector("[name=route]").value;

var apiMascota=ruta + '/apiMascota';

new Vue({


	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#apiVenta",

	data:{
		prueba:'HOLA MUNDO'
		
	},

	// // AL CREARSE LA PAGINA
	// created:function(){
	// 	this.obtenerMascotas();
	// 	this.obtenerEspecies();
	// },

	methods:{
		
		
	},
	// FIN DE METHODS



	// INICIO COMPUTED
	computed:{
		
	}
	// FIN DE COMPUTED



});