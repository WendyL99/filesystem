<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class InstranetController extends Controller
{
    protected $_base_uri = '';
    protected $_token = '';

    public function __construct()
    {
        $this->_base_uri = env('CSOA_BASE_URI');
        $this->_token = base64_encode(date("Ymd").env('CSOA_TOKEN_SALT'));
    }

    /**
     * 获取企业微信用户
     * @param Request $request
     * @return |null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getWechatUsers(Request $request)
    {
        $wechat_source = $request->get('q');

        $client = new Client([
            'base_uri' => $this->_base_uri,
            'timeout'  => 2.0
        ]);
        $requests = $client->request('POST','wechatwork/userlist/get',
            ['form_params' => ['wechat_source' => $wechat_source, 'token' => $this->_token]]);
        $json_data = json_decode($requests->getBody()->getContents(),true);
        if($json_data && $json_data['errcode'] == 0 && !empty($json_data['data'])){
            return $json_data['data'];
        }

        return null;
    }

    /**
     * 根据部门获取OA用户
     * @param Request $request
     * @return |null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOAUserlist(Request $request)
    {
        $departmentId = $request->get('q');

        $client = new Client([
            'base_uri' => $this->_base_uri,
            'timeout'   => 2.0
        ]);

        $request = $client->request('POST','oa/userlist/get',
            ['form_params' => ['departmentId' => $departmentId, 'token' => $this->_token]]);
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

}

