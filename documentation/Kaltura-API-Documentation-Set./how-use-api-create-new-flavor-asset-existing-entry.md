---
layout: page
title: How to Use the API to Create a New Flavor Asset for an Existing Entry
weight: 103
---

To create a new flavor asset for an existing entry, call the [flavorAsset.convert](https://developer.kaltura.com/api-docs/#/flavorAsset.convert) API action.

{% highlight php %}
<?php require\_once('lib/KalturaClient.php'); $config = new KalturaConfiguration($partnerId); $config->serviceUrl = 'http://www.kaltura.com/'; $client = new KalturaClient($config); $client->setKs('AddYourKS'); $entryId = '1\_entryIdString'; $flavorParamsId = 11111; $results = $client->flavorAsset->convert($entryId, $flavorParamsId); 
{% endhighlight %}
