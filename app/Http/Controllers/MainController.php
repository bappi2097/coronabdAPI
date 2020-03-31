<?php

namespace App\Http\Controllers;

use Exception;
use App\BanglaWorld;
use App\EnglishWorld;
use App\BanglaCountry;
use App\BanglaDistrict;
use App\EnglishCountry;
use App\EnglishDistrict;
use App\BanglaBangladesh;
use App\EnglishBangladesh;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function callFunc()
    {
        dd($this->getEnglishAllDistrict());
        return $this->getEnglishAllDistrict();
        return $this->getBanglaAllDistrict();
        return $this->getEnglishWorld();
        return $this->getBanglaWorld();
        return $this->getEnglishAllCountry();
        $this->getBanglaAllCountry();
        dd($this->getEnglishBangladesh());
        $this->getBanglaBangladesh();
    }
    public function getBanglaWorld()
    {
        $dataWorld = BanglaWorld::first();
        $data = [
            'data' => [
                'total_cases' => $dataWorld->total_cases,
                'total_recovered' => $dataWorld->total_recovered,
                'total_deaths' => $dataWorld->total_deaths,
                'active_cases' => $dataWorld->active_cases,
                'mild_cases' => $dataWorld->mild_cases,
                'critical_cases' => $dataWorld->critical_cases,
                'active_percentage' => $dataWorld->active_percentage,
                'recovered_percentage' => $dataWorld->recovered_percentage,
                'death_percentage' => $dataWorld->death_percentage,
            ],
            'source' => "https://www.worldometers.info/coronavirus/",
            'visit' => "https://coronabd.xyz/",
        ];
        return $data;
    }
    public function getEnglishWorld()
    {
        $dataWorld = EnglishWorld::first();
        $data = [
            'data' => [
                'total_cases' => $dataWorld->total_cases,
                'total_recovered' => $dataWorld->total_recovered,
                'total_deaths' => $dataWorld->total_deaths,
                'active_cases' => $dataWorld->active_cases,
                'mild_cases' => $dataWorld->mild_cases,
                'critical_cases' => $dataWorld->critical_cases,
                'active_percentage' => $dataWorld->active_percentage,
                'recovered_percentage' => $dataWorld->recovered_percentage,
                'death_percentage' => $dataWorld->death_percentage,
            ],
            'source' => "https://www.worldometers.info/coronavirus/",
            'visit' => "https://coronabd.xyz/",
        ];
        return $data;
    }
    public function getBanglaBangladesh()
    {
        $dataBangladesh = BanglaBangladesh::first();
        $data = [
            'data' => [
                'total_cases' => $dataBangladesh->total_cases,
                'total_recovered' => $dataBangladesh->total_recovered,
                'total_deaths' => $dataBangladesh->total_deaths,
                'active_cases' => $dataBangladesh->active_cases,
                'total_quarantine' => $dataBangladesh->total_quarantine,
                'finished_quarantine' => $dataBangladesh->finished_quarantine,
                'total_isolation' => $dataBangladesh->total_isolation,
                'finished_isolation' => $dataBangladesh->finished_isolation,
                'critical_cases' => $dataBangladesh->critical_cases,
                'active_percentage' => $dataBangladesh->active_percentage,
                'recovered_percentage' => $dataBangladesh->recovered_percentage,
                'death_percentage' => $dataBangladesh->death_percentage,
            ],
            'source' => [
                0 => "http://corona.gov.bd",
                1 => "https://www.worldometers.info/coronavirus/",
            ],
            'visit' => "https://coronabd.xyz/",
        ];
        return $data;
    }
    public function getEnglishBangladesh()
    {
        $dataBangladesh = EnglishBangladesh::first();
        $data = [
            'data' => [
                'total_cases' => $dataBangladesh->total_cases,
                'total_recovered' => $dataBangladesh->total_recovered,
                'total_deaths' => $dataBangladesh->total_deaths,
                'active_cases' => $dataBangladesh->active_cases,
                'total_quarantine' => $dataBangladesh->total_quarantine,
                'finished_quarantine' => $dataBangladesh->finished_quarantine,
                'total_isolation' => $dataBangladesh->total_isolation,
                'finished_isolation' => $dataBangladesh->finished_isolation,
                'critical_cases' => $dataBangladesh->critical_cases,
                'active_percentage' => $dataBangladesh->active_percentage,
                'recovered_percentage' => $dataBangladesh->recovered_percentage,
                'death_percentage' => $dataBangladesh->death_percentage,
            ],
            'source' => [
                0 => "http://corona.gov.bd",
                1 => "https://www.worldometers.info/coronavirus/",
            ],
            'visit' => "https://coronabd.xyz/",
        ];
        return $data;
    }
    public function getBanglaAllCountry()
    {
        $dataCountries = BanglaCountry::get();
        $data = array();
        $cnt = 0;
        foreach ($dataCountries as $dataCountry) {
            $dataC[$cnt]['country_name'] = $dataCountry->country_name;
            // $dataC[$cnt]['country_name_bangla'] = $dataCountry->country_name_bangla; //change
            $dataC[$cnt]['total_cases'] = $dataCountry->total_cases;
            $dataC[$cnt]['new_cases'] = $dataCountry->new_cases;
            $dataC[$cnt]['total_recovered'] = $dataCountry->total_recovered;
            $dataC[$cnt]['total_deaths'] = $dataCountry->total_deaths;
            $dataC[$cnt]['new_deaths'] = $dataCountry->new_deaths;
            $dataC[$cnt]['active_cases'] = $dataCountry->active_cases;
            $dataC[$cnt]['critical_cases'] = $dataCountry->critical_cases;
            $dataC[$cnt]['active_percentage'] = $dataCountry->active_percentage;
            $dataC[$cnt]['recovered_percentage'] = $dataCountry->recovered_percentage;
            $dataC[$cnt]['death_percentage'] = $dataCountry->death_percentage;
            $cnt++;
        }
        $data = [
            "data" => $dataC,
            'source' => "https://www.worldometers.info/coronavirus/",
            'visit' => "https://coronabd.xyz/",
        ];
        return $data;
    }
    public function getEnglishAllCountry()
    {
        $dataCountries = EnglishCountry::get();
        $data = array();
        $cnt = 0;
        foreach ($dataCountries as $dataCountry) {
            $dataC[$cnt]['country_name'] = $dataCountry->country_name;
            $dataC[$cnt]['total_cases'] = $dataCountry->total_cases;
            $dataC[$cnt]['new_cases'] = $dataCountry->new_cases;
            $dataC[$cnt]['total_recovered'] = $dataCountry->total_recovered;
            $dataC[$cnt]['total_deaths'] = $dataCountry->total_deaths;
            $dataC[$cnt]['new_deaths'] = $dataCountry->new_deaths;
            $dataC[$cnt]['active_cases'] = $dataCountry->active_cases;
            $dataC[$cnt]['critical_cases'] = $dataCountry->critical_cases;
            $dataC[$cnt]['active_percentage'] = $dataCountry->active_percentage;
            $dataC[$cnt]['recovered_percentage'] = $dataCountry->recovered_percentage;
            $dataC[$cnt]['death_percentage'] = $dataCountry->death_percentage;
            $cnt++;
        }
        $data = [
            "data" => $dataC,
            'source' => "https://www.worldometers.info/coronavirus/",
            'visit' => "https://coronabd.xyz/",
        ];
        return $data;
    }
    public function getBanglaAllDistrict()
    {
        $dataDistricts = BanglaDistrict::get();
        $cnt = 0;
        foreach ($dataDistricts as $dataDistrict) {
            $dataC[$cnt]['district_name'] = $dataDistrict->district_name;
            $dataC[$cnt]['district_name_bangla'] = $dataDistrict->district_name_bangla;
            // $dataC[$cnt]['division_name'] = $dataDistrict->division_name;   //change
            $dataC[$cnt]['total_cases'] = $dataDistrict->total_cases;
            $dataC[$cnt]['total_recovered'] = $dataDistrict->total_recovered;
            $dataC[$cnt]['total_deaths'] = $dataDistrict->total_deaths;
            $dataC[$cnt]['active_cases'] = $dataDistrict->active_cases;
            $dataC[$cnt]['active_percentage'] = $dataDistrict->active_percentage;
            $dataC[$cnt]['recovered_percentage'] = $dataDistrict->recovered_percentage;
            $dataC[$cnt]['death_percentage'] = $dataDistrict->death_percentage;
            $dataC[$cnt]['quarantine'] = $dataDistrict->quarantine;
            $cnt++;
        }
        $data = [
            "data" => $dataC,
            'source' => "https://www.somoynews.tv/coronavirus/bangladesh",
            'visit' => "https://coronabd.xyz/",
        ];
        return $data;
    }
    public function getEnglishAllDistrict()
    {
        $dataDistricts = EnglishDistrict::get();
        $cnt = 0;
        foreach ($dataDistricts as $dataDistrict) {
            $dataC[$cnt]['district_name'] = $dataDistrict->district_name;
            // $dataC[$cnt]['division_name'] = $dataDistrict->division_name;   //change
            $dataC[$cnt]['total_cases'] = $dataDistrict->total_cases;
            $dataC[$cnt]['total_recovered'] = $dataDistrict->total_recovered;
            $dataC[$cnt]['total_deaths'] = $dataDistrict->total_deaths;
            $dataC[$cnt]['active_cases'] = $dataDistrict->active_cases;
            $dataC[$cnt]['active_percentage'] = $dataDistrict->active_percentage;
            $dataC[$cnt]['recovered_percentage'] = $dataDistrict->recovered_percentage;
            $dataC[$cnt]['death_percentage'] = $dataDistrict->death_percentage;
            $dataC[$cnt]['quarantine'] = $dataDistrict->quarantine;
            $cnt++;
        }
        $data = [
            "data" => $dataC,
            'source' => "https://www.somoynews.tv/coronavirus/bangladesh",
            'visit' => "https://coronabd.xyz/",
        ];
        return $data;
    }
    public function getBanglaCountry($name)
    {
        if (BanglaCountry::where('country_name', $name)->exists()) {
            $dataCountry = BanglaCountry::where('country_name', $name)->first();
            $dataC['country_name'] = $dataCountry->country_name;
            // $dataC['country_name_bangla'] = $dataCountry->country_name_bangla; //change
            $dataC['total_cases'] = $dataCountry->total_cases;
            $dataC['new_cases'] = $dataCountry->new_cases;
            $dataC['total_recovered'] = $dataCountry->total_recovered;
            $dataC['total_deaths'] = $dataCountry->total_deaths;
            $dataC['new_deaths'] = $dataCountry->new_deaths;
            $dataC['active_cases'] = $dataCountry->active_cases;
            $dataC['critical_cases'] = $dataCountry->critical_cases;
            $dataC['active_percentage'] = $dataCountry->active_percentage;
            $dataC['recovered_percentage'] = $dataCountry->recovered_percentage;
            $dataC['death_percentage'] = $dataCountry->death_percentage;
            $data = [
                "data" => $dataC,
                'source' => "https://www.worldometers.info/coronavirus/",
                'visit' => "https://coronabd.xyz/",
            ];
            return $data;
        } else {
            $data = [
                'status' => "wrong route",
                'route_details' => [
                    0 => route('bn-bangladesh'),
                    1 => route('en-bangladesh'),
                    2 => route('bn-world'),
                    3 => route('en-world'),
                    4 => route('bn-countries'),
                    5 => route('en-countries'),
                    6 => route('bn-districts'),
                    7 => route('en-districts'),
                    8 => route('bn-country-name', ['name' => 'CountryName']),
                    9 => route('en-country-name', ['name' => 'CountryName']),
                    10 => route('bn-district-name', ['name' => 'DistrictName']),
                    10 => route('en-district-name', ['name' => 'DistrictName']),
                ],
                'contact_info' => [
                    "facebook" => "https://web.facebook.com/bappi.saha.75033",
                    "mail" => "bappi35-2097@diu.edu.bd",
                ],
                'visit' => "https://coronabd.xyz/",
            ];
            return $data;
        }
    }
    public function getEnglishCountry($name)
    {
        if (EnglishCountry::where('country_name', $name)->exists()) {
            $dataCountry = EnglishCountry::where('country_name', $name)->first();
            $dataC['country_name'] = $dataCountry->country_name;
            $dataC['total_cases'] = $dataCountry->total_cases;
            $dataC['new_cases'] = $dataCountry->new_cases;
            $dataC['total_recovered'] = $dataCountry->total_recovered;
            $dataC['total_deaths'] = $dataCountry->total_deaths;
            $dataC['new_deaths'] = $dataCountry->new_deaths;
            $dataC['active_cases'] = $dataCountry->active_cases;
            $dataC['critical_cases'] = $dataCountry->critical_cases;
            $dataC['active_percentage'] = $dataCountry->active_percentage;
            $dataC['recovered_percentage'] = $dataCountry->recovered_percentage;
            $dataC['death_percentage'] = $dataCountry->death_percentage;
            $data = [
                "data" => $dataC,
                'source' => "https://www.worldometers.info/coronavirus/",
                'visit' => "https://coronabd.xyz/",
            ];
            return $data;
        } else {
            $data = [
                'status' => "wrong route",
                'route_details' => [
                    0 => route('bn-bangladesh'),
                    1 => route('en-bangladesh'),
                    2 => route('bn-world'),
                    3 => route('en-world'),
                    4 => route('bn-countries'),
                    5 => route('en-countries'),
                    6 => route('bn-districts'),
                    7 => route('en-districts'),
                    8 => route('bn-country-name', ['name' => 'CountryName']),
                    9 => route('en-country-name', ['name' => 'CountryName']),
                    10 => route('bn-district-name', ['name' => 'DistrictName']),
                    10 => route('en-district-name', ['name' => 'DistrictName']),
                ],
                'contact_info' => [
                    "facebook" => "https://web.facebook.com/bappi.saha.75033",
                    "mail" => "bappi35-2097@diu.edu.bd",
                ],
                'visit' => "https://coronabd.xyz/",
            ];
            return $data;
        }
    }
    public function getBanglaDistrict($name)
    {
        if (BanglaDistrict::where('district_name', $name)->exists()) {
            $dataDistrict = BanglaDistrict::where('district_name', $name)->first();
            $dataC['district_name'] = $dataDistrict->district_name;
            $dataC['district_name_bangla'] = $dataDistrict->district_name_bangla;
            // $dataC['division_name'] = $dataDistrict->division_name;   //change
            $dataC['total_cases'] = $dataDistrict->total_cases;
            $dataC['total_recovered'] = $dataDistrict->total_recovered;
            $dataC['total_deaths'] = $dataDistrict->total_deaths;
            $dataC['active_cases'] = $dataDistrict->active_cases;
            $dataC['active_percentage'] = $dataDistrict->active_percentage;
            $dataC['recovered_percentage'] = $dataDistrict->recovered_percentage;
            $dataC['death_percentage'] = $dataDistrict->death_percentage;
            $dataC['quarantine'] = $dataDistrict->quarantine;
            $data = [
                "data" => $dataC,
                'source' => "https://www.somoynews.tv/coronavirus/bangladesh",
                'visit' => "https://coronabd.xyz/",
            ];
            return $data;
        } else {
            $data = [
                'status' => "wrong route",
                'route_details' => [
                    0 => route('bn-bangladesh'),
                    1 => route('en-bangladesh'),
                    2 => route('bn-world'),
                    3 => route('en-world'),
                    4 => route('bn-countries'),
                    5 => route('en-countries'),
                    6 => route('bn-districts'),
                    7 => route('en-districts'),
                    8 => route('bn-country-name', ['name' => 'CountryName']),
                    9 => route('en-country-name', ['name' => 'CountryName']),
                    10 => route('bn-district-name', ['name' => 'DistrictName']),
                    10 => route('en-district-name', ['name' => 'DistrictName']),
                ],
                'contact_info' => [
                    "facebook" => "https://web.facebook.com/bappi.saha.75033",
                    "mail" => "bappi35-2097@diu.edu.bd",
                ],
                'visit' => "https://coronabd.xyz/",
            ];
            return $data;
        }
    }
    public function getEnglishDistrict($name)
    {
        if (EnglishDistrict::where('district_name', $name)->exists()) {
            $dataDistrict = EnglishDistrict::where('district_name', $name)->first();
            $dataC['district_name'] = $dataDistrict->district_name;
            // $dataC['division_name'] = $dataDistrict->division_name;   //change
            $dataC['total_cases'] = $dataDistrict->total_cases;
            $dataC['total_recovered'] = $dataDistrict->total_recovered;
            $dataC['total_deaths'] = $dataDistrict->total_deaths;
            $dataC['active_cases'] = $dataDistrict->active_cases;
            $dataC['active_percentage'] = $dataDistrict->active_percentage;
            $dataC['recovered_percentage'] = $dataDistrict->recovered_percentage;
            $dataC['death_percentage'] = $dataDistrict->death_percentage;
            $dataC['quarantine'] = $dataDistrict->quarantine;
            $data = [
                "data" => $dataC,
                'source' => "https://www.somoynews.tv/coronavirus/bangladesh",
                'visit' => "https://coronabd.xyz/",
            ];
            return $data;
        } else {
            $data = [
                'status' => "wrong route",
                'route_details' => [
                    0 => route('bn-bangladesh'),
                    1 => route('en-bangladesh'),
                    2 => route('bn-world'),
                    3 => route('en-world'),
                    4 => route('bn-countries'),
                    5 => route('en-countries'),
                    6 => route('bn-districts'),
                    7 => route('en-districts'),
                    8 => route('bn-country-name', ['name' => 'CountryName']),
                    9 => route('en-country-name', ['name' => 'CountryName']),
                    10 => route('bn-district-name', ['name' => 'DistrictName']),
                    10 => route('en-district-name', ['name' => 'DistrictName']),
                ],
                'contact_info' => [
                    "facebook" => "https://web.facebook.com/bappi.saha.75033",
                    "mail" => "bappi35-2097@diu.edu.bd",
                ],
                'visit' => "https://coronabd.xyz/",
            ];
            return $data;
        }
    }
}
