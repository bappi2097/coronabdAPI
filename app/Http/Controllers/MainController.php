<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use KubAT\PhpSimple\HtmlDomParser;

class MainController extends Controller
{
    protected function quarantine()
    {
        try {
            $data = null;
            $url = "http://corona.gov.bd";
            $client = new Client();
            $response = $client->request('GET', $url);
            $isValidURL = $response->getStatusCode();
            if ($isValidURL == 200) {
                $html = $response->getBody()->getContents();
                $dom = HtmlDomParser::str_get_html($html);
                $ul = $dom->find('ul[class="list-inline custom-ulli-css"]')[0];
                $lis = $ul->find('li');
                $total_quarantine = $lis[4]->find('div', 0)->text();
                $finished_quarantine = $lis[5]->find('div', 0)->text();
                $total_isolation = $lis[6]->find('div', 0)->text();
                $finished_isolation = $lis[7]->find('div', 0)->text();
                $data = [
                    'total_quarantine' => $this->trimCon(
                        $this->btoenoS($total_quarantine)
                    ),
                    'finished_quarantine' => $this->trimCon(
                        $this->btoenoS($finished_quarantine)
                    ),
                    'total_isolation' => $this->trimCon(
                        $this->btoenoS($total_isolation)
                    ),
                    'finished_isolation' => $this->trimCon(
                        $this->btoenoS($finished_isolation)
                    )
                ];
                dd($data);
            }
        } catch (Exception $e) {
            //
        }
        return json_encode($data);
    }
    public function world()
    {
        $client = new Client();
        $url = "https://www.worldometers.info/coronavirus/";
        $response = $client->request('GET', $url);
        $isValidURL = $response->getStatusCode();
        if ($isValidURL == 200) {
            $dom = HtmlDomParser::file_get_html($url);
            $total = $dom->find('div[class=maincounter-number]');
            $total_cases = $this->trimCon($total[0]->text());
            $total_deaths = $this->trimCon($total[1]->text());
            $total_recovered = $this->trimCon($total[2]->text());
            $active_cases = $this->trimCon($dom->find('div[class=number-table-main]')[0]->text());
            $mild_condition = $this->trimCon($dom->find('span[class=number-table]')[0]->text());
            $critical_condition = $this->trimCon($dom->find('span[class=number-table]')[1]->text());
            $death_percentage = ($total_deaths / $total_cases) * 100;
            $recovered_percentage = ($total_recovered / $total_cases) * 100;
            $active_percentage = 100 - ($death_percentage + $recovered_percentage);

            $data = [
                'total_cases' => $total_cases,
                'total_deaths' => $total_deaths,
                'total_recovered' => $total_recovered,
                'active_cases' => $active_cases,
                'mild_condition' => $mild_condition,
                'critical_condition' => $critical_condition,
                'death_percentage' => $death_percentage,
                'recovered_percentage' => $recovered_percentage,
                'active_percentage' => $active_percentage,
            ];
            dd($data);
        }
    }


    public function countries()
    {
        $url = "https://www.worldometers.info/coronavirus/";
        $client = new Client();
        $response = $client->request('GET', $url);
        $isValidURL = $response->getStatusCode();
        if ($isValidURL == 200) {
            $dom = HtmlDomParser::file_get_html($url);
            $tbodys = $dom->find('tbody');
            $dataEn = array();
            $cnt = 0;
            foreach ($tbodys as $tbody) {
                $trs = $tbody->find('tr');
                for ($i = 1; $i < count($trs); $i++) {
                    $td = $trs[$i]->find('td');
                    $dataEn[$cnt]['country_name'] = (!empty($td[0]->find('a')) ? $td[0]->find('a')[0]->text() : $td[0]->text());
                    $dataBn[$cnt]['country_name'] = $this->etobno($dataEn[$cnt]['country_name']);
                    $dataEn[$cnt]['total_cases'] = $this->trimCon($td[1]->text());
                    $dataBn[$cnt]['total_cases'] = $this->etobno($dataEn[$cnt]['total_cases']);
                    $dataEn[$cnt]['new_cases'] = $this->trimCon($td[2]->text());
                    $dataBn[$cnt]['new_cases'] = $this->etobno($dataEn[$cnt]['new_cases']);
                    $dataEn[$cnt]['total_deaths'] = $this->trimCon($td[3]->text());
                    $dataBn[$cnt]['total_deaths'] = $this->etobno($dataEn[$cnt]['total_deaths']);
                    $dataEn[$cnt]['new_deaths'] = $this->trimCon($td[4]->text());
                    $dataBn[$cnt]['new_deaths'] = $this->etobno($dataEn[$cnt]['new_deaths']);
                    $dataEn[$cnt]['total_recovered'] = $this->trimCon($td[5]->text());
                    $dataBn[$cnt]['total_recovered'] = $this->etobno($dataEn[$cnt]['total_recovered']);
                    $dataEn[$cnt]['active_cases'] = $this->trimCon($td[6]->text());
                    $dataBn[$cnt]['active_cases'] = $this->etobno($dataEn[$cnt]['active_cases']);
                    $dataEn[$cnt]['critical_cases'] = $this->trimCon($td[7]->text());
                    $dataBn[$cnt]['critical_cases'] = $this->etobno($dataEn[$cnt]['critical_cases']);
                    $dataEn[$cnt]['death_percentage'] =  ($dataEn[$cnt]['total_deaths'] / $dataEn[$cnt]['total_cases']) * 100;
                    $dataBn[$cnt]['death_percentage'] =  $this->etobno($dataEn[$cnt]['death_percentage']);
                    $dataEn[$cnt]['recovered_percentage'] =  ($dataEn[$cnt]['total_recovered'] / $dataEn[$cnt]['total_cases']) * 100;
                    $dataBn[$cnt]['recovered_percentage'] =  $this->etobno($dataEn[$cnt]['recovered_percentage']);
                    $dataEn[$cnt]['active_percentage'] =  100 - ($dataEn[$cnt]['death_percentage'] + $dataEn[$cnt]['recovered_percentage']);
                    $dataBn[$cnt]['active_percentage'] =  $this->etobno($dataEn[$cnt]['active_percentage']);;
                    $cnt++;
                }
            }
            dd($dataBn);
        }
    }

    public function zilas()
    {
        $url = "https://www.somoynews.tv/coronavirus/bangladesh";
        $client = new Client();
        $response = $client->request('GET', $url);
        $isValidURL = $response->getStatusCode();
        if ($isValidURL == 200) {
            $html = $response->getBody()->getContents();
            $dom = HtmlDomParser::str_get_html($html);
            $rows = $dom->find('div[class=row border-bottom h4]');
            $cnt = 0;
            foreach ($rows as $row) {
                $data[$cnt]['zila_name'] = $row->find('div')[0]->text();
                $data[$cnt]['total_cases'] = $this->encodetoeno($row->find('div')[1]->text());
                $data[$cnt]['total_recovered'] = $this->encodetoeno($row->find('div')[3]->text());
                $data[$cnt]['total_deaths'] = $this->encodetoeno($row->find('div')[4]->text());
                $data[$cnt]['active_cases'] = $this->encodetoeno($row->find('div')[2]->text());
                $data[$cnt]['quarantine'] = $this->encodetoeno($row->find('div')[5]->text());
                $data[$cnt]['death_percentage'] = ($data[$cnt]['total_deaths'] / $data[$cnt]['total_cases']) * 100;
                $data[$cnt]['recovered_percentage'] = ($data[$cnt]['total_recovered'] / $data[$cnt]['total_cases']) * 100;
                $data[$cnt]['active_percentage'] = 100 - ($data[$cnt]['death_percentage'] + $data[$cnt]['recovered_percentage']);
                $cnt++;
            }
        }
        dd($data);
    }


    public function test()
    {
        $url = "http://localhost/new/API/APIv3/public/quarantine";
        $datainjson = file_get_contents($url);
        $data = json_decode($datainjson, true);
        dd($data);
    }
    protected function trimCon($data)
    {
        return (int) preg_replace('/[^0-9]/i', '', $data);
    }
    protected function etobnoS($str)
    {
        $search = array("0", "1", "2", "3", "4", "5", '6', "7", "8", "9");
        $replace = array("০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯");
        return str_replace($search, $replace, $str);
    }
    protected function etobno($no)
    {
        $str = (string) $no;
        $search = array("0", "1", "2", "3", "4", "5", '6', "7", "8", "9");
        $replace = array("০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯");
        return str_replace($search, $replace, $str);
    }
    protected function btoenoS($str)
    {
        $search = array("০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯");
        $replace = array("0", "1", "2", "3", "4", "5", '6', "7", "8", "9");
        return str_replace($search, $replace, $str);
    }
    protected function encodetoeno($str)
    {
        $search = array("&#2534;", "&#2535;", "&#2536;", "&#2537;", "&#2538;", "&#2539;", '&#2540;', "&#2541;", "&#2542;", "&#2543;");
        $replace = array("0", "1", "2", "3", "4", "5", '6', "7", "8", "9");
        return (int) str_replace($search, $replace, $str);
    }
}
