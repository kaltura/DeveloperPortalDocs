---
layout: page
title: Ads
subcat: SDK 3.0 - Android
weight: 440
---

This article describes the steps required for adding support for the Ad Manager Plugin functionality on Android devices. 
Supporting iab VAST and VAMP ad tags .

### Register the AdPlugin Plugin  

Register the Ad Plugin  as inside your application as follows:

```java
PlayKitManager.registerPlugins(AdPlugin.factory);
```

### Configure the Plugin Configuration Object  

To configure the plugin, add the following configuration to your `pluginConfig` file as follows:

```java
 private void addAdPluginConfig(PKPluginConfigs config, FrameLayout layout, RelativeLayout adSkin) {
        ADConfig adsConfig = new ADConfig()
        .setAdTagURL(mVideoItem.getAdTagUrl())
        .setPlayerViewContainer(layout)
        .setAdSkinContainer(adSkin).setCompanionAdWidth(728)
        .setCompanionAdHeight(90);
        config.setPluginConfig(ADPlugin.factory.getName(), 
        adsConfig);
    }
```
### AdConfig Defaults  

```java
    public ADConfig() {
        this.language                 = "en";
        this.videoBitrate             = -1;
        this.adLoadTimeOut            = DEFAULT_AD_LOAD_TIMEOUT;
        this.videoMimeType            = PKMediaFormat.mp4.mimeType;
        this.adTagType                = AdTagType.UNKNOWN;
        this.adTagURL = null;         //=> must be set via setter
        this.playerViewContainer      = null;
        this.adSkinContainer          = null;
        this.companionAdWidth         = 0;
        this.companionAdHeight        = 0;
```
Each config attribute can be set via setter method.
adTag should be supplied via setter.
All UI should be supplied to the plugin via the AdConfig. (i.e adSkin with buttons etc.)
In case companion ad should be displayed it ia requred to set the sutible width and height size as expected to be in adTag.
## Set the Plugin Configuration to the Ad Plugin  

For the Ad Plugin to start loading, you'll need to set the plugin configuration you created as follows:

```java
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
pluginConfig.plugins.setPluginConfig(ADPlugin.factory.getName(), adsConfig);
```

## Register to the Ad Events  

The Ad Loaded event includes the `AdInfo` playload. You can fetch this data in the following way:

```java 
player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                AdEvent.AdLoadedEvent adLoadedEvent = (AdEvent.AdLoadedEvent) event;
                log("AD_LOADED " + adLoadedEvent.adInfo.getAdTitle());
            }
        }, AdEvent.Type.AD_LOADED);

```

### AdInfo API  

```java
    String   getAdDescription();
    String   getAdId();
    String   getAdSystem();
    boolean  isAdSkippable();
    String   getAdTitle();
    String   getAdContentType();
    int      getAdWidth();
    int      getAdHeight();
    int      getTotalAdsInPod();
    int      getAdIndexInPod();
    int      getPodCount();
    int      getPodIndex();
    boolean  isBumper();
    long     getAdPodTimeOffset();
    long     getAdDuration();
    AdPositionType getAdPositionType();
```

## Ad Events/Error Registration Example  


```java
          private void addPlayerListeners(final ProgressBar appProgressBar) {

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log("ADS_PLAYBACK_ENDED");
            }
        }, AdEvent.Type.ADS_PLAYBACK_ENDED);


        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                AdEvent.AdRequestedEvent adRequestEvent = (AdEvent.AdRequestedEvent) event;
                log("AD_REQUESTED");// adtag = " + adRequestEvent.adTagUrl);
            }
        }, AdEvent.Type.AD_REQUESTED);


        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                AdEvent.AdProgressUpdateEvent aEventProress = (AdEvent.AdProgressUpdateEvent) event;
                //log.d("received NEW AD_PROGRESS_UPDATE " + adEventProress.currentPosition + "/" +  adEventProress.duration);
            }
        }, AdEvent.Type.AD_POSITION_UPDATED);


        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                AdEvent.Error adError = (AdEvent.Error) event;
                Log.d(TAG, "AD_ERROR " + adError.type + " "  + adError.error.message);
                log("AD_ERROR");
            }
        }, AdEvent.Type.ERROR);


        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log("AD_BREAK_STARTED");
                appProgressBar.setVisibility(View.VISIBLE);
            }
        }, AdEvent.Type.AD_BREAK_STARTED);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                AdEvent.AdCuePointsChangedEvent cuePointsList = (AdEvent.AdCuePointsChangedEvent) event;
                Log.d(TAG, "Has Postroll = " + cuePointsList.adCuePoints.hasPostRoll());
                log("AD_CUEPOINTS_UPDATED");
                onCuePointChanged();
            }
        }, AdEvent.Type.AD_CUEPOINTS_UPDATED);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                AdEvent.AdLoadedEvent adLoadedEvent = (AdEvent.AdLoadedEvent) event;
                log("AD_LOADED " + adLoadedEvent.adInfo.getAdTitle() + "/" + adLoadedEvent.adInfo.getTotalAdsInPod());
                appProgressBar.setVisibility(View.INVISIBLE);
            }
        }, AdEvent.Type.AD_LOADED);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log("AD_STARTED ");
                appProgressBar.setVisibility(View.INVISIBLE);
            }
        }, AdEvent.Type.AD_STARTED);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                AdEvent.AdEndedEvent adEndedEvent = (AdEvent.AdEndedEvent) event;
                if (adEndedEvent.adEndedReason == PKAdEndedReason.COMPLETED) {
                    log("AD_ENDED-" + adEndedEvent.adEndedReason);
                } else if (adEndedEvent.adEndedReason == PKAdEndedReason.SKIPPED) {
                    log("AD_ENDED-" + adEndedEvent.adEndedReason);
                    nowPlaying = false;
                }
                appProgressBar.setVisibility(View.INVISIBLE);
            }
        }, AdEvent.Type.AD_ENDED);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log("AD_RESUMED");
                nowPlaying = true;
                appProgressBar.setVisibility(View.INVISIBLE);
            }
        }, AdEvent.Type.AD_RESUMED);


        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log("AD_PAUSED");
                nowPlaying = true;
                appProgressBar.setVisibility(View.INVISIBLE);
            }
        }, AdEvent.Type.AD_PAUSED);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log("AD_ALL_ADS_COMPLETED");
                appProgressBar.setVisibility(View.INVISIBLE);
            }
        }, AdEvent.Type.ALL_ADS_COMPLETED);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                //log("PLAYER PLAY");
                nowPlaying = true;
            }
        }, PlayerEvent.Type.PLAY);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                //log("PLAYER PAUSE");
                nowPlaying = false;
            }
        }, PlayerEvent.Type.PAUSE);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                //log("PLAYER ENDED");
                appProgressBar.setVisibility(View.INVISIBLE);
                nowPlaying = false;
            }

        }, PlayerEvent.Type.ENDED);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log("FIRST_QUARTILE");
            }
        }, AdEvent.Type.FIRST_QUARTILE);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log("MIDPOINT");
            }
        }, AdEvent.Type.MIDPOINT);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log("THIRD_QUARTILE");
            }
        }, AdEvent.Type.THIRD_QUARTILE);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log("AD_BREAK_ENDED");
            }
        }, AdEvent.Type.AD_BREAK_ENDED);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log("AD_CLICKED");
                AdEvent.AdClickEvent advtClickEvent = (AdEvent.AdClickEvent) event;
                Log.d(TAG, "AD_CLICKED url = " + advtClickEvent.advtLink);
                nowPlaying = false;
            }
        }, AdEvent.Type.AD_CLICKED);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log("COMPANION_AD_CLICKED");
                AdEvent.CompanionAdClickEvent advtCompanionClickEvent = (AdEvent.CompanionAdClickEvent) event;
                Log.d(TAG, "COMPANION_AD_CLICKED url = " + advtCompanionClickEvent.advtCompanionLink);
                nowPlaying = false;
            }
        }, AdEvent.Type.COMPANION_AD_CLICKED);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log("AD_STARTED_BUFFERING");
                appProgressBar.setVisibility(View.VISIBLE);

            }
        }, AdEvent.Type.AD_STARTED_BUFFERING);

        player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                log("AD_PLAYBACK_READY");
                appProgressBar.setVisibility(View.INVISIBLE);

            }
        }, AdEvent.Type.AD_PLAYBACK_READY);

```
## Ad Events  

The IMA Plugin supports the following ad events:

```java
        AD_BREAK_PENDING,
        AD_BREAK_STARTED,
        AD_BREAK_ENDED,
        AD_BREAK_IGNORED,
        ADS_PLAYBACK_ENDED,
        ALL_ADS_COMPLETED,
        AD_POSITION_UPDATED,
        AD_REQUESTED,
        AD_CUEPOINTS_UPDATED,
        AD_LOADED,
        AD_STARTED,
        AD_ENDED,
        FIRST_QUARTILE,
        MIDPOINT,
        THIRD_QUARTILE,
        AD_PAUSED,
        AD_RESUMED,
        AD_CLICKED,
        COMPANION_AD_CLICKED,
        PLAYER_STATE,
        AD_STARTED_BUFFERING,
        AD_PLAYBACK_READY,
        AD_TOUCHED,
        ICON_TAPPED,
        ERROR_LOG, // none fatal error while player cannot play stream URL
        ERROR
```
        
## Ad Error Events  

The IMA Plugin supports the following ad error events:

```java
   PKAdErrorType.AD_LOAD_ERROR;
   PKAdErrorType.ADS_REQUEST_NETWORK_ERROR;
   PKAdErrorType.COMPANION_AD_LOADING_FAILED;
   PKAdErrorType.VMAP_EMPTY_RESPONSE;
   PKAdErrorType.VAST_EMPTY_RESPONSE;
   PKAdErrorType.VAST_TOO_MANY_REDIRECTS;
   PKAdErrorType.INVALID_ARGUMENTS;
   PKAdErrorType.NO_TRACKING_EVENTS;
   PKAdErrorType.VIDEO_PLAY_ERROR;
   PKAdErrorType.UNKNOWN_ERROR;
```

## Ad Skin Example  

```xml
   <?xml version="1.0" encoding="utf-8"?>
<RelativeLayout xmlns:android="http://schemas.android.com/apk/res/android"
    android:layout_width="fill_parent"
    android:layout_height="fill_parent"
    android:layout_gravity="center"
    android:clickable="true">

    <Button
        android:id="@+id/skip_btn"
        android:layout_width="wrap_content"
        android:layout_height="wrap_content"
        android:text="Skip Ad"
        android:textAllCaps="false"
        android:visibility="invisible"
        android:layout_marginTop="130dp"
        android:layout_alignParentTop="true"
        android:layout_alignParentLeft="true"
        android:layout_alignParentStart="true" />


    <Button
        android:id="@+id/skip_in_btn"
        android:layout_width="wrap_content"
        android:layout_height="wrap_content"
        android:text=""
        android:textAllCaps="false"
        android:focusable="false"
        android:visibility="invisible"
        android:layout_marginTop="130dp"
        android:layout_alignParentTop="true"
        android:layout_alignParentLeft="true"
        android:layout_alignParentStart="true" />


    <Button
        android:id="@+id/learn_more_btn"
        android:layout_width="70dp"
        android:layout_height="wrap_content"
        android:text="Learn More"
        android:visibility="invisible"
        android:textAllCaps="false"
        android:layout_alignTop="@+id/skip_btn"
        android:layout_alignParentRight="true"
        android:layout_alignParentEnd="true" />

    <LinearLayout

        android:layout_width="match_parent"
        android:layout_height="50dp"
        android:layout_gravity="center_horizontal"
        android:gravity="center"
        android:textAlignment="center"
        android:id="@+id/companionAdSlot"
        android:background="#DDDDDD"
        android:layout_alignParentTop="true"
        android:layout_alignParentLeft="true"
        android:layout_alignParentStart="true">
        <ImageView
            android:visibility="invisible"
            android:id="@+id/imageViewCompanion"
            android:layout_width="wrap_content"
            android:layout_height="wrap_content" />
    </LinearLayout>
</RelativeLayout>
```

## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
