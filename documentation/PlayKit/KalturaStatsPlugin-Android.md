---
layout: page
title: Configuring the Player to use Kaltura Stats Plugin in Android Devices
subcat: Android
weight: 294
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)


This article describes the steps required to use Kaltura Stats Plugin in Android devices.

## Enabling Kaltura Stats Plugin for the Kaltura Player  

To enable Kaltura Stats Plugin in Android devices for the Kaltura Player do the following steps:

Register the Plugin inside your app:

```
PlayKitManager.registerPlugins(KalturaStatsPlugin.factory);
```

## Configuring the plugin config object for Kaltura Stats Plugin  

To configure the Plugin, add the following configuration to your `pluginConfig`:

```
private void configureKalturaStatsPlugin(PlayerConfig pluginConfig) {
        JsonObject kalturaStatsConfig = new JsonObject();
        kalturaStatsConfig.addProperty("sessionId", sessionId);
        kalturaStatsConfig.addProperty("uiconfId", uiconfId);
        kalturaStatsConfig.addProperty("baseUrl", baseUrl);
        kalturaStatsConfig.addProperty("partnerId", partnerId); 
        kalturaStatsConfig.addProperty("timerInterval", timerInterval); //Timer interval to check progress of the media in milliseconds- recommended value - short media - 10000, long media - 30000
     

```

## Setting the plugin config, initiates onLoad in the plugin

In order for the Kaltura Stats Plugin to start loading, you need to set
the plugin config you created -

```
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
plugins.setPluginConfig("KalturaStats", kalturaStatsConfig); 
```

## Supported events by the kaltura Stats plugin

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






