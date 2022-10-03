<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Contracts\Validation\ValidationException;
//use Illuminate\Validation\Validation;
use Illuminate\Support\Facades\Validator;

use App\NotaContacto;
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


class ContactosController extends Controller
{
	protected $fillable = [
        'telefono',
        // add all other fields
    ];
	
	
	private function getContactosFromReqPag( &$contactos , Request $request , $paginate ){
		
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
				
			$contactos = Contacto::where('nombre', 'like',  '%'. $this->getGET($request,'cbNombre') .'%'  )
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
				
			$contactos = Contacto::where('nombre', 'like',  '%'. $this->getGET($request,'cbNombre') .'%'  )
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
				
			$contactos = Contacto::where('nombre', 'like',  '%'. $this->getGET($request,'cbNombre') .'%'  )
			->where('estado_id', 'like', $this->getGET($request,'cbEstados') )
			->where('ciudad_id', 'like', $this->getGET($request,'cbCiudades') )
			->where('tienda_id', 'like', $this->getGET($request,'cbTiendas') )
			->where('created_at', '<=', $fechaF )
			->orderBy('created_at','desc')
			->paginate($paginate);
		}else{
			$contactos = Contacto::where('nombre', 'like',  '%'. $this->getGET($request,'cbNombre') .'%'  )
			->where('estado_id', 'like', $this->getGET($request,'cbEstados') )
			->where('ciudad_id', 'like', $this->getGET($request,'cbCiudades') )
			->where('tienda_id', 'like', $this->getGET($request,'cbTiendas') )
			->orderBy('created_at','desc')
			->paginate($paginate);
		}
	
	}
		
	
    public function index( Request $request)
    {
		$contactos;

		$this->getContactosFromReqPag($contactos,$request,25);
		
		$estados = Estado::all();
		
    	return view( 'contactos.index', compact( ['contactos', 'estados'] ) )->with('title','Contactos');
		
    }
	
	function getGET(Request $request,$var){
		$salida = (isset($_GET[$var])? str_replace('','%', trim($_GET[$var]) ) : '%'  )   ;
		$salida = strlen ($salida)<1 ? '%' :  $salida ;
		//echo "<pre>$var : '$salida'</pre>";
		return $salida;
	}

    public function show(Contacto $contacto)
    {
		$estados = Estado::all();
        $statuses = Status::all();

    	return view( 'contactos.show', compact( ['contacto', 'estados', 'statuses'] ) )->with('title','Detalle de contacto');
    }
	
	public function exportContactos(Request $request){
		
		$contactos;

		$this->getContactosFromReqPag($contactos,$request,1000000);
		
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Fecha de captura');
		$sheet->setCellValue('B1', 'Id');
		$sheet->setCellValue('C1', 'Estado');
		$sheet->setCellValue('D1', 'Ciudad');
		$sheet->setCellValue('E1', 'Id Tienda');
		$sheet->setCellValue('F1', 'Tienda');
		$sheet->setCellValue('G1', 'Nombre');
		$sheet->setCellValue('H1', 'Segundo Nombre');
		$sheet->setCellValue('I1', 'Apellido Paterno');
		$sheet->setCellValue('J1', 'Apellido Materno');
		$sheet->setCellValue('K1', 'Teléfono');
		$sheet->setCellValue('L1', 'Celular');
		$sheet->setCellValue('M1', 'Producto');
		$sheet->setCellValue('N1', 'Email');
		$sheet->setCellValue('O1', 'Fecha de modificación');
		$sheet->setCellValue('P1', 'Status');
		
		$contador = 2;
		foreach( $contactos as $c ){
			$sheet->setCellValue( 'A'.($contador), $c->created_at->format('d/m/Y') );
			$sheet->setCellValue( 'B'.($contador), $c->id );
			$sheet->setCellValue( 'C'.($contador), (isset($c->estado->nombre )?$c->estado->nombre:'')  );
			$sheet->setCellValue( 'D'.($contador), (isset($c->ciudad->nombre )?$c->ciudad->nombre:'')  );
			$sheet->setCellValue( 'E'.($contador), (isset($c->tienda_id )?$c->tienda_id:'')  );
			$sheet->setCellValue( 'F'.($contador), (isset($c->tienda->nombre )?$c->tienda->nombre:'')  );
			$sheet->setCellValue( 'G'.($contador), $c->nombre );
			$sheet->setCellValue( 'H'.($contador), $c->segundo_nombre );
			$sheet->setCellValue( 'I'.($contador), $c->a_paterno );
			$sheet->setCellValue( 'J'.($contador), $c->a_materno );
			$sheet->setCellValue( 'K'.($contador), $c->telefono );
			$sheet->setCellValue( 'L'.($contador), $c->celular );
			$sheet->setCellValue( 'M'.($contador), $c->producto );
			$sheet->setCellValue( 'N'.($contador), $c->email );
			$sheet->setCellValue( 'O'.($contador), $c->updated_at->format('d/m/Y') );
			$sheet->setCellValue( 'P'.($contador++), (isset($c->status->nombre )?$c->status->nombre:''));
		}

		$writer = new Xlsx($spreadsheet);
		$writer->save('contactos.xlsx');
		return response()->download('contactos.xlsx');
	}
	
	public function save_data($contacto, Request $request)
	{		
		$contacto = Contacto::findOrFail($contacto);
		
		$input = $request->all();	
		
		$v = Validator::make( $input ,[
			'nombre' => 'bail|required',
			'telefono' => 'bail|required',
			'celular' => 'bail|required',
			'email' => 'bail|required',
			'estado_id' => 'bail|required',
			'ciudad_id' => 'bail|required',
			'tienda_id' => 'bail|required'
		]);

		$estados = Estado::all();
        $statuses = Status::all();
		
		$contacto->fill($input);
		
		//$contacto->notas()->fill($input);
		//print_r( $contacto );
		//die();
		
		if (!$v->fails())
		{
			$contacto->save();
			//return view( 'contactos.show', compact( ['contacto', 'estados', 'statuses'] ) )
			//	->with('title','Detalle de contacto')
			//	->withErrors($v->errors());
		}

		//Session::flash('message', 'Registro Guardado'); 
		//Session::flash('alert-class', 'alert-danger'); 
		
		$anotaciones = $request->input('anotacion.*', 'Sopas!!!!');
		
		if (is_array($anotaciones))
		foreach($anotaciones as $nots ){
			$nc = new NotaContacto( ['contacto_id' => $contacto->id , 'anotacion' => $nots  ] );
			$nc->save();
		}
		
		//$contacto->notas()->saveMany([]);
		
		if ( isset($_POST['submitNoReturn']) && ($_POST['submitNoReturn'] == 'submitNoReturn') )
			return view( 'contactos.show', compact( ['contacto', 'estados', 'statuses'] ) )->with('title','Detalle de contacto');
		
		
		return redirect()->action('ContactosController@index');
		
	}
	
	public function downloadPDF(Request $request){
	  $contactos;
	  
	  $this->getContactosFromReqPag($contactos,$request,1000000);
	  
	  $estado = Estado::find( request()->query('cbEstados')  );
	  if (!$estado ) $estado = new Estado(array('El nombre x'));
	  $ciudad = Ciudad::find( request()->query('cbCiudades')  );
	  if (!$ciudad ) $ciudad = new Ciudad(array('El nombre x'));
	  $tienda = Tienda::find( request()->query('cbTiendas')  );
	  if (!$tienda ) $tienda = new Tienda(array('El nombre x'));

      $pdf = PDF::loadView('contactos.pdf', compact( ['contactos','estado','ciudad','tienda'] ) )->setPaper('a4', 'landscape');
      return $pdf->download('contactos.pdf');

    }
	
	
	
	public function contactoForm(Request $request){
		
		if( isset( $_POST['submitEnviar'] ) ){
			$gr = new Contacto();
			$gr->fill( $request->all() );
			$gr->status_id = 1;//NUEVO
			$gr->save();

			return view (' contactos.gracias ');
		}
		
		$estados = Estado::all();
		
		return view( 'contactos.formulario', compact( ['estados'] ) )->with('title','Detalle de contacto');
	}
	
}
