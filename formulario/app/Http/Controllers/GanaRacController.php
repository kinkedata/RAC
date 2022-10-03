<?php

namespace App\Http\Controllers;

use App\GanaRac;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GanaRacController extends Controller
{
    public function index(Request $request)
    {
        $ganarac = null;
		
		$this->getGanaracFromReqPag($ganarac,$request,25);
		
    	return view('ganarac.index', compact('ganarac'))->with('title','GanaRac');
		
    }

    public function show()
    {
    	
    }
	
	
	private function getGanaracFromReqPag( &$ganarac , Request $request , $paginate ){
		//cbFechaInicio  cbFechaFinal  cbContrato cbNombre cbTelefono cbCorreo cbCodigo cbStatus
		if ( isset($_GET['cbFechaInicio']) &&
		    $_GET['cbFechaInicio'] && 
			isset($_GET['cbFechaFinal'])  && 
			$_GET['cbFechaFinal'] 
			){
				
			$fechaI = explode ('/',$this->getGET($request,'cbFechaInicio'))[2] . '-' .
				explode ('/',$this->getGET($request,'cbFechaInicio'))[1] . '-' .
				explode ('/',$this->getGET($request,'cbFechaInicio'))[0] ;
			$fechaF = explode ('/',$this->getGET($request,'cbFechaFinal'))[2] . '-' .
				explode ('/',$this->getGET($request,'cbFechaFinal'))[1] . '-' .
				explode ('/',$this->getGET($request,'cbFechaFinal'))[0];
				
			$ganarac = GanaRac::where('contrato', 'like', $this->getGET($request,'cbContrato') )
			->where('nombre', 'like', '%' . $this->getGET($request,'cbNombre') . '%' )
			->where('celular', 'like', '%' . $this->getGET($request,'cbTelefono') . '%' )
			->where('email', 'like', '%' . $this->getGET($request,'cbCorreo') . '%' )
			->where('codigo_gana_rac', 'like', '%' . $this->getGET($request,'cbCodigo') . '%' )
			->where('estatus', 'like', $this->getGET($request,'cbStatus') )
			->where([['created_at', '>=', $fechaI ],
			         ['created_at', '<=', $fechaF ]])
			->orderBy('created_at','desc')
			->paginate($paginate);
			
		}elseif(isset($_GET['cbFechaInicio']) && $_GET['cbFechaInicio'] ){
			
			$fechaI = explode ('/',$this->getGET($request,'cbFechaInicio'))[2] . '-' .
				explode ('/',$this->getGET($request,'cbFechaInicio'))[1] . '-' .
				explode ('/',$this->getGET($request,'cbFechaInicio'))[0] ;
				
			$ganarac = GanaRac::where('contrato', 'like', $this->getGET($request,'cbContrato') )
			->where('nombre', 'like', '%' . $this->getGET($request,'cbNombre') . '%' )
			->where('celular', 'like', '%' . $this->getGET($request,'cbTelefono') . '%' )
			->where('email', 'like', '%' . $this->getGET($request,'cbCorreo') . '%' )
			->where('codigo_gana_rac', 'like', '%' . $this->getGET($request,'cbCodigo') . '%' )
			->where('estatus', 'like', $this->getGET($request,'cbStatus') )
			->where('created_at', '>=',  $fechaI )
			->orderBy('created_at','desc')
			->paginate($paginate);
		}elseif(isset($_GET['cbFechaFinal'] ) && $_GET['cbFechaFinal'] ) {
			
			$fechaF = explode ('/',$this->getGET($request,'cbFechaFinal'))[2] . '-' .
				explode ('/',$this->getGET($request,'cbFechaFinal'))[1] . '-' .
				explode ('/',$this->getGET($request,'cbFechaFinal'))[0];
				
			$ganarac = GanaRac::where('contrato', 'like', $this->getGET($request,'cbContrato') )
			->where('nombre', 'like', '%' . $this->getGET($request,'cbNombre') . '%' )
			->where('celular', 'like', '%' . $this->getGET($request,'cbTelefono') . '%' )
			->where('email', 'like', '%' . $this->getGET($request,'cbCorreo') . '%' )
			->where('codigo_gana_rac', 'like', '%' . $this->getGET($request,'cbCodigo') . '%' )
			->where('estatus', 'like', $this->getGET($request,'cbStatus') )
			->where('created_at', '<=',  $fechaF )
			->orderBy('created_at','desc')
			->paginate($paginate);
		}else{
			$ganarac = GanaRac::where('contrato', 'like', $this->getGET($request,'cbContrato') )
			->where('nombre', 'like', '%' . $this->getGET($request,'cbNombre') . '%' )
			->where('celular', 'like', '%' . $this->getGET($request,'cbTelefono') . '%' )
			->where('email', 'like', '%' . $this->getGET($request,'cbCorreo') . '%' )
			->where('codigo_gana_rac', 'like', '%' . $this->getGET($request,'cbCodigo') . '%' )
			->where('estatus', 'like', $this->getGET($request,'cbStatus') )
			->orderBy('created_at','desc')
			->paginate($paginate);
		}
	
	}
	
	function getGET(Request $request,$var){
		$salida = (isset($_GET[$var])? str_replace('','%', trim($_GET[$var]) ) : '%'  )   ;
		$salida = strlen ($salida)<1 ? '%' :  $salida ;
		//echo "<pre>$var : '$salida'</pre>";
		return $salida;
	}
	
	public function exportExcel(Request $request){
		
		$ganarac = null;
		
		$this->getGanaracFromReqPag($ganarac,$request,1000000000);
		
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Fecha de captura');
		$sheet->setCellValue('B1', 'Contrato RAC');
		$sheet->setCellValue('C1', 'Nombre');
		$sheet->setCellValue('D1', 'Celular');
		$sheet->setCellValue('E1', 'Correo electrónico');
		$sheet->setCellValue('F1', 'Código');
		$sheet->setCellValue('G1', 'Estatus');
		
		//die($subscriptores);
		
		$contador = 2;
		for( $s = 0; $s < count($ganarac) ; $s++ ){
			
			$sheet->setCellValue( 'A'.($contador),   $ganarac[$s]->created_at->format('d/m/Y') );
			$sheet->setCellValue( 'B'.($contador),   $ganarac[$s]->contrato );
			$sheet->setCellValue( 'C'.($contador),   $ganarac[$s]->nombre );
			$sheet->setCellValue( 'D'.($contador),   $ganarac[$s]->celular );
			$sheet->setCellValue( 'E'.($contador),   $ganarac[$s]->email );
			$sheet->setCellValue( 'F'.($contador),   $ganarac[$s]->codigo_gana_rac );
			$sheet->setCellValue( 'G'.($contador++), $ganarac[$s]->estatus  );
		}

		$writer = new Xlsx($spreadsheet);
		$writer->save('ganarac.xlsx');
		return response()->download('ganarac.xlsx');
	}
	
	public function ganaracForm(Request $request){
		
		if( isset( $_POST['submitEnviar'] ) ){
			$gr = new GanaRac();
			$gr->fill( $request->all() );
			$gr->estatus = "Nuevo";
			$gr->save();

			return view (' ganarac.gracias ');
		}
		return view( 'ganarac.formulario' )->with('title','Detalle de contacto');
		
	}
	
}
