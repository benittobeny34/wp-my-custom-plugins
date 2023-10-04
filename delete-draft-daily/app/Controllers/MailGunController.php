<?php

namespace Cartrabbit\DeleteDraftDaily\App\Controllers;

use Mailgun\Mailgun;

class MailGunController
{
    public static function sendEmail()
    {
        $request = $_REQUEST;

        if (!isset($request['from_mail'])) {
            wp_send_json_error([
                'message' => 'From Mail Id Required'
            ]);
        }

        if (!isset($request['to_mail'])) {
            wp_send_json_error([
                'message' => 'to Mail Id Required'
            ]);
        }

        if (!isset($request['mail_content'])) {
            wp_send_json_error([
                'message' => 'Mail Content Required'
            ]);
        }


        $mgClient = Mailgun::create('e5b5619bcbf9739bc20ca767aedb204b-77316142-39e2e56c');
        $domain = "sandbox72b82c335dc543799d65adb819ee49fa.mailgun.org";

        # Make the call to the client.

        $result = $mgClient->messages()->send($domain, array(
            'from' => $request['from_mail'],
            'to' => $request['to_mail'],
            'subject' => 'Sample Mail Subject',
            'text' => $request['mail_content']
        ));

        wp_send_json_success([
            'message' => 'Mail Send Successfully'
        ]);

    }

    public
    static function postBounces()
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
}