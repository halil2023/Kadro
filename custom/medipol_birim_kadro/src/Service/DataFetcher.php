<?php

namespace Drupal\medipol_birim_kadro\Service;

use GuzzleHttp\ClientInterface;
use Drupal\Core\Http\ClientFactory;

class DataFetcher {
  protected $httpClient;

  public function __construct(ClientInterface $http_client) {
    $this->httpClient = $http_client;
  }

  public function fetchData() {
    try {
        // $config = $this->configFactory->get('medipol_birim_kadro.settings');
        // $url = $config->get('base_url');
        // if(!$url) {
        //     $url = "https://mebis.medipol.edu.tr/EgitimKadrosu/EgitimKadrosuJson?birimOID=10227&gorevlendirme=true&lang=tr";
        // }
        $url = "https://mebis.medipol.edu.tr/EgitimKadrosu/EgitimKadrosuJson?birimOID=10227&gorevlendirme=true&lang=tr";
        $response = $this->httpClient->request('GET', $url);
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), TRUE);
            return $data;
        }
        else {
            throw new \Exception('Failed to fetch data from URL.');
        }
    }
    catch (\Exception $e) {
      return NULL;
    }
  }
}
