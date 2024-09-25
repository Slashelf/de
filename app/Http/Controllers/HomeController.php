<?php

namespace App\Http\Controllers;

use App\Models\Facultad;
use App\Models\Carrera;
use App\Models\Tipo;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreDocumentRequest;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $facultades = Facultad::all();
        $tipos = Tipo::all();
        $carreras = Carrera::all();
        $documents = DB::select('CALL ListDocuments()'); 
    
        return view('archivos', compact('facultades', 'tipos', 'carreras', 'documents')); // Pasa también $documents
    }
    

    public function create()
    {
        $facultades = Facultad::all();
        $tipos = Tipo::all();
        $carreras = Carrera::all();

        return view('archivos', compact('facultades', 'tipos', 'carreras'));
    }

    public function store(StoreDocumentRequest $request)
    {
    $file = $request->file('document');
    $file_url = $file->getClientOriginalName();
    $params = [
        $request->title,
        $request->name,
        $request->facultad_id,
        $request->carrera_id,
        $request->program,
        (int) $request->year, 
        $request->tipo_id,
        (string) $file_url, 
    ];
   
   DB::statement('CALL InsertDocument(?, ?, ?, ?, ?, ?, ?, ?)', $params);
    return response()->json(['message' => 'Documento cargado con éxito.'], 200); 
    }

    
    

    
    
}

