---
layout: page
title: Configuring the IMA Plugin on Android Devices
subcat: SDK 3.0 (Beta) - Android
weight: 400
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)

This article describes the steps required for adding support for the IMA Plugin functionality on Android devices. IMA (or Interactive Media Ads) was developed by Google to enable you to display ads in your application's video, audio, and game content.

### Register the IMA Plugin  

Register the IMA Plugin as inside your application as follows:

```
PlayKitManager.registerPlugins(PhoenixAnalyticsPlugin.factory);
```

### Configure the Plugin Configuration Object  

To configure the plugin, add the following configuration to your `pluginConfig` file as follows:

```
private void configureIMAPlugin(PlayerConfig pluginConfig) {
    String adTagUrl = VIOAdUtil.getCastAdTag(mVideoDetailsModel);
    List<String> videoMimeTypes = new ArrayList<>();
    IMAConfig adsConfig = new IMAConfig("en", false, true, -1, videoMimeTypes, adTagUrl, true, true);
```
### IMConfig Constructor  

```
IMAConfig(String language, boolean enableBackgroundPlayback, boolean autoPlayAdBreaks, int videoBitrate, List<String> videoMimeTypes, String adTagUrl, boolean adAttribution, boolean adCountDown)
```

## Set the Plugin Configuration to the IMA Plugin  

For the IMA Plugin to start loading, you'll need to set the plugin configuration you created as follows:

```
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
pluginConfig.plugins.setPluginConfig(IMAPlugin.factory.getName(), adsConfig.toJSONObject());
```

## Register to the Ad Started Event  

The Ad Started event includes the `AdInfo` playload. You can fetch this data in the following way:

``` 
player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log.d("AD_STARTED");
                mAdStartedEventInfo = (AdEvent.AdStartedEvent) event;
                appProgressBar.setVisibility(View.INVISIBLE);
            }
        }, AdEvent.Type.STARTED);

```

### AdInfo API  

```
    String   getAdDescription();
    String   getAdId();
    String   getAdSystem();
    boolean  isAdSkippable();
    String   getAdTitle();
    String   getAdContentType();
    int      getAdWidth();
    int      getAdHeight();
    int      getAdPodCount();
    int      getAdPodPosition();
    long     getAdPodTimeOffset();
    long     getAdDuration();
```

## Ad Events/Error Registration Example  


```
        public void onEvent(PKEvent event) {
                log.d("AD_CONTENT_PAUSE_REQUESTED");
                PKAdInfo adInfo = player.getAdInfo();
                appProgressBar.setVisibility(View.VISIBLE);
            }
        }, AdEvent.Type.CONTENT_PAUSE_REQUESTED);
        
        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log.d("Ad Event AD_RESUMED");
                nowPlaying = true;
                appProgressBar.setVisibility(View.INVISIBLE);
            }
        }, AdEvent.Type.RESUMED);
        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log.d("Ad Event AD_ALL_ADS_COMPLETED");
                appProgressBar.setVisibility(View.INVISIBLE);
            }
        }, AdEvent.Type.ALL_ADS_COMPLETED);
        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log.d("Ad Error Event VAST_LOAD_TIMEOUT");
            }
        }, AdError.Type.VAST_LOAD_TIMEOUT);
```
## Ad Events  

The IMA Plugin supports the following ad events:

        STARTED,
        PAUSED,
        RESUMED,
        COMPLETED,
        FIRST_QUARTILE,
        MIDPOINT,
        THIRD_QUARTILE,
        SKIPPED(),
        CLICKED,
        TAPPED,
        ICON_TAPPED,
        AD_BREAK_READY,
        AD_PROGRESS,
        AD_BREAK_STARTED,
        AD_BREAK_ENDED,
        CUEPOINTS_CHANGED,
        LOADED,
        CONTENT_PAUSE_REQUESTED,
        CONTENT_RESUME_REQUESTED,
        ALL_ADS_COMPLETED
        
## Ad Error Events  

The IMA Plugin supports the following ad error events:

        INTERNAL_ERROR(2000),
        VAST_MALFORMED_RESPONSE(2001),
        UNKNOWN_AD_RESPONSE(2002),
        VAST_LOAD_TIMEOUT(2003),
        VAST_TOO_MANY_REDIRECTS(2004),
        VIDEO_PLAY_ERROR(2005),
        VAST_MEDIA_LOAD_TIMEOUT(2006),
        VAST_LINEAR_ASSET_MISMATCH(2007),
        OVERLAY_AD_PLAYING_FAILED(2008),
        OVERLAY_AD_LOADING_FAILED(2009),
        VAST_NONLINEAR_ASSET_MISMATCH(2010),
        COMPANION_AD_LOADING_FAILED(2011),
        UNKNOWN_ERROR(2012),
        VAST_EMPTY_RESPONSE(2013),
        FAILED_TO_REQUEST_ADS(2014),
        VAST_ASSET_NOT_FOUND(2015),
        ADS_REQUEST_NETWORK_ERROR(2016),
        INVALID_ARGUMENTS(2017),
        PLAYLIST_NO_CONTENT_TRACKING(2018);

