<?php

namespace Sample;

require 'vendor/autoload.php';
use PaypalPayoutsSDK\Core\PayPalHttpClient;
use PaypalPayoutsSDK\Core\SandboxEnvironment;
ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use LiveEnvironment.
     */
    public static function environment()
    {
        $clientId = getenv("CLIENT_ID") ?: "AQWC0k_2DpDxQdVXdOChaHfqP4ShFBAlimgzz4fcKGT8aiw-aQ1JXtVwicEyTXQP_zO_oySwliCuoyi_";
        $clientSecret = getenv("CLIENT_SECRET") ?: "EOIJbP3C2IP3PYE93hwz_DI9KI5DsBN9O0iOUPJUL63J2eFrIUn1hJYPcMLazs2BPP4e61Cb4zwir9dB";
        return new SandboxEnvironment($clientId, $clientSecret);
    }
}