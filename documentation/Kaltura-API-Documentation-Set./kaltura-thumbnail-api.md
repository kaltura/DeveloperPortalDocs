---
layout: page
title: How to use the API to Create a New Flavor Asset for an Existing Entry
---

To create a new flavor asset for an existing entry, call the [flavorAsset.convert][1] API action.

 [1]: https://developer.kaltura.com/api-docs/#/flavorAsset.convert{% highlight php %}<?php require\_once('lib/KalturaClient.php'); $config = new KalturaConfiguration($partnerId); $config->serviceUrl = 'http://www.kaltura.com/'; $client = new KalturaClient($config); $client->setKs('AddYourKS'); $entryId = '1\_entryIdString'; $flavorParamsId = 11111; $results = $client->flavorAsset->convert($entryId, $flavorParamsId); {% endhighlight %}
