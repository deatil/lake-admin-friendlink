<?php

namespace app\lfriendlink\validate;

use think\Validate;

/**
 * 设置模型
 *
 * @create 2019-11-19
 * @author deatil
 */
class LfriendlinkCate extends Validate 
{
    protected $rule = [
        'name' => 'require|unique:LfriendlinkCate|/^[a-zA-Z\w]{0,39}$/',
        'title' => 'require',
    ];
    
    protected $message = [
        'name.require' => '分类标识不能为空',
        'name.unique' => '分类标识已存在',
        'title.require' => '分类名称不能为空！',
    ];
    
    protected $scene = [
        'add' => [
            'name',
            'title',
        ],
        'edit' => [
            'name',
            'title',
        ]
    ];
}