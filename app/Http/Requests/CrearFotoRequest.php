<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearFotoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'album_id' => 'required|exists:albums,id',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpg,jpeg,png,webp|max:20480',
        ];
    }

    public function messages(): array
    {
        return [
            'album_id.required' => 'El álbum es obligatorio.',
            'album_id.exists' => 'El álbum seleccionado no existe.',
            'nombre.required' => 'El nombre de la foto es obligatorio.',
            'descripcion.required' => 'La descripción de la foto es obligatoria.',
            'imagen.required' => 'Debe seleccionar una imagen.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser jpg, jpeg, png o webp.',
            'imagen.max' => 'La imagen no debe pesar más de 20 MB.',
        ];
    }
}