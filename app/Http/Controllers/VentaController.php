<?php
// se crea con php artisan make:controller VentaController --api

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\DetalleVenta;
use Codedge\Fpdf\Fpdf\Fpdf;
use DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        //return 'hhh';
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        //envia todo en la base de datos
        //seccion del manejo de la venta
        // return $r;
        $venta=new Venta;
        $venta->folio=$r->get('folio');
        $venta->fecha_venta=$r->get('fecha_venta');
        $venta->num_articulos=$r->get('num_articulos');
        $venta->subtotal=$r->get('subtotal');
        $venta->iva=$r->get('iva');
        $venta->total=$r->get('total');

        $venta->save();
        //fin del amnejo de la venta
        //detalles llega del js

        //obtenemos el request el json de los detalles
        $detalles=$r->get('detalles');

        //insertamos los detalles ala tabla detalle_venta

        DetalleVenta::insert($detalles);

        //actualizar de la cantidad de productos(restar productos al vender)
        for ($i=0; $i < count($detalles); $i++) { 
            $cantidadVendida=$detalles[$i]['cantidad'];
            $productoVendido=$detalles[$i]['sku'];

            DB::update("UPDATE productos
                        SET cantidad=cantidad-$cantidadVendida
                        WHERE sku=$productoVendido");
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function ticket($folio)
    {
        $venta= Venta::find($folio);
        $altura=100;
        //definimos el tamaño del ticket
        $pdf = new Fpdf('P','mm',array(78,$altura));
        $pdf->AddPage();
        //tamaño de laletra


        $pdf->setFont('Arial','B',7);
        //DISEÑO DE TICKET
        $pdf->Cell(60,2,'ABARROTES LA LUPITA',0,1,'C');
        $pdf->ln();
        $pdf->Cell(10,2,'FOLIO: ',0,0,'L');
        //celdaque va a traer eldato dl folio
        $pdf->Cell(25,2,$venta->folio,0,0,'L');
        $pdf->Cell(11,2,'FECHA: ',0,0,'L');
        $pdf->Cell(14,2,$venta->fecha_venta,0,1,'L');
        $pdf->Cell(60,1,'','B','C');
        $pdf->ln(2);
        $pdf->setFont('Arial','B',6);
        $pdf->Cell(10,2.5,'SKU',1,0,'C');
        $pdf->Cell(22,2.5,'PRODUCTO',1,0,'C');
        $pdf->Cell(8,2.5,'CANT',1,0,'C');
        $pdf->Cell(10,2.5,'P,U',1,0,'C');
        $pdf->Cell(10,2.5,'TOTAL',1,1,'C');
        $pdf->ln();

        $detalles=$venta->detalles;
        foreach ($detalles as $detalle) {
            $pdf->Cell(10,2,$detalle->sku,0,0,'C');
            $pdf->Cell(22,2,$detalle->productos->nombre,0,0,'C');
            $pdf->Cell(8,2,$detalle->cantidad,0,0,'C');
            $pdf->Cell(10,2,$detalle->precio,0,0,'C');
            $pdf->Cell(10,2,$detalle->total,0,1,'C');
            
        }
        $pdf->OutPut();
        exit;
    }
}
