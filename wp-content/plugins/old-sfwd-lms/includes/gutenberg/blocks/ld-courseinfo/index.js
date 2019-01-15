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
    'learndash/ld-courseinfo',
    {
        title: sprintf( _x( 'LearnDash %s Info', 'LearnDash Course Info', 'learndash' ), ldlms_settings['settings']['custom_labels']['course'] || 'course' ),
        description: sprintf( _x( 'LearnDash %s Info Block', 'LearnDash Course Info Block', 'learndash' ), ldlms_settings['settings']['custom_labels']['course'] || 'course' ),
        //icon: icon,
        category: 'widgets',
        attributes: {
            show: {
                type: 'string',
            },
            course_id: {
                type: 'string',
            },
            user_id: {
                type: 'string',
            },
        },
        edit: props => {
			const { attributes: { show, course_id, user_id },
            	isSelected, className, setAttributes } = props;
			
            return [
				
                isSelected && (
                    <InspectorControls>
                        <PanelBody
                          title={ __( 'Settings', 'learndash' ) }
                        >
						<PanelRow>
							<SelectControl
								key="show"
								label={ __( 'Show', 'learndash' ) }
								options={ [
									{
										label: __('Title', 'learndash'),
										value: 'course_title',
									},
									{
										label: __('Earned Course Points', 'learndash'),
										value: 'course_points',
									},
									{
										label: __('Total User Course Points', 'learndash'),
										value: 'user_course_points',
									},
									{
										label: __('Completed On (date)', 'learndash'),
										value: 'completed_on',
									},
									{
										label: __('Cumulative Score', 'learndash'),
										value: 'cumulative_score',
									},
									{
										label: __('Cumulative Points', 'learndash'),
										value: 'cumulative_points',
									},
									{
										label: __('Possible Cumulative Total Points', 'learndash'),
										value: 'cumulative_total_points',
									},
									{
										label: __('Cumulative Percentage', 'learndash'),
										value: 'cumulative_percentage',
									},
									{
										label: __('Cumulative Time Spent', 'learndash'),
										value: 'cumulative_timespent',
									},
									{
										label: __('Aggregate Percentage', 'learndash'),
										value: 'aggregate_percentage',
									},
									{
										label: __('Aggregate Score', 'learndash'),
										value: 'aggregate_score',
									},
									{
										label: __('Aggregate Points', 'learndash'),
										value: 'aggregate_points',
									},
									{
										label: __('Possible Aggregate Total Points', 'learndash'),
										value: 'aggregate_total_points',
									},
									{
										label: __('Aggregate Time Spent', 'learndash'),
										value: 'aggregate_timespent',
									},


								] }
								onChange={ show => setAttributes( { show } ) }
							/>	
						</PanelRow>
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
				{ __( '[courseinfo] shortcode output shown here', 'learndash' ) }
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
