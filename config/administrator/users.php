<?php

use App\Models\User;

return [
    // 页面标题
    'title'   => '用户',

    // 模型单数，用作页面『新建 $single』
    'single'  => '用户',

    // 数据模型，用作数据的 CRUD
    'model'   => User::class,

    // 设置当前页面的访问权限，通过返回布尔值来控制权限。
    // 返回 True 即通过权限验证，False 则无权访问并从 Menu 中隐藏
    'permission'=> function()
    {
        return Auth::user()->can('manage_users');
    },

    // 字段负责渲染『数据表格』，由无数的『列』组成，
    'columns' => [

        // 列的标示，这是一个最小化『列』信息配置的列子，读取的是模型里对应
        // 的属性的值，如 $model->id
        'id',

        'name' => [
            'title'    => '用户名',
            'sortable' => false,
            'output' => function ($name, $model) {
                return '<a href="/users/'.$model->id.'" target=_blank>'.$name.'</a>';
            },
        ],

        'phone' => [
            'title' => '手机号',
        ],

        'company' => [
            'title' => '公司名',
        ],

        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],

    // 『模型表单』设置项
    'edit_fields' => [
        'name' => [
            'title' => '用户名',
        ],
        'phone' => [
            'title' => '手机号',
        ],
        'company' => [
            'title' => '公司名',
        ],
        'address' => [
            'title' => '地址',
        ],
        'market' => [
            'title' => '所属市场',
        ],
        'vip_account' => [
            'title' => '诚信通账号',
        ],
        'vip_url' => [
            'title' => '诚信通地址',
        ],
        'vip_belong' => [
            'title' => '所属部门',
        ],
        'vip_type' => [
            'title' => '会员类型',
        ],
        'roles' => [
            'title'      => '用户角色',

            // 指定数据的类型为关联模型
            'type'       => 'relationship',

            // 关联模型的字段，用来做关联显示
            'name_field' => 'name',
        ],
    ],

    // 『数据过滤』设置
    'filters' => [
        'id' => [

            // 过滤表单条目显示名称
            'title' => '用户 ID',
        ],
        'name' => [
            'title' => '用户名',
        ],
        'email' => [
            'title' => '邮箱',
        ],
    ],
];