<?php

namespace App\Http\Controllers;

use Exception;
use App\BanglaWorld;
use App\EnglishWorld;
use App\BanglaCountry;
use GuzzleHttp\Client;
use App\EnglishCountry;
use App\BanglaBangladesh;
use App\BanglaDistrict;
use App\EnglishBangladesh;
use App\EnglishDistrict;
use Illuminate\Http\Request;
use KubAT\PhpSimple\HtmlDomParser;

class DBInputController extends Controller
{
    public function callAll()
    {
        $this->bangladeshInput();
        $this->countryInput();
        $this->worldInput();
        $this->districtInput();
        $this->districtInputBangla();
        // return ['success' => true];
    }
    protected function bangladeshInput()
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
                $bd = EnglishCountry::where('country_name', 'Bangladesh')->first();
                $dataEn = [
                    'total_cases' => $bd->total_cases,
                    'total_recovered' => $bd->total_recovered,
                    'total_deaths' => $bd->total_deaths,
                    'active_cases' => $bd->active_cases,
                    'critical_cases' => $bd->critical_cases,
                    'active_percentage' => $bd->active_percentage,
                    'recovered_percentage' => $bd->recovered_percentage,
                    'death_percentage' => $bd->death_percentage,
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
                $dataBn = [
                    'total_cases' => $this->etobno($dataEn['total_cases']),
                    'total_recovered' => $this->etobno($dataEn['total_recovered']),
                    'total_deaths' => $this->etobno($dataEn['total_deaths']),
                    'active_cases' => $this->etobno($dataEn['active_cases']),
                    'critical_cases' => $this->etobno($dataEn['critical_cases']),
                    'active_percentage' => $this->etobno($dataEn['active_percentage']),
                    'recovered_percentage' => $this->etobno($dataEn['recovered_percentage']),
                    'death_percentage' => $this->etobno($dataEn['death_percentage']),
                    'total_quarantine' => $this->etobno($dataEn['total_quarantine']),
                    'finished_quarantine' => $this->etobno($dataEn['finished_quarantine']),
                    'total_isolation' => $this->etobno($dataEn['total_isolation']),
                    'finished_isolation' => $this->etobno($dataEn['finished_isolation'])
                ];
                if (BanglaBangladesh::where('id', 1)->update($dataBn) && EnglishBangladesh::where('id', 1)->update($dataEn)) {
                    return true;
                }
            }
        } catch (Exception $e) {
            return false;
        }
        return false;
    }

    protected function countryInput()
    {
        try {
            $cntb = 0;
            $cnte = 0;
            $url = "https://www.worldometers.info/coronavirus/";
            $client = new Client();
            $response = $client->request('GET', $url);
            $isValidURL = $response->getStatusCode();
            if ($isValidURL == 200) {
                $dom = HtmlDomParser::file_get_html($url);
                $tbodys = $dom->find('tbody');
                $dataEn = array();
                $cnt = 0;
                $trs = $tbodys[0]->find('tr');
                for ($i = 1; $i < count($trs); $i++) {
                    $td = $trs[$i]->find('td');
                    $dataEnc[$cnt]['country_name'] = (!empty($td[0]->find('a')) ? $td[0]->find('a')[0]->text() : $td[0]->text());
                    $dataBnc[$cnt]['country_name'] = $dataEnc[$cnt]['country_name'];
                    $dataBn[$cnt]['country_name_bangla'] = $dataEnc[$cnt]['country_name'];
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
                    $dataEn[$cnt]['death_percentage'] =  ($dataEn[$cnt]['total_cases'] != 0 ? ($dataEn[$cnt]['total_deaths'] / $dataEn[$cnt]['total_cases']) * 100 : 0);
                    $dataBn[$cnt]['death_percentage'] =  $this->etobno($dataEn[$cnt]['death_percentage']);
                    $dataEn[$cnt]['recovered_percentage'] =  ($dataEn[$cnt]['total_cases'] != 0 ? ($dataEn[$cnt]['total_recovered'] / $dataEn[$cnt]['total_cases']) * 100 : 0);
                    $dataBn[$cnt]['recovered_percentage'] =  $this->etobno($dataEn[$cnt]['recovered_percentage']);
                    $dataEn[$cnt]['active_percentage'] =  100 - ($dataEn[$cnt]['death_percentage'] + $dataEn[$cnt]['recovered_percentage']);
                    $dataBn[$cnt]['active_percentage'] =  $this->etobno($dataEn[$cnt]['active_percentage']);
                    BanglaCountry::where('country_name', $dataBnc[$cnt]['country_name'])->update($dataBn[$cnt]);
                    EnglishCountry::where('country_name', $dataEnc[$cnt]['country_name'])->update($dataEn[$cnt]);
                    $cnt++;
                }
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
        return false;
    }

    protected function worldInput()
    {
        try {
            $cnte = 0;
            $cntb = 0;
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
                $mild_cases = $this->trimCon($dom->find('span[class=number-table]')[0]->text());
                $critical_cases = $this->trimCon($dom->find('span[class=number-table]')[1]->text());
                $death_percentage = ($total_cases != 0 ? ($total_deaths / $total_cases) * 100 : 0);
                $recovered_percentage = ($total_cases != 0 ? ($total_recovered / $total_cases) * 100 : 0);
                $active_percentage = 100 - ($death_percentage + $recovered_percentage);

                $dataEn = [
                    'total_cases' => $total_cases,
                    'total_deaths' => $total_deaths,
                    'total_recovered' => $total_recovered,
                    'active_cases' => $active_cases,
                    'mild_cases' => $mild_cases,
                    'critical_cases' => $critical_cases,
                    'death_percentage' => $death_percentage,
                    'recovered_percentage' => $recovered_percentage,
                    'active_percentage' => $active_percentage,
                ];
                $dataBn = [
                    'total_cases' => $this->etobno($total_cases),
                    'total_deaths' => $this->etobno($total_deaths),
                    'total_recovered' => $this->etobno($total_recovered),
                    'active_cases' => $this->etobno($active_cases),
                    'mild_cases' => $this->etobno($mild_cases),
                    'critical_cases' => $this->etobno($critical_cases),
                    'death_percentage' => $this->etobno($death_percentage),
                    'recovered_percentage' => $this->etobno($recovered_percentage),
                    'active_percentage' => $this->etobno($active_percentage),
                ];
                if (EnglishWorld::where('id', 1)->update($dataEn) && BanglaWorld::where('id', 1)->update($dataBn)) {
                    return true;
                }
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
        return false;
    }

    protected function districtInput()
    {
        try {
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
                    $dataN[$cnt]['district_name_bangla'] = $row->find('div')[0]->text();
                    $data[$cnt]['total_cases'] = $this->etobno($this->encodetoeno($row->find('div')[1]->text()));
                    $data[$cnt]['total_recovered'] = $this->etobno($this->encodetoeno($row->find('div')[3]->text()));
                    $data[$cnt]['total_deaths'] = $this->etobno($this->encodetoeno($row->find('div')[4]->text()));
                    $data[$cnt]['active_cases'] = $this->etobno($this->encodetoeno($row->find('div')[2]->text()));
                    $data[$cnt]['quarantine'] = $this->etobno($this->encodetoeno($row->find('div')[5]->text()));
                    $data[$cnt]['death_percentage'] = $this->etobno(($this->btoenoS($data[$cnt]['total_cases']) != 0 ? ($this->btoenoS($data[$cnt]['total_deaths']) / $this->btoenoS($data[$cnt]['total_cases'])) * 100 : 0));
                    $data[$cnt]['recovered_percentage'] = $this->etobno(($this->btoenoS($data[$cnt]['total_cases']) != 0 ? ($this->btoenoS($data[$cnt]['total_recovered']) / $this->btoenoS($data[$cnt]['total_cases'])) * 100 : 0));
                    $data[$cnt]['active_percentage'] = $this->etobno(($this->btoenoS($data[$cnt]['total_cases']) != 0 ? (100 - ($this->btoenoS($data[$cnt]['death_percentage']) + $this->btoenoS($data[$cnt]['recovered_percentage']))) : 0));
                    BanglaDistrict::where('district_name_bangla', $dataN[$cnt]['district_name_bangla'])->update($data[$cnt]);
                    $cnt++;
                }
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
        return false;
    }
    public function districtInputBangla()
    {
        try {
            $getDatas = BanglaDistrict::select('district_name', 'total_cases', 'total_recovered', 'total_deaths', 'active_cases', 'quarantine', 'death_percentage', 'recovered_percentage', 'active_percentage')->get();
            $cnt = 0;
            $cntn = 0;
            foreach ($getDatas as $getData) {
                $dataEnn[$cnt]['district_name'] = $getData->district_name;
                $dataEn[$cnt]['total_cases'] = $this->btoenoS($getData->total_cases);
                $dataEn[$cnt]['total_recovered'] = $this->btoenoS($getData->total_recovered);
                $dataEn[$cnt]['total_deaths'] = $this->btoenoS($getData->total_deaths);
                $dataEn[$cnt]['active_cases'] = $this->btoenoS($getData->active_cases);
                $dataEn[$cnt]['quarantine'] = $this->btoenoS($getData->quarantine);
                $dataEn[$cnt]['death_percentage'] = $this->btoenoS($getData->death_percentage);
                $dataEn[$cnt]['recovered_percentage'] = $this->btoenoS($getData->recovered_percentage);
                $dataEn[$cnt]['active_percentage'] = $this->btoenoS($getData->active_percentage);
                EnglishDistrict::where('district_name', $dataEnn[$cnt]['district_name'])->update($dataEn[$cnt]);
                $cnt++;
            }
            return $cntn;
        } catch (Exception $e) {
            return $e;
        }
        return false;
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
        $search = array("০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", ",");
        $replace = array("0", "1", "2", "3", "4", "5", '6', "7", "8", "9", "");
        return (float) str_replace($search, $replace, $str);
    }
    protected function encodetoeno($str)
    {
        $search = array("&#2534;", "&#2535;", "&#2536;", "&#2537;", "&#2538;", "&#2539;", '&#2540;', "&#2541;", "&#2542;", "&#2543;");
        $replace = array("0", "1", "2", "3", "4", "5", '6', "7", "8", "9");
        return (int) str_replace($search, $replace, $str);
    }
}
