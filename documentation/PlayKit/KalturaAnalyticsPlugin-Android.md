---
layout: page
title: Configuring the Kaltura Video Player to use the Kaltura Analytics Plugin on Android Devices
subcat: Android
weight: 295
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)


This article describes the steps required for using the Kaltura Analytics Plugin on Android devices as well as the events supported by the plugin. Adding the Kaltura Analytics Plugin will enable you get detailed analytics. 

### Enable the Kaltura Analytics Plugin for the Kaltura Player  

To enable the Kaltura Analytics Plugin in Android devices, register the plugin inside your application as follows:

```
PlayKitManager.registerPlugins(KalturaAnalyticsPlugin.factory);
```

### Configure the Plugin Configuration Object for the Kaltura Analytics Plugin  

To configure the plugin, add the following configuration to your `pluginConfig` file as follows:

```
private void configureKalturaStatsPlugin(PlayerConfig pluginConfig) {
        JsonObject kalturaAnalyticsConfig = new JsonObject();
        kalturaAnalyticsConfig.addProperty("sessionId", sessionId);
        kalturaAnalyticsConfig.addProperty("uiconfId", uiconfId);
        kalturaAnalyticsConfig.addProperty("baseUrl", baseUrl);
        kalturaAnalyticsConfig.addProperty("partnerId", partnerId); 
        kalturaAnalyticsConfig.addProperty("timerInterval", timerInterval); //Timer interval to check progress of the media in milliseconds- recommended value - short media - 10000, long media - 30000
     

```

### Set the Plugin Configuration to Initiate onLoad of the Kaltura Analytics Plugin  

To enable the Kaltura Analytics Plugin to start loading, you'll need to set the plugin configuration you created as follows:

```
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
plugins.setPluginConfig("KalturaAnalytics", kalturaAnalyticsConfig); 
```

## Kaltura Analytics Plugin Supported Events  

The Kaltura Analytics Plugin supports the following events:

IMPRESSION(1),

PLAY_REQUEST(2),

PLAY(3),
        
RESUME(4),
        
PLAY_25PERCENT(11),
        
PLAY_50PERCENT(12),
        
PLAY_75PERCENT(13),
        
PLAY_100PERCENT(14),
        
PAUSE(33),
        
REPLAY(34),
       
SEEK(35),
        
SOURCE_SELECTED(39),
        
INFO(40),
        
SPEED(41),
        
VIEW(99);
