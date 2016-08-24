<?php
/*
 * This file is a part of HDS (HeBIS Discovery System). HDS is an 
 * extension of the open source library search engine VuFind, that 
 * allows users to search and browse beyond resources. More 
 * Information about VuFind you will find on http://www.vufind.org
 * 
 * Copyright (C) 2016 
 * HeBIS Verbundzentrale des HeBIS-Verbundes 
 * Goethe-Universität Frankfurt / Goethe University of Frankfurt
 * http://www.hebis.de
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

namespace Seboettg\CiteProc\Rendering;


use Seboettg\CiteProc\CiteProc;
use Seboettg\CiteProc\Context;
use Seboettg\CiteProc\Locale\Locale;

class GroupTest extends \PHPUnit_Framework_TestCase
{
    private $data = "{\"title\":\"Ein Buch\", \"URL\":\"http://foo.bar\"}";

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $context = new Context();
        $context->setLocale(new Locale("de-DE"));
        CiteProc::setContext($context);
    }

    public function testRenderDelimiter()
    {
        $str = '<group delimiter=" "><text term="retrieved"/><text term="from"/><text variable="URL"/></group>';
        $group = new Group(new \SimpleXMLElement($str));
        $this->assertEquals("abgerufen von http://foo.bar", $group->render(json_decode($this->data)));
    }

    public function testRenderAffixes()
    {
        $str = '<group prefix="[" suffix="]" delimiter=" "><text term="retrieved"/><text term="from"/><text variable="URL"/></group>';
        $group = new Group(new \SimpleXMLElement($str));
        $this->assertEquals("[abgerufen von http://foo.bar]", $group->render(json_decode($this->data)));
    }

    public function testRenderDisplay()
    {
        $str = '<group display="indent" prefix="[" suffix="]" delimiter=" "><text term="retrieved"/><text term="from"/><text variable="URL"/></group>';
        $group = new Group(new \SimpleXMLElement($str));
        $this->assertEquals("<div style=\"text-indent: 0px; padding-left: 45px;\">[abgerufen von http://foo.bar]</div>", $group->render(json_decode($this->data)));
    }
}
