'use strict';

const QtyCounter = {
    init: function () {
        console.log('QtyCounter initialized');

        document.body.addEventListener('click', function (event) {
            if (event.target.matches('.js-qty-plus, .js-qty-minus')) {
                const button = event.target;
                const quantityContainer = button.closest('.cart__product-quantity') || button.closest('.quantity'); // Proveri oba containera
                if (!quantityContainer) {
                    console.error('Container za količinu nije pronađen.');
                    return;
                }

                const input = quantityContainer.querySelector('input.qty'); // Pronalazi input unutar containera
                if (!input) {
                    console.error('Input za količinu nije pronađen.');
                    return;
                }

                let value = parseInt(input.value, 10);
                const min = parseInt(input.getAttribute('min'), 10) || 0;
                const max = parseInt(input.getAttribute('max'), 10) || Infinity;

                if (button.classList.contains('js-qty-plus') && value < max) {
                    value++;
                } else if (button.classList.contains('js-qty-minus') && value > min) {
                    value--;
                }

                input.value = value;
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });

        // Dodaj event listener za "change" događaj (samo za korpu)
        document.body.addEventListener('change', function (event) {
            if (event.target.matches('input.qty')) {
                const input = event.target;
                const form = input.closest('form.cart__form'); // Proverava da li je u korpi
                if (form) {
                    QtyCounter.updateCart(form); // Ažuriranje korpe putem AJAX-a
                } else {
                    console.log('Promena količine na stranici proizvoda:', input.value);
                }
            }
        });
    },

    // Funkcija za slanje AJAX zahteva (koristi se samo na stranici korpe)
    updateCart: async function (form) {
        const formData = new FormData(form);

        try {
            const response = await fetch(custom_params.ajax_url, {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'update_cart',
                    form_data: new URLSearchParams(formData).toString(),
                }),
            });

            const result = await response.json();

            if (result.success) {
                console.log('Korpa uspešno ažurirana.');

                // Ažuriraj HTML za korpu
                document.querySelector('div.woocommerce').innerHTML = result.data.cart_html;

                // Ažuriraj ukupne cene
                document.querySelector('.cart__collaterals').innerHTML = result.data.cart_totals;
            } else {
                console.error('Greška pri ažuriranju korpe:', result);
            }
        } catch (error) {
            console.error('AJAX greška:', error);
        }
    },
};

export default QtyCounter;

// document.addEventListener('DOMContentLoaded', () => {
//     QtyCounter.init();
// });
