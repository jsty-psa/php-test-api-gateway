<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getAuthorization() {
        $token = $this->generateRandomString(255);

        session(["authorization" => $token]);

        return response()->json([
            "Authorization" => $token
        ]);
    }

    public function apiTest(Request $request) {
        $authorization = $request->header("Authorization");
        $content_type = $request->header("content-type");
        $session_authorization = session('authorization');

        if($authorization != "Bearer $session_authorization") {
            return response()->json([
                "error" => [
                    "message" => "Invalid authorization key. Authorization Failed."
                ],
            ]);
        }

        if($content_type != "application/json") {
            return response()->json([
                "error" => [
                    "message" => "Invalid content type. Please use the appropriate content type and try again."
                ],
            ]);
        }

        $username = $request->get("username");
        $password = $request->get("password");

        if($username == NULL || $password == NULL ) {
            return response()->json([
                "error" => [
                    "message" => "Username and Password is required."
                ],
            ]);
        }

        if($username != $password) {
            return response()->json([
                "error" => [
                    "message" => "Invalid username and password"
                ],
            ]);
        }

        return response()->json([
            "success" => [
                "message" => "Hello World!"
            ],
        ]);
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }
}
