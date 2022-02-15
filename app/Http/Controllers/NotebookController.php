<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class NotebookController extends Controller
{
    /**
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        $notebook = Notebook::paginate(5);

        return $notebook;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name'=>['required','string','min:3'],
            'phone'=>['required', 'string','min:3'],
            'email'=>['required','string','min:3']
        ]);
        $notebook = Notebook::create($request->all());

        return response()->json($notebook, 201);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $notebook = Notebook::find($id);
        if (is_null($notebook)) {
            return response()->json(['error'=> true, 'message'=>'Not found'],404);
        }

        return response()->json($notebook,200);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $notebook = Notebook::find($id)->update($request->all());
        if (is_null($notebook)) {
            return response()->json(['error'=> true, 'message'=>'Not found'],404);
        }

        return response()->json($notebook, 200);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        $notebook = Notebook::find($id)->delete($request->all());
        if (is_null($notebook)) {
            return response()->json(['error'=> true, 'message'=>'Not found '],404);
        }

        return response()->json($notebook, 204);
    }
}
