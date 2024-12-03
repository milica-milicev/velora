'use strict';

const QtyCounter = {
    init: function () {
        console.log('QtyCounter initialized');

        // Klik za povećanje ili smanjenje količine
        document.body.addEventListener('click', function (event) {
            if (event.target.matches('.js-qty-plus, .js-qty-minus')) {
                const button = event.target;
                const quantityContainer = button.closest('.cart__product-quantity') || button.closest('.quantity');
                if (!quantityContainer) {
                    console.error('Container za količinu nije pronađen.');
                    return;
                }

                const input = quantityContainer.querySelector('input.qty');
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

        // Promena input vrednosti količine
        document.body.addEventListener('change', function (event) {
            if (event.target.matches('input.qty')) {
                const input = event.target;
                const form = input.closest('form.cart__form') || input.closest('form'); // Proveri oba formata
                if (form) {
                    QtyCounter.updateCart(form); // Ažuriranje korpe putem AJAX-a
                } else {
                    console.log('Promena količine na stranici proizvoda:', input.value);
                }
            }
        });
    },

    // Funkcija za ažuriranje korpe putem AJAX-a
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
                const cartContainer = document.querySelector('div.woocommerce');
                if (cartContainer) {
                    cartContainer.innerHTML = result.data.cart_html;
                }

                // Ažuriraj ukupne cene
                const cartTotals = document.querySelector('.cart__collaterals');
                if (cartTotals) {
                    cartTotals.innerHTML = result.data.cart_totals;
                }

                // Pozovi funkciju za ažuriranje broja proizvoda u headeru
                QtyCounter.updateHeaderCount(result.data.cart_count);
            } else {
                console.error('Greška pri ažuriranju korpe:', result);
            }
        } catch (error) {
            console.error('AJAX greška:', error);
        }
    },

    // Funkcija za ažuriranje broja u headeru
    updateHeaderCount: function (cartCount) {
        const cartCountElement = document.querySelector('.js-cart-count'); // Selektor za broj u headeru
        if (cartCountElement) {
            cartCountElement.textContent = cartCount || '0'; // Postavi broj ili "0" ako je prazan
        } else {
            console.error('Element sa klasom .js-cart-count nije pronađen.');
        }
    },
};

export default QtyCounter;
