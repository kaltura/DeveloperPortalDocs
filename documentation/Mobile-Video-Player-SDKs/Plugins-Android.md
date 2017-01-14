---
layout: page
title: Using Plugins on Android Devices
subcat: SDK 3.0 (Beta) - Android
weight: 395
---

## Setting the Plugin Configuration to the Youbora Plugin

For the Youbora Plugin to start loading, you'll need to set the plugin configuration you created as follows:

       ```
       PlayerConfig.Plugins pluginsConfig = config.plugins;
       pluginsConfig.setPluginConfig(YouboraPlugin.factory.getName(), converterYoubora.toJson()); 
       ```

## Setting the Plugin Configuration to the IMA Plugin  

For the IMA Plugin to start loading, you'll need to set the plugin configuration you created as follows:

       ```
       String adTagUrl = "https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/124319096/external/single_ad_samples&ciu_szs=300x250&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&cust_params=deployment%3Ddevsite%26sample_ct%3Dskippablelinear&correlator=";
       List<String> videoMimeTypes = new ArrayList<>();
       videoMimeTypes.add(MimeTypes.APPLICATION_MP4);
       IMAConfig adsConfig = new IMAConfig("en", false, true, -1, 
       videoMimeTypes, adTagUrl, true, true);
            
       pluginsConfig.setPluginConfig(IMAPlugin.factory.getName(),adsConfig.toJSONObject());

       ```
