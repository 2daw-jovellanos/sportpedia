<?php
class Ti
{
    private static $extend;
    private static $actualBlockName;
    private static $blocks;


    
    const TI_EXTENDED_MARK="{[{[TI_EXTENDED_MARK]}]}]}";

    static function extend($viewname)
    {
        
        self::$extend = $viewname;
    }

    static function startBlock($name)
    {
        self::$actualBlockName = $name;
        ob_start();
    }

    static function getExtendedBlock()
    {
        echo self::TI_EXTENDED_MARK;
    }

    static function endBlock()
    {
        $buff = ob_get_clean();
        if (self::$extend) {
            self::$blocks[self::$actualBlockName] = $buff;
        } else {
            if (isset(self::$blocks[self::$actualBlockName])) {
                $block = self::$blocks[self::$actualBlockName];
                echo str_replace(self::TI_EXTENDED_MARK, $buff, $block);
            } else {
                echo $buff;
            }
        }
    }

    static function endExtend()
    {
        $viewname = self::$extend;
        self::$extend = false;
        ob_start();
        require $viewname;
        echo ob_get_clean();
    }

}
