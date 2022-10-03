<?php

namespace App\Http\Controllers;

use App\Sugerencia;
use Illuminate\Http\Request;
//use Illuminate\Contracts\Validation\ValidationException;
//use Illuminate\Validation\Validation;
use Illuminate\Support\Facades\Validator;

use App\NotaSugerencia;
use App\Contacto;
use App\Estado;
use App\Ciudad;
use App\Tienda;
use App\Status;
use Session;
use DB;
use PDF;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class SugerenciasController extends Controller
{
    public function index( Request $request)
    {
        	
		$sugerencias;

		$this->getSugerenciasFromReqPag($sugerencias,$request,25);
		
		$estados = Estado::all();
		
    	return view('sugerencias.index', compact( ['sugerencias', 'estados'] ))->with('title','Sugerencias');
    }

    public function show(Sugerencia $sugerencia)
    {
		$estados = Estado::all();
        $statuses = Status::all();

    	return view('sugerencias.show', compact( ['sugerencia', 'estados','statuses'] ))->with('title','Detalle de la sugerencia');
    }
	
	public function save_data($sugerencia, Request $request)
	{		
		$sugerencia = Sugerencia::findOrFail($sugerencia);
		
		$input = $request->all();	
		
		$v = Validator::make( $input ,[
			'nombre' => 'bail|required',
			'celular' => 'bail|required',
			'email' => 'bail|required',
			'solicitud' => 'bail|required',
			'comentarios' => 'bail|required',
			'estado_id' => 'bail|required',
			'ciudad_id' => 'bail|required',
			'tienda_id' => 'bail|required',
			'status_id' => 'bail|required'
		]);

		$estados = Estado::all();
        $statuses = Status::all();
		
		$sugerencia->fill($input);
		
		//$contacto->notas()->fill($input);
		//print_r( $contacto );
		//die();
		
		if (!$v->fails())
		{
			$sugerencia->save();
			//return view( 'contactos.show', compact( ['contacto', 'estados', 'statuses'] ) )
			//	->with('title','Detalle de contacto')
			//	->withErrors($v->errors());
		}

		//Session::flash('message', 'Registro Guardado'); 
		//Session::flash('alert-class', 'alert-danger'); 
		
		$anotaciones = $request->input('anotacion.*', 'Sopas!!!!');
		
		if (is_array($anotaciones))
		foreach($anotaciones as $nots ){
			$nc = new NotaSugerencia( ['sugerencia_id' => $sugerencia->id , 'anotacion' => $nots  ] );
			$nc->save();
		}
		
		//$contacto->notas()->saveMany([]);
		
		if ( isset($_POST['submitNoReturn']) && ($_POST['submitNoReturn'] == 'submitNoReturn') )
			return view( 'sugerencias.show', compact( ['sugerencia', 'estados', 'statuses'] ) )->with('title','Detalle de la sugerencia');
		
		return redirect()->action('SugerenciasController@index');
		
		

	}
	
	function getGET(Request $request,$var){
		$salida = (isset($_GET[$var])? str_replace('','%', trim($_GET[$var]) ) : '%'  )   ;
		$salida = strlen ($salida)<1 ? '%' :  $salida ;
		//echo "<pre>$var : '$salida'</pre>";
		return $salida;
	}
	
	
	private function getSugerenciasFromReqPag( &$sugerencias , Request $request , $paginate ){
		
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
				
			$sugerencias = Sugerencia::where('nombre', 'like',  '%'. $this->getGET($request,'cbNombre') .'%'  )
			->where('estado_id', 'like', $this->getGET($request,'cbEstados') )
			->where('ciudad_id', 'like', $this->getGET($request,'cbCiudades') )
			->where('tienda_id', 'like', $this->getGET($request,'cbTiendas') )
			->where([['created_at', '>=',   $fechaI ],
			         ['created_at', '<=',   $fechaF ]])
			->orderBy('created_at','desc')
			->paginate($paginate);
		}elseif(isset($_GET['cbFechaInicio']) && $_GET['cbFechaInicio'] ){
			
			$fechaI = explode ('/',$this->getGET($request,'cbFechaInicio'))[2] . '-' .
				explode ('/',$this->getGET($request,'cbFechaInicio'))[1] . '-' .
				explode ('/',$this->getGET($request,'cbFechaInicio'))[0] ;
				
			$sugerencias = Sugerencia::where('nombre', 'like',  '%'. $this->getGET($request,'cbNombre') .'%'  )
			->where('estado_id', 'like', $this->getGET($request,'cbEstados') )
			->where('ciudad_id', 'like', $this->getGET($request,'cbCiudades') )
			->where('tienda_id', 'like', $this->getGET($request,'cbTiendas') )
			->where('created_at', '>=',  $fechaI )
			->orderBy('created_at','desc')
			->paginate($paginate);
		}elseif(isset($_GET['cbFechaFinal'] ) && $_GET['cbFechaFinal'] ) {
			
			$fechaF = explode ('/',$this->getGET($request,'cbFechaFinal'))[2] . '-' .
				explode ('/',$this->getGET($request,'cbFechaFinal'))[1] . '-' .
				explode ('/',$this->getGET($request,'cbFechaFinal'))[0];
				
			$sugerencias = Sugerencia::where('nombre', 'like',  '%'. $this->getGET($request,'cbNombre') .'%'  )
			->where('estado_id', 'like', $this->getGET($request,'cbEstados') )
			->where('ciudad_id', 'like', $this->getGET($request,'cbCiudades') )
			->where('tienda_id', 'like', $this->getGET($request,'cbTiendas') )
			->where('created_at', '<=', $fechaF )
			->orderBy('created_at','desc')
			->paginate($paginate);
		}else{
			$sugerencias = Sugerencia::where('nombre', 'like',  '%'. $this->getGET($request,'cbNombre') .'%'  )
			->where('estado_id', 'like', $this->getGET($request,'cbEstados') )
			->where('ciudad_id', 'like', $this->getGET($request,'cbCiudades') )
			->where('tienda_id', 'like', $this->getGET($request,'cbTiendas') )
			->orderBy('created_at','desc')
			->paginate($paginate);
		}
	
	}
	
	
	public function exportSugerencias(Request $request){
		
		$sugerencias;

		$this->getSugerenciasFromReqPag($sugerencias,$request,1000000);
		
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Fecha de captura');
		$sheet->setCellValue('B1', 'Estado');
		$sheet->setCellValue('C1', 'Ciudad');
		$sheet->setCellValue('D1', 'Tienda');
		$sheet->setCellValue('E1', 'Nombre');
		$sheet->setCellValue('F1', 'Celular');
		$sheet->setCellValue('G1', 'Email');
		$sheet->setCellValue('H1', 'Solicitud');
		$sheet->setCellValue('I1', 'Comentarios');
		$sheet->setCellValue('J1', 'Fecha de modificación');
		$sheet->setCellValue('K1', 'Status');
		
		$contador = 2;
		foreach( $sugerencias as $c ){
			$sheet->setCellValue( 'A'.($contador), $c->created_at->format('d/m/Y') );
			$sheet->setCellValue( 'B'.($contador), (isset($c->estado->nombre )?$c->estado->nombre:'')  );
			$sheet->setCellValue( 'C'.($contador), (isset($c->ciudad->nombre )?$c->ciudad->nombre:'')  );
			$sheet->setCellValue( 'D'.($contador), (isset($c->tienda->nombre )?$c->tienda->nombre:'')  );
			$sheet->setCellValue( 'E'.($contador), $c->nombre );
			$sheet->setCellValue( 'F'.($contador), $c->celular );
			$sheet->setCellValue( 'G'.($contador), $c->email );
			$sheet->setCellValue( 'H'.($contador), $c->solicitud );
			$sheet->setCellValue( 'I'.($contador), $c->comentarios );
			$sheet->setCellValue( 'J'.($contador), $c->updated_at->format('d/m/Y') );
			$sheet->setCellValue( 'K'.($contador++), (isset($c->status->nombre )?$c->status->nombre:''));
		}

		$writer = new Xlsx($spreadsheet);
		$writer->save('sugerencias.xlsx');
		return response()->download('sugerencias.xlsx');
	}
	
	public function downloadPDF(Request $request){
	  $sugerencias;
	  
	  $this->getSugerenciasFromReqPag($sugerencias,$request,1000000);
	  
	  $estado = Estado::find( request()->query('cbEstados')  );
	  if (!$estado ) $estado = new Estado(array('El nombre x'));
	  $ciudad = Ciudad::find( request()->query('cbCiudades')  );
	  if (!$ciudad ) $ciudad = new Ciudad(array('El nombre x'));
	  $tienda = Tienda::find( request()->query('cbTiendas')  );
	  if (!$tienda ) $tienda = new Tienda(array('El nombre x'));

      $pdf = PDF::loadView('sugerencias.pdf', compact( ['sugerencias','estado','ciudad','tienda'] ) )->setPaper('a4', 'landscape');
      return $pdf->download('sugerencias.pdf');

    }
	
	public function sugerianciaForm(Request $request){
		
		if( isset( $_POST['submitEnviar'] ) ){
			$gr = new Sugerencia();
			$gr->fill( $request->all() );
			$gr->status_id = 1;//NUEVO
			$gr->save();

			return view (' sugerencias.gracias ');
		}
		
		$estados = Estado::all();
		
		return view( 'sugerencias.formulario', compact( ['estados'] ) )->with('title','Detalle de contacto');
		
	}
	
	
}
