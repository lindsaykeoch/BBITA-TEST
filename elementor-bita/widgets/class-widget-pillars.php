<?php
namespace BITA\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Pillars extends Widget_Base {

    public function get_name()       { return 'bita-pillars'; }
    public function get_title()      { return __( 'BITA – Pillars Grid', 'bita' ); }
    public function get_icon()       { return 'eicon-posts-grid'; }
    public function get_categories() { return [ 'bita' ]; }

    protected function register_controls() {

        $this->start_controls_section( 'sec_intro', [
            'label' => __( 'Intro', 'bita' ),
        ] );

        $this->add_control( 'heading', [
            'label'   => __( 'Heading', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Independent. Personal. Precise.',
        ] );

        $this->add_control( 'intro_text', [
            'label'   => __( 'Intro text', 'bita' ),
            'type'    => Controls_Manager::TEXTAREA,
            'rows'    => 3,
            'default' => 'At the heart of Baseball in the Attic is its one-person approach, defined by the direct involvement, seasoned expertise, and careful attention of Michael Osacky.',
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

        /* ── Pillars ── */
        $this->start_controls_section( 'sec_pillars', [
            'label' => __( 'Pillar Cards', 'bita' ),
        ] );

        $repeater = new Repeater();

        $repeater->add_control( 'title', [
            'label'   => __( 'Title', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Pillar Title',
        ] );

        $repeater->add_control( 'body', [
            'label'   => __( 'Body text', 'bita' ),
            'type'    => Controls_Manager::TEXTAREA,
            'rows'    => 4,
            'default' => 'Describe this pillar here.',
        ] );

        $this->add_control( 'pillars', [
            'label'       => __( 'Pillars (max 4)', 'bita' ),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'title_field' => '{{{ title }}}',
            'default'     => [
                [
                    'title' => 'Nostalgic by nature.',
                    'body'  => 'Sports collectibles carry memory and meaning. Michael approaches each item with historian-level care, honoring its story and context. Nostalgia isn\'t sentimentalized; it\'s understood as part of the value.',
                ],
                [
                    'title' => 'Credibility that matters.',
                    'body'  => 'With ISA accreditation, PSA leadership experience, and decades in the hobby, Michael brings earned authority. His valuations are rigorous, defensible, and trusted by collectors, insurers, attorneys, and the IRS.',
                ],
                [
                    'title' => 'No Conflicts. No Hidden Agenda.',
                    'body'  => 'Baseball in the Attic appraises only — never sells. With no stake in the outcome, values aren\'t inflated or steered. Every appraisal is independent, objective, and grounded in research and standards.',
                ],
                [
                    'title' => 'You work directly with Michael.',
                    'body'  => 'From the first conversation through the final appraisal report, Michael personally handles every step. No junior appraisers, no handoffs. Just clear communication, careful evaluation, and discretion throughout.',
                ],
            ],
        ] );

        $this->end_controls_section();
    }

    protected function render() {
        $s   = $this->get_settings_for_display();
        $url = ! empty( $s['cta_url']['url'] ) ? esc_url( $s['cta_url']['url'] ) : '#';
        ?>
        <section class="bita-pillars">
            <div class="bita-pillars__intro">
                <h2 class="bita-sec-heading"><?php echo esc_html( $s['heading'] ); ?></h2>
                <p class="bita-sec-body"><?php echo esc_html( $s['intro_text'] ); ?></p>
            </div>
            <div class="bita-pillars__grid">
                <?php foreach ( array_slice( $s['pillars'], 0, 4 ) as $pillar ) : ?>
                    <div class="bita-pillar-card">
                        <h3><?php echo esc_html( $pillar['title'] ); ?></h3>
                        <hr class="bita-rule" />
                        <p class="bita-sec-body"><?php echo esc_html( $pillar['body'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <a href="<?php echo $url; ?>" class="bita-btn-pill">
                <?php echo esc_html( $s['cta_text'] ); ?>
            </a>
        </section>
        <?php
    }
}
