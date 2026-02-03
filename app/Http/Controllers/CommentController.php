<?php

namespace App\Http\Controllers;

use App\Models\Vacation;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function store(Request $request, Vacation $vacation): RedirectResponse
    {
        // Seguridad: solo usuarios con reserva
        if (!$vacation->canBeCommentedBy(auth()->user())) {
            abort(403);
        }

        $request->validate([
            'text' => 'required|string|max:500',
        ]);

        Comment::create([
            'user_id'     => auth()->id(),
            'vacation_id' => $vacation->id,
            'text'        => $request->text,
        ]);

        return back()->with([
            'comment' => 'Comentario añadido correctamente.'
        ]);
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $user = auth()->user();

        if (!$comment->canBeDeletedBy($user)) {
            abort(403);
        }

        $comment->delete();

        return back()->with([
            'comment' => 'Comentario eliminado correctamente.'
        ]);
    }
}
