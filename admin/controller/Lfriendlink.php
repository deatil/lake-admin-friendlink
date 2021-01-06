<?php

namespace app\admin\controller;

use think\facade\Db;
use think\facade\View;

/**
 * 友情链接
 *
 * @create 2019-11-19
 * @author deatil
 */
class Lfriendlink extends LfriendlinkBase 
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
            
            $order = "fl.sort ASC, fl.id ASC";
            $friendlink = Db::name('lfriendlink')
                ->alias('fl')
                ->join('__LFRIENDLINK_CATE__ flc', 'fl.cate_id = flc.id', 'left')
                ->field('
                    fl.*,
                    flc.name as cate_name,
                    flc.title as cate_title
                ')
                ->where($map);
            
            $data = $friendlink
                ->order($order)
                ->page($page, $limit)
                ->select()
                ->toArray();
            $total = $friendlink->count();

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
            $validate = $this->validate($data, '\\app\\lfriendlink\\validate\\Lfriendlink');
            if (true !== $validate) {
                return $this->error($validate);
            }
            
            $data = array_merge($data, [
                'add_time' => time(),
                'add_ip' => request()->ip(),
            ]);
            
            $result = Db::name('lfriendlink')
                ->insert($data);
            if (false === $result) {
                return $this->error(Db::name('lfriendlink')->getError());
            }
            
            return $this->success('添加成功！', url('admin/lfriendlink/index'));
        } else {
            $cate = Db::name('lfriendlink_cate')
                ->order('sort ASC, id DESC')
                ->select()
                ->toArray();

            $this->assign([
                'cate' => $cate,
            ]);            
            
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
            $validate = $this->validate($data, '\\app\\lfriendlink\\validate\\Lfriendlink');
            if (true !== $validate) {
                return $this->error($validate);
            }
            
            $id = request()->post('id');
            if (empty($id)) {
                return $this->error('ID错误！');
            }
            
            $info = Db::name('lfriendlink')->where([
                'id' => $id,
            ])->find();
            if (empty($info)) {
                return $this->error('链接不存在！');
            }
            
            $data = array_merge($data, [
                'edit_time' => time(),
                'edit_ip' => request()->ip(),
            ]);
            
            $result = Db::name('lfriendlink')
                ->where([
                    'id' => $id,
                ])
                ->update($data);
            if (false === $result) {
                return $this->error(Db::name('lfriendlink')->getError());
            }
            
            return $this->success('修改成功！', url('admin/lfriendlink/index'));
        } else {
            $id = request()->param('id');
            if (empty($id)) {
                return $this->error('ID错误！');
            }
            
            $info = Db::name('lfriendlink')->where([
                'id' => $id ,
            ])->find();
            
            $cate = Db::name('lfriendlink_cate')
                ->order('sort ASC, id DESC')
                ->select()
                ->toArray();

            View::assign([
                'info' => $info,
                'cate' => $cate,
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
        $lfriendlink = Db::name('lfriendlink')->where([
            'id' => $id,
        ])->find();
        if (empty($lfriendlink)) {
            return $this->error('链接不存在！');
        }
        
        $result = Db::name('lfriendlink')->where([
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
        $result = Db::name('lfriendlink')
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