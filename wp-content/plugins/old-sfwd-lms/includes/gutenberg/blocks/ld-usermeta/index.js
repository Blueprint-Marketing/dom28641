/**
 * Block dependencies
 */
import classnames from 'classnames';
//import icon from './icon';
import './style.scss';

/**
 * Internal block libraries
 */
const { __, _x, sprintf } = wp.i18n;
const { 
	registerBlockType, 
	//InnerBlocks,
    InspectorControls,
 } = wp.blocks;
 const {
//     Toolbar,
//     Button,
     Tooltip,
     PanelBody,
     PanelRow,
     FormToggle,
	 SelectControl,
	 TextControl
 } = wp.components;

registerBlockType(
    'learndash/ld-usermeta',
    {
        title: __( 'LearnDash User Meta', 'learndash' ),
        description: __( 'LearnDash User Meta', 'learndash' ),
        //icon: icon,
        category: 'widgets',
        attributes: {
            field: {
                type: 'string',
            },
            user_id: {
                type: 'string',
            },
        },
        edit: props => {
			const { attributes: { field, user_id },
            	isSelected, className, setAttributes } = props;
			
            return [
				
                isSelected && (
                    <InspectorControls>
                        <PanelBody
                          title={ __( 'Settings', 'learndash' ) }
                        >
						<PanelRow>
							<SelectControl
								key="field"
								label={ __( 'Field', 'learndash' ) }
								options={ [
									{
										label: __('Select a field to show', 'learndash'),
										value: '',
									},
									{
										label: __('User Login', 'learndash'),
										value: 'user_login',
									},
									{
										label: __('User Display Name', 'learndash'),
										value: 'display_name',
									},
									{
										label: __('User Nicename', 'learndash'),
										value: 'user_nicename',
									},
									{
										label: __('User First Name', 'learndash'),
										value: 'first_name',
									},
									{
										label: __('User Last Name', 'learndash'),
										value: 'last_name',
									},
									{
										label: __('User Nickname', 'learndash'),
										value: 'nickname',
									},
									{
										label: __('User Email', 'learndash'),
										value: 'user_email',
									},
									{
										label: __('User URL', 'learndash'),
										value: 'user_url',
									},
									{
										label: __('User Description', 'learndash'),
										value: 'description',
									},
								] }
								onChange={ field => setAttributes( { field } ) }
							/>	
						</PanelRow>
							<PanelRow>
								<TextControl
									label={ __( 'User ID', 'learndash' ) }
									help={ __( 'User ID help text', 'learndash' ) }
									value={ user_id || '' }
									onChange={ user_id => setAttributes( { user_id } ) }
								/>
	                          </PanelRow>
                        </PanelBody>
                    </InspectorControls>
                ),
				<div className={ className }>
				{ __( '[usermeta] shortcode output shown here', 'learndash' ) }
				</div>
            ];
        },
		
        save: props => {
			//const { attributes: { courseID },
        	//	className, setAttributes } = props;
			
			//return (
				//<div
                //className={ className }
				//>
			//	<InnerBlocks.Content />
				//</div>
				//);
		}
	},
);
