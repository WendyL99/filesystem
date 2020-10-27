<?php

use GuzzleHttp\Client;

/**
 * Get OA Department List Data
 * @return array|null
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
function getDepartmentList($base_uri, $token)
{
    $client = new Client([
        'base_uri' => $base_uri,
        'timeout'  => 2.0
    ]);
    $requests = $client->request('POST','departmentlist/get',
        ['form_params' => ['token' => $token]]);
    $json_data = json_decode($requests->getBody()->getContents(),true);
    $departments = array();
    if($json_data && $json_data['errcode'] == 0 && !empty($json_data['data'])){
        foreach ($json_data['data'] as $row){
            $tmp['id'] = $row['nid'];
            $tmp['text'] = $row['name'];
            $departments[] = $tmp;
        }

        return $departments;
    }

    return null;
}

/**
 *
 * @param $wechat_source
 * @param string $default
 * @return |null
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
function getWechatUserList($wechat_source, $default='')
{
    $_base_uri = env('CSOA_BASE_URI');
    $_token = base64_encode(date("Ymd").env('CSOA_TOKEN_SALT'));
    $client = new Client([
        'base_uri' => $_base_uri,
        'timeout'  => 2.0
    ]);
    $requests = $client->request('POST','wechatwork/userlist/get',
        ['form_params' => ['wechat_source' => $wechat_source, 'token' => $_token]]);

    $json_data = json_decode($requests->getBody()->getContents(),true);
    if($json_data && $json_data['errcode'] == 0 && !empty($json_data['data'])){
        if(isset($default) && $default && in_array($default, $json_data['data'])){
            $key = array_search($default,$json_data['data']);
            unset($json_data['data'][$key]);
            array_splice($json_data['data'], 0, 0, $default);
        }
        return $json_data['data'];
    }

    return null;
}

/**
 * 根据部门ID获取OA系统用户列表
 * @param $departmentId
 * @param string $default
 * @return array|null
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
function getOAUserList($departmentId, $default='')
{
    $_base_uri = env('CSOA_BASE_URI');
    $_token = base64_encode(date("Ymd").env('CSOA_TOKEN_SALT'));

    $client = new Client([
        'base_uri' => $_base_uri,
        'timeout'   => 2.0
    ]);

    $request = $client->request('POST','oa/userlist/get',
        ['form_params' => ['departmentId' => (int)$departmentId, 'token' => $_token]]);
    $data = json_decode($request->getBody()->getContents(), true);
    $userlist = array();
    if($data && $data['errcode'] == 0 && !empty($data['data'])){
        foreach ($data['data'] as $row){
            $tmp['id'] = $row['uid'];
            $tmp['text'] = $row['ename'].'('.$row['cname'].')';
            $userlist[] = $tmp;

            unset($tmp);
        }

        return $userlist;
    }

    return null;
}
