( function( api ) {

	// Extends our custom "blackwhite-lite" section.
	api.sectionConstructor['blackwhite-lite'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
