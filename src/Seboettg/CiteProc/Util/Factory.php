<?php

namespace Seboettg\CiteProc\Util;
use Seboettg\CiteProc\Exception\CiteProcException;


/**
 * Class Factory
 * @package Seboettg\CiteProc\Util
 *
 * @author Sebastian Böttger <boettger@hebis.uni-frankfurt.de>
 */
class Factory
{
    const CITE_PROC_NODE_NAMESPACE = "Seboettg\\CiteProc\\Rendering";

    static $nodes = [

        'layout'    => "\\Layout",
        'text'      => "\\Text",
        "macro"     => "\\Macro",
        'date'      => "\\Date",
        "number"    => "\\Number",
        "names"     => "\\Names",
        "label"     => "\\Label",
        "group"     => "\\Group",
        "choose"    => "\\Choose\\Choose",
        "if"        => "\\Choose\\ChooseIf",
        "else-if"   => "\\Choose\\ChooseElseIf",
        "else"      => "\\Choose\\ChooseElse",

    ];

    public static function create($node)
    {
        $nodeClass = self::CITE_PROC_NODE_NAMESPACE . self::$nodes[$node->getName()];
        if (!class_exists($nodeClass)) {
            //TODO: throw ex
            throw new CiteProcException("Class \"$nodeClass\" does not exist");
        }

        return new $nodeClass($node);
    }


    public static function loadLocale($lang) {
        $directory = __DIR__."/../../../../vendor/academicpuma/locales";
        $file = $directory . "/locales-" . ($lang) . ".xml";

        if (file_exists($file) == false) {
            throw new CiteProcException("Locale file \"locale-$file.xml\" does not exist!");
        }

        $content = file_get_contents($file);
        return new \SimpleXMLElement($content);
    }
}