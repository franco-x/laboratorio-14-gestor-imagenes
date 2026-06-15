<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h2 style="font-size: 24px; font-weight: 700; color: #111827; margin: 0;">
                    Crear Álbum
                </h2>
                <p style="color: #6b7280; margin-top: 5px;">
                    Registra un nuevo álbum para guardar tus fotos.
                </p>
            </div>

            <a href="{{ route('album.index') }}"
               style="background-color: #6b7280; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                Volver
            </a>
        </div>
    </x-slot>

    <div style="background-color: #f3f4f6; min-height: 100vh; padding: 35px 20px;">
        <div style="max-width: 850px; margin: auto;">
            <div style="background: white; border-radius: 18px; padding: 35px; box-shadow: 0 6px 18px rgba(0,0,0,0.12); border: 1px solid #e5e7eb;">

                <div style="margin-bottom: 25px; border-left: 5px solid #2563eb; padding-left: 15px;">
                    <h3 style="font-size: 22px; font-weight: 700; color: #111827; margin: 0;">
                        Datos del Álbum
                    </h3>
                    <p style="color: #6b7280; margin-top: 6px;">
                        Completa el nombre y la descripción del álbum.
                    </p>
                </div>

                <form action="{{ route('album.crear.post') }}" method="POST">
                    @csrf

                    <div style="margin-bottom: 22px;">
                        <label style="display: block; font-weight: 700; color: #111827; margin-bottom: 8px;">
                            Nombre del Álbum
                        </label>

                        <input type="text"
                               name="nombre"
                               value="{{ old('nombre') }}"
                               placeholder="Ejemplo: Álbum Familiar"
                               style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 16px; outline: none;">

                        @error('nombre')
                            <p style="color: #dc2626; font-size: 14px; margin-top: 6px;">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 700; color: #111827; margin-bottom: 8px;">
                            Descripción
                        </label>

                        <textarea name="descripcion"
                                  rows="5"
                                  placeholder="Ejemplo: Fotos importantes de mi familia"
                                  style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 16px; outline: none;">{{ old('descripcion') }}</textarea>

                        @error('descripcion')
                            <p style="color: #dc2626; font-size: 14px; margin-top: 6px;">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div style="display: flex; gap: 12px;">
                        <button type="submit"
                                style="background: linear-gradient(135deg, #2563eb, #7c3aed); color: white; padding: 12px 24px; border-radius: 10px; border: none; font-weight: 700; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.18);">
                            Crear Álbum
                        </button>

                        <a href="{{ route('album.index') }}"
                           style="background-color: #64748b; color: white; padding: 12px 24px; border-radius: 10px; text-decoration: none; font-weight: 700;">
                            Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>