'use strict';
const QtyCounter = {
    init: function() {
        const updateButton = document.querySelector('.js-update-btn'); // Selektuj dugme za ažuriranje

        function checkIfCartHasChanged() {
            const qtyFields = document.querySelectorAll('.js-qty-field');
            const hasChanged = Array.from(qtyFields).some(field => field.value !== field.defaultValue);
            updateButton.disabled = !hasChanged; // Onemogući ili omogući dugme na osnovu promene
        }

        document.body.addEventListener('click', function(e) {
            if (e.target.classList.contains('js-qty-plus') || e.target.classList.contains('js-qty-minus')) {
                const btn = e.target;
                const input = btn.parentNode.querySelector('.qty');
                let inputValue = parseInt(input.value, 10);

                if (btn.classList.contains('js-qty-plus')) {
                    inputValue++;
                } else if (btn.classList.contains('js-qty-minus')) {
                    if (inputValue > 1) {
                        inputValue--;
                    } else {
                        inputValue = 1; // Prevent the value from going below 1
                    }
                }

                input.value = inputValue;

                if (updateButton) {
                    checkIfCartHasChanged(); // Proveri promene nakon ažuriranja
                }
            }
        });

        // Prevent manual entry of negative numbers
        document.body.addEventListener('change', function(e) {
            if (e.target.classList.contains('js-qty-field') || e.target.classList.contains('qty')) {
                const input = e.target;
                let inputValue = parseInt(input.value, 10);

                if (inputValue < 1) {
                    input.value = 1;
                }

                if (updateButton) {
                    checkIfCartHasChanged(); // Proveri promene nakon manuelne promene
                }
            }
        });

        if (updateButton) {
            // Opciono: Možete dodati ovaj deo ako želite da proverite promene kada korisnik koristi tastaturu za promenu količine
            document.body.addEventListener('keyup', function(e) {
                if (e.target.classList.contains('js-qty-field') || e.target.classList.contains('qty')) {
                    checkIfCartHasChanged(); // Proveri promene nakon unos preko tastature
                }
            });
        }
    }
};

export default QtyCounter;
