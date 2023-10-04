<?php

namespace Cartrabbit\Postmark\App\Controllers;

class PostMarkController
{

    public static function listBounces()
    {
        $queryParams = [];// ['type' => 'HardBounce', 'inactive' => 'true'];

        if (isset($_REQUEST['offset'])) {
            $queryParams['offset'] = $_REQUEST['offset'];
        }
        if (isset($_REQUEST['fromDate'])) {
            $queryParams['fromDate'] = $_REQUEST['fromDate'];
        }

        if (isset($_REQUEST['toDate'])) {
            $queryParams['toDate'] = $_REQUEST['toDate'];
        }
        if (isset($_REQUEST['per_page'])) {
            $queryParams['count'] = $_REQUEST['per_page'];
        }

        if (isset($_REQUEST['email']) && !is_null($_REQUEST['email']) && $_REQUEST['email'] != '') {
            $queryParams['emailFilter'] = $_REQUEST['email'];
        }

        $query = http_build_query($queryParams);

        $credentials = get_option('post_mark_settings');


        $credentials = json_decode($credentials, true);

        $response = wp_remote_get("https://api.postmarkapp.com/bounces?{$query}", ['headers' => [
            'Access-Control-Allow-Origin' => '*',
            'Accept' => 'application/json',
            'X-Postmark-Server-Token' => $credentials['token'], // Replace 'server token' with your actual server token
        ]]);

        if (is_array($response) && !is_wp_error($response)) {
            $body = wp_remote_retrieve_body($response); // Get the response body
            $data = json_decode($body); // Parse JSON response, if applicable

            $statusCode = wp_remote_retrieve_response_code($response);

            if ($statusCode >= 400) {
                $errorData = is_array($response) ? wp_remote_retrieve_body($response) : [
                    'type' => 'error',
                    'message' => 'Unable to Fetch the record'
                ];
                wp_send_json_error($errorData);
            }

            wp_send_json_success($data);
            // Process the data here
        } else {
            wp_send_json_error([
                'type' => 'error',
                'message' => 'Unable to Fetch the record'
            ]);
        }
    }

    public static function postBounces()
    {
        $query = $_REQUEST['query'];
        $type = $_REQUEST['type'];
        $source = $_REQUEST['source'];


        $query = str_replace('\\', '', $query);

        $body = json_encode([
            'query' => $query,
            'source' => $source,
            'type' => $type
        ]);

        $credentials = get_option('post_mark_settings');
        $credentials = json_decode($credentials, true);

        $url = trim($credentials['site_url'], '/');

        $response = wp_remote_request("{$url}/api/subscribers/query/blocklist", [
            'method' => 'PUT',
            'headers' => [
                'Access-Control-Allow-Origin' => '*',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode("{$credentials['user_name']}:{$credentials['password']}"),
            ],
            'auth' => [
                'username' => $credentials['user_name'],
                'password' => $credentials['password']
            ],
            'body' => $body
        ]);

        if (is_array($response) && !is_wp_error($response)) {
            $body = wp_remote_retrieve_body($response); // Get the response body
            $data = json_decode($body); // Parse JSON response, if applicable

            wp_send_json_success($data);
            // Process the data here
        } else {
            wp_send_json_error([
                'type' => 'error',
                'message' => 'Unable to Post'
            ]);
        }
    }

    public static function savePostMarkSettings()
    {
        $data = [];
        $data['user_name'] = $_REQUEST['user_name'];
        $data['password'] = $_REQUEST['password'];
        $data['token'] = $_REQUEST['token'];
        $data['site_url'] = $_REQUEST['site_url'];
        $value = json_encode($data);
        update_option('post_mark_settings', $value);
    }

    public static function getPostMarkSettings()
    {
        $value = get_option('post_mark_settings');

        wp_send_json_success(json_decode($value));
    }
}