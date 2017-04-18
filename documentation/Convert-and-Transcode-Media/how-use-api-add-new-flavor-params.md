---
layout: page
title: How to use the API to Add New Flavor Params
weight: 102
---

> Note: Kaltura.com SaaS users - Please contact your Kaltura Account Manager to add new flavor params to your account. Configuration of the transcoding layer requires specialized ecnoding expertise.
 

To add flavor params, call the [flavorParams.add](https://developer.kaltura.com/api-docs/#/flavorParams.add) API action:

{% highlight php %}
<?php
require_once('lib/KalturaClient.php');
$config = new KalturaConfiguration($partnerId);
$config->serviceUrl = 'https://www.kaltura.com/';
$client = new KalturaClient($config);
$client->setKs('AddYourKS');
$flavorParams = new KalturaFlavorParams();
$flavorParams->name = 'YourflavorParamsName';
$flavorParams->systemName = 'YourflavorParamssystemName';
$flavorParams->description = 'YourflavorParamsDescription';
$flavorParams->tags = 'YourflavorParamsTag1, YourflavorParamsTag2';
$flavorParams->videoCodec = KalturaVideoCodec::FLV;
$results = $client->flavorParams->add($flavorParams);

{% endhighlight %}
