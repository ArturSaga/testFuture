<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;

class NotebookController extends Controller
{

    public function index()
    {
        $notebook = Notebook::paginate(5);
        return $notebook;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','string','min:3'],
            'phone'=>['required', 'string','min:3'],
            'email'=>['required','string','min:3']
        ]);
        $notebook = Notebook::create($request->all());
        return response()->json($notebook, 201);
    }

    public function show($id)
    {
        $notebook = Notebook::find($id);
        if (is_null($notebook))
        {
            return response()->json(['error'=> true, 'message'=>'Not found'],404);
        }
        return response()->json($notebook,200);
    }

    public function update(Request $request, $id)
    {
        $notebook = Notebook::find($id)->update($request->all());
        if (is_null($notebook))
        {
            return response()->json(['error'=> true, 'message'=>'Not found'],404);
        }

        return response()->json($notebook, 200);
    }


    public function destroy(Request $request, $id)
    {
        $notebook = Notebook::find($id)->delete($request->all());
        if (is_null($notebook))
        {
            return response()->json(['error'=> true, 'message'=>'Not found'],404);
        }
        return response()->json($notebook, 204);
    }
}
