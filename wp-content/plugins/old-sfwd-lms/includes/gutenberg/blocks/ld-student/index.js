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
	InnerBlocks,
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
    'learndash/ld-student',
    {
        title: __( 'LearnDash Student', 'learndash' ),
        description: __( 'LearnDash Student Block.', 'learndash'),
        //icon: icon,
        category: 'widgets',
        attributes: {
            course_id: {
                type: 'string',
            },
        },
        edit: props => {
			const { attributes: { course_id },
            	isSelected, className, setAttributes } = props;
			
            return [
				
                isSelected && (
                    <InspectorControls>
                        <PanelBody
                          title={ __( 'Settings', 'learndash' ) }
                        >
                            <PanelRow>
								<TextControl
									label={ sprintf( _x( '%s ID', 'Course ID', 'learndash' ), ldlms_settings['settings']['custom_labels']['course'] || 'course' ) }
									help={ sprintf( _x( '%s ID (required)', 'learndash' ), ldlms_settings['settings']['custom_labels']['course'] || 'course' ) }
									value={ course_id || '' }
									onChange={ course_id => setAttributes( { course_id } ) }
								/>
                            </PanelRow>
                        </PanelBody>
                    </InspectorControls>
                ),
				<div className={ className }>
				<InnerBlocks />
				</div>
            ];
        },
		
        save: props => {
			//const { attributes: { courseID },
        	//	className, setAttributes } = props;
			
			return (
				//<div
                //className={ className }
				//>
				<InnerBlocks.Content />
				//</div>
			);
		}
	},
);
