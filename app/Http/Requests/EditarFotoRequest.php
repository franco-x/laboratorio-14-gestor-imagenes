<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarFotoRequest extends FormRequest
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
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la foto es obligatorio.',
            'descripcion.required' => 'La descripción de la foto es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser jpg, jpeg, png o webp.',
            'imagen.max' => 'La imagen no debe pesar más de 20 MB.',
        ];
    }
}