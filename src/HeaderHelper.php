<?php
namespace shengxiaoweimo\helper;

class HeaderHelper
{
    /**
     * 解决跨域问题设置header头
    * @param array $option    允许访问的域名响应的域名默认全部
     */
    public static function setCoreHeader($option = ['*'])
    {
        //响应域名
        header('Access-Control-Allow-Origin:' . implode(',' , $option));
        // 响应类型
        header('Access-Control-Allow-Methods:POST,GET');
        // 响应头设置
        header('Access-Control-Allow-Headers:access-control-allow-methods,access-control-allow-origin,access-token');
    }

    /**
     * 导出文件header头设置
     * @param string $fileName 导出的文件名称，文件后缀为.txt和.csv可以直接导出，其他格式还需处理
     * @param string $type     导出文件类型 txt , excle
     * csv文件换行\n,换单元格\t1
     */
    public static function setExportHeader($fileName , $type = 'txt')
    {
        if($type == 'excle'){
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        } else  {
            header('Content-Type: application/octet-stream');
        }

        header('Content-Disposition: attachment;filename=' . $fileName);
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header ('Cache-Control: cache, must-revalidate');
        header ('Pragma: public');
    }
}