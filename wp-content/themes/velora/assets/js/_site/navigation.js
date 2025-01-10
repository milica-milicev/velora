'use strict';

const Navigation = {

    /*-------------------------------------------------------------------------------
        # Initialize
    -------------------------------------------------------------------------------*/
    init: function () {
        const menuBtn = document.querySelector('.js-menu-btn');
        const navigation = document.querySelector('.js-navigation');
        const header = document.querySelector('.js-site-header');
        const submenuIcons = document.querySelectorAll('.submenu-icon');

        // Upravljanje glavnim menijem
        if (navigation) {
            menuBtn.addEventListener('click', function () {
                this.classList.toggle('is-active');
                navigation.classList.toggle('is-active');
                header.classList.toggle('is-active-header');
            });
        }

        // Upravljanje submenu-ima
        if (submenuIcons.length) {
            submenuIcons.forEach(icon => {
                icon.addEventListener('click', function (event) {
                    const parentLi = this.parentElement; // Pretpostavlja se da je span unutar <li>
                    const submenu = parentLi.querySelector('.sub-menu'); // Traži submenu unutar parent <li>
					console.log('dsasdasdsas');
                    // Proveri da li je ispod 991px
                    if (window.innerWidth < 992 && submenu) {
                        event.preventDefault(); // Sprečava default ponašanje
						console.log('dsas');

                        // Dodaj ili ukloni klasu za prikaz submenua
                        if (submenu.style.display === 'block') {
                            submenu.style.display = 'none';
                            submenu.classList.remove('is-active');
                        } else {
                            submenu.style.display = 'block';
                            submenu.classList.add('is-active');
                        }
                    }
                });
            });
        }
    }
};

export default Navigation;
