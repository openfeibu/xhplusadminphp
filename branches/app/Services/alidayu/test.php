<?php
    include "TopSdk.php";
    date_default_timezone_set('Asia/Shanghai');

    // $httpdns = new HttpdnsGetRequest;
    // $client = new ClusterTopClient("4272","0ebbcccfee18d7ad1aebc5b135ffa906");
    // $client->gatewayUrl = "http://api.daily.taobao.net/router/rest";
    // var_dump($client->execute($httpdns,"6100e23657fb0b2d0c78568e55a3031134be9a3a5d4b3a365753805"));
    $c = new TopClient;
    $c->appkey = '23391567';
    $c->secretKey = '7972d2dc53b68b63c346df0de5df0b31';
    $req = new AlibabaAliqinFcSmsNumSendRequest;
    $req->setSmsType("normal");
    $req->setSmsFreeSignName("飞步校园");
    $req->setSmsParam("{\"code\":\"1234\",\"product\":\"飞步\"}");
    $req->setRecNum("18819203672");
    $req->setSmsTemplateCode("SMS_10840890");
    $resp = $c->execute($req);

    var_dump($resp);
?>