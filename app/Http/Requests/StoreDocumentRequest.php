<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'facultad_id' => 'required|exists:facultades,id',
            'carrera_id' => 'required|exists:carreras,id',
            'program' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'tipo_id' => 'required|exists:tipos,id',
            //'document' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ];
    }
}
