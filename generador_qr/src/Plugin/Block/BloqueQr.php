<?php

namespace Drupal\generador_qr\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\generador_qr\GeneradorQrService;
// ¡Ya NO necesitamos RouteMatchInterface!

/**
 * Bloque para poner el QR.
 * (Genera un QR de la página actual)
 *
 * @Block(
 * id = "qr_block_mediateca",
 * admin_label = @Translation("Bloque para poner el QR"),
 * )
 */
class BloqueQr extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * El servicio generador de QR.
   *
   * @var \Drupal\generador_qr\GeneradorQrService
   */
  protected $generadorQrService;

  /**
   * Construye un nuevo objeto BloqueQr.
   */
  // Simplificamos el constructor, ya no necesita RouteMatch
  public function __construct(array $configuration, $plugin_id, $plugin_definition, GeneradorQrService $generador_qr_service) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->generadorQrService = $generador_qr_service;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    // Inyectamos solo el servicio de QR
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('generador_qr.generador_qr_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Simplificamos el build.
    // Simplemente llamamos al servicio sin parámetros.
    // El servicio se encargará de obtener la URL de la página actual.
    return $this->generadorQrService->getQr();
  }

}
