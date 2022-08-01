<?php
namespace wcoding\batch16\finalproject\Model;

class Manager {
    protected $_connection;


    const DNAME = "batch16project";
    const HOST = "localhost";
    const LOGIN = "root";
    const PWD = "";

    const LANGUAGES = array(
        'Cantonese' => 'HK', 'Chinese(Mandarin)' => 'ZH', 'Dutch' => 'NL', 'English' => 'EN',
        'French' => 'FR', 'German' => 'DE', 'Hindi' => 'HI', 'Indonesian' => 'IN', 'Italian' => 'IT', 'Japanese' => 'JA',
        'Korean' => 'KO', 'Vietnamese' => 'VI', 'Portuguese' => 'PT', 'Russian' => 'RU', 'Spanish' => 'ES'
    );

    const COUNTRIES = array(
        'KR' => 'South Korea'
    );

    const PROVINCES = array(
        'KR' => array(
            'Busan',
            'Chungcheongbuk-do',
            'Chungcheongnam-do',
            'Daegu',
            'Daejeon',
            'Gangwon-do',
            'Gwangju',
            'Gyeonggi-do',
            'Gyeongsangbuk-do',
            'Gyeongsangnam-do',
            'Incheon',
            'Jeju-do',
            'Jeollabuk-do',
            'Jeollanam-do',
            'Sejong-si',
            'Seoul')
        );
    const CITIES = array(
        'Busan' => array(
            'Buk-gu',
            'Busanjin-gu',
            'Dong-gu',
            'Dongnae-gu',
            'Gangseo-gu',
            'Geumjeong-gu',
            'Haeundae-gu',
            'Jung-gu',
            'Nam-gu',
            'Saha-gu',
            'Sasang-gu',
            'Seo-gu',
            'Suyeong-gu',
            'Yeongdo-gu',
            'Yeonje-gu',
        ),
        'Chungcheongbuk-do' => array(
            'Cheongju',
            'Chungju',
            'Jecheon',
            'Eumseong',
            'Jincheon',
            'Okcheon',
            'Yeongdong',
            'Goesan',
            'Jeungpyeong',
            'Boeun',
            'Danyang'),
        'Chungcheongnam-do' => array(
            'Cheonan',
            'Asan',
            'Seosan',
            'Dangjin',
            'Gongju',
            'Nonsan',
            'Boryeong',
            'Gyeryong',
            'Hongseong',
            'Yesan',
            'Buyeo',
            'Seocheon',
            'Taean',
            'Geumsan',
            'Cheongyang',),
        'Daegu' => array(
            'Jung-gu',
            'Dong-gu',
            'Seo-gu',
            'Nam-gu',
            'Buk-gu',
            'Suseong-gu',
            'Dalseo-gu',
        ),
        'Daejeon' => array(
            'Daedeok-gu',
            'Dong-gu',
            'Jung-gu',
            'Seo-gu',
            'Yuseong-gu',
        ),
        'Gangwon-do' => array(
            'Wonju',
            'Chuncheon',
            'Gangneung',
            'Donghae',
            'Sokcho',
            'Samcheok',
            'Taebaek',
            'Hongcheon',
            'Cheorwon',
            'Hoengseong',
            'Pyeongchang',
            'Jeongseon',
            'Yeongwol',
            'Inje',
            'Goseong',
            'Yangyang',
            'Hwacheon',
            'Yanggu',),
        'Gwangju' => array(
            'Buk-gu',
            'Dong-gu',
            'Gwangsan-gu',
            'Nam-gu',
            'Seo-gu',
        ),
        'Gyeonggi-do' => array(
            'Suwon',
            'Seongnam',
            'Goyang',
            'Yongin',
            'Bucheon',
            'Ansan',
            'Anyang',
            'Namyangju',
            'Hwaseong',
            'Uijeongbu',
            'Siheung',
            'Pyeongtaek',
            'Gwangmyeong',
            'Paju',
            'Gunpo',
            'Gwangju',
            'Gimpo',
            'Icheon',
            'Yangju',
            'Guri',
            'Osan',
            'Anseong',
            'Uiwang',
            'Hanam',
            'Pocheon',
            'Dongducheon',
            'Gwacheon',
            'Yeoju',
            'Yangpyeong',
            'Gapyeong',
            'Yeoncheon',),
        'Gyeongsangbuk-do' => array(
            'Pohang',
            'Gumi',
            'Gyeongsan',
            'Gyeongju',
            'Andong',
            'Gimcheon',
            'Yeongju',
            'Sangju',
            'Yeongcheon',
            'Mungyeong',
            'Chilgok',
            'Uiseong',
            'Uljin',
            'Yecheon',
            'Cheongdo',
            'Seongju',
            'Yeongdeok',
            'Goryeong',
            'Bonghwa',
            'Cheongsong',
            'Gunwi',
            'Yeongyang',
            'Ulleung',),
        'Gyeongsangnam-do' => array(
            'Changwon',
            'Gimhae',
            'Jinju',
            'Yangsan',
            'Geoje',
            'Tongyeong',
            'Sacheon',
            'Miryang',
            'Haman',
            'Geochang',
            'Changnyeong',
            'Goseong',
            'Namhae',
            'Hapcheon',
            'Hadong',
            'Hamyang',
            'Sancheong',
            'Uiryeong',
        ),
        'Incheon' => array(
            'Bupyeong-gu',
            'Dong-gu',
            'Gyeyang-gu',
            'Jung-gu',
            'Namdong-gu',
            'Michuhol-gu',
            'Seo-gu',
            'Yeonsu-gu',
        ),
        'Jeju-do' => array(
            'Jeju', 
            'Seogwipo'
        ),
        'Jeollabuk-do' => array(
            'Jeonju',
            'Iksan',
            'Gunsan',
            'Jeongeup',
            'Gimje',
            'Namwon',
            'Wanju',
            'Gochang',
            'Buan',
            'Sunchang',
            'Imsil',
            'Muju',
            'Jinan',
            'Jangsu',),
        'Jeollanam-do' => array(
            'Yeosu',
            'Mokpo',
            'Suncheon',
            'Gwangyang',
            'Naju',
            'Muan',
            'Haenam',
            'Goheung',
            'Hwasun',
            'Yeongam',
            'Yeonggwang',
            'Wando',
            'Damyang',
            'Boseong',
            'Jangseong',
            'Jangheung',
            'Gangjin',
            'Sinan',
            'Hampyeong',
            'Jindo',
            'Gokseong',
            'Gurye',),

        'Seoul' => array(
            'Dobong-gu',
            'Dongdaemun-gu',
            'Dongjak-gu',
            'Eunpyeong-gu',
            'Gangbuk-gu',
            'Gangdong-gu',
            'Gangnam-gu',
            'Gangseo-gu',
            'Geumcheon-gu',
            'Guro-gu',
            'Gwanak-gu',
            'Gwangjin-gu',
            'Jongno-gu',
            'Jung-gu',
            'Jungnang-gu',
            'Mapo-gu',
            'Nowon-gu',
            'Seocho-gu',
            'Seodaemun-gu',
            'Seongbuk-gu',
            'Seongdong-gu',
            'Songpa-gu',
            'Yangcheon-gu',
            'Yeongdeungpo-gu',
            'Yongsan-gu',
        ),
        'Sejong-si' => array(
            'Hansol-dong',
            'Saerom-dong',
            'Dodam-dong',
            'Areum-dong',
            'Jongchon-dong',
            'Goun-dong',
            'Boram-dong',
            'Daepyeong-dong',
            'Sodam-dong',
            'Dajeong-dong',
            'Haemil-dong',
            'Bangok-dong',
        ),
    );

    const DISTRICTS = array (
        'Ansan' => array('Danwon-gu','Sangnok-gu'),
        'Anyang' => array('Dongan-gu','Manan-gu'),
        'Changwon' => array(
            'Jinhae-gu',
            'Masanhappo-gu',
            'Masanhoewon-gu',
            'Seongsan-gu',
            'Uichang-gu',
        ),
        'Cheongju' => array(
            'Heungdeok-gu',
            'Sangdang-gu',
            'Cheongwon-gu',
            'Seowon-gu',
        ),
        'Cheonan' => array('Dongnam-gu','Seobuk-gu'),
        'Goyang' => array(
            'Deogyang-gu',
            'Ilsandong-gu',
            'Ilsanseo-gu',
        ),
        'Jeonju' => array(
            'Deokjin-gu',
            'Wansan-gu',
        ),
        'Pohang' => array(
            'Buk-gu',
            'Nam-gu',
        ),
        'Seongnam' => array(
            'Bundang-gu',
            'Jungwon-gu',
            'Sujeong-gu',
        ),
        'Suwon' => array(
            'Gwonseon-gu',
            'Jangan-gu',
            'Paldal-gu',
            'Yeongtong-gu',
        ),
        'Yongin' => array(
            'Cheoin-gu',
            'Giheung-gu',
            'Suji-gu',
        )
    );

    protected $_user_id;

    protected function __construct() {
        $this-> _connection = new \PDO('mysql:host=' .self::HOST. ';dbname='.self::DNAME.';charset=utf8', self::LOGIN, self::PWD);
    }

    public function getUserId() {
        return $this->_user_id;
    }

    public function setUserId($userId) {
        $this->_user_id = $userId;
    }
    
    public function getLangauges($langCode) {
        foreach($this::LANGUAGES as $key=>$language) {
            if ($language == $langCode) {
                return $key;
            }
        }
    }

    public function getCities($province) {
        return !empty($this::CITIES[$province]) ? $this::CITIES[$province] : null;
    }

    public function getDistricts($city) {
        return !empty($this::DISTRICTS[$city]) ? $this::DISTRICTS[$city] : null;
    }
}