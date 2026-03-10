<?php
namespace BITA\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Top_Bar extends Widget_Base {

    public function get_name()       { return 'bita-topbar'; }
    public function get_title()      { return __( 'BITA – Top Bar', 'bita' ); }
    public function get_icon()       { return 'eicon-navigation-horizontal'; }
    public function get_categories() { return [ 'bita' ]; }

    protected function register_controls() {

        /* ── Content ── */
        $this->start_controls_section( 'sec_content', [
            'label' => __( 'Content', 'bita' ),
        ] );

        $this->add_control( 'contact_text', [
            'label'       => __( 'Contact prefix', 'bita' ),
            'type'        => Controls_Manager::TEXT,
            'default'     => 'Contact Michael:',
        ] );

        $this->add_control( 'contact_email', [
            'label'   => __( 'Email', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'info@baseballintheattic.com',
        ] );

        $this->add_control( 'contact_phone', [
            'label'   => __( 'Phone', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => '(312) 379-9090',
        ] );

        $this->add_control( 'follow_label', [
            'label'   => __( 'Follow label', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Follow us',
        ] );

        $this->add_control( 'social_image', [
            'label'  => __( 'Social icons image', 'bita' ),
            'type'   => Controls_Manager::MEDIA,
        ] );

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();

        $email  = esc_html( $s['contact_email'] );
        $phone  = esc_html( $s['contact_phone'] );
        $prefix = esc_html( $s['contact_text'] );
        $label  = esc_html( $s['follow_label'] );
        $social = ! empty( $s['social_image']['url'] ) ? esc_url( $s['social_image']['url'] ) : '';
        ?>
        <div class="bita-topbar">
            <div><?php echo $prefix; ?> <em><?php echo $email; ?></em> or <em><?php echo $phone; ?></em></div>
            <div class="bita-topbar__right">
                <span><?php echo $label; ?></span>
                <?php if ( $social ) : ?>
                    <img src="<?php echo $social; ?>" alt="Social links" />
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
