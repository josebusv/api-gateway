<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class ProductosService
{
  use ConsumesExternalServices;

  /**
   * URI base para consumir el servicio de AXLP
   * @var string
   */
  public $baseUri;
  /**
   * Secreto para consumir el servicio
   * @var string
   */
  public $secret;

  public function __construct()
  {
    $this->baseUri = config('services.productos.base_uri');
    $this->secret = config('services.productos.secrete');
  }
  /**
   * Retorna una lista de Productos
   * @return
   */
  public function obtainProductos()
  {
    //dd($this->baseUri);
    return $this->performRequest('GET', "/productos");
  }

/**
   * Retorna un producto especifico
   * @return
   */
  public function obtainProducto($producto)
  {
    //dd($this->baseUri);
    return $this->performRequest('GET', "/productos/{$producto}");
  }

  /**
   * Crea un producto
   * @return
   */
  public function createProductos($data)
  {
    //dd($this->baseUri);
    return $this->performRequest('GET', "/productos/{$data}");
  }

  /**
   * Actualiza un producto
   */
  public function editProductos($data, $producto)
  {
    return $this->performRequest('PUT', "/productos/{$producto}", $data);
  }
  /**
   * Elimina un producto
   */

   public function deleteProductos($producto)
   {
       return $this->performRequest('DELETE', "/productos/{$producto}");
   }

}
