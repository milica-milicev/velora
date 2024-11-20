'use strict';
const StickyHeader = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		// Get the header element
		const header = document.querySelector('.site-header');

		// Get the initial position of the header
		const headerTop = header.offsetTop;

		if (header) {
			// Add a scroll event listener to the window
			window.addEventListener('scroll', () => {
				// Get the current position of the scroll
				const scrollPos = window.scrollY;

				// Check if the user has scrolled past the initial position of the header
				if (scrollPos > headerTop) {
					// Add the "sticky" class to the header
					header.classList.add('is-sticky');
				} else {
					// Remove the "sticky" class from the header
					header.classList.remove('is-sticky');
				}
			});
		}
	}
};

export default StickyHeader;
