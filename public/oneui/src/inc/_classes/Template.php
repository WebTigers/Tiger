<?php
/**
 * Basic class used for storing template options and providing
 * various helper functions for populating the template with
 * random content
 *
 * @author pixelcave
 *
 */
class Template {
    // Template Variables
    public  $name               = '',
            $version            = '',
            $author             = '',
            $robots             = '',
            $title              = '',
            $description        = '',
            $og_url_site        = '',
            $og_url_image       = '',
            $assets_folder      = '',
            $main_nav           = array(),
            $main_nav_active    = '',
            $theme              = '',
            $cookies,
            $page_loader,
            $google_maps_api_key,
            $l_rtl,
            $l_sidebar_left,
            $l_sidebar_mini,
            $l_sidebar_visible_desktop,
            $l_sidebar_visible_mobile,
            $l_sidebar_dark,
            $l_side_overlay_hoverable,
            $l_side_overlay_visible,
            $l_page_overlay,
            $l_side_scroll,
            $l_header_fixed,
            $l_header_style,
            $l_m_content,
            $inc_side_overlay,
            $inc_sidebar,
            $inc_header,
            $inc_footer;

    private $nav_html           = '',
            $page_classes       = '',
            $placeholder_names  = array(
                'female' => array(
                    'Helen Jacobs',
                    'Amanda Powell',
                    'Marie Duncan',
                    'Susan Day',
                    'Alice Moore',
                    'Amber Harvey',
                    'Lisa Jenkins',
                    'Megan Fuller',
                    'Danielle Jones',
                    'Barbara Scott',
                    'Melissa Rice',
                    'Sara Fields',
                    'Judy Ford',
                    'Andrea Gardner',
                    'Lori Moore',
                    'Laura Carr',
                    'Lori Grant',
                    'Betty Kelley',
                    'Carol Ray',
                    'Carol White'
                ),
                'male' => array(
                    'Brian Cruz',
                    'Henry Harrison',
                    'Thomas Riley',
                    'Jesse Fisher',
                    'David Fuller',
                    'Brian Stevens',
                    'Jack Estrada',
                    'Ralph Murray',
                    'Carl Wells',
                    'Jack Greene',
                    'Jeffrey Shaw',
                    'Ryan Flores',
                    'Jose Wagner',
                    'Jose Parker',
                    'Jose Mills',
                    'Adam McCoy',
                    'Justin Hunt',
                    'Wayne Garcia',
                    'Scott Young',
                    'Albert Ray'
                )
            ),
            $placeholder_text   = array(
                'small'     => 'Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.',
                'medium'    => 'Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh orci.',
                'large'     => 'Felis ullamcorper curae erat nulla luctus sociosqu phasellus posuere habitasse sollicitudin, libero sit potenti leo ultricies etiam blandit id platea augue, erat habitant fermentum lorem commodo taciti tristique etiam curabitur suscipit lacinia habitasse amet mauris eu eget ipsum nec magna in, adipiscing risus aenean turpis proin duis fringilla praesent ornare lorem eros malesuada vitae nullam diam velit potenti consectetur, vehicula accumsan risus lectus tortor etiam facilisis tempus sapien tortor, mi vestibulum taciti dapibus viverra ac justo vivamus erat phasellus turpis nisi class praesent duis ligula, vel ornare faucibus potenti nibh turpis, at id semper nunc dui blandit. Enim et nec habitasse ultricies id tortor curabitur, consectetur eu inceptos ante conubia tempor platea odio, sed sem integer lacinia cras non risus euismod turpis platea erat ultrices iaculis rutrum taciti, fusce lobortis adipiscing dapibus habitant sodales gravida pulvinar, elementum mi tempus ut commodo congue ipsum justo nec dui cursus scelerisque elementum volutpat tellus nulla laoreet taciti, nibh suspendisse primis arcu integer vulputate etiam ligula lobortis nunc, interdum commodo libero aliquam suscipit phasellus sollicitudin arcu varius venenatis erat ornare tempor nullam donec vitae etiam tellus.'
            );

    /**
     * Class constructor
     */
    public function __construct($name = '', $version = '', $assets_folder = '') {
        // Set Template's name, version and assets folder
        $this->name                 = $name;
        $this->version              = $version;
        $this->assets_folder        = $assets_folder;
    }

    /**
     * Builds #page-container classes
     *
     * @param   boolean $print True to print the classes and False to return them
     *
     * @return  string  Returns the classes if $print is set to false
     */
    public function page_classes($print = true) {
        // Build page classes
        if ($this->cookies) {
            $this->page_classes .= ' enable-cookies';
        }

        // If sidebar is included
        if ($this->inc_sidebar) {
            if ($this->l_sidebar_visible_desktop) {
                $this->page_classes .= ' sidebar-o';
            }

            if ($this->l_sidebar_visible_mobile) {
                $this->page_classes .= ' sidebar-o-xs';
            }

            if ($this->l_sidebar_dark) {
                $this->page_classes .= ' sidebar-dark';
            }

            if ($this->l_sidebar_mini) {
                $this->page_classes .= ' sidebar-mini';
            }
        }

        // If side overlay is included
        if ($this->inc_side_overlay) {
            if ($this->l_side_overlay_hoverable) {
                $this->page_classes .= ' side-overlay-hover';
            }

            if ($this->l_side_overlay_visible) {
                $this->page_classes .= ' side-overlay-o';
            }

            if ($this->l_page_overlay) {
                $this->page_classes .= ' enable-page-overlay';
            }
        }

        // if sidebar or side overlay is included
        if ($this->inc_sidebar || $this->inc_side_overlay) {
            if ( ! $this->l_sidebar_left) {
                $this->page_classes .= ' sidebar-r';
            }

            if ($this->l_side_scroll) {
                $this->page_classes .= ' side-scroll';
            }
        }

        // If header is included
        if ($this->inc_header) {
            if ($this->l_header_fixed) {
                $this->page_classes .= ' page-header-fixed';
            }

            if ($this->l_header_dark) {
                $this->page_classes .= ' page-header-dark';
            }
        }

        // Main content classes
        if ($this->l_m_content == 'boxed') {
            $this->page_classes .= ' main-content-boxed';
        } else if ($this->l_m_content == 'narrow') {
            $this->page_classes .= ' main-content-narrow';
        }

        // RTL support class
        if ($this->l_rtl) {
            $this->page_classes .= ' rtl-support';
        }

        // Print or return page classes
        if ($this->page_classes) {
            if ($print) {
                echo ' class="'. trim($this->page_classes) .'"';
            } else {
                return trim($this->page_classes);
            }
        } else {
            return false;
        }
    }

    /**
     * Builds navigation
     *
     * @param   array       $nav_array A PHP array to create the menu from, False to use the default array
     * @param   boolean     $nav_horizontal True if the menu is for horizontal view as well
     * @param   boolean     $print True to print the navigation, False to return it
     *
     * @return  string      Returns the navigation if $print is set to false
     */
    public function build_nav($nav_array = false, $nav_horizontal = false, $print = true) {
        // Clean navigation HTML
        $this->nav_html = '';

        // If a navigation array is not used, use the default one
        if (!$nav_array) {
            $nav_array = $this->main_nav;
        }

        // Build navigation
        $this->build_nav_array($nav_array, $nav_horizontal);

        // Print or return navigation
        if ($print) {
            echo $this->nav_html;
        } else {
            return $this->nav_html;
        }
    }

    /**
     * Build navigation helper - Builds main navigation one level at a time
     *
     * @param   string      $nav_array A multi dimensional array with menu/sub menus links
     * @param   boolean     $nav_horizontal True if the menu is for horizontal view as well
     */
    private function build_nav_array($nav_array, $nav_horizontal) {
        foreach ($nav_array as $node) {
            // Get all vital link info
            $link_name      = '<span class="nav-main-link-name">' . (isset($node['name']) ? $node['name'] : '') . '</span>' . "\n";
            $link_icon      = isset($node['icon']) ? '<i class="nav-main-link-icon ' . $node['icon'] . '"></i>' . "\n" : '';
            $link_badge     = isset($node['badge']) ? '<span class="nav-main-link-badge badge badge-pill badge-' . (is_array($node['badge']) ? $node['badge'][1] : 'primary') . '">' . (is_array($node['badge']) ? $node['badge'][0] : $node['badge']) . '</span>' . "\n" : '';
            $link_url       = isset($node['url']) ? $node['url'] : '#';
            $link_sub       = isset($node['sub']) && is_array($node['sub']) ? true : false;
            $link_type      = isset($node['type']) ? isset($node['type']) : '';
            $sub_active     = false;
            $link_active    = $link_url == $this->main_nav_active ? true : false;

            // If link type is a header
            if ($link_type == 'heading') {
                $this->nav_html .= "<li class=\"nav-main-heading\">" . (isset($node['name']) ? $node['name'] : '') . "</li>\n";
            } else {
                // If it is a submenu search for an active link in all sub links
                if ($link_sub) {
                    $sub_active = $this->build_nav_array_search($node['sub']) ? true : false;
                }

                // Set menu properties
                $li_prop        = ' class="nav-main-item' . ($sub_active && !$nav_horizontal ? ' open' : '') . '"';
                $link_prop      = ' class="nav-main-link' . ($link_active || ($sub_active && $nav_horizontal)  ? ' active' : '') . ($link_sub ? ' nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="' . ($sub_active ? 'true' : 'false') . '"' : '"');

                // Add the link
                $this->nav_html .= "<li$li_prop>\n";
                $this->nav_html .= "<a$link_prop href=\"$link_url\">\n$link_icon$link_name$link_badge</a>\n";

                // If it is a submenu, call the function again
                if ($link_sub) {
                    $this->nav_html .= "<ul class=\"nav-main-submenu\">\n";
                    $this->build_nav_array($node['sub'], $nav_horizontal);
                    $this->nav_html .= "</ul>\n";
                }

                $this->nav_html .= "</li>\n";
            }
        }
    }

    /**
     * Build navigation helper - Search navigation array for active menu links
     *
     * @param   string      $nav_array A multi dimensional array with menu/sub menus links
     *
     * @return  boolean     Returns true if an active link is found
     */
    private function build_nav_array_search($nav_array) {
        foreach ($nav_array as $node) {
            if (isset($node['url']) && ($node['url'] == $this->main_nav_active)) {
                return true;
            } else if (isset($node['sub']) && is_array($node['sub'])) {
                if ($this->build_nav_array_search($node['sub'])) {
                    return true;
                }
            }
        }
    }

    /**
     * Helper function to include a CSS file from the assets folder
     *
     * @param string $asset_css The url of the CSS file in the assets folder
     *
     */
    public function get_css($asset_css) {
        echo "<link rel=\"stylesheet\" href=\"$this->assets_folder/$asset_css\">\n";
    }

    /**
     * Helper function to include a JS file from the assets folder
     *
     * @param string $asset_js The url of the JS file in the assets folder
     *
     */
    public function get_js($asset_js) {
        echo "<script src=\"$this->assets_folder/$asset_js\"></script>\n";
    }

    /**
     * Prints random paragraphs
     *
     * @param string    $size   'small', 'medium', 'large' available paragraph sizes
     * @param int       $num    The number of paragraphs to be printed
     *
     */
    public function get_text($size = 'medium', $num = 0) {
        if ($num > 0) {
            for ($i = 0; $i < $num; $i++) {
                echo '<p>' . $this->placeholder_text[$size] . '</p>'. "\n";
            }
        } else {
            echo '<p>' . $this->placeholder_text[$size] . '</p>'. "\n";
        }
    }

    /**
     * Prints a random user name
     *
     * @param string    $gender 'male' or 'female' for a specific name
     */
    public function get_name($gender = '') {
        $available  = array('male', 'female');
        $gender_f   = ($gender ? $gender : $available[rand(0, 1)]);

        echo $this->placeholder_names[$gender_f][rand(0, 19)];
    }

    /**
     * Prints a random or a specific avatar from the avatars folder
     *
     * @param int       $id     A number for printing a specific avatar
     * @param string    $gender 'female' or 'male' for a specific gender
     * @param int       $size   16, 20, 32, 48, 96 or 128 pixels
     * @param boolean   $thumb  Add avatar thumb class or not
     * @param string    $class  Add a custom class to the image
     */
    public function get_avatar($id = 0, $gender = '', $size = 0, $thumb = false, $class = '') {
        $id_f       = ($id ? $id : ($gender ? ($gender == 'female' ? rand(1, 8) : rand(9, 16)) : rand(1, 16)));
        $class_f    = '';

        if ($size == 16) {
            $class_f = ' img-avatar16';
        } else if ($size == 32) {
            $class_f = ' img-avatar32';
        } else if ($size == 48) {
            $class_f = ' img-avatar48';
        } else if ($size == 96) {
            $class_f = ' img-avatar96';
        } else if ($size == 128) {
            $class_f = ' img-avatar128';
        }

        if ($thumb) {
            $class_f .= ' img-avatar-thumb';
        }

        if ($class) {
            $class_f .= ' ' . $class;
        }

        echo '<img class="img-avatar' . $class_f . '" src="' . $this->assets_folder . '/media/avatars/avatar' . $id_f . '.jpg" alt="">'. "\n";
    }

    /**
     * Prints a random or a specific photo from the photos folder
     *
     * @param int       $id     A number for printing a specific image
     * @param string    $class  CSS classes for the img tag
     */
    public function get_photo($id = 0, $retina = false, $class = '') {
        echo '<img' . ($class ? ' class="' . $class . '"' : '') . ' src="' . $this->assets_folder . '/media/photos/photo' . ($id ? $id : rand(1, 25)) . ($retina ? '@2x' : '') . '.jpg" alt="">'. "\n";
    }

    /**
     * Prints a random tag
     *
     * @param boolean $print True to print the generated tag and False to return it
     * @param boolean $status True for status tags and False for plan tags
     *
     * @return string  Returns the generated tag if $print is set to false
     */
    public function get_tag($print = true, $status = false) {
        // Tag seed data
        $data = array(
            '0' => array('class' => 'success', 'text'  => 'VIP'),
            '1' => array('class' => 'info', 'text'  => 'Business'),
            '2' => array('class' => 'primary', 'text'  => 'Personal'),
            '3' => array('class' => 'warning', 'text'  => 'Trial'),
            '4' => array('class' => 'danger', 'text'  => 'Disabled'),
            '5' => array('class' => 'success', 'text'  => 'Completed'),
            '6' => array('class' => 'info', 'text'  => 'Processing'),
            '7' => array('class' => 'warning', 'text'  => 'Pending'),
            '8' => array('class' => 'danger', 'text'  => 'Canceled')
        );

        // Generate tag
        $rand = $status ? rand(5, 8) : rand(0, 4);
        $tag  = '<span class="badge badge-' . $data[$rand]['class'] . '">' . $data[$rand]['text'] . '</span>'. "\n";

        // Print or return generated tag
        if ($print) {
            echo $tag;
        } else {
            return $tag;
        }
    }
}
