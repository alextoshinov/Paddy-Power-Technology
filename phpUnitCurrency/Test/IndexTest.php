<?php
namespace phpUnitCurrency\Test;
require_once '../index.php';


class IndexTest extends \PHPUnit_Framework_TestCase
{
    public function test_json_content()
    {
        $url = 'http://rocky-brushlands-8739.herokuapp.com/rates';
        $content = file_get_contents($url);
        $this->assertJson($content);
    }
    //
    public function testArrayCount()
    {
        $pieces = explode(" ", 'CONVERT 3 EUR to USD');
        $this->assertCount(5, $pieces);
    }
    //
    public function testCheck_code() {
        $url = 'http://rocky-brushlands-8739.herokuapp.com/rates';
        $code = 'EUR';
        $content = file_get_contents($url);
        $curencies = json_decode($content, true);
        foreach($curencies as $curency)
        {
            if(in_array($code, $curency))
            {
                $check_code = true;
            }
            else {
                continue;
            }
        }
        $this->assertTrue($check_code);
    }


}

