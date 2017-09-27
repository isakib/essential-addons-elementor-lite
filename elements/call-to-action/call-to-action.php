<?php 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Widget_Eael_Cta_Box extends Widget_Base {

	public function get_name() {
		return 'eael-cta-box';
	}

	public function get_title() {
		return esc_html__( 'EA Call to Action', 'essential-addons-elementor' );
	}

	public function get_icon() {
		return 'fa fa-paper-plane-o';
	}

   public function get_categories() {
		return [ 'essential-addons-elementor' ];
	}
	
	protected function _register_controls() {

  		/**
  		 * Infobox Image Settings
  		 */
  		$this->start_controls_section(
  			'eael_section_cta_content_settings',
  			[
  				'label' => esc_html__( 'Content Settings', 'essential-addons-elementor' )
  			]
  		);

  		$this->add_control(
		  'eael_cta_type',
		  	[
		   	'label'       	=> esc_html__( 'Content Style', 'essential-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'cta-basic',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'cta-basic'  		=> esc_html__( 'Basic', 'essential-addons-elementor' ),
		     		'cta-flex' 			=> esc_html__( 'Flex Grid', 'essential-addons-elementor' ),
		     		'cta-icon-flex' 	=> esc_html__( 'Flex Grid with Icon', 'essential-addons-elementor' ),
		     	],
		  	]
		);

  		/**
  		 * Condition: 'eael_cta_type' => 'cta-basic'
  		 */
		$this->add_control(
		  'eael_cta_content_type',
		  	[
		   	'label'       	=> esc_html__( 'Content Type', 'essential-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'cta-default',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'cta-default'  	=> esc_html__( 'Default', 'essential-addons-elementor' ),
		     		'cta-center' 		=> esc_html__( 'Center', 'essential-addons-elementor' ),
		     	],
		     	'condition'    => [
		     		'eael_cta_type' => 'cta-basic'
		     	]
		  	]
		);

		$this->add_control(
		  'eael_cta_color_type',
		  	[
		   	'label'       	=> esc_html__( 'Color Style', 'essential-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'cta-lite',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'cta-lite'  		=> esc_html__( 'Lite', 'essential-addons-elementor' ),
		     		'cta-dark' 			=> esc_html__( 'Dark', 'essential-addons-elementor' ),
		     		'cta-bg-img' 		=> esc_html__( 'Background Image', 'essential-addons-elementor' ),
		     		'cta-bg-img-fixed' => esc_html__( 'Background Fixed Image', 'essential-addons-elementor' ),
		     	],
		  	]
		);

		/**
		 * Condition: 'eael_cta_type' => 'cta-icon-flex'
		 */
		$this->add_control(
			'eael_cta_flex_grid_icon',
			[
				'label' => esc_html__( 'Icon', 'essential-addons-elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-bullhorn',
				'condition' => [
					'eael_cta_type' => 'cta-icon-flex'
				]
			]
		);

		$this->add_control( 
			'eael_cta_title',
			[
				'label' => esc_html__( 'Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'The Ultimate Addons For Elementor', 'essential-addons-elementor' )
			]
		);
		$this->add_control( 
			'eael_cta_content',
			[
				'label' => esc_html__( 'Content', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( 'Add a strong one liner supporting the heading above and giving users a reason to click on the button below.', 'essential-addons-elementor' ),
				'separator' => 'after'
			]
		);

		$this->add_control( 
			'eael_cta_btn_text',
			[
				'label' => esc_html__( 'Button Text', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Button Text', 'essential-addons-elementor' )
			]
		);

		$this->add_control( 
			'eael_cta_btn_link',
			[
				'label' => esc_html__( 'Button Link', 'essential-addons-elementor' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
        			'url' => 'http://',
        			'is_external' => '',
     			],
     			'show_external' => true,
     			'separator' => 'after'
			]
		);

		/**
		 * Condition: 'eael_cta_color_type' => 'cta-bg-img' && 'eael_cta_color_type' => 'cta-bg-img-fixed',
		 */
		$this->add_control(
			'eael_cta_bg_image',
			[
				'label' => esc_html__( 'Background Image', 'essential-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'selectors' => [
            	'{{WRAPPER}} .eael-call-to-action.bg-img' => 'background-image: url({{URL}});',
            	'{{WRAPPER}} .eael-call-to-action.bg-img-fixed' => 'background-image: url({{URL}});',
        		],
				'condition' => [
					'eael_cta_color_type' => [ 'cta-bg-img', 'cta-bg-img-fixed' ],
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Cta Title Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'eael_section_cta_title_style_settings',
			[
				'label' => esc_html__( 'Title Typography &amp; Color', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'eael_cta_title_typography',
				'selector' => '{{WRAPPER}} .eael-call-to-action .title',
			]
		);

		$this->add_control(
			'eael_cta_title_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eael-call-to-action .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Cta Content Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'eael_section_cta_content_style_settings',
			[
				'label' => esc_html__( 'Content Typography &amp; Color', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'eael_cta_content_typography',
				'selector' => '{{WRAPPER}} .eael-call-to-action p',
			]
		);

		$this->add_control(
			'eael_cta_content_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eael-call-to-action p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Buttont Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'eael_section_cta_btn_style_settings',
			[
				'label' => esc_html__( 'Button Style', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
		  'eael_cta_btn_effect_type',
		  	[
		   	'label'       	=> esc_html__( 'Effect', 'essential-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'default',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'default'  			=> esc_html__( 'Default', 'essential-addons-elementor' ),
		     		'left-to-right'  	=> esc_html__( 'Left to Right', 'essential-addons-elementor' ),
		     	],
		  	]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'eael_cta_btn_typography',
				'selector' => '{{WRAPPER}} .eael-call-to-action .cta-button',
			]
		);

		$this->add_control(
			'eael_cta_btn_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f9f9f9',
				'selectors' => [
					'{{WRAPPER}} .eael-call-to-action .cta-button' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'eael_cta_btn_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#3F51B5',
				'selectors' => [
					'{{WRAPPER}} .eael-call-to-action .cta-button:after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}


	protected function render( ) {
		
   	$settings = $this->get_settings();
      $infobox_image = $this->get_settings( 'eael_infobox_image' );
	  	$infobox_image_url = Group_Control_Image_Size::get_attachment_image_src( $infobox_image['id'], 'thumbnail', $settings );	
	  	$target = $settings['eael_cta_btn_link']['url'] ? 'target="_blank"' : '';
	  	if( 'cta-lite' == $settings['eael_cta_color_type'] ) {
	  		$cta_class = 'bg-lite';
	  	}else if( 'cta-dark' == $settings['eael_cta_color_type'] ) {
	  		$cta_class = 'bg-dark';
	  	}else if( 'cta-bg-img' == $settings['eael_cta_color_type'] ) {
	  		$cta_class = 'bg-img';
	  	}else if( 'cta-bg-img-fixed' == $settings['eael_cta_color_type'] ) {
	  		$cta_class = 'bg-img bg-fixed';
	  	}
	  	// Is Basic Cta Content Center or Not
	  	if( 'cta-center' == $settings['eael_cta_content_type'] ) {
	  		$cta_center = 'cta-center';
	  	}else {
	  		$cta_center = '';
	  	}
	  	// Button Effect
	  	if( 'left-to-right' == $settings['eael_cta_btn_effect_type'] ) {
	  		$cta_btn_effect = 'effect-2';
	  	}else {
	  		$cta_btn_effect = '';
	  	}
	
	?>
	<?php if( 'cta-basic' == $settings['eael_cta_type'] ) : ?>
	<div class="eael-call-to-action <?php echo esc_attr( $cta_class ); ?> <?php echo esc_attr( $cta_center ); ?>">
	    <h2 class="title"><?php echo $settings['eael_cta_title']; ?></h2>
	    <p><?php echo $settings['eael_cta_content']; ?></p>
	    <a href="<?php echo esc_url( $settings['eael_cta_btn_link']['url'] ); ?>" <?php echo $target; ?> class="cta-button <?php echo esc_attr( $cta_btn_effect ); ?>"><?php esc_html_e( $settings['eael_cta_btn_text'], 'essential-addons-elementor' ); ?></a>
	</div>		
	<?php endif; ?>
	<?php if( 'cta-flex' == $settings['eael_cta_type'] ) : ?>
	<div class="eael-call-to-action cta-flex <?php echo esc_attr( $cta_class ); ?>">
	    <div class="content">
	        <h2 class="title"><?php echo $settings['eael_cta_title']; ?></h2>
	        <p><?php echo $settings['eael_cta_content']; ?></p>
	    </div>
	    <div class="action">
	        <a href="<?php echo esc_url( $settings['eael_cta_btn_link']['url'] ); ?>" <?php echo $target; ?> class="cta-button <?php echo esc_attr( $cta_btn_effect ); ?>"><?php esc_html_e( $settings['eael_cta_btn_text'], 'essential-addons-elementor' ); ?></a>
	    </div>
	</div>
	<?php endif; ?>
	<?php if( 'cta-icon-flex' == $settings['eael_cta_type'] ) : ?>
	<div class="eael-call-to-action cta-icon-flex <?php echo esc_attr( $cta_class ); ?>">
	    <div class="icon">
	        <i class="<?php echo esc_attr( $settings['eael_cta_flex_grid_icon'] ); ?>"></i>
	    </div>
	    <div class="content">
	        <h2 class="title"><?php echo $settings['eael_cta_title']; ?></h2>
	        <p><?php echo $settings['eael_cta_content']; ?></p>
	    </div>
	    <div class="action">
	       <a href="<?php echo esc_url( $settings['eael_cta_btn_link']['url'] ); ?>" <?php echo $target; ?> class="cta-button <?php echo esc_attr( $cta_btn_effect ); ?>"><?php esc_html_e( $settings['eael_cta_btn_text'], 'essential-addons-elementor' ); ?></a>
	    </div>
	</div>
	<?php endif; ?>
	<?php
	}

	protected function content_template() {
		
		?>
		
	
		<?php
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_Eael_Cta_Box() );