<?php
namespace BITA\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Who extends Widget_Base {

    public function get_name()       { return 'bita-who'; }
    public function get_title()      { return __( 'BITA – Who We Work With', 'bita' ); }
    public function get_icon()       { return 'eicon-users-middle'; }
    public function get_categories() { return [ 'bita' ]; }

    protected function register_controls() {

        $this->start_controls_section( 'sec_intro', [
            'label' => __( 'Intro', 'bita' ),
        ] );

        $this->add_control( 'heading', [
            'label'   => __( 'Heading', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Who We Work With',
        ] );

        $this->add_control( 'intro_text', [
            'label'   => __( 'Intro text', 'bita' ),
            'type'    => Controls_Manager::TEXTAREA,
            'rows'    => 3,
            'default' => 'Baseball in the Attic works with people facing important decisions around sports memorabilia — from inheritance and insurance to legal matters and long-term planning.',
        ] );

        $this->end_controls_section();

        /* ── Cards ── */
        $this->start_controls_section( 'sec_cards', [
            'label' => __( 'Cards', 'bita' ),
        ] );

        $repeater = new Repeater();

        $repeater->add_control( 'title', [
            'label'   => __( 'Title', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Card Title',
        ] );

        $repeater->add_control( 'body', [
            'label'   => __( 'Body text', 'bita' ),
            'type'    => Controls_Manager::TEXTAREA,
            'rows'    => 3,
            'default' => 'Description of who this serves.',
        ] );

        $this->add_control( 'cards', [
            'label'       => __( 'Cards (6, displayed 3 per row)', 'bita' ),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'title_field' => '{{{ title }}}',
            'default'     => [
                [ 'title' => 'Estate Planning & Inheritance',     'body' => 'Appraisals for inherited or long-held collections, providing clarity before estate decisions are made.' ],
                [ 'title' => 'Insurance Coverage',                'body' => 'Documented valuations to support insurance coverage, updated policy limits, and future claims.' ],
                [ 'title' => 'Legal & Divorce Matters',           'body' => 'Independent, well-documented appraisals prepared for asset division, litigation, or formal review.' ],
                [ 'title' => 'Donation Planning',                 'body' => 'Valuations for charitable contributions, museums, or institutional gifts.' ],
                [ 'title' => 'Professional Advisors',             'body' => 'Independent sports memorabilia appraisals supporting attorneys, fiduciaries, and financial professionals.' ],
                [ 'title' => 'Athletes & Legacy Families',        'body' => 'Discreet, objective valuation of collections tied to public legacy or personal family history.' ],
            ],
        ] );

        $this->end_controls_section();

        /* ── Decorative image ── */
        $this->start_controls_section( 'sec_decor', [
            'label' => __( 'Decorative Image', 'bita' ),
        ] );

        $this->add_control( 'decor_image', [
            'label'       => __( 'Yankees / baseball image', 'bita' ),
            'type'        => Controls_Manager::MEDIA,
            'description' => __( 'Displayed faintly in the top-right corner, rotated.', 'bita' ),
        ] );

        $this->end_controls_section();
    }

    protected function render() {
        $s     = $this->get_settings_for_display();
        $decor = ! empty( $s['decor_image']['url'] ) ? esc_url( $s['decor_image']['url'] ) : '';

        // Split cards into rows of 3
        $cards    = $s['cards'];
        $rows     = array_chunk( $cards, 3 );
        ?>
        <section class="bita-who">
            <?php if ( $decor ) : ?>
            <div class="bita-decor-yankees">
                <img src="<?php echo $decor; ?>" alt="" />
            </div>
            <?php endif; ?>

            <div class="bita-who__intro">
                <h2 class="bita-sec-heading"><?php echo esc_html( $s['heading'] ); ?></h2>
                <p class="bita-sec-body"><?php echo esc_html( $s['intro_text'] ); ?></p>
            </div>

            <div class="bita-who__rows">
                <?php foreach ( $rows as $row ) : ?>
                    <div class="bita-who__row">
                        <?php foreach ( $row as $card ) : ?>
                            <div class="bita-who-card">
                                <h3><?php echo esc_html( $card['title'] ); ?></h3>
                                <hr class="bita-rule" />
                                <p class="bita-sec-body"><?php echo esc_html( $card['body'] ); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php
    }
}
