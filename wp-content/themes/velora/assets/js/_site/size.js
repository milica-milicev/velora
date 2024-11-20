'use strict';
const Size = {

    /*-------------------------------------------------------------------------------
        # Initialize
    -------------------------------------------------------------------------------*/
    init: function () {
        const variationItems = document.querySelectorAll('.js-variation-item');

        // Proveri da li ima stavki i postavi inicijalnu selekciju
        if (variationItems.length > 0) {
            const firstItem = variationItems[0];
            firstItem.classList.add('selected');

            variationItems.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Ukloni prethodnu selekciju
                    variationItems.forEach(function(btn) {
                        btn.classList.remove('selected');
                    });
                    // Dodaj selekciju na kliknuto dugme
                    button.classList.add('selected');
        
                    // Ažuriraj hidden select element
                    const attributeName = button.getAttribute('data-attribute_name');
                    const attributeValue = button.getAttribute('data-value');
                    const selectField = document.getElementById(attributeName);
                    
                    if (selectField) {
                        selectField.value = attributeValue;

                        // Pokreni 'change' događaj na select polju
                        selectField.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
            });
        }
    }
};

export default Size;
