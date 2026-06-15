<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearFotoRequest;
use App\Http\Requests\EditarFotoRequest;
use App\Models\Album;
use App\Models\Foto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FotoController extends Controller
{
    public function index(Request $request)
    {
        $album_id = $request->get('album_id');

        $album = Album::where('id', $album_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $fotos = $album->fotos()->latest()->get();

        return view('album.fotos', compact('album', 'fotos'));
    }

    public function getCrear(Request $request)
    {
        $album_id = $request->get('album_id');

        Album::where('id', $album_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('foto.crear', compact('album_id'));
    }

    public function postCrear(CrearFotoRequest $request)
    {
        $album = Album::where('id', $request->album_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $imagen = $request->file('imagen');

        $nombreImagen = sha1(Carbon::now()->format('YmdHisv') . $imagen->getClientOriginalName());
        $nombreImagen = $nombreImagen . '.' . $imagen->guessExtension();

        $ruta = 'imagenes';
        $imagen->move(public_path($ruta), $nombreImagen);

        Foto::create([
            'album_id' => $album->id,
            'foto_nombre' => $request->nombre,
            'foto_descripcion' => $request->descripcion,
            'foto_ruta' => $ruta . '/' . $nombreImagen,
        ]);

        return redirect()
            ->route('foto.index', ['album_id' => $album->id])
            ->with('correcto', 'La foto ha sido creada correctamente.');
    }

    public function edit(Foto $foto)
    {
        if ($foto->album->user_id !== Auth::id()) {
            abort(403);
        }

        return view('foto.editar', compact('foto'));
    }

    public function update(EditarFotoRequest $request, Foto $foto)
    {
        if ($foto->album->user_id !== Auth::id()) {
            abort(403);
        }

        $rutaFinal = $foto->foto_ruta;

        if ($request->hasFile('imagen')) {
            $rutaAnterior = public_path($foto->foto_ruta);

            if (file_exists($rutaAnterior)) {
                unlink($rutaAnterior);
            }

            $imagen = $request->file('imagen');

            $nombreImagen = sha1(Carbon::now()->format('YmdHisv') . $imagen->getClientOriginalName());
            $nombreImagen = $nombreImagen . '.' . $imagen->guessExtension();

            $ruta = 'imagenes';
            $imagen->move(public_path($ruta), $nombreImagen);

            $rutaFinal = $ruta . '/' . $nombreImagen;
        }

        $foto->update([
            'foto_nombre' => $request->nombre,
            'foto_descripcion' => $request->descripcion,
            'foto_ruta' => $rutaFinal,
        ]);

        return redirect()
            ->route('foto.index', ['album_id' => $foto->album_id])
            ->with('correcto', 'La foto ha sido actualizada correctamente.');
    }

    public function destroy(Foto $foto)
    {
        $album = $foto->album;

        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $rutaImagen = public_path($foto->foto_ruta);

        if (file_exists($rutaImagen)) {
            unlink($rutaImagen);
        }

        $foto->delete();

        return redirect()
            ->route('foto.index', ['album_id' => $album->id])
            ->with('correcto', 'La foto ha sido eliminada correctamente.');
    }
}