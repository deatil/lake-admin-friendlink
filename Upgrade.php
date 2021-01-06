<?php

namespace app\lfriendlink;

/**
 * 更新
 *
 * @create 2019-11-19
 * @author deatil
 */
class Upgrade
{

    /**
     * 执行
     * @return boolean
     *
     * @create 2019-11-19
     * @author deatil
     */
    public function run()
    {
        return true;
    }
    
    /**
     * 安装完回调
     * @return boolean
     *
     * @create 2019-11-19
     * @author deatil
     */
    public function end()
    {
        return true;
    }

}
