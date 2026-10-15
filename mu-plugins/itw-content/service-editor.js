/**
 * "Service details" panel in the block editor sidebar for Services.
 */
( ( wp ) => {
	const { registerPlugin } = wp.plugins;
	const { PluginDocumentSettingPanel } = wp.editor;
	const { TextControl, SelectControl } = wp.components;
	const { useSelect } = wp.data;
	const { useEntityProp } = wp.coreData;
	const { __ } = wp.i18n;
	const el = wp.element.createElement;

	const Panel = () => {
		const postType = useSelect( ( select ) => select( 'core/editor' ).getCurrentPostType(), [] );
		const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );

		if ( postType !== 'service' || ! meta ) {
			return null;
		}

		return el(
			PluginDocumentSettingPanel,
			{ name: 'itw-service-details', title: __( 'Service details', 'itw-content' ), initialOpen: true },
			el( TextControl, {
				label: __( 'Starting price (optional)', 'itw-content' ),
				help: __( 'Shown as "From …". For example: Rp 3 juta per m². Leave empty to hide.', 'itw-content' ),
				value: meta.itw_price_from || '',
				onChange: ( v ) => setMeta( { ...meta, itw_price_from: v } ),
			} ),
			el( SelectControl, {
				label: __( 'Show projects from', 'itw-content' ),
				help: __( 'The project category whose projects appear on this service page.', 'itw-content' ),
				value: meta.itw_project_category || 0,
				options: [ { value: 0, label: __( 'Latest projects', 'itw-content' ) }, ...( window.itwService?.categories || [] ) ],
				onChange: ( v ) => setMeta( { ...meta, itw_project_category: parseInt( v, 10 ) || 0 } ),
			} )
		);
	};

	registerPlugin( 'itw-service-details', { render: Panel } );
} )( window.wp );
