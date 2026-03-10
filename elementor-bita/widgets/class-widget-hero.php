<?php
namespace BITA\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Hero extends Widget_Base {

    public function get_name()       { return 'bita-hero'; }
    public function get_title()      { return __( 'BITA – Hero', 'bita' ); }
    public function get_icon()       { return 'eicon-banner'; }
    public function get_categories() { return [ 'bita' ]; }

    protected function register_controls() {

        /* ── Content ── */
        $this->start_controls_section( 'sec_content', [
            'label' => __( 'Content', 'bita' ),
        ] );

        $this->add_control( 'label', [
            'label'   => __( 'Page label', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'About Us',
        ] );

        $this->add_control( 'heading', [
            'label'   => __( 'Heading', 'bita' ),
            'type'    => Controls_Manager::TEXTAREA,
            'default' => "Michael Osacky:\nYour Trusted Sports Memorabilia Appraiser",
            'rows'    => 3,
        ] );

        $this->add_control( 'subtext', [
            'label'   => __( 'Subtext', 'bita' ),
            'type'    => Controls_Manager::TEXTAREA,
            'default' => 'Michael Osacky is an ISA-accredited, USPAP-compliant appraiser and Lead Appraiser at PSA, providing independent, formal appraisal reports for sports cards and memorabilia across all major sports.',
            'rows'    => 4,
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

        /* ── Image ── */
        $this->start_controls_section( 'sec_image', [
            'label' => __( 'Memorabilia Image', 'bita' ),
        ] );

        $this->add_control( 'hero_image', [
            'label'       => __( 'Image', 'bita' ),
            'type'        => Controls_Manager::MEDIA,
            'description' => __( 'Displayed rotated on the right side of the hero.', 'bita' ),
        ] );

        $this->end_controls_section();
    }

    protected function render() {
        $s   = $this->get_settings_for_display();
        $url = ! empty( $s['cta_url']['url'] ) ? esc_url( $s['cta_url']['url'] ) : '#';
        $img = ! empty( $s['hero_image']['url'] ) ? esc_url( $s['hero_image']['url'] ) : '';

        // Convert newlines in heading to <br>
        $heading = nl2br( esc_html( $s['heading'] ) );
        ?>
        <section class="bita-hero">
            <div class="bita-hero__panels">
                <div class="bita-hero__panel-dark"></div>
                <div class="bita-hero__panel-cream"></div>
            </div>

            <?php if ( $img ) : ?>
            <div class="bita-hero__img-wrap">
                <img src="<?php echo $img; ?>" alt="Sports memorabilia" />
            </div>
            <?php endif; ?>

            <div class="bita-hero__content">
                <p class="bita-hero__label"><?php echo esc_html( $s['label'] ); ?></p>
                <div class="bita-hero__heading-wrap">
                    <h1 class="bita-hero__heading"><?php echo $heading; ?></h1>
                    <p class="bita-hero__subtext"><?php echo esc_html( $s['subtext'] ); ?></p>
                    <a href="<?php echo $url; ?>" class="bita-btn-pill"><?php echo esc_html( $s['cta_text'] ); ?></a>
                </div>
            </div>
        </section>
        <?php
    }
}
