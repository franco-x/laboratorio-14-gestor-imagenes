<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Mis Álbumes
            </h2>

            <a href="{{ route('album.crear') }}"
               style="background: linear-gradient(135deg, #2563eb, #7c3aed); color: white; padding: 10px 18px; border-radius: 10px; font-weight: 600; text-decoration: none; box-shadow: 0 4px 12px rgba(0,0,0,0.18);">
                Crear Álbum
            </a>
        </div>
    </x-slot>

    <div class="py-8" style="background-color: #f3f4f6; min-height: 100vh;">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if(session('correcto'))
                <div style="background-color: #dcfce7; color: #166534; padding: 15px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    <strong>Realizado:</strong> {{ session('correcto') }}
                </div>
            @endif

            @if($albums->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($albums as $album)
                        <div style="background: white; border-radius: 14px; padding: 24px; box-shadow: 0 4px 14px rgba(0,0,0,0.10); border: 1px solid #e5e7eb;">
                            <h3 style="font-size: 20px; font-weight: 700; color: #111827; margin-bottom: 8px;">
                                {{ $album->album_nombre }}
                            </h3>

                            <p style="color: #4b5563; margin-bottom: 18px;">
                                {{ $album->album_descripcion }}
                            </p>

                            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                <a href="{{ route('foto.index', ['album_id' => $album->id]) }}"
                                   style="background-color: #0891b2; color: white; padding: 8px 14px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                    Ver Fotos
                                </a>

                                <a href="{{ route('album.edit', $album) }}"
                                   style="background-color: #f59e0b; color: white; padding: 8px 14px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                    Editar
                                </a>

                                <form action="{{ route('album.destroy', $album) }}" method="POST"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar este álbum?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            style="background-color: #dc2626; color: white; padding: 8px 14px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer;">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="background: white; border-radius: 16px; padding: 35px; text-align: center; box-shadow: 0 4px 14px rgba(0,0,0,0.10); border: 1px solid #e5e7eb;">
                    <h3 style="font-size: 22px; font-weight: 700; color: #111827; margin-bottom: 10px;">
                        Todavía no tienes álbumes creados
                    </h3>

                    <p style="color: #6b7280; margin-bottom: 25px;">
                        Crea tu primer álbum para empezar a guardar tus fotos.
                    </p>

                    <a href="{{ route('album.crear') }}"
                       style="background: linear-gradient(135deg, #2563eb, #7c3aed); color: white; padding: 12px 22px; border-radius: 10px; font-weight: 600; text-decoration: none; box-shadow: 0 4px 12px rgba(0,0,0,0.18); display: inline-block;">
                        Crear mi primer álbum
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>