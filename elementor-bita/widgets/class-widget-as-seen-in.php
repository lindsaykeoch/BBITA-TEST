<?php
namespace BITA\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class As_Seen_In extends Widget_Base {

    public function get_name()       { return 'bita-as-seen-in'; }
    public function get_title()      { return __( 'BITA – As Seen In', 'bita' ); }
    public function get_icon()       { return 'eicon-press-posts'; }
    public function get_categories() { return [ 'bita' ]; }

    protected function register_controls() {

        $this->start_controls_section( 'sec_content', [
            'label' => __( 'Content', 'bita' ),
        ] );

        $this->add_control( 'heading', [
            'label'   => __( 'Section heading', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'As Seen In',
        ] );

        /* Repeater for logos */
        $repeater = new Repeater();

        $repeater->add_control( 'logo', [
            'label' => __( 'Logo image', 'bita' ),
            'type'  => Controls_Manager::MEDIA,
        ] );

        $repeater->add_control( 'alt', [
            'label'   => __( 'Alt text', 'bita' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Publication',
        ] );

        $repeater->add_control( 'height', [
            'label'   => __( 'Logo height (px)', 'bita' ),
            'type'    => Controls_Manager::NUMBER,
            'default' => 60,
            'min'     => 20,
            'max'     => 120,
        ] );

        $repeater->add_control( 'row', [
            'label'   => __( 'Row (1–5)', 'bita' ),
            'type'    => Controls_Manager::NUMBER,
            'default' => 1,
            'min'     => 1,
            'max'     => 5,
            'description' => __( 'Logos with the same row number appear together.', 'bita' ),
        ] );

        $this->add_control( 'logos', [
            'label'       => __( 'Logos', 'bita' ),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'title_field' => '{{{ alt }}}',
        ] );

        $this->end_controls_section();
    }

    protected function render() {
        $s    = $this->get_settings_for_display();
        $rows = [];

        foreach ( $s['logos'] as $item ) {
            $row_num = max( 1, intval( $item['row'] ) );
            $rows[ $row_num ][] = $item;
        }

        ksort( $rows );
        ?>
        <section class="bita-seen">
            <div class="bita-seen__header">
                <hr class="bita-rule" style="flex:1;" />
                <h2><?php echo esc_html( $s['heading'] ); ?></h2>
                <hr class="bita-rule" style="flex:1;" />
            </div>
            <div class="bita-logos-wrap">
                <?php foreach ( $rows as $row_items ) : ?>
                    <div class="bita-logo-row">
                        <?php foreach ( $row_items as $item ) : ?>
                            <?php
                            $url = ! empty( $item['logo']['url'] ) ? esc_url( $item['logo']['url'] ) : '';
                            $h   = intval( $item['height'] );
                            if ( ! $url ) continue;
                            ?>
                            <img src="<?php echo $url; ?>"
                                 alt="<?php echo esc_attr( $item['alt'] ); ?>"
                                 style="height:<?php echo $h; ?>px;" />
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <hr class="bita-rule" />
        </section>
        <?php
    }
}
