<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RoleMiddleware;
use App\Models\Photo;
use App\Models\Vacation;
use App\Http\Requests\PhotoCreateRequest;
use App\Http\Requests\PhotoDestroyRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware(RoleMiddleware::class . ':advanced,admin')
             ->only(['store', 'destroy', 'destroy-multiple']);
    }

    public function store(PhotoCreateRequest $request): RedirectResponse
    {
        try {
            foreach ($request->file('image') as $image) {

                if (!$image->isValid()) {
                    continue;
                }

                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

                $path = $image->storeAs(
                    'images',
                    $fileName,
                    'local'
                );

                Photo::create([
                    'vacation_id' => $request->vacation_id,
                    'route'       => $path,
                ]);
            }

            return redirect()->route('vacations.index')->with('general', 'Imágenes subidas correctamente.');
        } catch (\Throwable $e) {
            return back()->withErrors([
                'general' => 'Error al subir imágenes: ' . $e->getMessage()
            ]);
        }
    }

    public function show(Photo $photo)
    {
        if (
            $photo == null ||
            $photo->route == null ||
            !file_exists(storage_path('app/private') . '/' . $photo->route)
        ) {
            return response()->file(
                base_path('public/img/no-image.jpg')
            );
        }

        return response()->file(
            storage_path('app/private') . '/' . $photo->route
        );
    }

    public function destroy(Photo $photo): RedirectResponse
    {
        $result = false;
        $message = ['general' => 'La imagen ha sido eliminada correctamente.'];

        try {
            $this->destroyImage($photo->route);
            $result = $photo->delete();
        } catch (\Exception $e) {
            $message['general'] = 'Error al eliminar la imagen.';
        }

        if (!$result) {
            return back()->withErrors($message);
        }

        return back()->with($message);
    }

    public function destroyMultiple(PhotoDestroyRequest $request): RedirectResponse
    {
        try {
            foreach ($request->photos as $photoId) {

                $photo = Photo::find($photoId);

                if (!$photo) {
                    continue;
                }

                if (
                    $photo->route &&
                    file_exists(storage_path('app/' . $photo->route))
                ) {
                    unlink(storage_path('app/' . $photo->route));
                    Storage::disk('private')->delete($photo->route);
                }

                $photo->delete();
            }

            return redirect()->route('vacations.index')->with('general', 'Imágenes eliminadas correctamente.');
        } catch (\Throwable $e) {
            return back()->withErrors([
                'general' => 'Error al eliminar las imágenes.'
            ]);
        }
    }
}
