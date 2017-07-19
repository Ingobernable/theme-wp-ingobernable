( function( api ) {

	// Extends our custom "mekanews-lite" section.
	api.sectionConstructor['mekanews-lite'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
