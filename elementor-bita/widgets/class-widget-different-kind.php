<?php
namespace BITA\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Different_Kind extends Widget_Base {

    public function get_name()       { return 'bita-different-kind'; }
    public function get_title()      { return __( 'BITA – Different Kind', 'bita' ); }
    public function get_icon()       { return 'eicon-image-hotspot'; }
    public function get_categories() { return [ 'bita' ]; }

    protected function register_controls() {

        $this->start_controls_section( 'sec_text', [
            'label' => __( 'Text', 'bita' ),
        ] );

        $this->add_control( 'heading', [
            'label'   => __( 'Section heading', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'A Different Kind of Appraisal Experience',
        ] );

        $this->add_control( 'para_1', [
            'label'   => __( 'Paragraph 1', 'bita' ),
            'type'    => Controls_Manager::TEXTAREA,
            'rows'    => 4,
            'default' => 'The typical sports collection appraisal process is rushed, anonymous, and influenced by competing incentives. Speed and volume are priorities, and in many cases, the party assigning value is also positioned to benefit from a future transaction, compromising objectivity. Baseball in the Attic was built differently.',
        ] );

        $this->add_control( 'para_2', [
            'label'   => __( 'Paragraph 2', 'bita' ),
            'type'    => Controls_Manager::TEXTAREA,
            'rows'    => 4,
            'default' => 'Michael Osacky operates as a one-person, independent practice by design. From the first conversation through the in-person evaluation and the final written report, you work directly with him. Most appraisals are conducted on site, allowing collections to be examined carefully and in context. He does not buy, sell, or consign memorabilia. The focus remains on thoughtful analysis, clear communication, and delivering grounded, defensible appraisals you can rely on.',
        ] );

        $this->end_controls_section();

        $this->start_controls_section( 'sec_card', [
            'label' => __( 'Card Image', 'bita' ),
        ] );

        $this->add_control( 'card_image', [
            'label'       => __( 'Baseball card image', 'bita' ),
            'type'        => Controls_Manager::MEDIA,
            'description' => __( 'Displayed twice — once straight, once rotated 5°.', 'bita' ),
        ] );

        $this->end_controls_section();
    }

    protected function render() {
        $s    = $this->get_settings_for_display();
        $card = ! empty( $s['card_image']['url'] )
                ? esc_url( $s['card_image']['url'] )
                : \Elementor\Utils::get_placeholder_image_src();
        ?>
        <section>
            <h2 class="bita-sec-heading" style="text-align:center; margin-bottom:80px;">
                <?php echo esc_html( $s['heading'] ); ?>
            </h2>
            <div class="bita-diff__inner">
                <div class="bita-diff__text bita-sec-body">
                    <?php foreach ( [ 'para_1', 'para_2' ] as $key ) : ?>
                        <?php if ( ! empty( $s[ $key ] ) ) : ?>
                            <p><?php echo esc_html( $s[ $key ] ); ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="bita-card-stack">
                    <img class="bita-card-back"  src="<?php echo $card; ?>" alt="Baseball card" />
                    <img class="bita-card-front" src="<?php echo $card; ?>" alt="Baseball card" />
                </div>
            </div>
        </section>
        <?php
    }
}
