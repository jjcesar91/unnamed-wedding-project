<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(auth()->check() && in_array(auth()->user()->role, ['owner','admin'])) return true;
        abort(403, 'Accesso negato. Non hai i permessi per creare un Evento.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:20|',
            'img' => 'nullable|file|mimes:jpeg,png,jpg|max:10240',
            'description' => 'nullable|string|max:255',
            'date' => 'date|after_or_equal:today',
            'location'=> 'required|string|max:40',
            'type' => 'required|in:matrimonio,promessa,battesimo,cresima,argento,oro,platino,compleanno,rinnovo,baby',
            'active'=>'boolean'
        ];
    }

    public function messages(): array{
        return [
            'title.required' => 'Il titolo è obbligatorio.',
            'title.string' => 'Il titolo deve essere una stringa.',
            'title.max' => 'Il titolo non può essere più lungo di 20 caratteri.',
            
            'img.file' => 'Il campo deve contenere un file valido.',
            'img.mimes' => 'Il file deve essere un\'immagine nei formati: jpeg, png, jpg.',
            'img.size' => 'Il file non può superare i 10 MB.',
            
            'description.string' => 'La descrizione deve essere una stringa.',
            'description.max' => 'La descrizione non può essere più lunga di 255 caratteri.',
            
            'date.date' => 'La data deve essere una data valida.',
            'date.after_or_equal' => 'La data deve essere uguale o successiva a oggi.',
            
            'location.required' => 'La località è obbligatoria.',
            'location.string' => 'La località deve essere una stringa.',
            'location.max' => 'La località non può essere più lunga di 40 caratteri.',
            
            'type.required' => 'Il tipo è obbligatorio.',
            'type.in' => 'Il tipo deve essere uno dei seguenti: matrimonio, promessa, battesimo, cresima, argento, oro, platino, compleanno, rinnovo, baby.',
            
            'active.boolean' => 'Lo stato attivo deve essere vero o falso.',
        ];
    }
}
