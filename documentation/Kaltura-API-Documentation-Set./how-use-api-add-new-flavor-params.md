---
layout: page
title: How to use the API to Add New Flavor Params
---

> Note: Kaltura.com SaaS users - Please contact your Kaltura Account Manager to add new flavor params to your account. Configuration of the transcoding layer requires specialized ecnoding expertise.
 

To add flavor params, call the [flavorParams.add][1] API action.

 [1]: https://developer.kaltura.com/api-docs/#/flavorParams.add

<pre class="brush: php;fontsize: 100; first-line: 1; ">&lt;?php
require_once('lib/KalturaClient.php');
$config = new KalturaConfiguration($partnerId);
$config-&gt;serviceUrl = 'http://www.kaltura.com/';
$client = new KalturaClient($config);
$client-&gt;setKs('AddYourKS');
$flavorParams = new KalturaFlavorParams();
$flavorParams-&gt;name = 'YourflavorParamsName';
$flavorParams-&gt;systemName = 'YourflavorParamssystemName';
$flavorParams-&gt;description = 'YourflavorParamsDescription';
$flavorParams-&gt;tags = 'YourflavorParamsTag1, YourflavorParamsTag2';
$flavorParams-&gt;videoCodec = KalturaVideoCodec::FLV;
$results = $client-&gt;flavorParams-&gt;add($flavorParams);
</pre>
