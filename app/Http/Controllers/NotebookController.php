<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;


class NotebookController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/notebook",
     *      summary="Sign in",
     *      description="Notebook Get",
     *      operationId="authLogin",
     *      tags={"notebook"},
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="notebook", type="Notebook", ref="#/components/schemas/Notebook"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Wrong credentials response",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="an error occurred")
     *          )
     *     )
     * )
     */
    protected function index(): LengthAwarePaginator
    {
        $notebook = Notebook::paginate(5);

        return $notebook;
    }

    /**
     * @OA\Post(
     *      path="/api/notebook",
     *      summary="Sign in",
     *      description="Notebook Post",
     *      operationId="authLogin",
     *      tags={"notebook"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass user credentials",
     *           @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *              @OA\Property(property="name", type="string", maxLength=32, example="Alexandr"),
     *              @OA\Property(property="company", type="string", maxLength=32, example="ozon"),
     *              @OA\Property(property="phone", type="string", maxLength=32, example="88004002020"),
     *              @OA\Property(property="email", type="string", maxLength=32, example="ozon@mail.ru"),
     *              @OA\Property(property="data", type="string", maxLength=32, example="12.01.1990"),
     *              @OA\Property(property="foto", type="string", maxLength=32, example="no foto"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="notebook",
     *                  type="Notebook",
     *                  ref="#/components/schemas/Notebook"
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Wrong credentials response",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Sorry, an error occurred"
     *              )
     *          )
     *     )
     * )
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
     * @OA\Get(
     *      path="/api/notebook/{id}",
     *      summary="Sign in",
     *      description="Notebook Get by id",
     *      operationId="authLogin",
     *      tags={"notebook"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="The ID of notebook",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Enter id",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *              @OA\Property(property="name", type="string", maxLength=32, example="Alexandr"),
     *              @OA\Property(property="company", type="string", maxLength=32, example="ozon"),
     *              @OA\Property(property="phone", type="string", maxLength=32, example="88004002020"),
     *              @OA\Property(property="email", type="string", maxLength=32, example="ozon@mail.ru"),
     *              @OA\Property(property="data", type="string", maxLength=32, example="12.01.1990"),
     *              @OA\Property(property="foto", type="string", maxLength=32, example="no foto"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="notebook",
     *                  type="Notebook",
     *                  ref="#/components/schemas/Notebook"),
     *              )
     *          ),
     *          @OA\Response(
     *              response=422,
     *              description="Wrong credentials response",
     *              @OA\JsonContent(
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      example="Sorry, an error occurred")
     *                  )
     *              )
     *          )
     * )
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
     * @OA\Put(
     *      path="/api/notebook/{id}",
     *      summary="Sign in",
     *      description="Notebook Update by id",
     *      operationId="authLogin",
     *      tags={"notebook"},
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of notebook",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Enter new data",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *              @OA\Property(property="name", type="string", maxLength=32, example="Alexandr"),
     *              @OA\Property(property="company", type="string", maxLength=32, example="ozon"),
     *              @OA\Property(property="phone", type="string", maxLength=32, example="88004002020"),
     *              @OA\Property(property="email", type="string", maxLength=32, example="ozon@mail.ru"),
     *              @OA\Property(property="data", type="string", maxLength=32, example="12.01.1990"),
     *              @OA\Property(property="foto", type="string", maxLength=32, example="no foto"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="notebook",
     *                  type="Notebook",
     *                  ref="#/components/schemas/Notebook"
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Wrong credentials response",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Sorry, an error occurred"
     *              )
     *          )
     *      )
     * )
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $notebook = Notebook::find($id);
        if (is_null($notebook)) {
            return response()->json(['error' => true, 'message' => 'Notebook not found'], 404);
        }

        $rules =[
            'name'=>['required','string','min:3'],
            'phone'=>['required', 'string','min:3'],
            'email'=>['required','string','min:3']
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $notebook->update($request->all());

        return response()->json($notebook, 200);
    }
    /**
     * @OA\Delete(
     *      path="/api/notebook/{id}",
     *      summary="Sign in",
     *      description="Login by email, password",
     *      operationId="authLogin",
     *      tags={"notebook"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="The ID of example",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *      ),
     *      @OA\Response(
     *          response="202",
     *          description="Deleted",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Wrong credentials response",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Sorry, wrong email address or password. Please try again"
     *              )
     *          )
     *     )
     * )
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

        return response()->json(['message' => 'Successfully deleted'], 200);
    }
}
