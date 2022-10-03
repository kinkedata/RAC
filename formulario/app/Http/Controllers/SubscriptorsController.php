<?php

namespace App\Http\Controllers;

use App\Subscriptor;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SubscriptorsController extends Controller
{
    public function index(Request $request)
    {
        $subscriptores = null;
		
		$this->getSubscriptoresFromReqPag($subscriptores,$request,25);
		
    	return view('suscriptores.index', compact('subscriptores'))->with('title','Subscriptores');		
    }

    public function show()
    {
    	
    }
	
	
	public function exportExcel(Request $request){
		
		$subscriptores = null;

		$this->getSubscriptoresFromReqPag($subscriptores,$request,1000000000);
		
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Fecha de captura');
		$sheet->setCellValue('B1', 'Sexo');
		$sheet->setCellValue('C1', 'Correo');
		$sheet->setCellValue('D1', 'Status');
		
		//die($subscriptores);
		
		$contador = 2;
		for( $s = 0; $s < count($subscriptores) ; $s++ ){
			
			$sheet->setCellValue( 'A'.($contador),   $subscriptores[$s]->created_at->format('d/m/Y') );
			$sheet->setCellValue( 'B'.($contador),   $subscriptores[$s]->genero );
			$sheet->setCellValue( 'C'.($contador),   $subscriptores[$s]->email  );
			$sheet->setCellValue( 'D'.($contador++), $subscriptores[$s]->estatus  );
		}

		$writer = new Xlsx($spreadsheet);
		$writer->save('subscriptores.xlsx');
		return response()->download('subscriptores.xlsx');
	}
	
	
	private function getSubscriptoresFromReqPag( &$subscriptores , Request $request , $paginate ){
		
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
				
			$subscriptores = Subscriptor::where('genero', 'like', $this->getGET($request,'cbSexo') )
			->where('email', 'like', '%' . $this->getGET($request,'cbCorreo') . '%' )
			->where('estatus', 'like', $this->getGET($request,'cbStatus') )
			->where([['created_at', '>=', $fechaI ],
			         ['created_at', '<=', $fechaF ]])
			->orderBy('created_at','desc')
			->paginate($paginate);
		}elseif(isset($_GET['cbFechaInicio']) && $_GET['cbFechaInicio'] ){
			
			$fechaI = explode ('/',$this->getGET($request,'cbFechaInicio'))[2] . '-' .
				explode ('/',$this->getGET($request,'cbFechaInicio'))[1] . '-' .
				explode ('/',$this->getGET($request,'cbFechaInicio'))[0] ;
				
			$subscriptores = Subscriptor::where('genero', 'like', $this->getGET($request,'cbSexo') )
			->where('email', 'like', '%' . $this->getGET($request,'cbCorreo') . '%' )
			->where('estatus', 'like', $this->getGET($request,'cbStatus') )
			->where('created_at', '>=',  $fechaI )
			->orderBy('created_at','desc')
			->paginate($paginate);
		}elseif(isset($_GET['cbFechaFinal'] ) && $_GET['cbFechaFinal'] ) {
			
			$fechaF = explode ('/',$this->getGET($request,'cbFechaFinal'))[2] . '-' .
				explode ('/',$this->getGET($request,'cbFechaFinal'))[1] . '-' .
				explode ('/',$this->getGET($request,'cbFechaFinal'))[0];
				
			$subscriptores = Subscriptor::where('genero', 'like', $this->getGET($request,'cbSexo') )
			->where('email', 'like', '%' . $this->getGET($request,'cbCorreo') . '%' )
			->where('estatus', 'like', $this->getGET($request,'cbStatus') )
			->where('created_at', '<=',  $fechaF )
			->orderBy('created_at','desc')
			->paginate($paginate);
		}else{
			$subscriptores = Subscriptor::where('genero', 'like', $this->getGET($request,'cbSexo') )
			->where('email', 'like', '%' . $this->getGET($request,'cbCorreo') . '%' )
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
	
	public function subscriptorsForm(Request $request){
		
		if( isset( $_POST['submitEnviar'] ) ){
			$gr = new Subscriptor();
			$gr->fill( $request->all() );
			$gr->estatus = "Nuevo";
			$gr->save();
		
			return view('suscriptores.gracias');
		}
		return view( 'suscriptores.formulario' )->with('title','Detalle de contacto');
		
	}
}
