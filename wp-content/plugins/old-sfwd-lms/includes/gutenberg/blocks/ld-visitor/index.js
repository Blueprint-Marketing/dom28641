/**
 * Block dependencies
 */
import classnames from 'classnames';
//import icon from './icon';
import './style.scss';

//import ldlms from 'ldlms';
//console.log('ldlms[%o]', ldlms);

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
    'learndash/ld-visitor',
    {
        title: __( 'LearnDash Visitor', 'learndash' ),
        description: sprintf( _x( 'This shortcode shows the content if the user is not enrolled in the %s. The shortcode can be used on any page or widget area.', 'placeholders: course', 'learndash'), 
		ldlms_settings['settings']['custom_labels']['course'] || 'course' ),
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
									label={ sprintf( _x( '%s ID', 'placeholder: Course', 'learndash' ), ldlms_settings['settings']['custom_labels']['course'] || 'course' ) }
									help={ sprintf( _x( 'Enter single %1$s ID. Leave blank for current %2$s.', 'placeholders: Course, Course', 'learndash' ), 
										ldlms_settings['settings']['custom_labels']['course'] || 'course', ldlms_settings['settings']['custom_labels']['course'] || 'course' ) }
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
			const { attributes: { course_id },
        		className, setAttributes } = props;
			
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
