<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Categorías', description: 'CRUD de categorías de productos')]
class CategoryController extends Controller
{
    use ApiResponse;

    #[OA\Get(
        path: '/api/categories',
        summary: 'Listar todas las categorías',
        description: 'Retorna la lista completa de categorías con conteo de productos.',
        tags: ['Categorías'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Listado exitoso',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Listado de categorías'),
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(
                            properties: [
                                new OA\Property(property: 'id', type: 'integer', example: 1),
                                new OA\Property(property: 'name', type: 'string', example: 'Electrónica'),
                                new OA\Property(property: 'description', type: 'string', example: 'Productos electrónicos'),
                                new OA\Property(property: 'products_count', type: 'integer', example: 3),
                            ]
                        )),
                    ]
                )
            ),
        ]
    )]
    public function index(): JsonResponse
    {
        $categories = Category::withCount('products')->get();

        return $this->successResponse($categories, 'Listado de categorías');
    }

    #[OA\Post(
        path: '/api/categories',
        summary: 'Crear una nueva categoría',
        tags: ['Categorías'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Electrónica'),
                    new OA\Property(property: 'description', type: 'string', example: 'Productos electrónicos'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Categoría creada exitosamente'),
            new OA\Response(response: 422, description: 'Error de validación'),
        ]
    )]
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = Category::create($request->validated());

        return $this->successResponse($category, 'Categoría creada correctamente', 201);
    }

    #[OA\Get(
        path: '/api/categories/{id}',
        summary: 'Obtener una categoría por ID',
        tags: ['Categorías'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Categoría encontrada'),
            new OA\Response(response: 404, description: 'Categoría no encontrada'),
        ]
    )]
    public function show(int $id): JsonResponse
    {
        $category = Category::with('products')->find($id);

        if (!$category) {
            return $this->errorResponse('Categoría no encontrada', 404);
        }

        return $this->successResponse($category, 'Detalle de la categoría');
    }

    #[OA\Put(
        path: '/api/categories/{id}',
        summary: 'Actualizar una categoría',
        tags: ['Categorías'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Electrónica Actualizada'),
                    new OA\Property(property: 'description', type: 'string', example: 'Descripción actualizada'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Categoría actualizada exitosamente'),
            new OA\Response(response: 404, description: 'Categoría no encontrada'),
            new OA\Response(response: 422, description: 'Error de validación'),
        ]
    )]
    public function update(UpdateCategoryRequest $request, int $id): JsonResponse
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->errorResponse('Categoría no encontrada', 404);
        }

        $category->update($request->validated());

        return $this->successResponse($category, 'Categoría actualizada correctamente');
    }

    #[OA\Delete(
        path: '/api/categories/{id}',
        summary: 'Eliminar una categoría',
        tags: ['Categorías'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Categoría eliminada exitosamente'),
            new OA\Response(response: 404, description: 'Categoría no encontrada'),
        ]
    )]
    public function destroy(int $id): JsonResponse
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->errorResponse('Categoría no encontrada', 404);
        }

        $category->delete();

        return $this->successResponse(null, 'Categoría eliminada correctamente');
    }
}
