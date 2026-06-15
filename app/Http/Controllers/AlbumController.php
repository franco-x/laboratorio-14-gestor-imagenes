<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearAlbumRequest;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function mostrar()
    {
        $albums = Album::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('album.mostrar', compact('albums'));
    }

    public function getCrear()
    {
        return view('album.crear');
    }

    public function postCrear(CrearAlbumRequest $request)
    {
        Album::create([
            'user_id' => Auth::id(),
            'album_nombre' => $request->nombre,
            'album_descripcion' => $request->descripcion,
        ]);

        return redirect()
            ->route('album.index')
            ->with('correcto', 'El álbum ha sido creado correctamente.');
    }

    public function edit(Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        return view('album.editar', compact('album'));
    }

    public function update(CrearAlbumRequest $request, Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $album->update([
            'album_nombre' => $request->nombre,
            'album_descripcion' => $request->descripcion,
        ]);

        return redirect()
            ->route('album.index')
            ->with('correcto', 'El álbum ha sido actualizado correctamente.');
    }

    public function destroy(Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $album->delete();

        return redirect()
            ->route('album.index')
            ->with('correcto', 'El álbum ha sido eliminado correctamente.');
    }
}