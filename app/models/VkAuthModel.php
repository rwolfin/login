<?php
namespace app\models;

class VkAuthModel {
    public function getAuthorizeUrl() {
        $params = [
            'client_id' => VK_CLIENT_ID,
            'redirect_uri' => VK_REDIRECT_URI,
            'display' => 'page',
            'scope' => 'email',
            'response_type' => 'code',
            'v' => '5.131'
        ];
        return 'https://oauth.vk.com/authorize?' . http_build_query($params);
    }

    public function getUserData($code) {
        $params = [
            'client_id' => VK_CLIENT_ID,
            'client_secret' => VK_CLIENT_SECRET,
            'redirect_uri' => VK_REDIRECT_URI,
            'code' => $code
        ];
        
        $tokenResponse = file_get_contents('https://oauth.vk.com/access_token?' . http_build_query($params));
        $tokenData = json_decode($tokenResponse, true);
        
        if (isset($tokenData['access_token'])) {
            $userParams = [
                'user_ids' => $tokenData['user_id'],
                'access_token' => $tokenData['access_token'],
                'fields' => 'first_name,last_name',
                'v' => '5.131'
            ];
            
            $userResponse = file_get_contents('https://api.vk.com/method/users.get?' . http_build_query($userParams));
            $userData = json_decode($userResponse, true);
            
            if (isset($userData['response'][0])) {
                $user = $userData['response'][0];
                return [
                    'id' => $tokenData['user_id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'email' => $tokenData['email'] ?? null
                ];
            }
        }
        return null;
    }
}