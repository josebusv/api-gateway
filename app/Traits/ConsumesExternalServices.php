<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalServices
{
  /**
   * Send a request to any service
   * @return string
   */
  public function performRequest($method, $requesUrl, $formParams = [] , $headers = [])
  {

    $client = new Client([
      'base_uri' => $this->baseUri,
    ]);

    if(isset($this->secret)){
      $headers['Authorization'] = $this->secret;
    }


    //echo $headers['Authorization'];
    //dd($method, $requesUrl, $this->baseUri, $headers['Authorization']);
    $response = $client->request($method, $requesUrl, ['form_params' => $formParams, 'headers'  =>  $headers]);
    //dd($response->getHeader('Authorization'));


    return $response->getBody()->getContents();
    //return $response->getHeader('Authorization');
  }
}
