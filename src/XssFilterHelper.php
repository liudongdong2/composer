<?php
namespace shengxiaoweimo\helper;
/**
 * XssFilterHelper::dataXssFilter($data);
 * Class XssFilter
 */

class XssFilterHelper
{
    public static $data = [];
    private static $FILER_WORDS =
        [
            '/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/','/script/','/javascript/','/vbscript/','/expression/','/applet/','/meta/','/xml/','/blink/','/link/','/style/','/embed/','/object/','/frame/','/layer/','/title/','/bgsound/','/base/','/onload/','/onunload/','/onchange/','/onsubmit/','/onreset/','/onselect/','/onblur/','/onfocus/','/onabort/','/onkeydown/','/onkeypress/','/onkeyup/','/onclick/','/ondblclick/','/onmousedown/','/onmousemove/','/onmouseout/','/onmouseover/','/onmouseup/','/onunload/'
        ];

    public static function dataXssFilter($data)
    {
        static::$data = $data;
        static::xssFilterFunc(XssFilter::$data);
        return static::$data;
    }

    private static function xssFilterFunc(&$data)
    {
        if (is_array($data))
        {
            foreach ($data as $key => $value)
            {
                if (!is_array($value))
                {
                    if (!get_magic_quotes_gpc())
                    {
                        $value  = addslashes($value);
                    }
                    $value       = preg_replace(Self::$FILER_WORDS , '' ,$value);
                    $data[$key]     = htmlentities(strip_tags($value));
                }
                else
                {
                    static::xssFilterFunc($data[$key]);
                }
            }
        }
    }
}