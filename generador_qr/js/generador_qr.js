(function (Drupal, once, $) {
  'use strict';

  // Verificamos que la librería QRCode (de qrcode.min.js) esté cargada
  if (typeof QRCode === 'undefined') {
    console.error('Librería QRCode no encontrada. Asegúrate de que qrcode.min.js se carga ANTES que este script.');
    return;
  }

  /**
   * Behavior para inicializar los generadores de QR.
   */
  Drupal.behaviors.generadorQR = {
    attach: function (context, settings) {

      // Buscamos todos los elementos con nuestra clase y aplicamos .once()
      const elements = once('generadorQR', '.generador-qr-container', context);
      
      // Iteramos sobre cada elemento encontrado (cada bloque de QR)
      elements.forEach(function (domElement) {
        
        // Leemos la URL/texto desde el atributo data-qr-text
        var qrText = domElement.dataset.qrText;

        // Solo generamos el QR si el texto no está vacío
        if (qrText) {
          try {
            // Pasamos el 'domElement' (el div mismo) a la librería QRCode,
            // en lugar de un string "qrcode".
            new QRCode(domElement, {
              text: qrText,
              width: 128, // Puedes ajustar esto
              height: 128, // Puedes ajustar esto
              correctLevel: QRCode.CorrectLevel.H
            });
          } catch (e) {
            console.error('Error al generar QR:', e);
          }
        } else {
            // Esto es lo que te pasaba antes: data-qr-text estaba vacío
            console.warn('Contenedor QR encontrado pero sin data-qr-text.');
        }
      });
    }
  };

})(Drupal, once, jQuery);
