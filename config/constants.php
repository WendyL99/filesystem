<?php
/**
 * 站点常量
 */

return [
    'CN' => [
        'CNAME'                         => '中文名',
        'UID'                           => 'OA系统用户ID',
        'USERID'                        => '企业微信账号',
        'WECHAT_SOURCE'                 => '所属企业微信',
        'ENAME'                         => '英文名',
        'STATUS'                        => '状态',
        'HIREDATE'                      => '入职时间',
        'ID_CARD'                       => '身份证号',
        'SEX'                           => '性别',
        'BIRTHDATE'                     => '出生日期',
        'MARITAL_STATUS'                => '婚姻状态',
        'HAS_CHILDREN'                  => '有无小孩',
        'COMPANY'                       => '所属公司名称',
        'DEPARTMENT'                    => '部门',
        'POSITION'                      => '职位',
        'POSITION_LEVEL'                => '职位级别',
        'BANK_NAME'                     => '工资银行卡名称',
        'BANK_CARD_NUM'                 => '银行卡号',
        'SOCIAL_INSURANCE_BASE'         => '购买社保基数',
        'PROVIDENT_FUND_BASE'           => '购买公积金基数',
        'PROVIVENT_FUND_RATE'           => '购买公积金比例(%)',
        'CURRENT_ADDRESS'               => '现居住地址',
        'DETAIL_ADDRESS'                => '详细地址',
        'LUANGUAGE'                     => '语言',
        'PHONE'                         => '联系电话',
        'EMEGENCY_CONTACT_RELATIONSHIP' => '紧急联系人关系',
        'EMEGENCY_CONTACT_NAME'         => '紧急联系人姓名',
        'EMEGENCY_CONTACT'              => '紧急联系人电话',

        'SCHOOL_NAME'                   => '毕业院校',
        'MAJOR_NAME'                    => '所读专业',
        'EDUCATION_BACKGROUND'          => '学历',
        'GRADUATE_DATE'                 => '毕业时间',
        'AWARDS'                        => '获奖情况',

        'COMPANY_NAME'                  => '公司名称',
        'WORK_START_TIME'               => '工作开始时间',
        'WORK_END_TIME'                 => '工作结束时间',

        'FILEID'                        => '系统档案编号',

        'CREATEDAT'                     => '创建时间',
        'UPDATEDAT'                     => '更新时间',
    ],

    'OPTIONS' => [
    'STATUS_OPT'            => ['0'=>'在职','1'=>'已离职','2'=>'待入职'],
    'SEX_OPT'               => ['F' => '女', 'M' => '男'],
    'MARITAL_STATUS_OPT'    => ['0'=>'未婚','1'=>'已婚','2'=>'离异', '3' => '再婚'],
    'CHILDREN_OPT'          => ['0' => '无', '1' => '有,1个', '2' => '有,2个', '3' => '有,3个', '4' => '有,3个以上'],
    'POSITION_LEVEL_OPT'    => ['0' => '员工', '1' => '组长', '2' => '主管', '3' => '部门经理', '4' => '总监', '5'=>'CEO'],
    'LUANGUAGE_OPT'         => [1 => '国语', 2 => '粤语', 3 => '英语', 4 => '其他'],
    'COMPANY_OPT'           => ['0' => '广州杰钡利贸易有限公司', '1' => '广州环朝商贸有限公司'],
    'WECHAT_SOURCE_OPT'     => ['0' => '请选择', 'JIEBEILI'=>'杰钡利','TECKLE'=>'德河', 'COMPRAME'=>'拉丁', 'GLOBAL'=>'金河'],
]
];
