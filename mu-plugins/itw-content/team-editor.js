/**
 * "Team member" panel in the block editor sidebar.
 */
( ( wp ) => {
	const { registerPlugin } = wp.plugins;
	const { PluginDocumentSettingPanel } = wp.editor;
	const { TextControl } = wp.components;
	const { useSelect } = wp.data;
	const { useEntityProp } = wp.coreData;
	const { __ } = wp.i18n;
	const el = wp.element.createElement;

	const Panel = () => {
		const postType = useSelect( ( select ) => select( 'core/editor' ).getCurrentPostType(), [] );
		const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );

		if ( postType !== 'team_member' || ! meta ) {
			return null;
		}

		const field = ( key, label, help, type = 'text' ) =>
			el( TextControl, {
				label,
				help,
				type,
				value: meta[ key ] || '',
				onChange: ( v ) => setMeta( { ...meta, [ key ]: v } ),
			} );

		return el(
			PluginDocumentSettingPanel,
			{ name: 'itw-team-member', title: __( 'Team member', 'itw-content' ), initialOpen: true },
			field( 'itw_role', __( 'Role', 'itw-content' ), __( 'For example: Senior interior designer', 'itw-content' ) ),
			field( 'itw_linkedin', __( 'LinkedIn URL', 'itw-content' ), '', 'url' ),
			field( 'itw_instagram', __( 'Instagram URL', 'itw-content' ), '', 'url' )
		);
	};

	registerPlugin( 'itw-team-member', { render: Panel } );
} )( window.wp );
