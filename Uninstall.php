<?php

namespace app\lfriendlink;

use think\facade\Db;

/**
 * 卸载脚本
 *
 * @create 2019-11-19
 * @author deatil
 */
class Uninstall
{
    // 相关表
    private $tableList = [
        'lfriendlink',
        'lfriendlink_cate',
    ];

    /**
     * 卸载
     * @return boolean
     *
     * @create 2019-11-19
     * @author deatil
     */
    public function run()
    {
        if (request()->param('clear') == 1) {
            // 删除表
            if (!empty($this->tableList)) {
                $dbPrefix = app()->db->connect()->getConfig('prefix');
                foreach ($this->tableList as $tablename) {
                    if (!empty($tablename)) {
                        $tablename = $dbPrefix . $tablename;
                        Db::execute("DROP TABLE IF EXISTS `{$tablename}`;");
                    }
                }
            }
        }

        return true;
    }

}
