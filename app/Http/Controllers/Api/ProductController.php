<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Productos', description: 'CRUD de productos')]
class ProductController extends Controller
{
    use ApiResponse;

    #[OA\Get(
        path: '/api/products',
        summary: 'Listar todos los productos',
        description: 'Retorna la lista completa de productos con su categoría asociada.',
        tags: ['Productos'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Listado exitoso',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Listado de productos'),
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(
                            properties: [
                                new OA\Property(property: 'id', type: 'integer', example: 1),
                                new OA\Property(property: 'name', type: 'string', example: 'Camiseta Overskull'),
                                new OA\Property(property: 'description', type: 'string', example: 'Camiseta negra edición limitada'),
                                new OA\Property(property: 'price', type: 'number', format: 'float', example: 89.90),
                                new OA\Property(property: 'stock', type: 'integer', example: 50),
                                new OA\Property(property: 'category_id', type: 'integer', example: 1),
                            ]
                        )),
                    ]
                )
            ),
        ]
    )]
    public function index(): JsonResponse
    {
        $products = Product::with('category')->get();

        return $this->successResponse($products, 'Listado de productos');
    }

    #[OA\Post(
        path: '/api/products',
        summary: 'Crear un nuevo producto',
        tags: ['Productos'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'price', 'stock', 'category_id'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Camiseta Overskull'),
                    new OA\Property(property: 'description', type: 'string', example: 'Camiseta negra edición limitada'),
                    new OA\Property(property: 'price', type: 'number', format: 'float', example: 89.90),
                    new OA\Property(property: 'stock', type: 'integer', example: 50),
                    new OA\Property(property: 'category_id', type: 'integer', example: 1),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Producto creado exitosamente'),
            new OA\Response(response: 422, description: 'Error de validación'),
        ]
    )]
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());
        $product->load('category');

        return $this->successResponse($product, 'Producto creado correctamente', 201);
    }

    #[OA\Get(
        path: '/api/products/{id}',
        summary: 'Obtener un producto por ID',
        tags: ['Productos'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Producto encontrado'),
            new OA\Response(response: 404, description: 'Producto no encontrado'),
        ]
    )]
    public function show(int $id): JsonResponse
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return $this->errorResponse('Producto no encontrado', 404);
        }

        return $this->successResponse($product, 'Detalle del producto');
    }

    #[OA\Put(
        path: '/api/products/{id}',
        summary: 'Actualizar un producto',
        tags: ['Productos'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'price', 'stock', 'category_id'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Camiseta Overskull Edición 2'),
                    new OA\Property(property: 'description', type: 'string', example: 'Camiseta edición actualizada'),
                    new OA\Property(property: 'price', type: 'number', format: 'float', example: 99.90),
                    new OA\Property(property: 'stock', type: 'integer', example: 30),
                    new OA\Property(property: 'category_id', type: 'integer', example: 1),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Producto actualizado exitosamente'),
            new OA\Response(response: 404, description: 'Producto no encontrado'),
            new OA\Response(response: 422, description: 'Error de validación'),
        ]
    )]
    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse('Producto no encontrado', 404);
        }

        $product->update($request->validated());
        $product->load('category');

        return $this->successResponse($product, 'Producto actualizado correctamente');
    }

    #[OA\Delete(
        path: '/api/products/{id}',
        summary: 'Eliminar un producto',
        tags: ['Productos'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Producto eliminado exitosamente'),
            new OA\Response(response: 404, description: 'Producto no encontrado'),
        ]
    )]
    public function destroy(int $id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse('Producto no encontrado', 404);
        }

        $product->delete();

        return $this->successResponse(null, 'Producto eliminado correctamente');
    }
}
