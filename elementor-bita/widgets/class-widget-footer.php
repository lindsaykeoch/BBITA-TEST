<?php
namespace BITA\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Footer extends Widget_Base {

    public function get_name()       { return 'bita-footer'; }
    public function get_title()      { return __( 'BITA – Footer', 'bita' ); }
    public function get_icon()       { return 'eicon-footer'; }
    public function get_categories() { return [ 'bita' ]; }

    protected function register_controls() {

        /* ── Brand ── */
        $this->start_controls_section( 'sec_brand', [
            'label' => __( 'Brand', 'bita' ),
        ] );

        $this->add_control( 'brand_name', [
            'label'   => __( 'Brand name', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Baseball in the Attic',
        ] );

        $this->add_control( 'decor_card', [
            'label'       => __( 'Decorative card image', 'bita' ),
            'type'        => Controls_Manager::MEDIA,
            'description' => __( 'Large baseball card shown rotated at top-left.', 'bita' ),
        ] );

        $this->end_controls_section();

        /* ── Nav links ── */
        $this->start_controls_section( 'sec_nav', [
            'label' => __( 'Navigation Links', 'bita' ),
        ] );

        $repeater = new Repeater();
        $repeater->add_control( 'label', [
            'label'   => __( 'Label', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Page',
        ] );
        $repeater->add_control( 'link', [
            'label'   => __( 'URL', 'bita' ),
            'type'    => Controls_Manager::URL,
            'default' => [ 'url' => '#' ],
        ] );

        $this->add_control( 'nav_links', [
            'label'       => __( 'Links', 'bita' ),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'title_field' => '{{{ label }}}',
            'default'     => [
                [ 'label' => 'Home',             'link' => [ 'url' => '#' ] ],
                [ 'label' => 'About',            'link' => [ 'url' => '#' ] ],
                [ 'label' => 'Appraisals',       'link' => [ 'url' => '#' ] ],
                [ 'label' => 'PSA Lead Appraiser', 'link' => [ 'url' => '#' ] ],
                [ 'label' => 'Contact Us',       'link' => [ 'url' => '#' ] ],
            ],
        ] );

        $this->end_controls_section();

        /* ── Contact ── */
        $this->start_controls_section( 'sec_contact', [
            'label' => __( 'Contact Info', 'bita' ),
        ] );

        $this->add_control( 'phone', [
            'label'   => __( 'Phone', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => '312.379.9090',
        ] );

        $this->add_control( 'email', [
            'label'   => __( 'Email', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'info@BaseballintheAttic.com',
        ] );

        $this->end_controls_section();

        /* ── Footer bar ── */
        $this->start_controls_section( 'sec_bar', [
            'label' => __( 'Bottom Bar', 'bita' ),
        ] );

        $this->add_control( 'copyright', [
            'label'   => __( 'Copyright text', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => '© 2025 Baseball in the Attic. All Rights Reserved.',
        ] );

        $this->add_control( 'privacy_url', [
            'label'   => __( 'Privacy Policy URL', 'bita' ),
            'type'    => Controls_Manager::URL,
            'default' => [ 'url' => '#' ],
        ] );

        $this->add_control( 'terms_url', [
            'label'   => __( 'Terms of Service URL', 'bita' ),
            'type'    => Controls_Manager::URL,
            'default' => [ 'url' => '#' ],
        ] );

        $this->add_control( 'social_image', [
            'label' => __( 'Social icons image', 'bita' ),
            'type'  => Controls_Manager::MEDIA,
        ] );

        $this->end_controls_section();
    }

    protected function render() {
        $s          = $this->get_settings_for_display();
        $decor      = ! empty( $s['decor_card']['url'] )   ? esc_url( $s['decor_card']['url'] )   : '';
        $social     = ! empty( $s['social_image']['url'] ) ? esc_url( $s['social_image']['url'] ) : '';
        $priv_url   = ! empty( $s['privacy_url']['url'] )  ? esc_url( $s['privacy_url']['url'] )  : '#';
        $terms_url  = ! empty( $s['terms_url']['url'] )    ? esc_url( $s['terms_url']['url'] )    : '#';
        ?>
        <footer class="bita-footer">
            <?php if ( $decor ) : ?>
            <div class="bita-footer__decor">
                <img src="<?php echo $decor; ?>" alt="" />
            </div>
            <?php endif; ?>

            <div class="bita-footer__inner">
                <p class="bita-footer__brand"><?php echo esc_html( $s['brand_name'] ); ?></p>

                <div class="bita-footer__nav">
                    <div class="bita-footer__links">
                        <?php foreach ( $s['nav_links'] as $item ) : ?>
                            <a href="<?php echo esc_url( $item['link']['url'] ); ?>">
                                <?php echo esc_html( $item['label'] ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <div class="bita-footer__contact">
                        <span>Phone: <?php echo esc_html( $s['phone'] ); ?></span>
                        <span>Email: <?php echo esc_html( $s['email'] ); ?></span>
                    </div>
                </div>
            </div>

            <div class="bita-footer__bar">
                <p><?php echo esc_html( $s['copyright'] ); ?></p>
                <p>
                    <a href="<?php echo $priv_url; ?>">Privacy Policy</a>
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href="<?php echo $terms_url; ?>">Terms of Service</a>
                </p>
                <?php if ( $social ) : ?>
                    <img src="<?php echo $social; ?>" alt="Social media" />
                <?php endif; ?>
            </div>
        </footer>
        <?php
    }
}
