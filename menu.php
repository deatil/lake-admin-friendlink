<?php

return [
    [
        "route" => "admin/Lfriendlink/index",
        "method" => "GET",
        "type" => 2,
        "is_menu" => 1,
        "title" => "友情链接",
        "icon" => "icon-shiyongwendang",
        "tip" => "",
        "listorder" => 115,
        "child" => [
            [
                "route" => "admin/Lfriendlink/index",
                "method" => "GET",
                "type" => 1,
                "is_menu" => 1,
                "title" => "友情链接",
                "icon" => "icon-shiyongwendang",
                "child" => [
                    [
                        "route" => "admin/Lfriendlink/add",
                        "method" => "GET",
                        "type" => 1,
                        "is_menu" => 0,
                        "title" => "添加链接",
                        "child" => [
                            [
                                "route" => "admin/Lfriendlink/add",
                                "method" => "POST",
                                "type" => 1,
                                "is_menu" => 0,
                                "title" => "添加链接",
                            ],
                        ],
                    ],
                    [
                        "route" => "admin/Lfriendlink/edit",
                        "method" => "GET",
                        "type" => 1,
                        "is_menu" => 0,
                        "title" => "编辑链接",
                        "child" => [
                            [
                                "route" => "admin/Lfriendlink/edit",
                                "method" => "POST",
                                "type" => 1,
                                "is_menu" => 0,
                                "title" => "编辑链接",
                            ],
                        ],
                    ],
                    [
                        "route" => "admin/Lfriendlink/delete",
                        "method" => "POST",
                        "type" => 1,
                        "is_menu" => 0,
                        "title" => "删除链接",
                    ],
                    [
                        "route" => "admin/Lfriendlink/status",
                        "method" => "POST",
                        "type" => 1,
                        "is_menu" => 0,
                        "title" => "链接状态",
                    ],
                ],
            ],
            [
                "route" => "admin/LfriendlinkCate/index",
                "method" => "GET",
                "type" => 1,
                "is_menu" => 1,
                "title" => "链接分类",
                "icon" => "icon-shiyongwendang",
                "child" => [
                    [
                        "route" => "admin/LfriendlinkCate/add",
                        "method" => "GET",
                        "type" => 1,
                        "is_menu" => 0,
                        "title" => "添加分类",
                        "child" => [
                            [
                                "route" => "admin/LfriendlinkCate/add",
                                "method" => "POST",
                                "type" => 1,
                                "is_menu" => 0,
                                "title" => "添加分类",
                            ],
                        ],
                    ],
                    [
                        "route" => "admin/LfriendlinkCate/edit",
                        "method" => "GET",
                        "type" => 1,
                        "is_menu" => 0,
                        "title" => "编辑分类",
                        "child" => [
                            [
                                "route" => "admin/LfriendlinkCate/edit",
                                "method" => "POST",
                                "type" => 1,
                                "is_menu" => 0,
                                "title" => "编辑分类",
                            ],
                        ],
                    ],
                    [
                        "route" => "admin/LfriendlinkCate/delete",
                        "method" => "POST",
                        "type" => 1,
                        "is_menu" => 0,
                        "title" => "删除分类",
                    ],
                    [
                        "route" => "admin/LfriendlinkCate/status",
                        "method" => "POST",
                        "type" => 1,
                        "is_menu" => 0,
                        "title" => "分类状态",
                    ],

                ],
            ],
        ],
    ],
];
