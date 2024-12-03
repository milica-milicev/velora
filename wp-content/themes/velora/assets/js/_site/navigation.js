'use strict';
const Navigation = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		const menuBtn = document.querySelector('.js-menu-btn');
		const navigation = document.querySelector('.js-navigation');
		const header = document.querySelector('.js-site-header');

		if (navigation) {
			menuBtn.addEventListener('click', function() {
				this.classList.toggle('is-active');
				navigation.classList.toggle('is-active');
				header.classList.toggle('is-active-header');
			});
		}
	}
};

export default Navigation;
