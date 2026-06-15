<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <div>
                <h2 style="font-size:26px; font-weight:800; color:#111827; margin:0;">
                    Editar Foto
                </h2>
                <p style="color:#6b7280; margin-top:6px;">
                    Modifica los datos de la foto seleccionada.
                </p>
            </div>

            <a href="{{ route('foto.index', ['album_id' => $foto->album_id]) }}"
               style="background:#475569; color:white; padding:11px 18px; border-radius:10px; text-decoration:none; font-weight:700;">
                Volver al Álbum
            </a>
        </div>
    </x-slot>

    <div style="background:#eef2f7; min-height:100vh; padding:40px 20px;">
        <div style="max-width:850px; margin:0 auto;">
            <div style="background:white; border-radius:20px; padding:35px; box-shadow:0 8px 25px rgba(0,0,0,0.15); border:1px solid #e5e7eb;">

                <div style="background:linear-gradient(135deg,#f59e0b,#ea580c); padding:22px; border-radius:16px; margin-bottom:30px; color:white;">
                    <h3 style="font-size:24px; font-weight:800; margin:0;">
                        Formulario de Edición de Foto
                    </h3>
                    <p style="margin-top:8px;">
                        Puedes cambiar el nombre, descripción o reemplazar la imagen.
                    </p>
                </div>

                <form action="{{ route('foto.update', $foto) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="album_id" value="{{ $foto->album_id }}">

                    <div style="margin-bottom:22px;">
                        <label style="display:block; font-weight:800; margin-bottom:8px; color:#111827;">
                            Nombre de la foto
                        </label>

                        <input type="text"
                               name="nombre"
                               value="{{ old('nombre', $foto->foto_nombre) }}"
                               style="width:100%; padding:14px; border:2px solid #cbd5e1; border-radius:12px; font-size:16px;">

                        @error('nombre')
                            <p style="color:#dc2626; font-weight:600;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-bottom:22px;">
                        <label style="display:block; font-weight:800; margin-bottom:8px; color:#111827;">
                            Descripción
                        </label>

                        <textarea name="descripcion"
                                  rows="5"
                                  style="width:100%; padding:14px; border:2px solid #cbd5e1; border-radius:12px; font-size:16px;">{{ old('descripcion', $foto->foto_descripcion) }}</textarea>

                        @error('descripcion')
                            <p style="color:#dc2626; font-weight:600;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-bottom:25px;">
                        <label style="display:block; font-weight:800; margin-bottom:8px; color:#111827;">
                            Imagen actual
                        </label>

                        <img src="{{ asset($foto->foto_ruta) }}"
                             alt="{{ $foto->foto_nombre }}"
                             style="width:100%; max-height:300px; object-fit:cover; border-radius:16px; border:1px solid #e5e7eb;">
                    </div>

                    <div style="margin-bottom:30px;">
                        <label style="display:block; font-weight:800; margin-bottom:8px; color:#111827;">
                            Cambiar imagen
                        </label>

                        <div style="background:#fff7ed; border:3px dashed #f59e0b; border-radius:16px; padding:28px; text-align:center;">
                            <p style="font-size:18px; font-weight:800; color:#92400e; margin-bottom:15px;">
                                Selecciona una nueva imagen solo si deseas reemplazar la actual
                            </p>

                            <input type="file"
                                   name="imagen"
                                   accept="image/*"
                                   style="background:white; padding:14px; border-radius:12px; border:1px solid #94a3b8; width:100%;">
                        </div>

                        @error('imagen')
                            <p style="color:#dc2626; font-weight:600;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="display:flex; gap:14px; flex-wrap:wrap;">
                        <button type="submit"
                                style="background:linear-gradient(135deg,#f59e0b,#ea580c); color:white; padding:14px 26px; border:none; border-radius:12px; font-weight:800; font-size:16px; cursor:pointer;">
                            Actualizar Foto
                        </button>

                        <a href="{{ route('foto.index', ['album_id' => $foto->album_id]) }}"
                           style="background:#64748b; color:white; padding:14px 26px; border-radius:12px; text-decoration:none; font-weight:800; font-size:16px;">
                            Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>