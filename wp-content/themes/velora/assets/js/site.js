
import LazyLoader from './_site/lazy-load';
import Navigation from './_site/navigation';
import StickyHeader from './_site/sticky-header';
import Sliders from './_site/sliders';
//import Size from './_site/size';

document.addEventListener('DOMContentLoaded', () => {
	LazyLoader.init();
	Navigation.init();
	StickyHeader.init();
	Sliders.init();
	//Size.init();
});
