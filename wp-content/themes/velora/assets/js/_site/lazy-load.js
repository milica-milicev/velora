import LazyLoad from "vanilla-lazyload";

'use strict';
const LazyLoader = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		var lazyLoadInstance = new LazyLoad({
			elements_selector: '.lazy'
		});
		lazyLoadInstance.update();
	}
};

export default LazyLoader;
