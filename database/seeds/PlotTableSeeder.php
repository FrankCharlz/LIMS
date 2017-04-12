<?php

use Illuminate\Database\Seeder;

class PlotTableSeeder extends Seeder
{
    const users = [2,3,13,20,21,22,28,30,61];
    private $locs = [
        "-6.8381450","39.2464636",
        "-6.8376855","39.2466134",
        "-6.8378103","39.2468594",
        "-6.8389074","39.2467600",
        "-6.8387913","39.2465832",
        "-6.8387154","39.2461595",
        "-6.8386688","39.2466514",
        "-6.8378837","39.2460689",
        "-6.8372095","39.2462505",
        "-6.8386728","39.2465096",
        "-6.8369609","39.2478174",
        "-6.8358780","39.2468356",
        "-6.8388668","39.2479766",
        "-6.8389267","39.2483151",
        "-6.8385398","39.2456499",
        "-6.8375399","39.2440321",
        "-6.8372869","39.2441595",
        "-6.8377633","39.2465067",
        "-6.8361521","39.2451002",
        "-6.8357684","39.2461584",
        "-6.8373142","39.2454052",
        "-6.8380190","39.2477486",
        "-6.8371668","39.2455916",
        "-6.8383020","39.2464034",
        "-6.8371736","39.2454533",
        "-6.8362268","39.2467828",
        "-6.8363794","39.2486622",
        "-6.8352823","39.2460605",
        "-6.8352584","39.2469230",
        "-6.8362302","39.2482837",
        "-6.8380710","39.2467132",
        "-6.8377797","39.2444863",
        "-6.8356910","39.2451989",
        "-6.8360445","39.2463047",
        "-6.8353251","39.2467196",
        "-6.8380448","39.2442329",
        "-6.8352342","39.2446834",
        "-6.8359867","39.2482202",
        "-6.8358295","39.2475960",
        "-6.8372225","39.2483004",
        "-6.8357681","39.2459273",
        "-6.8350657","39.2452188",
        "-6.8355173","39.2460575",
        "-6.8353345","39.2461380",
        "-6.8379920","39.2449092",
        "-6.8351519","39.2451972",
        "-6.8373693","39.2441113",
        "-6.8363291","39.2485797",
        "-6.8365379","39.2459691",
        "-6.8372048","39.2447556",
        "-6.8387668","39.2467611",
        "-6.8382445","39.2459750",
        "-6.8357611","39.2486469",
        "-6.8365921","39.2456438",
        "-6.8374686","39.2463674",
        "-6.8371459","39.2473938",
        "-6.8370049","39.2481985",
        "-6.8383789","39.2473348",
        "-6.8389247","39.2440375",
        "-6.8375526","39.2471151",
        "-6.8358938","39.2479386",
        "-6.8359933","39.2474675",
        "-6.8360106","39.2476389",
        "-6.8380936","39.2449675",
        "-6.8377441","39.2463145",
        "-6.8358868","39.2440752",
        "-6.8371779","39.2474812",
        "-6.8351543","39.2479025",
        "-6.8369208","39.2442117",
        "-6.8387408","39.2462158",
        "-6.8366503","39.2484198",
        "-6.8359410","39.2467845",
        "-6.8364443","39.2479626",
        "-6.8377207","39.2483615",
        "-6.8356644","39.2476887",
        "-6.8356606","39.2443019",
        "-6.8375442","39.2451868",
        "-6.8359858","39.2441887",
        "-6.8356427","39.2450708",
        "-6.8356214","39.2447436",
        "-6.8357868","39.2482260",
        "-6.8360130","39.2456871",
        "-6.8370198","39.2475270",
        "-6.8350589","39.2448228",
        "-6.8380993","39.2467880",
        "-6.8352653","39.2457650",
        "-6.8377593","39.2467898",
        "-6.8350347","39.2462824",
        "-6.8353094","39.2443172",
        "-6.8372618","39.2452396",
        "-6.8366686","39.2480332",
        "-6.8375863","39.2443390",
        "-6.8352781","39.2486336",
        "-6.8382861","39.2450768",
        "-6.8377794","39.2472675",
        "-6.8372282","39.2443465",
        "-6.8377300","39.2444682",
        "-6.8364237","39.2452043",
        "-6.8369037","39.2485123",
        "-6.8385199","39.2459498",
        "-6.8385752","39.2480605",
        "-6.8372847","39.2486405",
        "-6.8384575","39.2489779",
        "-6.8355425","39.2456952",
        "-6.8371131","39.2451933",
        "-6.8368538","39.2443205",
        "-6.8380386","39.2444888",
        "-6.8364530","39.2461544",
        "-6.8350345","39.2449410",
        "-6.8383248","39.2441649",
        "-6.8369609","39.2478174",
        "-6.8358780","39.2468356",
        "-6.8388668","39.2479766",
        "-6.8389267","39.2483151",
        "-6.8385398","39.2456499",
        "-6.8375399","39.2440321",
        "-6.8372869","39.2441595",
        "-6.8377633","39.2465067",
        "-6.8361521","39.2451002",
        "-6.8357684","39.2461584",
        "-6.8373142","39.2454052",
        "-6.8380190","39.2477486",
        "-6.8371668","39.2455916",
        "-6.8383020","39.2464034",
        "-6.8371736","39.2454533",
        "-6.8362268","39.2467828",
        "-6.8363794","39.2486622",
        "-6.8352823","39.2460605",
        "-6.8352584","39.2469230",
        "-6.8362302","39.2482837",
        "-6.8380710","39.2467132",
        "-6.8377797","39.2444863",
        "-6.8356910","39.2451989",
        "-6.8360445","39.2463047",
        "-6.8353251","39.2467196",
        "-6.8380448","39.2442329",
        "-6.8352342","39.2446834",
        "-6.8359867","39.2482202",
        "-6.8358295","39.2475960",
        "-6.8372225","39.2483004",
        "-6.8357681","39.2459273",
        "-6.8350657","39.2452188",
        "-6.8355173","39.2460575",
        "-6.8353345","39.2461380",
        "-6.8379920","39.2449092",
        "-6.8351519","39.2451972",
        "-6.8373693","39.2441113",
        "-6.8363291","39.2485797",
        "-6.8365379","39.2459691",
        "-6.8372048","39.2447556",
        "-6.8387668","39.2467611",
        "-6.8382445","39.2459750",
        "-6.8357611","39.2486469",
        "-6.8365921","39.2456438",
        "-6.8374686","39.2463674",
        "-6.8371459","39.2473938",
        "-6.8370049","39.2481985",
        "-6.8383789","39.2473348",
        "-6.8389247","39.2440375",
        "-6.8375526","39.2471151",
        "-6.8358938","39.2479386",
        "-6.8359933","39.2474675",
        "-6.8360106","39.2476389",
        "-6.8380936","39.2449675",
        "-6.8377441","39.2463145",
        "-6.8358868","39.2440752",
        "-6.8371779","39.2474812",
        "-6.8351543","39.2479025",
        "-6.8369208","39.2442117",
        "-6.8387408","39.2462158",
        "-6.8366503","39.2484198",
        "-6.8359410","39.2467845",
        "-6.8364443","39.2479626",
        "-6.8377207","39.2483615",
        "-6.8356644","39.2476887",
        "-6.8356606","39.2443019",
        "-6.8375442","39.2451868",
        "-6.8359858","39.2441887",
        "-6.8356427","39.2450708",
        "-6.8356214","39.2447436",
        "-6.8357868","39.2482260",
        "-6.8360130","39.2456871",
        "-6.8370198","39.2475270",
        "-6.8350589","39.2448228",
        "-6.8380993","39.2467880",
        "-6.8352653","39.2457650",
        "-6.8377593","39.2467898",
        "-6.8350347","39.2462824",
        "-6.8353094","39.2443172",
        "-6.8372618","39.2452396",
        "-6.8366686","39.2480332",
        "-6.8375863","39.2443390",
        "-6.8352781","39.2486336",
        "-6.8382861","39.2450768",
        "-6.8377794","39.2472675",
        "-6.8372282","39.2443465",
        "-6.8377300","39.2444682",
        "-6.8364237","39.2452043",
        "-6.8369037","39.2485123",
        "-6.8385199","39.2459498",
        "-6.8385752","39.2480605",
        "-6.8372847","39.2486405",
        "-6.8384575","39.2489779",
        "-6.8355425","39.2456952",
        "-6.8371131","39.2451933",
        "-6.8368538","39.2443205",
        "-6.8380386","39.2444888",
        "-6.8364530","39.2461544",
        "-6.8350345","39.2449410",
        "-6.8383248","39.2441649",
        "-6.8224473","39.2386100",
        "-6.8317462","39.2461210",
        "-6.8313755","39.2456023",
        "-6.8226293","39.2457809",
        "-6.8321645","39.2313607",
        "-6.8280111","39.2400997",
        "-6.8223121","39.2405125",
        "-6.8357637","39.2499838",
        "-6.8273705","39.2488778",
        "-6.8278535","39.2433213",
        "-6.8261672","39.2484855",
        "-6.8207488","39.2429314",
        "-6.8369632","39.2490639",
        "-6.8232434","39.2301541",
        "-6.8383819","39.2367930",
        "-6.8322237","39.2491371",
        "-6.8329473","39.2324405",
        "-6.8284081","39.2347674",
        "-6.8289334","39.2364847",
        "-6.8378035","39.2407180",
        "-6.8263801","39.2322981",
        "-6.8396990","39.2348520",
        "-6.8233803","39.2372815",
        "-6.8392521","39.2369840",
        "-6.8227169","39.2375313",
        "-6.8360951","39.2346956",
        "-6.8289734","39.2311694",
        "-6.8343861","39.2325498",
        "-6.8379416","39.2403546",
        "-6.8311578","39.2395875",
        "-6.8394162","39.2406386",
        "-6.8275589","39.2311716",
        "-6.8276167","39.2360130",
        "-6.8329317","39.2305705",
        "-6.8268341","39.2450903",
        "-6.8290421","39.2387091",
        "-6.8307351","39.2401957",
        "-6.8322141","39.2439744",
        "-6.8351523","39.2403010",
        "-6.8256291","39.2442854",
        "-6.8307868","39.2360047",
        "-6.8322610","39.2429269",
        "-6.8352229","39.2353963",
        "-6.8208155","39.2455864",
        "-6.8388200","39.2345702",
        "-6.8224133","39.2436376",
        "-6.8379254","39.2339508",
        "-6.8248912","39.2313363",
        "-6.8221267","39.2485440",
        "-6.8244687","39.2430318",
        "-6.8362543","39.2449419",
        "-6.8261223","39.2313635",
        "-6.8347624","39.2415616",
        "-6.8225813","39.2488645",
        "-6.8359568","39.2429299",
        "-6.8312324","39.2355236",
        "-6.8282964","39.2414599",
        "-6.8334703","39.2426344",
        "-6.8275267","39.2377346",
        "-6.8214746","39.2487870",
        "-6.8384139","39.2316763",
        "-6.8391796","39.2301489",
        "-6.8249636","39.2365835",
        "-6.8320175","39.2301879",
        "-6.8347158","39.2367390",
        "-6.8278428","39.2322499",
        "-6.8250557","39.2372739",
        "-6.8306776","39.2491431",
        "-6.8363860","39.2449122",
        "-6.8397754","39.2474834",
        "-6.8352273","39.2460574",
        "-6.8394856","39.2424064",
        "-6.8334096","39.2403588",
        "-6.8351736","39.2363286",
        "-6.8201124","39.2360757",
        "-6.8319944","39.2443727",
        "-6.8315636","39.2450409",
        "-6.8373641","39.2412283",
        "-6.8346251","39.2410313",
        "-6.8217913","39.2324581",
        "-6.8307711","39.2438759",
        "-6.8357390","39.2305986",
        "-6.8214918","39.2473212",
        "-6.8293545","39.2442923",
        "-6.8207770","39.2324508",
        "-6.8362048","39.2485939",
        "-6.8355149","39.2435777",
        "-6.8299149","39.2460396",
        "-6.8319722","39.2424322",
        "-6.8226021","39.2394597",
        "-6.8323824","39.2487871",
        "-6.8336526","39.2366787",
        "-6.8336658","39.2412853",
        "-6.8270012","39.2326547",
        "-6.8258093","39.2373686",
        "-6.8339173","39.2357404",
        "-6.8265982","39.2397289",
        "-6.8351545","39.2472173",
        "-6.8387675","39.2410996",
        "-6.8275353","39.2441009",
        "-6.9587686","39.3292317",
        "-6.9093996","39.2825324",
        "-6.9570188","39.3813908",
        "-6.8695477","39.3927844",
        "-6.8363341","39.3398745",
        "-6.9881219","39.3635800",
        "-6.9130072","39.3297324",
        "-6.8704633","39.2783139",
        "-6.9331103","39.3405738",
        "-6.8619699","39.3734525",
        "-6.9097391","39.2149140",
        "-6.9701856","39.3636013",
        "-6.8533038","39.2403303",
        "-6.9138120","39.2598174",
        "-6.8848951","39.3626565",
        "-6.8183236","39.2974862",
        "-6.9389332","39.3169676",
        "-6.9253349","39.2455330",
        "-6.9563007","39.3261135",
        "-6.9014557","39.3350342",
        "-6.9677505","39.3662902",
        "-6.8741865","39.3468046",
        "-6.8244009","39.2034336",
        "-6.8043042","39.3561935",
        "-6.8109901","39.3784686",
        "-6.9845028","39.3718728",
        "-6.9603682","39.2232595",
        "-6.9728850","39.2925324",
        "-6.9341899","39.2246519",
        "-6.9852747","39.3892057",
        "-6.8927718","39.3881572",
        "-6.9218725","39.2190739",
        "-6.8890379","39.2802340",
        "-6.8453075","39.3391206",
        "-6.9653157","39.2560354",
        "-6.8350818","39.3720801",
        "-6.8928401","39.3267633",
        "-6.8404904","39.2959026",
        "-6.9806498","39.2966105",
        "-6.8033305","39.2838544",
        "-6.9765101","39.3998148",
        "-6.9294403","39.2808414",
        "-6.8620070","39.2911141",
        "-6.8253855","39.2921855",
        "-6.9839637","39.3185991",
        "-6.9654849","39.2783217",
        "-6.9371580","39.3513914",
        "-6.9552898","39.2258324",
        "-6.8675694","39.2083846",
        "-6.8988691","39.3891313",
        "-6.9555561","39.2817792",
        "-6.8979069","39.2641362",
        "-6.8151507","39.2005908",
        "-6.8224719","39.2094340",
        "-6.9144212","39.2390627",
        "-6.8797756","39.3310738",
        "-6.8213366","39.2198297",
        "-6.8464490","39.3975444",
        "-6.9777779","39.3409323",
        "-6.8160793","39.3025028",
        "-6.8559081","39.3410816",
        "-6.8505109","39.2318129",
        "-6.8926260","39.2397593",
        "-6.8616904","39.2440978",
        "-6.9299402","39.2372783",
        "-6.8586274","39.2845531",
        "-6.9432840","39.2711655",
        "-6.8515613","39.3092719",
        "-6.8016615","39.2306245",
        "-6.9734994","39.3282547",
        "-6.8014920","39.2821100",
        "-6.8898488","39.2951338",
        "-6.8286859","39.3447098",
        "-6.9256704","39.2080696",
        "-6.8615996","39.3800570",
        "-6.9287234","39.2758063",
        "-6.9188112","39.3920398",
        "-6.9816396","39.3740901",
        "-6.9149244","39.2462229",
        "-6.8899157","39.2784149",
        "-6.9412087","39.2123982",
        "-6.9157389","39.3942091",
        "-6.9060771","39.2747358",
        "-6.9560715","39.3781434",
        "-6.8775914","39.3650358",
        "-6.9855584","39.3908845",
        "-6.8928433","39.2481341",
        "-6.9681190","39.3910627",
        "-6.8958824","39.2268888",
        "-6.9068701","39.3680055",
        "-6.8131919","39.3894759",
        "-6.8153228","39.3276646",
        "-6.9889446","39.2972124",
        "-6.8801342","39.3374541",
        "-6.8812141","39.3539890",
        "-6.9472430","39.2424525",
        "-6.9310489","39.3204523",
        "-6.8488432","39.2682646",
        "-6.9879238","39.3210332",
        "-6.8864927","39.3350758",
        "-6.8497751","39.2635918",
        "-6.8497751","39.2635918",
        "-6.8497751","39.2635918",
        "-6.8497751","39.2635918",
        "-6.8497751","39.2635918",
        "-6.8405502","39.2356281",
        "-6.8368378","39.2495756"];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $even = 1; $odd = 2;
        while ($even % 2 !== 0) { $even = random_int(0, sizeof($this->locs)); }
        while ($odd% 2 === 0) { $odd = random_int(0, sizeof($this->locs)); }

        DB::table('plot')->insert([
            'owner_name' => 'Rebeca Ingram',
            'owner_id' => self::users[random_int(0, sizeof(self::users)-1)],
            'certificate_id' => random_int(2, 7),
            'block_id' => random_int(1, 120),
            'plot_number' => random_int(100, 999),
            'status_id' => random_int(1,4),
            'latitude' => $this->locs[$even],
            'longitude' => $this->locs[$odd]

        ]);
    }
}
