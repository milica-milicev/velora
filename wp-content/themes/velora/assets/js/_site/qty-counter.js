'use strict';

const QtyCounter = {
    init: function () {
        jQuery(document).ready(function ($) {
            // Funkcija za slanje AJAX zahteva
            function updateCart(form) {
                const formData = form.serialize();
                $.ajax({
                    type: 'POST',
                    url: custom_params.ajax_url, // URL definisan u wp_localize_script
                    data: {
                        action: 'update_cart', // Naziv AJAX akcije
                        form_data: formData   // Podaci iz forme
                    },
                    success: function (response) {
                        if (response.success) {
                            // Ažuriraj HTML tabele korpe
                            $('div.woocommerce').html(response.data.cart_html);

                            // Ažuriraj HTML ukupnih cena
                            $('.cart__collaterals').html(response.data.cart_totals);

                            // Opciono: Ažuriraj mini korpu (ako je koristiš)
                            $('#mini-cart').html(response.data.mini_cart);
                        } else {
                            console.error('Greška pri ažuriranju korpe:', response);
                        }
                    },
                    error: function (error) {
                        console.error('AJAX greška:', error);
                    }
                });
            }

            // Klik na "+" ili "-" dugme
            $('body').on('click', '.js-qty-plus, .js-qty-minus', function () {
                const button = $(this);
                const input = button.closest('.quantity').find('.qty');
                const form = button.closest('form'); // Forma korpe
                let value = parseInt(input.val(), 10);

                // Uvećaj ili smanji vrednost
                if (button.hasClass('js-qty-plus')) {
                    value++;
                } else if (button.hasClass('js-qty-minus') && value > 1) {
                    value--;
                }

                input.val(value); // Postavi novu vrednost u input
                updateCart(form); // Ažuriraj korpu
            });

            // Ručna promena unosa
            $('body').on('change', '.qty', function () {
                const input = $(this);
                const form = input.closest('form');
                updateCart(form);
            });
        });
    }
};

export default QtyCounter;

// // Inicijalizacija skripte
// document.addEventListener('DOMContentLoaded', function () {
//     QtyCounter.init();
// });
