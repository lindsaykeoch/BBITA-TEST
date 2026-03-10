<?php
namespace BITA\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Ready extends Widget_Base {

    public function get_name()       { return 'bita-ready'; }
    public function get_title()      { return __( 'BITA – Ready To Talk', 'bita' ); }
    public function get_icon()       { return 'eicon-call-to-action'; }
    public function get_categories() { return [ 'bita' ]; }

    protected function register_controls() {

        $this->start_controls_section( 'sec_content', [
            'label' => __( 'Content', 'bita' ),
        ] );

        $this->add_control( 'heading', [
            'label'   => __( 'Heading', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Ready to Talk?',
        ] );

        $this->add_control( 'body', [
            'label'   => __( 'Body text', 'bita' ),
            'type'    => Controls_Manager::TEXTAREA,
            'rows'    => 5,
            'default' => 'If you have questions about a sports card collection or the appraisal process itself, you\'re welcome to reach out. Whether you\'re navigating inheritance, insurance, legal matters, or simply want clarity around what you have, we\'re happy to connect. No obligation, just a direct conversation about your collection and the appropriate next step.',
        ] );

        $this->add_control( 'cta_text', [
            'label'   => __( 'Button text', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Start Your Appraisal',
        ] );

        $this->add_control( 'cta_url', [
            'label'   => __( 'Button URL', 'bita' ),
            'type'    => Controls_Manager::URL,
            'default' => [ 'url' => '#' ],
        ] );

        $this->end_controls_section();

        $this->start_controls_section( 'sec_bg', [
            'label' => __( 'Background Texture', 'bita' ),
        ] );

        $this->add_control( 'texture_image', [
            'label'       => __( 'Paper texture image', 'bita' ),
            'type'        => Controls_Manager::MEDIA,
            'description' => __( 'Overlay blended with luminosity.', 'bita' ),
        ] );

        $this->end_controls_section();
    }

    protected function render() {
        $s       = $this->get_settings_for_display();
        $url     = ! empty( $s['cta_url']['url'] ) ? esc_url( $s['cta_url']['url'] ) : '#';
        $texture = ! empty( $s['texture_image']['url'] ) ? esc_url( $s['texture_image']['url'] ) : '';
        ?>
        <section class="bita-ready">
            <?php if ( $texture ) : ?>
            <div class="bita-ready__texture">
                <img src="<?php echo $texture; ?>" alt="" />
            </div>
            <?php endif; ?>

            <div class="bita-ready__left">
                <h2><?php echo esc_html( $s['heading'] ); ?></h2>
                <a href="<?php echo $url; ?>" class="bita-btn-pill">
                    <?php echo esc_html( $s['cta_text'] ); ?>
                </a>
            </div>

            <p class="bita-ready__right">
                <?php echo esc_html( $s['body'] ); ?>
            </p>
        </section>
        <?php
    }
}
