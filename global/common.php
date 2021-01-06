<?php

use think\facade\Db;
use think\facade\Event;

/**
 * 分类列表
 *
 * @create 2019-11-20
 * @author deatil
 */
function lfriendlink_cates($order = '') {
    if (empty($order)) {
        $order = "sort ASC, id DESC";
    }
    
    $map = [
        ['status', '=', 1],
    ];
    $data = Db::name('lfriendlink_cate')
        ->field("name,title,description")
        ->where($map)
        ->order($order)
        ->select()
        ->toArray();

    return $data;
}

/**
 * 链接列表
 *
 * @create 2019-11-20
 * @author deatil
 */
function lfriendlink_links($cate = '', $order = '', $html = false) {
    if (empty($order)) {
        $order = "fl.sort ASC, fl.id DESC";
    }
    
    $map = [
        ['fl.status', '=', 1],
    ];
    
    if (!empty($cate)) {
        if (strpos($cate, ',') !== false) {
            $map[] = ['flc.name', 'in', explode(',', $cate)];
        } else {
            $map[] = ['flc.name', '=', $cate];
        }
    }
    
    $data = Db::name('lfriendlink')
        ->alias('fl')
        ->join('lfriendlink_cate flc', 'fl.cate_id = flc.id', 'left')
        ->field("
            fl.name,
            fl.url,
            fl.description,
            fl.logo,
            fl.type,
            fl.target,
            flc.name as cate_name,
            flc.title as cate_title
        ")
        ->where($map)
        ->order($order)
        ->select()
        ->toArray();
    
    if (!empty($data)) {
        foreach ($data as $k => $v) {
            $data[$k]['logo'] = lake_get_file_path($v['logo']);
            if ($html) {
                $data[$k]['url'] = sprintf(
                    '<a href="%s" target="%s" title="%s">%s</a>',
                    $v['url'],
                    $v['target'],
                    $v['description'],
                    $v['name']
                );
            }
        }
    }

    return $data;
}

/**
 * 链接列表显示
 *
 * @create 2020-1-14
 * @author deatil
 */
function lfriendlink_links_show($html = '', $cate = '', $order = '') {
    
    $links = lfriendlink_links($cate, $order, true);
    
    $link_html = '';
    if (!empty($links)) {
        foreach ($links as $link) {
            if (!empty($html)) {
                $link_html = str_replace([
                    '{url}',
                    '{target}',
                    '{name}',
                    '{description}',
                    '{logo}',
                    '{type}',
                    '{cate_name}',
                    '{cate_title}',
                ], [
                    $link['url'],
                    $link['target'],
                    $link['name'],
                    $link['description'],
                    $link['logo'],
                    $link['type'],
                    $link['cate_name'],
                    $link['cate_title'],
                ], $html);
            } else {
                $link_html .= $link['url'];
            }
        }
    }
    
    return $link_html;
}

// 模版行为显示
Event::listen('lfriendlink_link_show', function ($params) {
    if (!empty($param) && isset($param['cate'])) {
        $cate = $param['cate'];
    } else {
        $cate = '';
    }
    if (!empty($param) && isset($param['order'])) {
        $order = $param['order'];
    } else {
        $order = '';
    }
    
    $links = lfriendlink_links($cate, $order, true);
    $link_html = '';
    if (!empty($links)) {
        foreach ($links as $link) {
            $link_html .= $link['url'];
        }
    }
    
    if (!empty($param) && isset($param['html'])) {
        $tpl = $param['html'];
        
        $html = str_replace([
            '{link}',
        ], [
            $link_html,
        ], $tpl);
    } else {
        $html = '
            <div class="lfriendlink">
                友情链接：'.$link_html.'
            </div>    
        ';
    }
    
    return $html;
});
