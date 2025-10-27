<?php

namespace Drupal\generador_qr;

use Symfony\Component\HttpFoundation\RequestStack;
use Drupal\Core\Render\Markup;

class GeneradorQrService {

  /**
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * Constructor.
   */
  public function __construct(RequestStack $request_stack) {
    $this->requestStack = $request_stack;
  }

  /**
   * Genera el render array del QR.
   */
  public function getQr() {
    $request = $this->requestStack->getCurrentRequest();

    // Obtenemos la URL actual completa.
    $current_url = $request->getSchemeAndHttpHost() . $request->getRequestUri();

    // Retornamos un render array con el template y la librería.
    return [
      '#theme' => 'generador_qr',
      '#qr_data' => $current_url,
      '#attached' => [
        'library' => [
          'generador_qr/generador_qr_assets',
        ],
      ],
    ];
  }
}

