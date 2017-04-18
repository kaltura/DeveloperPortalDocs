---
layout: page
title: How to use the API to Add a New Conversion Profile
weight: 101
---

To add a conversion profile, call the [conversionProfile.add](https://developer.kaltura.com/api-docs/#/conversionProfile.add) API action:


{% highlight php %}
<?php 
require_once('lib/KalturaClient.php'); 
$config = new KalturaConfiguration($partnerId); 
$config->serviceUrl = 'https://www.kaltura.com/'; 
$client = new KalturaClient($config); 
$client->setKs('AddYourKS'); 
$conversionProfile = new KalturaConversionProfile(); 
$conversionProfile->status = KalturaConversionProfileStatus::ENABLED; 
$conversionProfile->name = 'YourConversionProfileName'; 
$conversionProfile->isDefault = KalturaNullableBoolean::TRUE_VALUE; 
$results = $client-> conversionProfile ->add($conversionProfile);
{% endhighlight %}
