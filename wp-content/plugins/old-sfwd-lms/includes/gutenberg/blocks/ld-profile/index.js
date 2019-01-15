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
    'learndash/ld-profile',
    {
        title: __( 'LearnDash Profile', 'learndash' ),
        description: __( 'LearnDash Profile Block.', 'learndash' ),
        //icon: icon,
        category: 'widgets',
        attributes: {
            per_page: {
                type: 'number',
            },
            orderby: {
                type: 'string',
            },
            order: {
                type: 'string',
            },
            course_points_user: {
                type: 'boolean',
            },
            expand_all: {
                type: 'boolean',
            },
        },
        edit: props => {
			const { attributes: { per_page, orderby, order, course_points_user, expand_all },
            	isSelected, className, setAttributes } = props;
			
            return [
				
                isSelected && (
                    <InspectorControls>
                        <PanelBody
                          title={ __( 'Settings', 'learndash' ) }
                        >
                            <PanelRow>
								<TextControl
							  		label={ sprintf( _x( '%s per page', 'placeholder: Courses', 'learndash' ), ldlms_settings['settings']['custom_labels']['courses'] || 'Courses' ) }
									value={ per_page || '' }
									type={ 'number' }
									onChange={ per_page => setAttributes( { per_page } ) }
								/>
                            </PanelRow>
							<PanelRow>
								<SelectControl
									key="orderby"
									label={ __( 'Order by', 'learndash' ) }
									//value={ `${ orderBy }/${ order }` }
									options={ [
										{
											label: __('ID - Order by post id. (default)', 'learndash'),
											value: 'ID',
										},
										{
											label: __('Title - Order by post title', 'learndash'),
											value: 'title',
										},
										{
											/* translators: label for ordering posts by title in ascending order */
											label: __('Date - Order by post date', 'learndash'),
											value: 'date',
										},
										{
											/* translators: label for ordering posts by title in descending order */
											label: __('Menu - Order by Page Order Value', 'learndash'),
											value: 'menu_order',
										}
									] }
									onChange={ orderby => setAttributes( { orderby } ) }
								/>	
							</PanelRow>
							<PanelRow>
								<SelectControl
									key="orderby"
									label={ __( 'Order', 'learndash' ) }
									//value={ `${ orderBy }/${ order }` }
									options={ [
										{
											label: __('DESC - highest to lowest values (default)', 'learndash'),
											value: 'DESC',
										},
										{
											label: __('ASC - lowest to highest values', 'learndash'),
											value: 'ASC',
										},
									] }
									onChange={ order => setAttributes( { order } ) }
								/>	
							</PanelRow>
							<PanelRow>
			                    <ToggleControl
			                        label={ sprintf( _x('Show Earned %s Points', 'placeholder: Course', 'learndash'), ldlms_settings['settings']['custom_labels']['course'] || 'Course' ) }
			                        checked={ course_points_user }
			                        onChange={ course_points_user => setAttributes( { course_points_user } ) }
			                    />
							</PanelRow>
							<PanelRow>
			                    <ToggleControl
			                        label={ sprintf( _x('Expand All %s Sections', 'placeholder: Course', 'learndash'), ldlms_settings['settings']['custom_labels']['course'] || 'Course' ) }
			                        checked={ expand_all }
			                        onChange={ expand_all => setAttributes( { expand_all } ) }
			                    />
							</PanelRow>
                        </PanelBody>
                    </InspectorControls>
                ),
				<div className={ className }>
				{ __( '[ld_profile] shortcode output shown here', 'learndash' ) }
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
				//<InnerBlocks.Content />
				//</div>
			//);
		}
	},
);
