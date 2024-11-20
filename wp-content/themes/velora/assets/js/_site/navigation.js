'use strict';
const Navigation = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		const menuBtn = document.querySelector('.js-menu-btn');
		const navigation = document.querySelector('.js-navigation');

		if (navigation) {
			menuBtn.addEventListener('click', function() {
				this.classList.toggle('is-active');
				navigation.classList.toggle('is-active');
			});
		}
	}
};

export default Navigation;
