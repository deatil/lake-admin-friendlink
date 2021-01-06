<?php

namespace app\admin\controller;

use think\facade\Db;
use think\facade\View;

/**
 * 友情链接分类
 *
 * @create 2019-11-19
 * @author deatil
 */
class LfriendlinkCate extends LfriendlinkBase 
{    
    
    /**
     * 框架初始化
     *
     * @create 2019-11-19
     * @author deatil
     */
    public function initialize() 
    {
        parent::initialize();
    }

    /**
     * 列表
     *
     * @create 2019-11-19
     * @author deatil
     */
    public function index() 
    {
        if ($this->request->isAjax()) {
            $limit = $this->request->param('limit/d', 20);
            $page = $this->request->param('page/d', 1);
            $map = $this->buildparams();
            
            $order = "sort ASC, id DESC";
            $data = Db::name('lfriendlink_cate')
                ->where($map)
                ->order($order)
                ->page($page, $limit)
                ->select()
                ->toArray();
            $total = Db::name('lfriendlink_cate')
                ->where($map)
                ->count();

            $result = [
                "code" => 0, 
                "count" => $total, 
                "data" => $data,
            ];
            return json($result);
        } else {            
            return View::fetch();
        }
    }

    /**
     * 添加
     *
     * @create 2019-11-19
     * @author deatil
     */
    public function add() 
    {
        if (request()->isPost()) {
            $data = request()->post();
            $validate = $this->validate($data, '\\app\\lfriendlink\\validate\\LfriendlinkCate');
            if (true !== $validate) {
                return $this->error($validate);
            }
            
            $data = array_merge($data, [
                'add_time' => time(),
                'add_ip' => request()->ip(),
            ]);
            
            $result = Db::name('lfriendlink_cate')
                ->insert($data);
            if (false === $result) {
                return $this->error(Db::name('lfriendlink_cate')->getError());
            }
            
            return $this->success('添加成功！', url('admin/LfriendlinkCate/index'));
        } else {
            return View::fetch();
        }
    }

    /**
     * 编辑
     *
     * @create 2019-11-19
     * @author deatil
     */
    public function edit() 
    {
        if (request()->isPost()) {
            $data = request()->post();
            $validate = $this->validate($data, '\\app\\lfriendlink\\validate\\LfriendlinkCate');
            if (true !== $validate) {
                return $this->error($validate);
            }
            
            $id = request()->post('id');
            if (empty($id)) {
                return $this->error('ID错误！');
            }
            
            $info = Db::name('lfriendlink_cate')->where([
                'id' => $id,
            ])->find();
            if (empty($info)) {
                return $this->error('链接分类不存在！');
            }
            
            $data = array_merge($data, [
                'edit_time' => time(),
                'edit_ip' => request()->ip(),
            ]);
            
            $result = Db::name('lfriendlink_cate')
                ->where([
                    'id' => $id,
                ])
                ->update($data);
            if (false === $result) {
                return $this->error(Db::name('lfriendlink_cate')->getError());
            }
            
            return $this->success('修改成功！', url('admin/LfriendlinkCate/index'));
        } else {
            $id = request()->param('id');
            if (empty($id)) {
                return $this->error('ID错误！');
            }
            
            $info = Db::name('lfriendlink_cate')->where([
                'id' => $id ,
            ])->find();

            View::assign([
                'info' => $info,
            ]);
            
            return View::fetch();
        }
    }

    /**
     * 删除
     *
     * @create 2019-11-19
     * @author deatil
     */
    public function delete($id = '') 
    {
        $lfriendlink = Db::name('lfriendlink_cate')->where([
            'id' => $id,
        ])->find();
        if (empty($lfriendlink)) {
            return $this->error('链接分类不存在！');
        }
        
        $result = Db::name('lfriendlink_cate')->where([
            'id' => $id,
        ])->delete();
        if (false === $result) {
            return $this->error('删除失败！');
        }
        
        return $this->success('删除成功！');
    }
    
    /**
     * 修改状态
     *
     * @create 2019-11-19
     * @author deatil
     */
    public function setstate() 
    {
        $id = request()->param('id');
        $status = input('status', '0', 'trim,intval');

        if (!$id) {
            return $this->error("非法操作！");
        }

        $map['id'] = $id;
        $result = Db::name('lfriendlink_cate')
            ->where($map)
            ->data([
                'status' => $status,
            ])
            ->update();
        if (false === $result) {
            return $this->error("设置失败！");
        }
        
        return $this->success("设置成功！");
    } 
    
}