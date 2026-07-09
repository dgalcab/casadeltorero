<?php
defined('ABSPATH') || exit;

/**
 * Endpoint AJAX que alimenta el filtrado en tiempo real (con y sin sesión).
 */
class BAH_Ajax
{
    private static $instance = null;

    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        add_action('wp_ajax_bah_filter', [$this, 'handle_filter']);
        add_action('wp_ajax_nopriv_bah_filter', [$this, 'handle_filter']);
    }

    public function handle_filter()
    {
        check_ajax_referer('bah_filter_nonce', 'nonce');

        $raw_filters = isset($_POST['filters']) ? wp_unslash($_POST['filters']) : []; // phpcs:ignore WordPress.Security.ValidatedSanitization.MissingUnslash
        $filters     = is_array($raw_filters) ? BAH_Query::sanitize_filters($raw_filters) : [];
        $paged       = isset($_POST['page']) ? max(1, absint($_POST['page'])) : 1;
        $per_page    = isset($_POST['per_page']) ? absint($_POST['per_page']) : 0;

        $query = BAH_Query::run($filters, $paged, $per_page ?: null);

        $html  = BAH_Render::grid($query);
        $count = (int) $query->found_posts;

        wp_send_json_success([
            'html'        => $html,
            'count'       => $count,
            'page'        => $paged,
            'maxPages'    => (int) $query->max_num_pages,
            'hasMore'     => $paged < (int) $query->max_num_pages,
            'emptyStateHtml' => 0 === $count ? BAH_Render::empty_state() : '',
        ]);
    }
}
