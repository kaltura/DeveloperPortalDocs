---
layout: page
title: Configuring the Youbora Plugin on Android Devices
subcat: Android Version 3.0
weight: 291
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)

This article describes the steps required for implementing the Youbora Plugin on Android devices. Youbora is an intelligence analytics and optimization platform used in Kaltura's solution to track media analytics events. 

You'll need to set up an account in http://www.youbora.com and then set the account details in the plugin configuration to use this plugin. After these steps, you'll be able to use the Youbora dashboard and watch statistical events and analytics sent by the Kaltura Video Payer.

## Enabling the Youbora Plugin for the Kaltura Video Player  

To enable the Youbora Plugin on Android devices, implement the following steps:

### Register the Youbora Plugin Inside your Application  

Register the Youbora Plugin as follows:

```
PlayKitManager.registerPlugins(YouboraPlugin.factory);
```

### Configure the Plugin Configuration Object for the Youbora Plugin  

To configure the Youbora Plugin, add the following configuration to your `pluginConfig` file as follows:

        ```
        private void configureYouboraPlugin(PlayerConfig pluginConfig) {
        JsonObject youboraConfigEntry = new JsonObject();
        youboraConfigEntry.addProperty("accountCode", "your youbora account code");
        youboraConfigEntry.addProperty("username", "user name for youbora"); //Optional
        youboraConfigEntry.addProperty("haltOnError", true);
        youboraConfigEntry.addProperty("enableAnalytics", true); //If you want to enable youbora ads analytics

        JsonObject mediaEntry = new JsonObject();
        mediaEntry.addProperty("title", "media title");

        JsonObject adsEntry = new JsonObject(); //If you have ads support in your app
        adsEntry.addProperty("adsExpected", true);
        adsEntry.addProperty("title", "ad title");
        adsEntry.addProperty("campaign", "ad campaign");

        JsonObject extraParamEntry = new JsonObject(); // You can define upto 10 configurable params "param1" to "param10"
        extraParamEntry.addProperty("param1", "Configurable");
        extraParamEntry.addProperty("param2", "playKitPlayer");
        extraParamEntry.addProperty("param3", "Configurable");

        JsonObject propertiesEntry = new JsonObject();
        propertiesEntry.addProperty("genre", "");
        propertiesEntry.addProperty("type", "");
        propertiesEntry.addProperty("transaction_type", "");
        propertiesEntry.addProperty("year", "");
        propertiesEntry.addProperty("cast", "");
        propertiesEntry.addProperty("director", "");
        propertiesEntry.addProperty("owner", "");
        propertiesEntry.addProperty("parental", "");
        propertiesEntry.addProperty("price", "");
        propertiesEntry.addProperty("rating", "");
        propertiesEntry.addProperty("audioType", "");
        propertiesEntry.addProperty("audioChannels", "");
        propertiesEntry.addProperty("device", "");
        propertiesEntry.addProperty("quality", "");

        ConverterYoubora converterYoubora = new ConverterYoubora(youboraConfigEntry, mediaEntry,
                adsEntry, extraParamEntry, propertiesEntry); // you set the coverterYoubora.toJson() as the plugin config object
                }

        ```

### Set the Plugin Configuration to the Youbora Plugin  

For the Youbora Plugin to start loading, you'll need to set the plugin configuration you created as follows:

        ```
        PlayerConfig config = new PlayerConfig();
        PlayerConfig.Plugins plugins = config.plugins;
        plugins.setPluginConfig("Youbora", converterYoubora.toJson()); 
        ```

### Analyze the Youbora Plugin Requests

The following is the correct flow of events when the Youbora Plugin is activated and you use the Kaltura Video Player to play media. 

1. Data request event - /data: The response will contain the URL, while all other events will be send to:
        
        ```
        http://nqs.nice264.com/data?system=kalturatest&pluginName=playkit%2Fandroid-0.0.3&timemark=1481719756186&pluginVersion=5.3.0-   playkit%2Fandroid-0.0.3&outputformat=jsonp
        ```
2. Start event /start: After pressing **Play** or if auto-play is on, the following will occur:
        
        ```
        http://test-nqs-lw2.nice264.com/start?          deviceId=&cdn=&param6=&duration=15&user=&param10=&code=V_19210_apk0b5rp2e5bq0gm_0&resource=http%3A%2F%2Flbd.kaltura.com%3A8002%2Fedash%2Fp%2F552741%2Fsp%2F55274100%2FserveFlavor%2FentryId%2F1_a2qor9cc%2Fv%2F1%2FflavorId%2F1_%2C93t0pa0f%2Cnr0yylo6%2C644jy89i%2C%2Fforceproxy%2Ftrue%2Fname%2Fa.mp4.urlset%2Fmanifest.mpd&adsExpected=true&param1=playkit%2Fandroid-0.0.3&param7=&param2=&timemark=1481719912433&isp=&pingTime=5&playerVersion=playkit%2Fandroid-0.0.3&system=kalturatest&properties=%7B%22device%22%3A%22%22%2C%22audioType%22%3A%22%22%2C%22rating%22%3A%22%22%2C%22cast%22%3A%22joe+joe%22%2C%22quality%22%3A%22%22%2C%22owner%22%3A%22%22%2C%22year%22%3A%222000%22%2C%22parental%22%3A%22%22%2C%22genre%22%3A%22action%22%2C%22price%22%3A%22%22%2C%22transaction_type%22%3A%22%22%2C%22audioChannels%22%3A%22%22%2C%22type%22%3A%22video%22%2C%22director%22%3A%22henry%22%7D&live=false&param8=&param4=&pluginVersion=5.3.0-playkit%2Fandroid-0.0.3&param9=&rendition=&title=&transcode=&param3=&hashTitle=true&ip=&player=playkit%2Fandroid-0.0.3&param5=
        ```

3. Join event /join. After the media starts playing the following will occur:

        ```
        http://test-nqs-lw2.nice264.com/joinTime?timemark=1481719912435&eventTime=0.0&mediaDuration=15.0&time=3&code=V_19210_apk0b5rp2e5bq0gm_0
        ```

4. Ping event /ping: This will ping the event every five seconds.

5. Stop event /stop: Use this funciton after the media finishes playing.


