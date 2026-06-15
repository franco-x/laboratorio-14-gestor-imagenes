<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h2 style="font-size: 24px; font-weight: 700; color: #111827; margin: 0;">
                    Fotos del álbum: {{ $album->album_nombre }}
                </h2>
                <p style="color: #6b7280; margin-top: 5px;">
                    Aquí puedes agregar, editar y visualizar las fotos guardadas en este álbum.
                </p>
            </div>

            <a href="{{ route('album.index') }}"
               style="background-color: #64748b; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                Volver a Álbumes
            </a>
        </div>
    </x-slot>

    <div style="background-color: #f3f4f6; min-height: 100vh; padding: 35px 20px;">
        <div style="max-width: 1100px; margin: auto;">

            @if(session('correcto'))
                <div style="background-color: #dcfce7; color: #166534; padding: 15px 18px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 3px 10px rgba(0,0,0,0.08);">
                    <strong>Realizado:</strong> {{ session('correcto') }}
                </div>
            @endif

            <div style="background: white; border-radius: 18px; padding: 25px; box-shadow: 0 6px 18px rgba(0,0,0,0.10); border: 1px solid #e5e7eb; margin-bottom: 25px;">
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 15px; flex-wrap: wrap;">
                    <div>
                        <h3 style="font-size: 22px; font-weight: 700; color: #111827; margin: 0;">
                            Galería de Fotos
                        </h3>
                        <p style="color: #6b7280; margin-top: 6px;">
                            Agrega imágenes reales al álbum seleccionado.
                        </p>
                    </div>

                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <a href="{{ route('foto.crear', ['album_id' => $album->id]) }}"
                           style="background: linear-gradient(135deg, #16a34a, #059669); color: white; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 700; box-shadow: 0 4px 12px rgba(0,0,0,0.18);">
                            Crear Foto
                        </a>

                        <a href="{{ route('album.index') }}"
                           style="background-color: #64748b; color: white; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 700;">
                            Volver
                        </a>
                    </div>
                </div>
            </div>

            @if($fotos->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
                    @foreach($fotos as $foto)
                        <div style="background: white; border-radius: 18px; overflow: hidden; box-shadow: 0 6px 18px rgba(0,0,0,0.12); border: 1px solid #e5e7eb;">
                            <img src="{{ asset($foto->foto_ruta) }}"
                                 alt="{{ $foto->foto_nombre }}"
                                 style="width: 100%; height: 230px; object-fit: cover; display: block;">

                            <div style="padding: 22px;">
                                <h3 style="font-size: 20px; font-weight: 700; color: #111827; margin-bottom: 8px;">
                                    {{ $foto->foto_nombre }}
                                </h3>

                                <p style="color: #4b5563; margin-bottom: 18px;">
                                    {{ $foto->foto_descripcion }}
                                </p>

                                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    <a href="{{ route('foto.edit', $foto) }}"
                                       style="background-color: #f59e0b; color: white; padding: 10px 16px; border-radius: 9px; text-decoration: none; font-weight: 700;">
                                        Editar
                                    </a>

                                    <form action="{{ route('foto.destroy', $foto) }}" method="POST"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar esta foto?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                style="background-color: #dc2626; color: white; padding: 10px 16px; border-radius: 9px; border: none; font-weight: 700; cursor: pointer;">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="background: white; border-radius: 18px; padding: 40px; text-align: center; box-shadow: 0 6px 18px rgba(0,0,0,0.10); border: 1px solid #e5e7eb;">
                    <div style="width: 70px; height: 70px; border-radius: 50%; background: #dbeafe; color: #2563eb; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; font-size: 32px; font-weight: 700;">
                        +
                    </div>

                    <h3 style="font-size: 22px; font-weight: 700; color: #111827; margin-bottom: 10px;">
                        Este álbum todavía no tiene fotos
                    </h3>

                    <p style="color: #6b7280; margin-bottom: 25px;">
                        Sube tu primera imagen para completar la galería del laboratorio.
                    </p>

                    <a href="{{ route('foto.crear', ['album_id' => $album->id]) }}"
                       style="background: linear-gradient(135deg, #16a34a, #059669); color: white; padding: 13px 24px; border-radius: 10px; text-decoration: none; font-weight: 700; box-shadow: 0 4px 12px rgba(0,0,0,0.18); display: inline-block;">
                        Subir primera foto
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>