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
	 TextControl
 } = wp.components;

registerBlockType(
    'learndash/ld-user-course-points',
    {
        title: sprintf( _x( 'LearnDash User %s Points', 'LearnDash User Course Points', 'learndash' ), ldlms_settings['settings']['custom_labels']['course'] || 'course' ),
        description: sprintf( _x( 'LearnDash User %s Points', 'LearnDash User Counrs Points', 'learndash' ), ldlms_settings['settings']['custom_labels']['course'] || 'course' ),
        //icon: icon,
        category: 'widgets',
        attributes: {
            user_id: {
                type: 'string',
            },
        },
        edit: props => {
			const { attributes: { user_id },
            	isSelected, className, setAttributes } = props;
			
            return [
				
                isSelected && (
                    <InspectorControls>
                        <PanelBody
                          title={ __( 'Settings', 'learndash' ) }
                        >
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
				{ __( '[ld_user_course_points] shortcode output shown here', 'learndash' ) }
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
