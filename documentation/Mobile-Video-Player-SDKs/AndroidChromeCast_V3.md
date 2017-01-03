---
layout: page
title: Google Cast V3 Setup for Android Devices
subcat: Android Version 2.0
weight: 370
---

## Introduction

The Cast functionality allows your videos to be cast from a Android mobile device, via the Chromecast plugin, directly to a Kaltura Player receiver app on a Chromecast-connected TV.

### Before You Begin  

Before you begin setting up the Cast feature, make sure you've read the article [Android Player SDK and Environment Setup - Getting Started](https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/Android-Getting-Started.html).

## Basic Definitions

* `Sender` - A Cast enabled Kaltura Player running inside of a iOS Application; the Kaltura Player requires a Sender App ID.
* `Receiver` - A Kaltura Player Receiver App that runs on the Chromecast device.


### Getting Started  

To begin casting, follow these steps:

1. Create the `KPPlayerConfig config` as follows:
        ```
        KPPlayerConfig config = new KPPlayerConfig("{your-server-id}", "{your-ui-conf-id}", "{your-pqrtner-id}").setEntryId("{your-entry_id}");
        ```
2. Next, add the following to your `config` instance:

```
config.addConfig("chromecast.plugin", "true");
config.addConfig("chromecast.useKalturaPlayer", "true"); 
config.addConfig("chromecast.applicationID",getString(R.string.app_id));
config.addConfig("chromecast.useKalturaPlayer", "true");
config.addConfig("chromecast.receiverLogo", "true");
config.addConfig("chromecast.defaultThumbnail", "the thumbnail you want to use");
config.addConfig("chromecast", "{\"proxyData\":" + proxyDataReceiver + "}");  // change the played media Format in order to stream it to TV in higher resolution
config.addConfig("strings.mwe-chromecast-loading", "Loading to CC");  // Set Loading message
config.addConfig("chromecast.logoUrl", "Your Logo")
            
```

#### Scanning/Connecting Chromecast Devices  

This version does not require device scannig and connection methods this is achived now by Cast V3 MediaRouteButton that should be attached to the Activity

```
 mMediaRouteButton = (MediaRouteButton) findViewById(R.id.media_route_button);
 CastButtonFactory.setUpMediaRouteButton(getApplicationContext(), mMediaRouteButton);
```
    


#### Casting Media

To cast media, set the `mCastProvider` property under `PlayerViewController` with the `KCastProvider` object you created as follows:

```
 mCastProvider = (KCastProviderV3Impl) KCastFactory.createCastProvider(MainActivity.this, getString(R.string.app_id), getString(R.string.cast_logo_url));
 mCastProvider.addCastStateListener(mCastStateListener);

```

#### Setting Cast Provider

```
   mPlayer.setCastProvider(mCastProvider);
   mCastProvider.setKCastProviderListener(new KCastProvider.KCastProviderListener() {
          @Override
          public void onCastMediaRemoteControlReady(KCastMediaRemoteControl castMediaRemoteControl) {
                LOGD(TAG, "onCastMediaRemoteControlReady hasMediaSession = " + castMediaRemoteControl.hasMediaSession(false));
          }

          @Override
          public void onCastReceiverError(String errorMsg , int errorCode) {
                 LOGE(TAG, "onCastReceiverError errorMsg = " + errorMsg + " errorCode = "  + errorCode);
           }
    });
```

#### Disconnecting from a Device

To disconnect from a device use the following:

You can disconnect using the mediaRouterButton or programatically:

```
mCastProvider.disconnectFromDevcie();
```

### Using the Media Remote Control  

The `KCastProvider` includes a `mCastProvider.getCastMediaRemoteControl()` instance that controls the playback of the video being cast.

At the app level you may add listener to the 
`onCastMediaRemoteControlReady`
and the `onCastReceiverError` Events.

```
public interface KCastProvider {
    void startReceiver(Context context, boolean guestModeEnabled);
    void startReceiver(Context context);
    void disconnectFromCastDevice();
    KCastDevice getSelectedCastDevice();
    void setKCastProviderListener(KCastProviderListener listener);
    KCastMediaRemoteControl getCastMediaRemoteControl();
    boolean isRecconected();
    boolean isConnected();
    boolean isCasting();

    interface KCastProviderListener {
        void onCastMediaRemoteControlReady(KCastMediaRemoteControl castMediaRemoteControl);
        void onCastReceiverError(String errorMsg, int errorCode);
    }
}

```

### Change Media

In oreder to switch between videos during cast playback you should use 

#####OVP
```
mPlayer.changeMedia("Entry ID");
```

#####OTT

```
String URL = "Your thumbnail url";
//if proxy data for CC has to be different than the player
mPlayer.setKDPAttribute("chromecast","proxyData",getChromecatProxyDataJson(entryID));
//for changing the thumbnail of the minicontroller for current media id 
mPlayer.setKDPAttribute("chromecast","defaultThumbnail","'" + URL + "'");  
//for updating mini controller png
mPlayer.getConfig().addConfig("chromecast.defaultThumbnail", URL);
mPlayer.changeMedia(proxyData JSON Object);
```

### it is rewuired to set castProvider again in case that player activity or fragment was destroyed.
### Demo Application  

A best practice sample application, which demonstrates the code that is required for a proper casting experience, can be found in this 
[demo Android](https://github.com/kaltura/player-sdk-native-android/tree/develop/KalturaDemos/CCPlayerDemo). 
