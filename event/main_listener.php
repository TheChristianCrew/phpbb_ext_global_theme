<?php

namespace thechristiancrew\globalthemeinc\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface {

  protected $template, $root_path;

  public function __construct(\phpbb\template\template $template, $root_path) {
    $this->template = $template;
    $this->root_path = $root_path;
  }

  static public function getSubscribedEvents() {

    return array(
      'core.page_header_after' => 'load_global_theme_inc',
      'core.page_footer_after' => 'load_global_theme_inc'
    );

  }

  public function load_global_theme_inc() {

    // Set defaults
    $cc_site_url = 'https://ccgaming.com';
    $cc_global_theme_path = 'cc-global-theme/v3';
    $cc_global_theme_url = $cc_site_url .'/'. $cc_global_theme_path;

    // Check if we're in a development environment
    if (generate_board_url() == 'http://localhost/software/phpbb') {
      $cc_site_url = 'http://localhost/sites/thechristiancrew';
      $cc_global_theme_url = 'http://localhost/sites/'. $cc_global_theme_path;
    }

    // Assign template vars
    $this->template->assign_vars(array(
      'CC_SITE_URL' => $cc_site_url,
      'CC_GLOBAL_THEME_URL' => $cc_global_theme_url,
    ));

  }

}
