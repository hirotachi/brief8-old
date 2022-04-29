// Set custom editor scripts on page loaded
document.addEventListener(
	'DOMContentLoaded',
	function () {
		qodefSetBodyClasses();
	}
);

// Set preview screen body class
const qodefSetBodyClasses = () => {

	if ( typeof wp === 'object' && typeof wp.data === 'object' ) {
		const wpData 	  	= wp.data;
		let initialScreen 	= 'desktop';

		document.body.classList.add( 'qode-essential-addons--' + initialScreen );

		wpData.subscribe(
			() =>
			{
				const currentPageData = wpData.select( 'core/edit-post' );

				if ( currentPageData !== null ) {
					const currentScreen = currentPageData.__experimentalGetPreviewDeviceType().toLowerCase();

					if ( typeof currentScreen !== 'undefined' && initialScreen !== currentScreen && ['tablet', 'mobile', 'desktop'].includes( currentScreen ) ) {
						document.body.classList.remove( 'qode-essential-addons--tablet' );
						document.body.classList.remove( 'qode-essential-addons--mobile' );
						document.body.classList.remove( 'qode-essential-addons--desktop' );

						document.body.classList.add( 'qode-essential-addons--' + currentScreen );

						initialScreen = currentScreen;
					}
				}
			}
		);
	}
}
