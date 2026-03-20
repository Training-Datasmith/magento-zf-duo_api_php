<?php

declare (strict_types=1);
namespace Duo_Api;

/*
 * https://www.duosecurity.com/docs/accountsapi
 */
class Accounts extends Client
{
    public function list_accounts()
    {
        $method = 'POST';
        $endpoint = '/accounts/v1/account/list';
        $params = [];
        return self::json_api_call($method, $endpoint, $params);
    }
    public function create_account($name)
    {
        assert(is_string($name));
        $method = 'POST';
        $endpoint = '/accounts/v1/account/create';
        $params = ['name' => $name];
        return self::json_api_call($method, $endpoint, $params);
    }
    public function delete_account($account_id)
    {
        assert(is_string($account_id));
        $method = 'POST';
        $endpoint = '/accounts/v1/account/delete';
        $params = ['account_id' => $account_id];
        return self::json_api_call($method, $endpoint, $params);
    }
}