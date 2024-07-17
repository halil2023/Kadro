<?php

namespace Drupal\medipol_birim_kadro\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\medipol_birim_kadro\Service\DataFetcher;
use Symfony\Component\HttpFoundation\JsonResponse;

class BirimKadroController extends ControllerBase {
  protected $dataFetcher;

  public function __construct(DataFetcher $data_fetcher) {
    $this->dataFetcher = $data_fetcher;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('medipol_birim_kadro.data_fetcher')
    );
  }

  public function showData() {
    $data = $this->dataFetcher->fetchData();
    // dd("Calisti");
    if ($data) {
        return new JsonResponse($data);
    }
    else {
        return new JsonResponse(['error' => 'Failed to fetch data.'], 500);
    }
  }
}
