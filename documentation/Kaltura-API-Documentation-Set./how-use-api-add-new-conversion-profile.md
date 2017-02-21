---
layout: page
title: How to use the API to Add a New Conversion Profile
---

To add a conversion profile, call the [conversionProfile.add][1] API action.

 [1]: https://developer.kaltura.com/api-docs/#/conversionProfile.add{% highlight php %}<?php require\_once('lib/KalturaClient.php'); $config = new KalturaConfiguration($partnerId); $config->serviceUrl = 'http://www.kaltura.com/'; $client = new KalturaClient($config); $client->setKs('AddYourKS'); $conversionProfile = new KalturaConversionProfile(); $conversionProfile->status = KalturaConversionProfileStatus::ENABLED; $conversionProfile->name = 'YourConversionProfileName'; $conversionProfile->isDefault = KalturaNullableBoolean::TRUE\_VALUE; $results = $client-> conversionProfile ->add($conversionProfile);{% endhighlight %}
