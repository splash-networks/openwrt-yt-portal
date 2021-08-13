<?php
session_start();

include 'parameters.php';
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$_SESSION["mac"]=$_POST['mac'];
$_SESSION["ip"]=$_POST['ip'];
$_SESSION["linkorig"]=$_POST['link-orig'];
$_SESSION["linkloginonly"]=$_POST['link-login-only'];

$_SESSION["user_type"] = "new";
$_SESSION["method"] = "Form";

/*
Checking DB to see if user exists or not.
*/

$host_ip = $_SERVER['HOST_IP'];
$db_user = $_SERVER['DB_USER'];
$db_pass = $_SERVER['DB_PASS'];
$db_name = $_SERVER['DB_NAME'];

$con = mysqli_connect($host_ip, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
  echo "Failed to connect to SQL: " . mysqli_connect_error();
}

$result = mysqli_query($con, "SELECT * FROM `$table_name` WHERE mac='$_SESSION[mac]'");

if ($result->num_rows >= 1) {
  $row = mysqli_fetch_array($result);

  $_SESSION["fname"] = $row[2];
  $_SESSION["lname"] = $row[3];
  $_SESSION["email"] = $row[4];
  $_SESSION["method"] = $row[6];

  mysqli_close($con);

  $_SESSION["user_type"] = "repeat";
  header("Location: welcome.php");
} else {
  mysqli_close($con);
}

?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Astiisb WiFi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="bulma.min.css" />
  <link rel="stylesheet" href="font-awesome\css\font-awesome.min.css" />
  <script defer src="vendor\fortawesome\font-awesome\js\all.js"></script>
  <link rel="icon" type="image/png" href="favicomatic\favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="favicomatic\favicon-16x16.png" sizes="16x16" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="bg">

    <figure id="logo">
      <img src="logo.png">
    </figure>

    <div id="login" class="content is-size-4 has-text-weight-bold">Login for Free Wi-Fi</div>

    <div id="gap" class="content is-size-6"></div>

    <form id="verify" method="post" action="verify.php">
        <div class="centered_elements">
          <div class="field has-addons">
            <p class="control">
              <span class="select">
                <select id="country_code" name="country_code">
                  <option value="+1">(CA) +1</option>
                  <option value="+1" selected>(US) +1</option>
                  <option value="+7">(KZ) +7</option>
                  <option value="+7">(RU) +7</option>
                  <option value="+20">(EG) +20</option>
                  <option value="+27">(ZA) +27</option>
                  <option value="+30">(GR) +30</option>
                  <option value="+31">(NL) +31</option>
                  <option value="+32">(BE) +32</option>
                  <option value="+33">(FR) +33</option>
                  <option value="+34">(ES) +34</option>
                  <option value="+36">(HU) +36</option>
                  <option value="+39">(IT) +39</option>
                  <option value="+40">(RO) +40</option>
                  <option value="+41">(CH) +41</option>
                  <option value="+43">(AT) +43</option>
                  <option value="+44">(GB) +44</option>
                  <option value="+45">(DK) +45</option>
                  <option value="+46">(SE) +46</option>
                  <option value="+47">(NO) +47</option>
                  <option value="+47">(SJ) +47</option>
                  <option value="+48">(PL) +48</option>
                  <option value="+49">(DE) +49</option>
                  <option value="+51">(PE) +51</option>
                  <option value="+52">(MX) +52</option>
                  <option value="+53">(CU) +53</option>
                  <option value="+54">(AR) +54</option>
                  <option value="+55">(BR) +55</option>
                  <option value="+56">(CL) +56</option>
                  <option value="+57">(CO) +57</option>
                  <option value="+58">(VE) +58</option>
                  <option value="+60">(MY) +60</option>
                  <option value="+61">(AU) +61</option>
                  <option value="+61">(CX) +61</option>
                  <option value="+61">(CC) +61</option>
                  <option value="+62">(ID) +62</option>
                  <option value="+63">(PH) +63</option>
                  <option value="+64">(NZ) +64</option>
                  <option value="+64">(PN) +64</option>
                  <option value="+65">(SG) +65</option>
                  <option value="+66">(TH) +66</option>
                  <option value="+81">(JP) +81</option>
                  <option value="+82">(KR) +82</option>
                  <option value="+84">(VN) +84</option>
                  <option value="+86">(CN) +86</option>
                  <option value="+90">(TR) +90</option>
                  <option value="+91">(IN) +91</option>
                  <option value="+92">(PK) +92</option>
                  <option value="+93">(AF) +93</option>
                  <option value="+94">(LK) +94</option>
                  <option value="+95">(MM) +95</option>
                  <option value="+98">(IR) +98</option>
                  <option value="+211">(SS) +211</option>
                  <option value="+212">(MA) +212</option>
                  <option value="+212">(EH) +212</option>
                  <option value="+213">(DZ) +213</option>
                  <option value="+216">(TN) +216</option>
                  <option value="+218">(LY) +218</option>
                  <option value="+220">(GM) +220</option>
                  <option value="+221">(SN) +221</option>
                  <option value="+222">(MR) +222</option>
                  <option value="+223">(ML) +223</option>
                  <option value="+224">(GN) +224</option>
                  <option value="+225">(CI) +225</option>
                  <option value="+226">(BF) +226</option>
                  <option value="+227">(NE) +227</option>
                  <option value="+228">(TG) +228</option>
                  <option value="+229">(BJ) +229</option>
                  <option value="+230">(MU) +230</option>
                  <option value="+231">(LR) +231</option>
                  <option value="+232">(SL) +232</option>
                  <option value="+233">(GH) +233</option>
                  <option value="+234">(NG) +234</option>
                  <option value="+235">(TD) +235</option>
                  <option value="+236">(CF) +236</option>
                  <option value="+237">(CM) +237</option>
                  <option value="+238">(CV) +238</option>
                  <option value="+239">(ST) +239</option>
                  <option value="+240">(GQ) +240</option>
                  <option value="+241">(GA) +241</option>
                  <option value="+242">(CG) +242</option>
                  <option value="+243">(CD) +243</option>
                  <option value="+244">(AO) +244</option>
                  <option value="+245">(GW) +245</option>
                  <option value="+246">(IO) +246</option>
                  <option value="+248">(SC) +248</option>
                  <option value="+249">(SD) +249</option>
                  <option value="+250">(RW) +250</option>
                  <option value="+251">(ET) +251</option>
                  <option value="+252">(SO) +252</option>
                  <option value="+253">(DJ) +253</option>
                  <option value="+254">(KE) +254</option>
                  <option value="+255">(TZ) +255</option>
                  <option value="+256">(UG) +256</option>
                  <option value="+257">(BI) +257</option>
                  <option value="+258">(MZ) +258</option>
                  <option value="+260">(ZM) +260</option>
                  <option value="+261">(MG) +261</option>
                  <option value="+262">(YT) +262</option>
                  <option value="+262">(RE) +262</option>
                  <option value="+263">(ZW) +263</option>
                  <option value="+264">(NA) +264</option>
                  <option value="+265">(MW) +265</option>
                  <option value="+266">(LS) +266</option>
                  <option value="+267">(BW) +267</option>
                  <option value="+268">(SZ) +268</option>
                  <option value="+269">(KM) +269</option>
                  <option value="+290">(SH) +290</option>
                  <option value="+291">(ER) +291</option>
                  <option value="+297">(AW) +297</option>
                  <option value="+298">(FO) +298</option>
                  <option value="+299">(GL) +299</option>
                  <option value="+350">(GI) +350</option>
                  <option value="+351">(PT) +351</option>
                  <option value="+352">(LU) +352</option>
                  <option value="+353">(IE) +353</option>
                  <option value="+354">(IS) +354</option>
                  <option value="+355">(AL) +355</option>
                  <option value="+356">(MT) +356</option>
                  <option value="+357">(CY) +357</option>
                  <option value="+358">(FI) +358</option>
                  <option value="+359">(BG) +359</option>
                  <option value="+370">(LT) +370</option>
                  <option value="+371">(LV) +371</option>
                  <option value="+372">(EE) +372</option>
                  <option value="+373">(MD) +373</option>
                  <option value="+374">(AM) +374</option>
                  <option value="+375">(BY) +375</option>
                  <option value="+376">(AD) +376</option>
                  <option value="+377">(MC) +377</option>
                  <option value="+378">(SM) +378</option>
                  <option value="+379">(VA) +379</option>
                  <option value="+380">(UA) +380</option>
                  <option value="+381">(RS) +381</option>
                  <option value="+382">(ME) +382</option>
                  <option value="+383">(XK) +383</option>
                  <option value="+385">(HR) +385</option>
                  <option value="+386">(SI) +386</option>
                  <option value="+387">(BA) +387</option>
                  <option value="+389">(MK) +389</option>
                  <option value="+420">(CZ) +420</option>
                  <option value="+421">(SK) +421</option>
                  <option value="+423">(LI) +423</option>
                  <option value="+500">(FK) +500</option>
                  <option value="+501">(BZ) +501</option>
                  <option value="+502">(GT) +502</option>
                  <option value="+503">(SV) +503</option>
                  <option value="+504">(HN) +504</option>
                  <option value="+505">(NI) +505</option>
                  <option value="+506">(CR) +506</option>
                  <option value="+507">(PA) +507</option>
                  <option value="+508">(PM) +508</option>
                  <option value="+509">(HT) +509</option>
                  <option value="+590">(BL) +590</option>
                  <option value="+590">(MF) +590</option>
                  <option value="+591">(BO) +591</option>
                  <option value="+592">(GY) +592</option>
                  <option value="+593">(EC) +593</option>
                  <option value="+595">(PY) +595</option>
                  <option value="+597">(SR) +597</option>
                  <option value="+598">(UY) +598</option>
                  <option value="+599">(CW) +599</option>
                  <option value="+599">(AN) +599</option>
                  <option value="+670">(TL) +670</option>
                  <option value="+672">(AQ) +672</option>
                  <option value="+673">(BN) +673</option>
                  <option value="+674">(NR) +674</option>
                  <option value="+675">(PG) +675</option>
                  <option value="+676">(TO) +676</option>
                  <option value="+677">(SB) +677</option>
                  <option value="+678">(VU) +678</option>
                  <option value="+679">(FJ) +679</option>
                  <option value="+680">(PW) +680</option>
                  <option value="+681">(WF) +681</option>
                  <option value="+682">(CK) +682</option>
                  <option value="+683">(NU) +683</option>
                  <option value="+685">(WS) +685</option>
                  <option value="+686">(KI) +686</option>
                  <option value="+687">(NC) +687</option>
                  <option value="+688">(TV) +688</option>
                  <option value="+689">(PF) +689</option>
                  <option value="+690">(TK) +690</option>
                  <option value="+691">(FM) +691</option>
                  <option value="+692">(MH) +692</option>
                  <option value="+850">(KP) +850</option>
                  <option value="+852">(HK) +852</option>
                  <option value="+853">(MO) +853</option>
                  <option value="+855">(KH) +855</option>
                  <option value="+856">(LA) +856</option>
                  <option value="+880">(BD) +880</option>
                  <option value="+886">(TW) +886</option>
                  <option value="+960">(MV) +960</option>
                  <option value="+961">(LB) +961</option>
                  <option value="+962">(JO) +962</option>
                  <option value="+963">(SY) +963</option>
                  <option value="+964">(IQ) +964</option>
                  <option value="+965">(KW) +965</option>
                  <option value="+966">(SA) +966</option>
                  <option value="+967">(YE) +967</option>
                  <option value="+968">(OM) +968</option>
                  <option value="+970">(PS) +970</option>
                  <option value="+971">(AE) +971</option>
                  <option value="+972">(IL) +972</option>
                  <option value="+973">(BH) +973</option>
                  <option value="+974">(QA) +974</option>
                  <option value="+975">(BT) +975</option>
                  <option value="+976">(MN) +976</option>
                  <option value="+977">(NP) +977</option>
                  <option value="+992">(TJ) +992</option>
                  <option value="+993">(TM) +993</option>
                  <option value="+994">(AZ) +994</option>
                  <option value="+995">(GE) +995</option>
                  <option value="+996">(KG) +996</option>
                  <option value="+998">(UZ) +998</option>
                  <option value="+1-242">(BS) +1-242</option>
                  <option value="+1-246">(BB) +1-246</option>
                  <option value="+1-264">(AI) +1-264</option>
                  <option value="+1-268">(AG) +1-268</option>
                  <option value="+1-284">(VG) +1-284</option>
                  <option value="+1-340">(VI) +1-340</option>
                  <option value="+1-345">(KY) +1-345</option>
                  <option value="+1-441">(BM) +1-441</option>
                  <option value="+1-473">(GD) +1-473</option>
                  <option value="+1-649">(TC) +1-649</option>
                  <option value="+1-664">(MS) +1-664</option>
                  <option value="+1-670">(MP) +1-670</option>
                  <option value="+1-671">(GU) +1-671</option>
                  <option value="+1-684">(AS) +1-684</option>
                  <option value="+1-721">(SX) +1-721</option>
                  <option value="+1-758">(LC) +1-758</option>
                  <option value="+1-767">(DM) +1-767</option>
                  <option value="+1-784">(VC) +1-784</option>
                  <option value="+1-787">(PR) +1-787</option>
                  <option value="+1-809">(DO) +1-809</option>
                  <option value="+1-868">(TT) +1-868</option>
                  <option value="+1-869">(KN) +1-869</option>
                  <option value="+1-876">(JM) +1-876</option>
                  <option value="+44-1481">(GG) +44-1481</option>
                  <option value="+44-1534">(JE) +44-1534</option>
                  <option value="+44-1624">(IM) +44-1624</option>
                </select>
              </span>
            </p>

            <p class="control">
              <input class="input" type="tel" id="phone_number" name="phone_number" placeholder="Phone Number">
            </p>

          </div>

          <button id="test" class="button is-danger">Verify Phone Number</button>

        </div>
      </form>

    <div id="powered" class="content is-size-6">Powered by Astiisb</div>
    <div id="copyright" class="content is-size-6">(C) Copyright 2020</div>

  </div>

</body>
</html>