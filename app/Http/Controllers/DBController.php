<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\BanglaDistrict;
use App\EnglishDistrict;
use Illuminate\Http\Request;
use KubAT\PhpSimple\HtmlDomParser;

class DBController extends Controller
{
    public function zila()
    {
        $url = "https://en.wikipedia.org/wiki/List_of_districts_of_Bangladesh";
        $dom = HtmlDomParser::file_get_html($url);
        $tr = $dom->find('tbody')[0]->find('tr');
        $cnt = 0;
        for ($i = 1; $i < 65; $i++) {
            $data[$cnt]['district_name'] = $this->delDestrict($tr[$i]->find('td')[0]->find('a')[0]->text());
            // $data[$cnt]['district_name_bangla'] = $tr[$i]->find('td')[1]->text();
            $cnt++;
        }
        dd(EnglishDistrict::insert($data));
    }
    protected function delDestrict($str)
    {
        return str_replace(" District", "", $str);
    }
}
