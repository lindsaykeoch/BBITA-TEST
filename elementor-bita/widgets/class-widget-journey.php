<?php
namespace BITA\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Journey extends Widget_Base {

    public function get_name()       { return 'bita-journey'; }
    public function get_title()      { return __( 'BITA – Journey', 'bita' ); }
    public function get_icon()       { return 'eicon-person'; }
    public function get_categories() { return [ 'bita' ]; }

    protected function register_controls() {

        /* ── Text ── */
        $this->start_controls_section( 'sec_text', [
            'label' => __( 'Text', 'bita' ),
        ] );

        $this->add_control( 'heading', [
            'label'   => __( 'Section heading', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'The Journey Behind My Appraisals',
        ] );

        $this->add_control( 'para_1', [
            'label'   => __( 'Paragraph 1', 'bita' ),
            'type'    => Controls_Manager::TEXTAREA,
            'rows'    => 4,
            'default' => 'The heirloom baseball signed by the Babe himself. The championship ring, heavy in your palm, engraved with a year that became emblematic in your family. Sports history gives collections value. Personal stories give them meaning.',
        ] );

        $this->add_control( 'para_2', [
            'label'   => __( 'Paragraph 2', 'bita' ),
            'type'    => Controls_Manager::TEXTAREA,
            'rows'    => 4,
            'default' => "Michael Osacky's journey began the way many collections do, with a dusty shoebox of baseball cards passed down from his grandfather. He was drawn to the details: why one card could be worth more than another, how condition and provenance shape value, and how each piece found its way into a collection. That early curiosity grew into a lifelong passion for the hobby.",
        ] );

        $this->add_control( 'para_3', [
            'label'   => __( 'Paragraph 3', 'bita' ),
            'type'    => Controls_Manager::TEXTAREA,
            'rows'    => 4,
            'default' => 'Today, Michael is an ISA-accredited, USPAP-compliant appraiser and Lead Appraiser at PSA, providing independent, formal appraisal reports grounded in research, standards, and objectivity. Every collection is approached with care — grounded in research, guided by standards, and fueled by a genuine love of the hobby.',
        ] );

        $this->add_control( 'person_name', [
            'label'   => __( 'Person name', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Michael Osacky',
        ] );

        $this->end_controls_section();

        /* ── Photos ── */
        $this->start_controls_section( 'sec_photos', [
            'label' => __( 'Photo Stack', 'bita' ),
        ] );

        $this->add_control( 'photo_main', [
            'label' => __( 'Main photo (front, portrait)', 'bita' ),
            'type'  => Controls_Manager::MEDIA,
        ] );

        $this->add_control( 'photo_1', [
            'label' => __( 'Background photo 1', 'bita' ),
            'type'  => Controls_Manager::MEDIA,
        ] );

        $this->add_control( 'photo_2', [
            'label' => __( 'Background photo 2', 'bita' ),
            'type'  => Controls_Manager::MEDIA,
        ] );

        $this->add_control( 'photo_3', [
            'label' => __( 'Background photo 3', 'bita' ),
            'type'  => Controls_Manager::MEDIA,
        ] );

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();

        $ph = \Elementor\Utils::get_placeholder_image_src();

        $main = ! empty( $s['photo_main']['url'] ) ? esc_url( $s['photo_main']['url'] ) : $ph;
        $p1   = ! empty( $s['photo_1']['url'] )    ? esc_url( $s['photo_1']['url'] )    : $ph;
        $p2   = ! empty( $s['photo_2']['url'] )    ? esc_url( $s['photo_2']['url'] )    : $ph;
        $p3   = ! empty( $s['photo_3']['url'] )    ? esc_url( $s['photo_3']['url'] )    : $ph;
        ?>
        <section class="bita-journey">
            <h2 class="bita-sec-heading" style="text-align:center;">
                <?php echo esc_html( $s['heading'] ); ?>
            </h2>
            <div class="bita-journey__inner" style="margin-top:80px;">
                <div class="bita-photo-col">
                    <div class="bita-photo-stack">
                        <div class="bita-ps-bg"></div>
                        <img class="bita-ps-1" src="<?php echo $p1; ?>" alt="" />
                        <img class="bita-ps-2" src="<?php echo $p2; ?>" alt="" />
                        <img class="bita-ps-3" src="<?php echo $p3; ?>" alt="" />
                        <img class="bita-ps-main" src="<?php echo $main; ?>" alt="<?php echo esc_attr( $s['person_name'] ); ?>" />
                    </div>
                    <p class="bita-photo-name"><?php echo esc_html( $s['person_name'] ); ?></p>
                </div>
                <div class="bita-journey__text bita-sec-body">
                    <?php foreach ( [ 'para_1', 'para_2', 'para_3' ] as $key ) : ?>
                        <?php if ( ! empty( $s[ $key ] ) ) : ?>
                            <p><?php echo esc_html( $s[ $key ] ); ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
