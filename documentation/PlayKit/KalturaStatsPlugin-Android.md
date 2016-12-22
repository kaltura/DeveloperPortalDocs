---
layout: page
title: Configuring the Kaltura Video Player to use the Kaltura Stats Plugin in Android Devices
subcat: Android
weight: 294
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)

This article describes the steps required for configuring the Kaltura Video Player to use the Kaltura Stats Plugin on Android devices. This will enable you to obtain important statistical information about usage.

## Register the Kaltura Stats Plugin for the Kaltura Video Player  

To enable the Kaltura Stats Plugin, register the plugin inside your application as follows:

```
PlayKitManager.registerPlugins(KalturaStatsPlugin.factory);
```

## Configure the Plugin Configuration Object for the Kaltura Stats Plugin  

To configure the Kaltura Stats Plugin, add the following configuration to your `pluginConfig` file as follows:

```
private void configureKalturaStatsPlugin(PlayerConfig pluginConfig) {
        JsonObject kalturaStatsConfig = new JsonObject();
        kalturaStatsConfig.addProperty("sessionId", sessionId);
        kalturaStatsConfig.addProperty("uiconfId", uiconfId);
        kalturaStatsConfig.addProperty("baseUrl", baseUrl);
        kalturaStatsConfig.addProperty("partnerId", partnerId); 
        kalturaStatsConfig.addProperty("timerInterval", timerInterval); //Timer interval to check progress of the media in milliseconds- recommended value - short media - 10000, long media - 30000
     

```

## Set the Plugin Configuration to Initiate onLoad of the Kaltura Stats Plugin  

To enable the Kaltura Stats Plugin to start loading, you'll need to set the plugin configuration you created as follows:

```
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
plugins.setPluginConfig("KalturaStats", kalturaStatsConfig); 
```

## Kaltura Stats Plugin Supported Events  

The Kaltura Stats Plugin supports the following events:

 WIDGET_LOADED(1),

 MEDIA_LOADED(2),

 PLAY(3),

 PLAY_REACHED_25(4),

 PLAY_REACHED_50(5),

 PLAY_REACHED_75(6),

 PLAY_REACHED_100(7),

 BUFFER_START(12),

 BUFFER_END(13),

 REPLAY(16),

 SEEK(17),

 PREROLL_STARTED(24),

 MIDROLL_STARTED(25),

 POSTROLL_STARTED(26),

 PREROLL_CLICKED(28),

 MIDROLL_CLICKED(29),

 POSTROLL_CLICKED(30),

 PREROLL_25(32),

 PREROLL_50(33),

 PREROLL_75(34),

 MIDROLL_25(35),

 MIDROLL_50(36),

 MIDROLL_75(37),

 POSTROLL_25(38),

 POSTROLL_50(39),

 POSTROLL_75(40),

 ERROR(99);






