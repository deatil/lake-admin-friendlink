<?php

namespace app\lfriendlink\validate;

use think\Validate;

/**
 * 设置模型
 *
 * @create 2019-11-19
 * @author deatil
 */
class Lfriendlink extends Validate 
{
    protected $rule = [
        'name' => 'require',
        'type' => 'require',
    ];
    
    protected $message = [
        'name.require' => '链接名称不能为空',
        'type.require' => '链接类型不能为空！',
    ];
    
    protected $scene = [
        'add' => 'name, type',
        'edit' => 'name, type'
    ];
}