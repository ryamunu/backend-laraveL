<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Overskull Products API',
    description: 'API REST para gestión de productos y categorías — Prueba Técnica Full Stack',
    contact: new OA\Contact(email: 'pierog@overskull.pe')
)]
#[OA\Server(
    url: 'http://localhost:8000',
    description: 'Servidor local de desarrollo'
)]
abstract class Controller
{
    //
}
