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
    'learndash/ld-group',
    {
        title: __( 'LearnDash Group', 'learndash' ),
        description: __( 'LearnDash Group Block.', 'learndash'),
        //icon: icon,
        category: 'widgets',
        attributes: {
            group_id: {
                type: 'string',
            },
        },
        edit: props => {
			const { attributes: { group_id },
            	isSelected, className, setAttributes } = props;
			
            return [
				
                isSelected && (
                    <InspectorControls>
                        <PanelBody
                          title={ __( 'Settings', 'learndash' ) }
                        >
                            <PanelRow>
								<TextControl
									label={ __( 'Group ID', 'learndash' ) }
									help={ __( 'Group ID (required)', 'learndash' ) }
									value={ group_id || '' }
									onChange={ group_id => setAttributes( { group_id } ) }
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
			//const { attributes: { course_id },
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
