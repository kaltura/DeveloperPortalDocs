---
layout: page
title: Configuring the TVPAPI Stats Plugin on Android Devices
subcat: Android Version 3.0
weight: 403
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)


This article describes the steps required for using the TVPAPI Stats Plugin on Android devices to get statistical information on the device, as well as the events supported by the plugin. 

### Register the TVPAPI Stats Plugin  

Register the TVPAPI Stats Plugin in your application as follows:

```
PlayKitManager.registerPlugins(TVPAPIAnalyticsPlugin.factory);
```

### Configure the Plugin Configuration Object for the TVPAPI Stats Plugin 

To configure the TVPAPI Stats Plugin, add the following configuration to your `pluginConfig` file as follows:

```
private void configureTVPAPIPlugin(PlayerConfig pluginConfig) {
        JsonObject TVPAPIConfigEntry = new JsonObject();
        TVPAPIConfigEntry.addProperty("fileId", "fileId");
        TVPAPIConfigEntry.addProperty("baseUrl", "base url"); //Sample url - http://tvpapi-preprod.ott.kaltura.com/v3_9/gateways/jsonpostgw.aspx?
        TVPAPIConfigEntry.addProperty("timerInterval", timer value for HIT events - in millisecondes);//Default value - 30000
        TVPAPIConfigEntry.add("initObj", initObj); // must be a valid initObj of TVPAPI
```

### Set the Plugin Configuration to the TVPAPI Stats Plugin  

To ensure that the TVPAPI Stats Plugin starts loading, you'll need to set the plugin configuration you created as follows:

```
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
plugins.setPluginConfig("TVPAPIAnalytics" , TVPAPIConfigEntry.toJson()); 
```

## TVPAPI Stats Plugin Supported Events  

The TVPAPI Stats Plugin supports the following events:

TVPAPI action Types{

 MediaHit, //outputs every interval time
 
 MediaMark //Outputs in the following events - {PLAY,STOP,PAUSE,FIRST_PLAY,LOAD,FINISH,BITRATE_CHANGE,ERROR}
 
}

## Concurrency Handler  

To receive concurrency events from the TVPAPI Stats Plugin, you'll need to add a listener to the following event:

```
messageBus.listen(new PKEvent.Listener() {
                        @Override
                        public void onEvent(PKEvent event) {
                            if (event instanceof OttEvent){
                                \\Handle concurrency events
                            }
                        }
                    }, OttEvent.OttEventType.Concurrency);
                    
```
