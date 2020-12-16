<?php

const PS5_TOKEN = 'ax6ura3rta7yb729n9hijaiap1ysq1';
const PS5_DIGITAL_TOKEN = 'atxxm734txggy62y2zi616547nugzk';
const USER_KEY = 'uEE7HdEZKdV4oJWoH7MZQfBGF3jrhA';
const DIGITAL_URL = 'https://www.emag.ro/consola-playstation-5-digital-edition-so-9396505/pd/DKKW72MBM';
const NORMAL_URL = 'https://www.emag.ro/consola-playstation-5-so-9396406/pd/DNKW72MBM';

main();

function main(): void
{
    while (true) {
        sendNotifications(checkStock());
        sleep(2);
    }
}

/**
 * @return bool|string
 */
function checkStock(): array
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://www.emag.ro/get-client-navigation-history?fields%255Bresized_images%255D=150x150%252C80x80',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => [
            'Cookie: EMAGROSESSID=5e2ea292817349c3b8ba0e9ac5e198f4; EMAGUUID=1603298825-202673724-94583.348; EMAGVISITOR=a%3A1%3A%7Bs%3A7%3A%22user_id%22%3Bi%3A272596%3B%7D; _pdr_internal=GA1.2.8271792959.1603298825; ltuid=1603298825.279-c914add8d897ccd610bbb524ba09ae970366e652; site_version_11=not_mobile; _ga=GA1.2.1058330103.1573033267; _ga_MKTP=GA1.2.1251055733.1573041243; __gads=ID=ef800cf75c3434c2:T=1573043882:S=ALNI_MZF_lAwtxEXI1t-hiRCdoVY1Znl6g; ga_user_id=65f4fa8070749b77253b56dfce66ac34; customer_has_orders=1; GKD=%96%93%B4%E2%94%A9%94s%92%96%91%93%B1%BF%B2%96%9C%AB%85%B6%96%A5%CF%D8%94%A9%91%AA%9D%A9%89%96%B2%B2%9C%96%9D%98%8A%A7%A2%B5%B8%A8; _pin_unauth=dWlkPVkyTmhZalZsWXprdE1UYzJNaTAwT0dJd0xXSXlNekV0WW1NMk5EYzVNamMwTURWaQ; user_remember=%DB%11b%C5dy%B9%BA%A4%928%CA%A9%3D%ECl5%12%1A1%98%2B%B6%D9%82%14%F3%E2%1A7%FF%AA%3B%02j%05W%21%81%C5%C1%2F%96%B4%DE5%19%25%AAw%A8%40x%CD%EB%D0%9D%3C%9C%02%17%89%D4%0A%9EWzT%94a%A5%3E%5D%1E%B5%B9Y%2F%CE%B5%F6%C6%E4t.%F3%5C%CAv.%B2ck%A2m%F8%3F%04C%98%95%ED%7D%DA%19%23%E3%C9%F0E%1B%FF%E5%13%E6%C0%B7%88%F5%E5x%14w%3ALe%3Bb%D7%28tYO%E5%28w%17_%B8%A3%F8%DBp%2F%D6%BD%0F%A1%2B%28%84%02%FC%BC%AC%A3%02%9D%204%E15%B6%F3%A41%1F%E5; pdr_user_id=65f4fa8070749b77253b56dfce66ac34; user_token=e2fdb3501bbd9efc836d7829337d8135; supermarket_delivery_address=%7B%22name%22%3A%22Bucure%5Cu015fti%22%2C%22id%22%3A%224954%22%2C%22delivery_type%22%3A2%2C%22storage_type%22%3A%7B%221%22%3A%221%22%2C%222%22%3A%221%22%2C%223%22%3A%221%22%7D%2C%22delivery_categories%22%3A%7B%22Fructe%20si%20Legume%22%3A1%2C%22Lactate%2C%20Oua%20si%20Paine%22%3A1%2C%22Carne%2C%20Mezeluri%20si%20Pes%20...%22%3A1%2C%22Produse%20congelate%22%3A1%2C%22Alimente%20de%20baza%2C%20cons%20...%22%3A1%2C%22Cafea%2C%20cereale%2C%20dulciu%20...%22%3A1%2C%22Bauturi%20si%20tutun%22%3A1%2C%22Ingrijire%20copii%22%3A1%2C%22Intretinerea%20casei%20si%20%20...%22%3A1%2C%22Ingrijire%20personala%20%22%3A1%2C%22Vinoteca%22%3A1%2C%22Produse%20naturale%20si%20sa%20...%22%3A1%7D%7D; _hjid=2a02d6b0-3fd7-4e14-ae87-4e3ccca215a7; _gcl_au=1.1.1947778093.1605084165; _gcl_aw=GCL.1605517253.Cj0KCQiA48j9BRC-ARIsAMQu3WTrJ5iFAn6vQJJ2FBN-BojpQKrAQY1eFVgXZ1Cpf6xLtKHYtxXDaYcaAorVEALw_wcB; profile_token=pftk_6461101155049641290; eab335=b; delivery_locality_id=12318; campaign_notifications={"283":1,"5409":1}; sapi-token=eyJ1c2VyX2lkIjoyNzI1OTYsInVzZXJfa2V5IjoidzVzUllzT0ZaSG5DdWNLNnc1SENzSHhzSzBIQ2lzTzR3cVFJWmNPWnc1aHh3NzhlWHNLSnc0YkRsZ1wvQ3VpTENxeFREbmNLWXc2RnV3b3JEcFExXC9UTU94dzd0ckdNT0l3cVRDcThLY3c0ekRoY0s0UFNQQ204T1wvd29FUUI4S0xNTUsyYnNPOHdyekNyTUtqQXNLZElEVERvVFhDdHNPendxUXhIOE9sIiwibGFuZ19jb2RlX2tleSI6Inc1c1JZc09GWkhuQ3VjSzZ3NUhDc0h4c0swSENpc080WjhLbXdvWERpc080dzYweHc0ZkNwWFJCdzZYQ2tRakR1TUt6dzdyRG5NSzRPTU9KSjBuRHZjT3NKY084d3FRNnc1TkV3ckxEdmtJcXdybkRtOE9adzZqQ3JjT2FKRXJDbXNPR3dyMFd3N2ttdzZrVHdwckNrUUFsT0RaUHdyRWJCUjFjdzd3PSIsImF1dGhfdG9rZW5fa2V5IjoidzVzUllzT0ZaSG5DdWNLNnc1SENzSHhzSzBIQ2lzTzR3Nmxqd3BFNUF4ekN1akRDcnNLZ3dwXC9DdHdiRHBzT0V3cjE1dzY3RHVsSENtbU5FSU1LM3dwVENvc092YW1mQ3ZXY2p3NHJEdURMQ3RGWXZ3b2xhd3JiQ3BtVENsY085R2lVSHc1a2VMeXBTd3JuQ3BDZG1Ic0tHUlgzQ3ZDWER0OEtodzVYQ3VnYkRoOE9vZThLQnc2WmJ3N3Rhd3FWS3c3VERoTUsxdzZ4UFNCb2t3cVwvRGlzT0V3NUhEcDhPQ3dxUERsOEtod3JjemFzS1l3NUhEbUVUQ2pBPT0iLCJ1dWlkIjoiMTYwMzI5ODgyNS0yMDI2NzM3MjQtOTQ1ODMuMzQ4In0%3D; cart_summary=%7B%22t%22%3A1608110859%2C%22b%22%3A0%2C%22p%22%3A0%2C%22bfc%22%3A0%2C%22line%22%3A%7B%225785%22%3A46%2C%221%22%3A59%2C%223207%22%3A11%2C%2216330%22%3A8%7D%7D; G_ENABLED_IDPS=google; web_push_perm=denied; _scid=f9870b62-44c8-4b37-9ada-f51094d64d06; sk_t_undefined=on; sk_t_skin_stock_busters___mai_2019_reveal=2; sk_t_skin_ziua_emag_teasing_=1; sk_t_skin_campanie_spring_sale_martie_2020_=1; listingDisplayId=2; liveagent_oref=https://www.emag.ro/search/gigabit%20usb%20adaptor?ref=effective_search; liveagent_ptid=762a965a-a848-4627-b825-d362d72d6a63; sk_t_skin_campanie_gradinarit__06_04__30_06_2020=3; sk_t_skin_revolutia_preturilor_septembrie_2019___ultimele_ore=11; sk_t_skin_livrare_rapida__23_03__05_04_2020=11; eab240=b; eab244=b; sk_t_skin_hobbies__19_iunie___05_iulie=1; liveagent_vc=10; eab251=c; eab257=b; eab262=c; eab273=c; eab274=a; eab269=a; sk_t_skin_revolutia_preturilor_iunie_2019___reveal_=1; sk_c_undefined=17; sk_t_skin_christmas_in_july=1; eab279=b; eab275=b; eab282=b; eab283=a; eab290=b; eab292=b; eab297=a; eab303=d; eab310=b; eab311=c; eab313=b; eab315=c; eab316=c; eab331=b; listingPerPage=100; udp=eAGNkUEOhDAIRe%2FSE5QCavE0Ttx0Mckkzs707oPoDMZkTFf0k%2BY%2FPkzCshbJME5Csi4CEuYwWoWtJgnv5Wjw0Xi%2BtgdJQCAMYxFCZDWAw%2BARVCTz3R0gbr8gkstaq2KxBUtXLES%2BxwKDk3S85Mq4TC1cZVj%2BPS5K6DHfpu0cUwQZXRqVcgs1Xak52vb%2B7vicrkg6DWFU7Fuo31v%2Fsuahu80K2dPpaQdXSq0fX4SZQQ%3D%3D; eab333=d; vp=2133x1174; sr=1920x1160; EMAG_VIEW=not_mobile; eab336=b; _rscd=1; _rsdc=2; _rsv=47; eab337=c; _dc_gtm_UA-220157-3=1; _uetsid=be5ed1d03d8411ebbc5021858ee58cc5; _uetvid=aa10b5065ffbd9bbef5222b7841989b2; _derived_epik=dj0yJnU9ejkyZElDSTJaQy1NSkxmTVRzeUZxbUExU254RWNQcjgmbj11cjZhZEtXVG1nb2tqMEhSVGRBNDhRJm09MSZ0PUFBQUFBRl9hZkZVJnJtPTEmcnQ9QUFBQUFGX2FmRlU; _pdr_view_id=1608154372-40138.219-744059432',
        ],
    ]);
    $response = curl_exec($curl);
    curl_close($curl);

    $response = json_decode($response, true);
    return $response;
}

/**
 * @param array $response
 */
function sendNotifications(array $response): void
{
    foreach ($response['historyList']['items'] as $index => $id) {
        $itemStock = $response['historyList']['items'][$index]['offer']['availability']['code'];
        $itemName = $response['historyList']['items'][$index]['sef_name'];
        $itemEstimate = $response['historyList']['items'][$index]['offer']['availability']['days_estimation'];
        $itemPrice = $response['historyList']['items'][$index]['offer']['price']['current'];
        $itemVendor = $response['historyList']['items'][$index]['offer']['vendor']['name']['default'];

        $message = "Consola <font color='#00ff51'>$itemName</font> vanduta de <font color='#0000ff'>$itemVendor</font> la pretul <font color='#0000ff'>$itemPrice</font> are stoc <font color='#FF0000'>$itemStock</font> si estimare adaugare stoc de $itemEstimate zile.";
        if ((int)$itemPrice <= 2600 && $itemStock != 'out_of_stock') {
            $itemName == 'consola-playstation-5-so-9396406' ? pushNotification(PS5_TOKEN, $message, NORMAL_URL) : pushNotification(PS5_DIGITAL_TOKEN, $message, DIGITAL_URL);
        }
        echo $message . PHP_EOL . PHP_EOL;
    }
}

/**
 * @param $appToken
 * @param $message
 * @param $url
 */
function pushNotification($appToken, $message, $url)
{
    curl_setopt_array($ch = curl_init(), [
        CURLOPT_URL => "https://api.pushover.net/1/messages.json",
        CURLOPT_POSTFIELDS => [
            "html" => 1,
            "token" => $appToken,
            "user" => USER_KEY,
            "title" => 'Stock Alert',
            "message" => $message,
            "url_title" => $appToken == PS5_TOKEN ? 'PS5 LINK' : 'PS5 DIGITAL LINK ',
            "url" => $url,
            'sound' => 'persistent',
        ],
        CURLOPT_SAFE_UPLOAD => true,
        CURLOPT_RETURNTRANSFER => true,
    ]);
    curl_exec($ch);
    curl_close($ch);
}