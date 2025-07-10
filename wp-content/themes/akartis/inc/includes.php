<?php 

    // scroll to top
    function akartis_scroll_to_top() {
        $html = '';
        $html .= '<div class="scroll-to-top">';
        $html .= '<button type="button" class="scroll-to-top-btn float-and-slide" id="scroll-to-top-btn">';
        $html .= '<span class="fa fa-arrow-up"></span>';
        $html .= '</button>';
        $html .= '</div>';

        echo $html;
    }
    add_action('akartis_scroll_to_top', 'akartis_scroll_to_top');

    function akartis_footer_copyright() {
        $year = date('Y');
        $html = '';
        $html .= '<section class="footer-copyright">';
        $html .= '<div class="container">';
        $html .= '<p>Copyright &copy; ' . $year . ' AKARTiS. All rights reserved.</p>';
        $html .= '</div>';
        $html .= '</section>';

        echo $html;
    }
    add_action('akartis_footer_copyright', 'akartis_footer_copyright');


