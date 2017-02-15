---
layout: page
title: Analytics
subcat: SDK 3.0 - Android
weight: 298
---

Kaltura’s Mobile Video Player SDKs for Android make it easy for you to integrate analytics data collection, by providing you with several analytics solutions.

## Supported Analytics

| Analytics Plugin Name | More Information |
|-----------------------|------------------|
| Kaltura Analytics     | []()             |
| Kaltura Stats         | []()             |
| TVPAPI                | []()             |
| Phoenix               | []()             |
| Youbora               | []()             |



## Kaltura Analytics Plugin  

This section describes the steps required for using the Kaltura Analytics Plugin on Android devices as well as the events supported by the plugin. Adding the Kaltura Analytics Plugin will enable you get detailed analytics. 

### Enable the Kaltura Analytics Plugin for the Kaltura Player  

To enable the Kaltura Analytics Plugin in Android devices, register the plugin inside your application as follows:

```java
PlayKitManager.registerPlugins(KalturaAnalyticsPlugin.factory);
```

### Configure the Plugin Configuration Object for the Kaltura Analytics Plugin  

To configure the plugin, add the following configuration to your `pluginConfig` file as follows:

```java
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

```java
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
plugins.setPluginConfig("KalturaAnalytics", kalturaAnalyticsConfig); 
```

### Kaltura Analytics Plugin Supported Events  

The Kaltura Analytics Plugin supports the following events:

```java        
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
```

## Kaltura Stats Plugin  

This section describes the steps required for configuring the Kaltura Video Player to use the Kaltura Stats Plugin on Android devices. This will enable you to obtain important statistical information about usage.

### Register the Kaltura Stats Plugin for the Kaltura Video Player  

To enable the Kaltura Stats Plugin, register the plugin inside your application as follows:

```java
PlayKitManager.registerPlugins(KalturaStatsPlugin.factory);
```

### Configure the Plugin Configuration Object for the Kaltura Stats Plugin  

To configure the Kaltura Stats Plugin, add the following configuration to your `pluginConfig` file as follows:

```java
private void configureKalturaStatsPlugin(PlayerConfig pluginConfig) {
        JsonObject kalturaStatsConfig = new JsonObject();
        kalturaStatsConfig.addProperty("sessionId", sessionId);
        kalturaStatsConfig.addProperty("uiconfId", uiconfId);
        kalturaStatsConfig.addProperty("baseUrl", baseUrl);
        kalturaStatsConfig.addProperty("partnerId", partnerId); 
        kalturaStatsConfig.addProperty("timerInterval", timerInterval); //Timer interval to check progress of the media in milliseconds- recommended value - short media - 10000, long media - 30000
```

### Set the Plugin Configuration to Initiate onLoad of the Kaltura Stats Plugin  

To enable the Kaltura Stats Plugin to start loading, you'll need to set the plugin configuration you created as follows:

```java
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
plugins.setPluginConfig("KalturaStats", kalturaStatsConfig); 
```

### Kaltura Stats Plugin Supported Events  

The Kaltura Stats Plugin supports the following events:

```java
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
```

## TVPAPI Stats Plugin  

This section describes the steps required for using the TVPAPI Stats Plugin on Android devices to get statistical information on the device, as well as the events supported by the plugin. 


### Register the TVPAPI Stats Plugin  

Register the TVPAPI Stats Plugin in your application as follows:

```java
PlayKitManager.registerPlugins(TVPAPIAnalyticsPlugin.factory);               
```

### Configure the Plugin Configuration Object for the TVPAPI Stats Plugin 

To configure the TVPAPI Stats Plugin, add the following configuration to your `pluginConfig` file as follows:

```java
private void configureTVPAPIPlugin(PlayerConfig pluginConfig) {
JsonObject TVPAPIConfigEntry = new JsonObject();
TVPAPIConfigEntry.addProperty("fileId", "fileId");
TVPAPIConfigEntry.addProperty("baseUrl", "base url"); //Sample url - http://tvpapi-     preprod.ott.kaltura.com/v3_9/gateways/jsonpostgw.aspx?
TVPAPIConfigEntry.addProperty("timerInterval", timer value for HIT events - in millisecondes);//Default value - 30000
TVPAPIConfigEntry.add("initObj", initObj); // must be a valid initObj of TVPAPI
```

### Set the Plugin Configuration to the TVPAPI Stats Plugin  

To ensure that the TVPAPI Stats Plugin starts loading, you'll need to set the plugin configuration you created as follows:

```java
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
plugins.setPluginConfig("TVPAPIAnalytics" , TVPAPIConfigEntry.toJson()); 
```

### TVPAPI Stats Plugin Supported Events  

The TVPAPI Stats Plugin supports the following events:

```java
TVPAPI action Types{
MediaHit, //outputs every interval time
 MediaMark //Outputs in the following events - {PLAY,STOP,PAUSE,FIRST_PLAY,LOAD,FINISH,BITRATE_CHANGE,ERROR}
}
```

### Concurrency Handler  

To receive concurrency events from the TVPAPI Stats Plugin, you'll need to add a listener to the following event:

```java
messageBus.listen(new PKEvent.Listener() {
@Override
public void onEvent(PKEvent event) {
	if (event instanceof OttEvent){
	\\Handle concurrency events
	}
}
}, OttEvent.OttEventType.Concurrency);                    
```

## Phoenix Stats Plugin  

This article describes the steps required for configuring the Kaltura Video Player to use the Phoenix Stats Plugin on Android devices as well as the supported plugin events. This will enable you to obtain important statistical information about usage.

### Register the Phoenix Stats Plugin inside your Application  

Register the Phoenix Stats Plugin inside your application as follows:

```java
PlayKitManager.registerPlugins(PhoenixAnalyticsPlugin.factory);
```

### Configure the Plugin Configuration Object for the Phoenix Stats Plugin  

To configure the Phoenix Stats Plugin, add the following configuration to your `pluginConfig` file as follows:

```java
private void configurePhoenixPlugin(PlayerConfig pluginConfig) {
        JsonObject phoenixConfigEntry = new JsonObject();
        phoenixConfigEntry.addProperty("fileId", "fileId");
        phoenixConfigEntry.addProperty("partnerId", "partner id");
        phoenixConfigEntry.addProperty("baseUrl", "base url");
        phoenixConfigEntry.addProperty("ks", ks); 
        phoenixConfigEntry.addProperty("timerInterval", timer value for HIT events - in millisecondes);//Default value - 30000
```

### Set the Plugin Configuration to the Phoenix Stats Plugin  

For the  Phoenix Stats Plugin to start loading, you'll need to set the plugin configuration you created as follows:

```java
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
plugins.setPluginConfig("PhoenixAnalytics" , phoenixConfigEntry.toJson()); 
```

### Phoenix Stats Plugin Supported Events  

The following events are supported by the Phoenix Stats Plugin:

```java
 HIT, //outputs every interval time
 
 PLAY, 
 
 STOP,
 
 PAUSE,
 
 FIRST_PLAY,
 
 LOAD,
 
 FINISH,
 
 BITRATE_CHANGE,
 
 ERROR
```

### Concurrency Handler  

To receive concurrency events from the Phoenix Stats Plugin, you'll need to add a listener to the following event:

```java
messageBus.listen(new PKEvent.Listener() {
                        @Override
                        public void onEvent(PKEvent event) {
                            if (event instanceof OttEvent){
                                \\Handle concurrency events
                            }
                        }
                    }, OttEvent.OttEventType.Concurrency);
                    
```

## Youbora Plugin  

This article describes the steps required for implementing the Youbora Plugin on Android devices. Youbora is an intelligence analytics and optimization platform used in Kaltura's solution to track media analytics events. 

You'll need to set up an account in http://www.youbora.com and then set the account details in the plugin configuration to use this plugin. After these steps, you'll be able to use the Youbora dashboard and watch statistical events and analytics sent by the Kaltura Video Payer.

### Enabling the Youbora Plugin  

To enable the Youbora Plugin in Android devices, register the plugin inside your application as follows

```java
PlayKitManager.registerPlugins(YouboraPlugin.factory);
```

### Configure the Plugin Configuration Object for the Youbora Plugin  

To configure the Youbora Plugin, add the following configuration to your `pluginConfig` file as follows:

```java
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

```java
        PlayerConfig config = new PlayerConfig();
        PlayerConfig.Plugins plugins = config.plugins;
        plugins.setPluginConfig("Youbora", converterYoubora.toJson()); 
```

### Analyze the Youbora Plugin Requests

The following is the correct flow of events when the Youbora Plugin is activated and you use the Kaltura Video Player to play media. 

1 . Data request event - /data: The response will contain the URL, while all other events will be send to:
        
```java
        http://nqs.nice264.com/data?system=kalturatest&pluginName=playkit%2Fandroid-0.0.3&timemark=1481719756186&pluginVersion=5.3.0-   playkit%2Fandroid-0.0.3&outputformat=jsonp
```

2 . Start event /start: After pressing **Play** or if auto-play is on, the following will occur:
        
```java
http://test-nqs-lw2.nice264.com/start?          deviceId=&cdn=&param6=&duration=15&user=&param10=&code=V_19210_apk0b5rp2e5bq0gm_0&resource=http%3A%2F%2Flbd.kaltura.com%3A8002%2Fedash%2Fp%2F552741%2Fsp%2F55274100%2FserveFlavor%2FentryId%2F1_a2qor9cc%2Fv%2F1%2FflavorId%2F1_%2C93t0pa0f%2Cnr0yylo6%2C644jy89i%2C%2Fforceproxy%2Ftrue%2Fname%2Fa.mp4.urlset%2Fmanifest.mpd&adsExpected=true&param1=playkit%2Fandroid-0.0.3&param7=&param2=&timemark=1481719912433&isp=&pingTime=5&playerVersion=playkit%2Fandroid-0.0.3&system=kalturatest&properties=%7B%22device%22%3A%22%22%2C%22audioType%22%3A%22%22%2C%22rating%22%3A%22%22%2C%22cast%22%3A%22joe+joe%22%2C%22quality%22%3A%22%22%2C%22owner%22%3A%22%22%2C%22year%22%3A%222000%22%2C%22parental%22%3A%22%22%2C%22genre%22%3A%22action%22%2C%22price%22%3A%22%22%2C%22transaction_type%22%3A%22%22%2C%22audioChannels%22%3A%22%22%2C%22type%22%3A%22video%22%2C%22director%22%3A%22henry%22%7D&live=false&param8=&param4=&pluginVersion=5.3.0-playkit%2Fandroid-0.0.3&param9=&rendition=&title=&transcode=&param3=&hashTitle=true&ip=&player=playkit%2Fandroid-0.0.3&param5=
```

3 . Join event /join. After the media starts playing the following will occur:

```java
        http://test-nqs-lw2.nice264.com/joinTime?timemark=1481719912435&eventTime=0.0&mediaDuration=15.0&time=3&code=V_19210_apk0b5rp2e5bq0gm_0
```

4 . Ping event /ping: This will ping the event every five seconds.

5 . Stop event /stop: Use this funciton after the media finishes playing.



## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
