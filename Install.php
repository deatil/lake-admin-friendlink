<?php

namespace app\lfriendlink;

use Lake\Module;

/**
 * 安装脚本
 *
 * @create 2019-11-19
 * @author deatil
 */
class Install
{
    /**
     * 安装完回调
     * @return boolean
     *
     * @create 2019-11-19
     * @author deatil
     */
    public function end()
    {    
        $Module = new Module();
        
        // 清除旧数据
        if (request()->param('clear') == 1) {
            // 
        }
        
        // 安装数据库
        $runSqlStatus = $Module->runSQL(__DIR__ . "/install/install.sql");
        if (!$runSqlStatus) {
            return false;
        }
        
        return true;
    }

}
