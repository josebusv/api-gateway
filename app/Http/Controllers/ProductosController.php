<?php

namespace App\Http\Controllers;

use App\Services\ProductosService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductosController extends Controller
{

    use ApiResponser;
    /**
     * Este servicio consume el servicio de productos
     * @var ProductosService
     */
    public $productosService;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductosService $productosService)
    {
        $this->productosService = $productosService;
    }

    /**
     * Retorna un listado de todos los productos
     */
    public function index()
    {
        return $this->successResponse($this->productosService->obtainProductos());
    }

    /**
     * Crea una instacia de un producto
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->productosService->createProductos($request->all(), Response::HTTP_CREATED));
    }

    /**
     * Retorna una instancia especifica de producto
     */
    public function show($producto)
    {
        return $this->successResponse($this->productosService->obtainProducto($producto));
    }

    /**
     * Actualiza una instancia de producto
     */
    public function update(Request $request, $producto)
    {
        return $this->successResponse($this->productosService->editProductos($request->all(), $producto));
    }
    /**
     * Elimina la instancia de producto
     */
    public function destroy($producto, $user_id)
    {
        return $this->successResponse($this->productosService->deleteProductos($producto));
    }

}
