---
layout: page
title: Configuring the Player to use Youbora Plugin in Android Devices
subcat: Android
weight: 291
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)


This article describes the steps required to use Youbora Plugin in Android devices.

## Enabling Youbora Plugin for the Kaltura Player  

To enable Youbora Plugin in Android devices for the Kaltura Player do the following steps:

Register Youbora Plugin inside your app:

```
PlayKitManager.registerPlugins(YouboraPlugin.factory);
```

## Configuring the plugin config object for Youbora Plugin  

To configure the Youbora Plugin, add the following configuration to your `pluginConfig`:

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

## Setting the plugin config to Youbora Plugin

In order for the Youbora Plugin to start loading, you need to set
the plugin config you created -

```
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
plugins.setPluginConfig("Youbora", converterYoubora.toJson()); 
```

## Analyzing the Youbora Plugin requests

The correct flow of events when Youbora Plugin is activated and you play media using Kaltur aPlayer - 

1. Data request event - /data
The response will contain the URL all other events will be send to.
http://nqs.nice264.com/data?system=kalturatest&pluginName=playkit%2Fandroid-0.0.3&timemark=1481719756186&pluginVersion=5.3.0-playkit%2Fandroid-0.0.3&outputformat=jsonp


2. Start event /start
After play was pressed or auto-play is on
http://test-nqs-lw2.nice264.com/start?deviceId=&cdn=&param6=&duration=15&user=&param10=&code=V_19210_apk0b5rp2e5bq0gm_0&resource=http%3A%2F%2Flbd.kaltura.com%3A8002%2Fedash%2Fp%2F552741%2Fsp%2F55274100%2FserveFlavor%2FentryId%2F1_a2qor9cc%2Fv%2F1%2FflavorId%2F1_%2C93t0pa0f%2Cnr0yylo6%2C644jy89i%2C%2Fforceproxy%2Ftrue%2Fname%2Fa.mp4.urlset%2Fmanifest.mpd&adsExpected=true&param1=playkit%2Fandroid-0.0.3&param7=&param2=&timemark=1481719912433&isp=&pingTime=5&playerVersion=playkit%2Fandroid-0.0.3&system=kalturatest&properties=%7B%22device%22%3A%22%22%2C%22audioType%22%3A%22%22%2C%22rating%22%3A%22%22%2C%22cast%22%3A%22joe+joe%22%2C%22quality%22%3A%22%22%2C%22owner%22%3A%22%22%2C%22year%22%3A%222000%22%2C%22parental%22%3A%22%22%2C%22genre%22%3A%22action%22%2C%22price%22%3A%22%22%2C%22transaction_type%22%3A%22%22%2C%22audioChannels%22%3A%22%22%2C%22type%22%3A%22video%22%2C%22director%22%3A%22henry%22%7D&live=false&param8=&param4=&pluginVersion=5.3.0-playkit%2Fandroid-0.0.3&param9=&rendition=&title=&transcode=&param3=&hashTitle=true&ip=&player=playkit%2Fandroid-0.0.3&param5=


3. Join event /join
After media started playing
http://test-nqs-lw2.nice264.com/joinTime?timemark=1481719912435&eventTime=0.0&mediaDuration=15.0&time=3&code=V_19210_apk0b5rp2e5bq0gm_0

4. Ping event /ping     
Every 5 seconds

5. Stop event /stop
After media finished playing


