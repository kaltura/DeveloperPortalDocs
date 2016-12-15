---
layout: page
title: Configuring the Player to use Kaltura Analytics Plugin in Android Devices
subcat: Android
weight: 295
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)


This article describes the steps required to use Kaltura Analytics Plugin in Android devices.

## Enabling Kaltura Analytics Plugin for the Kaltura Player  

To enable Kaltura Analytics Plugin in Android devices for the Kaltura Player do the following steps:

Register the Plugin inside your app:

```
PlayKitManager.registerPlugins(KalturaAnalyticsPlugin.factory);
```

## Configuring the plugin config object for Kaltura Analytics Plugin  

To configure the Plugin, add the following configuration to your `pluginConfig`:

```
private void configureKalturaStatsPlugin(PlayerConfig pluginConfig) {
        JsonObject kalturaAnalyticsConfig = new JsonObject();
        kalturaAnalyticsConfig.addProperty("sessionId", sessionId);
        kalturaAnalyticsConfig.addProperty("uiconfId", uiconfId);
        kalturaAnalyticsConfig.addProperty("baseUrl", baseUrl);
        kalturaAnalyticsConfig.addProperty("partnerId", partnerId); 
        kalturaAnalyticsConfig.addProperty("timerInterval", timerInterval); //Timer interval to check progress of the media in milliseconds- recommended value - short media - 10000, long media - 30000
     

```

## Setting the plugin config, initiates onLoad in the plugin

In order for the Kaltura Analytics Plugin to start loading, you need to set
the plugin config you created -

```
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
plugins.setPluginConfig("KalturaAnalytics", kalturaAnalyticsConfig); 
```

## Supported events by the kaltura Analytics plugin

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







