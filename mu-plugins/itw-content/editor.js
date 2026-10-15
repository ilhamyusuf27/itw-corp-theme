/**
 * "Project details" panel in the block editor sidebar for Projects.
 * Plain script (no build step): uses the wp.* globals.
 */
( ( wp ) => {
	const { registerPlugin } = wp.plugins;
	const { PluginDocumentSettingPanel } = wp.editor;
	const { TextControl, TextareaControl, ToggleControl, CheckboxControl, BaseControl } = wp.components;
	const { useSelect } = wp.data;
	const { useEntityProp } = wp.coreData;
	const { __ } = wp.i18n;
	const el = wp.element.createElement;

	const Panel = () => {
		const postType = useSelect( ( select ) => select( 'core/editor' ).getCurrentPostType(), [] );
		const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );

		if ( postType !== 'project' || ! meta ) {
			return null;
		}

		const set = ( key ) => ( value ) => setMeta( { ...meta, [ key ]: value } );
		const scope = Array.isArray( meta.itw_scope ) ? meta.itw_scope : [];
		const toggleScope = ( option ) => ( checked ) =>
			setMeta( { ...meta, itw_scope: checked ? [ ...scope, option ] : scope.filter( ( s ) => s !== option ) } );

		return el(
			PluginDocumentSettingPanel,
			{ name: 'itw-project-details', title: __( 'Project details', 'itw-content' ), initialOpen: true },
			el( TextControl, {
				label: __( 'Year', 'itw-content' ),
				type: 'number',
				value: meta.itw_year || '',
				onChange: ( v ) => set( 'itw_year' )( v ? parseInt( v, 10 ) : 0 ),
			} ),
			el( TextControl, {
				label: __( 'Area (m²)', 'itw-content' ),
				type: 'number',
				value: meta.itw_area || '',
				onChange: ( v ) => set( 'itw_area' )( v ? parseFloat( v ) : 0 ),
			} ),
			el( TextControl, {
				label: __( 'Duration', 'itw-content' ),
				help: __( 'For example: 4 months', 'itw-content' ),
				value: meta.itw_duration || '',
				onChange: set( 'itw_duration' ),
			} ),
			el(
				BaseControl,
				{ label: __( 'Scope of work', 'itw-content' ), id: 'itw-scope' },
				( window.itwProject?.scope || [] ).map( ( option ) =>
					el( CheckboxControl, {
						key: option,
						label: option,
						checked: scope.includes( option ),
						onChange: toggleScope( option ),
					} )
				)
			),
			el( TextareaControl, {
				label: __( 'Client quote', 'itw-content' ),
				value: meta.itw_quote || '',
				onChange: set( 'itw_quote' ),
			} ),
			el( TextControl, {
				label: __( 'Quote by', 'itw-content' ),
				help: __( 'For example: Homeowner, Bandung', 'itw-content' ),
				value: meta.itw_quote_by || '',
				onChange: set( 'itw_quote_by' ),
			} ),
			el( ToggleControl, {
				label: __( 'Featured on homepage', 'itw-content' ),
				checked: !! meta.itw_featured,
				onChange: set( 'itw_featured' ),
			} )
		);
	};

	registerPlugin( 'itw-project-details', { render: Panel } );
} )( window.wp );
