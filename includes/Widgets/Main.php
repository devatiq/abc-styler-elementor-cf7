<?php
namespace includes\Widgets\ABCCF7;

use Inc\Widgets\BaseWidget;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

class Main extends BaseWidget
{

    // define protected variables...
    protected $name = 'ABC-ABCCF7';
    protected $title = 'ABC Contact Form 7';
    protected $icon = 'eicon-form-horizontal';
    protected $categories = [
        'basic'
    ];
    protected $keywords = [
        'contact form 7',
        'cf7',
        'contact form',
        'form',
        'contact',
        'abc contact form 7',
        'abc cf7',
        'abc contact form',
        'abc form',
        'abc contact'
    ];


    /**
     * Get Contact Form 7 Shortcodes
     * Retrieves a list of Contact Form 7 shortcodes.
     *
     * @return array
     */
    private function get_contact_form_shortcodes()
    {
        $formlist = array();
        $forms_args = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
        $forms = get_posts($forms_args);
        if ($forms) {
            foreach ($forms as $form) {
                $formlist[$form->ID] = $form->post_title;
            }
        } else {
            $formlist['0'] = esc_html__('Form not found', 'abccf7');
        }
        return $formlist;
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'abc_elementor_contact_form_setting',
            [
                'label' => __('Contact Form 7 Setting', 'abccf7'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Contact Form 7 Shortcode Dropdown
        $this->add_control(
            'abc_ele_contact_form_shortcode',
            [
                'label' => __('Select Form', 'abccf7'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_contact_form_shortcodes(),
            ]
        );

        // end of Contact form section
        $this->end_controls_section();

        // start of Contact Form input style section
        $this->start_controls_section(
            'abc_elementor_cf7_input_style_setting',
            [
                'label' => __('Input', 'abccf7'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // contact form 7 label typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'abc_ele_cf7_label_typography',
                'label' => __('Label Typography', 'abccf7'),
                'selector' => '{{WRAPPER}} #abc-ele-contact-form-wrapper form label',
            ]
        );
        // contact form 7 label text color
        $this->add_control(
            'abc_ele_cf7_label_text_color',
            [
                'label' => __('Label Text Color', 'abccf7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper form label' => 'color: {{VALUE}};',
                ],
            ]
        );
        // contact form 7 input field gap
        $this->add_responsive_control(
            'abc_ele_cf7_input_gap',
            [
                'label' => __('Input Gap', 'abccf7'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper form label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // contact form 7 input field height
        $this->add_responsive_control(
            'abc_ele_cf7_input_height',
            [
                'label' => __('Height', 'abccf7'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap input' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // contact form 7 input field width
        $this->add_responsive_control(
            'abc_ele_cf7_input_width',
            [
                'label' => __('Width', 'abccf7'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap input' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // contact form 7 input field border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'abc_ele_cf7_input_border',
                'label' => __('Border', 'abccf7'),
                'selector' => '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap input',
            ]
        );
        // contact form 7 input field border radius
        $this->add_responsive_control(
            'abc_ele_cf7_input_border_radius',
            [
                'label' => __('Border Radius', 'abccf7'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // contact form 7 input field padding
        $this->add_responsive_control(
            'abc_ele_cf7_input_padding',
            [
                'label' => __('Padding', 'abccf7'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // contact form 7 input field margin
        $this->add_responsive_control(
            'abc_ele_cf7_input_margin',
            [
                'label' => __('Margin', 'abccf7'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // contact form 7 input field text color
        $this->add_control(
            'abc_ele_cf7_input_text_color',
            [
                'label' => __('Text Color', 'abccf7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap input' => 'color: {{VALUE}};',
                ],
            ]
        );
        // contact form 7 input field background color
        $this->add_control(
            'abc_ele_cf7_input_bg_color',
            [
                'label' => __('Background Color', 'abccf7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap input' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        // contact form 7 input field placeholder color
        $this->add_control(
            'abc_ele_cf7_input_placeholder_color',
            [
                'label' => __('Placeholder Color', 'abccf7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap input::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}}  #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap input::-moz-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}}  #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap input:-ms-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}}  #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap input::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );
        // contact form 7 input field focus text color
        $this->add_control(
            'abc_ele_cf7_input_focus_text_color',
            [
                'label' => __('Focus Text Color', 'abccf7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap input:focus' => 'color: {{VALUE}};',
                ],
            ]
        );
        // contact form 7 input field focus background color
        $this->add_control(
            'abc_ele_cf7_input_focus_bg_color',
            [
                'label' => __('Focus Background Color', 'abccf7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap input:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // end of Contact Form input style section
        $this->end_controls_section();

        //Contact Form textarea style section
        $this->start_controls_section(
            'abc_elementor_cf7_textarea_style_setting',
            [
                'label' => __('Textarea', 'abccf7'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // contact form 7 textarea field height
        $this->add_responsive_control(
            'abc_ele_cf7_textarea_height',
            [
                'label' => __('Height', 'abccf7'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // contact form 7 textarea field width
        $this->add_responsive_control(
            'abc_ele_cf7_textarea_width',
            [
                'label' => __('Width', 'abccf7'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // contact form 7 textarea field border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'abc_ele_cf7_textarea_border',
                'label' => __('Border', 'abccf7'),
                'selector' => '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea',
            ]
        );
        // contact form 7 textarea field border radius
        $this->add_responsive_control(
            'abc_ele_cf7_textarea_border_radius',
            [
                'label' => __('Border Radius', 'abccf7'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // contact form 7 textarea field padding
        $this->add_responsive_control(
            'abc_ele_cf7_textarea_padding',
            [
                'label' => __('Padding', 'abccf7'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // contact form 7 textarea field margin
        $this->add_responsive_control(
            'abc_ele_cf7_textarea_margin',
            [
                'label' => __('Margin', 'abccf7'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // contact form 7 textarea field text color
        $this->add_control(
            'abc_ele_cf7_textarea_text_color',
            [
                'label' => __('Text Color', 'abccf7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea' => 'color: {{VALUE}};',
                ],
            ]
        );
        // contact form 7 textarea field background color
        $this->add_control(
            'abc_ele_cf7_textarea_bg_color',
            [
                'label' => __('Background Color', 'abccf7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        // contact form 7 textarea field placeholder color
        $this->add_control(
            'abc_ele_cf7_textarea_placeholder_color',
            [
                'label' => __('Placeholder Color', 'abccf7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}}  #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea::-moz-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}}  #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea:-ms-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}}  #abc-ele-contact-form-wrapper .wpcf7-form-control-wrap textarea::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );



        // end of Contact Form textarea style section
        $this->end_controls_section();


        //Contact Form radio field style section
        $this->start_controls_section(
            'abc_elementor_cf7_radio_style_setting',
            [
                'label' => __('Radio & Checkbox', 'abccf7'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // contact form 7 radio field label typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'abc_ele_cf7_radio_label_typography',
                'label' => __('Typography', 'abccf7'),
                'selector' => '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-list-item-label',

            ]
        );
        // contact form 7 radio field label color
        $this->add_control(
            'abc_ele_cf7_radio_label_color',
            [
                'label' => __('Label Color', 'abccf7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-list-item-label' => 'color: {{VALUE}};',
                ]
            ]
        );
        // contact form 7 radio field label gap
        $this->add_responsive_control(
            'abc_ele_cf7_radio_label__item_gap',
            [
                'label' => __('Item Gap', 'abccf7'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-list-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        //contact form 7 radio and checkbox label gap
        $this->add_responsive_control(
            'abc_ele_cf7_radio_checkbox_label_gap',
            [
                'label' => __('Label Gap', 'abccf7'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-list-item label' => 'gap: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        //input size
        $this->add_responsive_control(
            'abc_ele_cf7_radio_checkbox_input_size',
            [
                'label' => __('Input Size', 'abccf7'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control.wpcf7-checkbox .wpcf7-list-item input[type="checkbox"] ' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control.wpcf7-radio .wpcf7-list-item input[type="radio"]' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .wpcf7-form-control.wpcf7-acceptance .wpcf7-list-item input[type="checkbox"]' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        // end of Contact Form radio field label
        $this->end_controls_section();


        //Contact Form submit button style section
        $this->start_controls_section(
            'abc_elementor_cf7_submit_button_style_setting',
            [
                'label' => __('Submit Button', 'abccf7'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // contact form 7 submit button alignment
        $this->add_responsive_control(
            'abc_ele_cf7_submit_button_alignment',
            [
                'label' => __('Alignment', 'abccf7'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'abccf7'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'abccf7'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'abccf7'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper .abc-ele-contact-form-submit' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        // contact form 7 submit button field typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'abc_ele_cf7_submit_button_typography',
                'label' => __('Typography', 'abccf7'),
                'selector' => '{{WRAPPER}} #abc-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit',
            ]
        );

        // contact form 7 submit button field padding
        $this->add_responsive_control(
            'abc_ele_cf7_submit_button_padding',
            [
                'label' => __('Padding', 'abccf7'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // contact form 7 submit button field margin
        $this->add_responsive_control(
            'abc_ele_cf7_submit_button_margin',
            [
                'label' => __('Margin', 'abccf7'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // contact form 7 submit button field text color
        $this->add_control(
            'abc_ele_cf7_submit_button_text_color',
            [
                'label' => __('Text Color', 'abccf7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit' => 'color: {{VALUE}};',
                ],
            ]
        );
        // contact form 7 submit button field background color
        $this->add_control(
            'abc_ele_cf7_submit_button_bg_color',
            [
                'label' => __('Background Color', 'abccf7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        // contact form 7 submit button field border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'abc_ele_cf7_submit_button_border',
                'label' => __('Border', 'abccf7'),
                'selector' => '{{WRAPPER}} #abc-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit',
            ]
        );
        // contact form 7 submit button field border radius
        $this->add_responsive_control(
            'abc_ele_cf7_submit_button_border_radius',
            [
                'label' => __('Border Radius', 'abccf7'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // contact form 7 submit button field hover text color
        $this->add_control(
            'abc_ele_cf7_submit_button_hover_text_color',
            [
                'label' => __('Hover Text Color', 'abccf7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        // contact form 7 submit button field hover background color
        $this->add_control(
            'abc_ele_cf7_submit_button_hover_bg_color',
            [
                'label' => __('Hover Background Color', 'abccf7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        // contact form 7 submit button field hover border color
        $this->add_control(
            'abc_ele_cf7_submit_button_hover_border_color',
            [
                'label' => __('Hover Border Color', 'abccf7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #abc-ele-contact-form-wrapper input[type="submit"].wpcf7-form-control.wpcf7-submit:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        // end of Contact Form submit button style section
        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        //load render view to show widget output on frontend/website.
        include 'RenderView.php';
    }
}