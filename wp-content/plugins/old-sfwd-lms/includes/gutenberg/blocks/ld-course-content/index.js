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
	 RangeControl,
	 FormToggle,
	 SelectControl,
	 ToggleControl,
	 TextControl
 } = wp.components;

registerBlockType(
    'learndash/ld-course-content',
    {
        title: __( 'LearnDash Course Content', 'learndash' ),
        description: __( 'LearnDash Course Content Block.', 'learndash' ),
        //icon: icon,
        category: 'widgets',
        attributes: {
            course_id: {
                type: 'number',
            },
            per_page: {
                type: 'number',
            },
        },
        edit: props => {
			const { attributes: { course_id, per_page },
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
                            <PanelRow>
								<TextControl
							  		label={ sprintf( _x( '%s per page', 'placeholder: Lessons', 'learndash' ), ldlms_settings['settings']['custom_labels']['lessons'] || 'Lessons' ) }
									value={ per_page || '' }
									type={ 'number' }
									onChange={ per_page => setAttributes( { per_page } ) }
								/>
                            </PanelRow>
                        </PanelBody>
                    </InspectorControls>
                ),
				<div className={ className }>
				{ __( '[course_content] shortcode output shown here', 'learndash' ) }
				</div>
            ];
        },
		
        save: props => {
			//const { attributes: { course_id },
        	//	className, setAttributes } = props;
			
			//return (
				//<div
                //className={ className }
				//>
				//<InnerBlocks.Content />
				//</div>
			//);
		}
	},
);
