<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryRequest;
use App\Models\History;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth' => 'role:admin'])->only(['create', 'store', 'destroy']);
    }
    public function index(Request $request)
    {
        $tagId = $request->input('tag_id');

        if ($tagId) {
            $histories = History::whereHas('tags', function ($query) use ($tagId) {
                $query->where('tags.id', $tagId);
            })->get();
        } else {
            $histories = History::latest()->get();
        }

        return view('history.index')->with(['histories' => $histories, 'tags' => Tag::all()]);
    }

    public function create()
    {
        return view('history.create')->with(['tags' => Tag::all()]);
    }

    public function store(HistoryRequest $request)
    {
        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $name = $file->getClientOriginalName();

            $path = basename($file->storeAs('/', $name,));
        } else {
            $path = null;
        }

        $history =  History::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'file' => $path
        ]);

        foreach ($request->tags as $tag) {
            $history->tags()->attach($tag);
        }

        return redirect()->route('history.index')->with('success', 'Tarixiy hujjat muvofiqatli qabul qilindi');
    }
    public function show(History $history)
    {
        return view('history.show')->with('history', $history);
    }


    public function destroy(History $history)
    {
        if (Auth::user()->hasRole('admin')) {
            if ($history->file) {
                Storage::delete($history->file);
            }
            $history->delete();
        } else {
            abort(403, 'Unauthorized action.');
        }

        return redirect()->route('history.index')->with('success', "Hujjat Muvoffaqqiyatli o'chirli");
    }

    public function downloadFile(History $history)
    {
        if (!$history->file || !Storage::exists('/' . $history->file)) {
            return redirect()->back()->with('error', 'Fayl topilmadi!');
        }

        return Storage::download('/' . $history->file);
    }
}
