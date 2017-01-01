temp
---
layout: page
title: Getting Started: Integrating the Playkit SDK in Android Applications
subcat: Android
weight: 291
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)

This article describes the steps required for integrating the Playkit SDK in Android applications. Please follow these instructions carefully to make sure the integration is successful.

## Integrate the Playkit SDK into your Application Settings

1. Clone the SDK  from https://github.com/kaltura/playkit-android and locate it next to your application code.
2. In the setting.gradle, add the SDK project settings as follows:
{% highlight c %}
include ':playkit', ':playkitdemo'
{% endhighlight %}
3. In your build.gradle file, add the dependency for the SDK:
{% highlight c %}
compile project(path: ':playkit')
{% endhighlight %}

Next, to set up the Kaltura Video Player and its plugins, you'll need to provide it with a PKMediaEntry object.


## Creating a PKMediaEntry  

The PKMediaEntry contains information regarding the media that will be played. With this information, the Kaltura Video Player
prepares the source that will play the media, decides which type of player is required to play the media, and more.

#### Methods for Creating the PKMediaEntry  

The PKMediaEntry can be created using one of the following methods:

1. **Manually** - Instantiate a new PKMediaEntry instance and fill the its fields.
   [Learn more here...](#PkMediaEntry breakdown)

2. **Using a MockMediaProvider** - Create a PKMediaEntry from a json input file or JsonObject.
   [Learn more here...](https://github.com/kaltura/DeveloperPortalDocs/tree/playkit/documentation/PlayKit/MediaEntryProvider.md#MockMediaProvider)

3. **Using a remote media Provider** - Use one of the provided MediaEntryProvider implementations:
    For OVP environments, use "KalturaOvpMediaProvider".
    For OTT environments, use "PhoenixMediaProvider".

    To use this method, you'll need to do the following:
   
   a) Create an instance of one of the above mentioned providers.
   
   b) Set the mandatory parameters needed for fetching data, such as media id, SessionProvider, etc.
   
   c) Once your provider object is ready, activate its "load" method and pass a completion callback. If successful, the PKMediaEntry object will be provided in the response.
   
   [Learn more here...](PlayKit/MediaEntryProvider.md#RemoteMediaProviders)

Once you have a PKMediaEntry ready you can build the player configuration and plugins, and continue to prepare the Kaltura Video Player for play.


### [PKMediaEntry](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PKMediaEntry.java)

PkMediaEntry holds information gathered from the media details and needed for the player.
Such as, url to play, DRM data, duration.

String id - correlates to the media/entry id
long duration - the media duration in seconds
MediaEntryType mediaType - indicates the type to be played: can be Vod, Live or Unknown.
List<PKMediaSource> sources - list of source objects

The PKMediaEntry can be created with builder style instantiation, chain setters:
```
PKMediaEntry mediaEntry = new PKMediaEntry().setId(entry.getId())
                                            .setSources(sourcesList)
                                            .setDuration(entry.getDuration())
                                            .setMediaType(MediaTypeConverter.toMediaEntryType(entry.getType()));
```

### [PKMediaSource](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PKMediaSource.java)

PKMediaEntry object contains a list of "PKMediaSource". All sources relates to the same media, but have different format / quality / flavors.
The player decides which of the source will actually be played.


**Manually Create Media Source:**

PKMediaSource can be created with builder like coding, by chaining setters:

```
PKMediaSource pkMediaSource = new PKMediaSource().setId(sourceId)
                                                 .setUrl(sourceUrl)
                                                 .setDrmData(dramDataList);

```

* **_In OTT environments:_**
Each source represents one MediaFile (Media or AssetInfo contains list of MediaFile items. Each file represents different format. HD, SD Download...)
Each file can point to a different video, like Trailer MediaFile and HD media file.
When playing on OTT environments, specific "format" (MediaFile), should be configured.


* **_In OVP environments:_**
PKMediaSource items are created according to some criteria:
  * Supported video format: url [.mp4], mpdash [.mpd], applehttp [.m3u8]
  * Flavors: defines the quality of the video.
  * Bit rate

Single "Entry" can have many media sources. Player should decides according to device capability, connection quality, and other parameters,
which of the sources is best the for the current play.
In case of DRM restricted media, such as widevine, drm information will be needed for the play.

### [PKDrmParams](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PKDrmParams.java)

PKDrmParams represents a single DRM license info object.
PKDrmParams contains the licenseUri that will be needed to the play.

PKMediaSource contains a list of "PKDrmParams" items. The player will select the source and the relevant DRM data according to device type, Connectivity,
supported formats, etc.

[more about Media Providers...](https://github.com/kaltura/DeveloperPortalDocs/tree/playkit/documentation/PlayKit/MediaProviders.md)


## Build the Player Config

```
PlayerConfig config = new PlayerConfig();
config.media.setMediaEntry(mediaEntry);
config.media.setAutoPlay(true);
if (WATCHED_DURATION == -1) {
    config.media.setStartPosition(0);
} else {
    config.media.setStartPosition((long) MEDIA_WATCHED_DURATION);
}
```


## Setting the plugin config to Youbora Plugin

In order for the Youbora Plugin to start loading, you need to set
the plugin config you created -

```
PlayerConfig.Plugins pluginsConfig = config.plugins;
pluginsConfig.setPluginConfig(YouboraPlugin.factory.getName(), converterYoubora.toJson());
```

## Setting the plugin config to IMA Plugin

```
String adTagUrl = "https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/124319096/external/single_ad_samples&ciu_szs=300x250&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&cust_params=deployment%3Ddevsite%26sample_ct%3Dskippablelinear&correlator=";
List<String> videoMimeTypes = new ArrayList<>();
videoMimeTypes.add(MimeTypes.APPLICATION_MP4);
IMAConfig adsConfig = new IMAConfig("en", false, true, -1,
videoMimeTypes, adTagUrl, true, true);

pluginsConfig.setPluginConfig(IMAPlugin.factory.getName(),adsConfig.toJSONObject());

```

## Create The PlayKitManager
```
playerKit = PlayKitManager.loadPlayer(config, this);

```

## Initializing the Player with your config

```
if (playerKit == null) {
    playerKit = PlayKitManager.loadPlayer(config, VideoPlayerBaseActivity.this);
    final FrameLayout playerKitViewContainer = (FrameLayout) findViewById(R.id.player_root);
    ViewGroup.LayoutParams layoutParams = new ViewGroup.LayoutParams(getWindow().getDecorView().getMeasuredWidth(),
            getWindow().getDecorView().getMeasuredHeight());

    View playerKitView = playerKit.getView();
    playerKitView.setLayoutParams(layoutParams);
    playerKitViewContainer.addView(playerKitView);
    setPlayerListeners();
} else {
    String adTagUrl = VIOAdUtil.getCastAdTag(mVideoDetailsModel);
    playerKit.updatePluginConfig(IMAPlugin.factory.getName(), IMAConfig.AD_TAG_URL, adTagUrl);
}
playerKit.prepare(config.media);
if (config.media.isAutoPlay()) {
    playerKit.play();
}
```

## Registering to the Player Events

```
private void setPlayerListeners() {
    playerKit.addEventListener(new PKEvent.Listener() {
         @Override
         public void onEvent(PKEvent event) {
             log.v("addEventListener " + event.eventType());
             log.v("Player Total duration => " + playerKit.getDuration());
             Enum receivedEventType = event.eventType();
             if (event instanceof PlayerEvent) {
                 switch (((PlayerEvent) event).type) {
                     case CAN_PLAY:
                         showOrHideContentLoaderProgress(false);
                         setUpdateProgressTask(true);
                         break;
                     case PLAY:
                         changePlayPauseControllerState(PLAY_STATE);
                         break;
                     case PLAYING:
                         PLAYBACK_STATE = PLAY_STATE;
                         onPlayerPlay();
                        break;
                     case PAUSE:
                         PLAYBACK_STATE = PAUSE_STATE;
                         break;
                     case SEEKING:
                         break;
                     case SEEKED:
                         handlePlayerControlOnSeek(false);
                         break;
                     case ENDED:
                         PLAYBACK_STATE = PAUSE_STATE;
                         onPlayerEnd();
                         break;
                     case TRACKS_AVAILABLE:
                         PKTracks tracks = ((PlayerEvent.TracksAvailable)event).getPKTracks();
                         mPlayerTrackInfo = tracks;
                         break;
                     case ERROR:
                         String errorMsg = "Player error occurred.";
                         break;
                 }
             } else if (event instanceof AdEvent) {
                 switch (((AdEvent) event).type) {
                     case LOADED:
                         showOrHideContentLoaderProgress(false);
                         break;
                     case ALL_ADS_COMPLETED:
                         break;
                     case CONTENT_PAUSE_REQUESTED:
                         break;
                     case STARTED:
                         PLAYBACK_STATE = PLAY_STATE;
                         mAdStartedEventInfo = (AdEvent.AdStartedEvent) event;
                         mAdPlayState = AD_STARTED;
                         mAdRequestStatus = AD_SERVED;
                         break;
                     case PAUSED:
                         PLAYBACK_STATE = PAUSE_STATE;
                         break;
                     case TAPPED:
                         break;
                     case COMPLETED:
                         mAdPlayState = AD_COMPLETE;
                         break;
                     case SKIPPED:
                         break;
                 }
             } else if (event instanceof AdError) {
                 switch (((AdError) event).errorType) {
                     case ADS_REQUEST_NETWORK_ERROR:
                     case INTERNAL_ERROR:
                     case VAST_MALFORMED_RESPONSE:
                     case UNKNOWN_AD_RESPONSE:
                     case VAST_LOAD_TIMEOUT:
                     case VAST_TOO_MANY_REDIRECTS:
                     case VIDEO_PLAY_ERROR:
                     case VAST_MEDIA_LOAD_TIMEOUT:
                     case VAST_LINEAR_ASSET_MISMATCH:
                     case OVERLAY_AD_PLAYING_FAILED:
                     case OVERLAY_AD_LOADING_FAILED:
                     case VAST_NONLINEAR_ASSET_MISMATCH:
                     case COMPANION_AD_LOADING_FAILED:
                     case UNKNOWN_ERROR:
                     case VAST_EMPTY_RESPONSE:
                     case FAILED_TO_REQUEST_ADS:
                     case VAST_ASSET_NOT_FOUND:
                     case INVALID_ARGUMENTS:
                     case PLAYLIST_NO_CONTENT_TRACKING:
                         playerKit.play();
                         break;
                 }
             }

             if (event instanceof PlayerEvent || receivedEventType == AdEvent.Type.PAUSED || receivedEventType == AdEvent.Type.RESUMED || receivedEventType == AdEvent.Type.STARTED) {
                 mPlayKitState = event.eventType();
             }

         }

     }, PlayerEvent.Type.PLAY, PAUSE, CAN_PLAY, PlayerEvent.Type.SEEKING, PlayerEvent.Type.SEEKED, PlayerEvent.Type.PLAYING,
            PlayerEvent.Type.ENDED, PlayerEvent.Type.TRACKS_AVAILABLE, PlayerEvent.Type.ERROR,
            AdEvent.Type.LOADED, AdEvent.Type.SKIPPED, AdEvent.Type.TAPPED, AdEvent.Type.CONTENT_PAUSE_REQUESTED, AdEvent.Type.CONTENT_RESUME_REQUESTED, AdEvent.Type.STARTED, AdEvent.Type.PAUSED, AdEvent.Type.RESUMED,
            AdEvent.Type.COMPLETED, AdEvent.Type.ALL_ADS_COMPLETED, AdError.Type.ADS_REQUEST_NETWORK_ERROR,
            AdError.Type.VAST_EMPTY_RESPONSE, AdError.Type.COMPANION_AD_LOADING_FAILED, AdError.Type.FAILED_TO_REQUEST_ADS,
            AdError.Type.INTERNAL_ERROR, AdError.Type.OVERLAY_AD_LOADING_FAILED, AdError.Type.PLAYLIST_NO_CONTENT_TRACKING,
            AdError.Type.UNKNOWN_ERROR, AdError.Type.VAST_LINEAR_ASSET_MISMATCH, AdError.Type.VAST_MALFORMED_RESPONSE,
            AdError.Type.VAST_LOAD_TIMEOUT, AdError.Type.INVALID_ARGUMENTS, AdError.Type.VAST_TOO_MANY_REDIRECTS);
}

```

## Registering to Player State Change Listener

```
playerKit.addStateChangeListener(new PKEvent.Listener() {
        @Override
        public void onEvent(PKEvent event) {

            PlayerEvent.StateChanged stateChanged = (PlayerEvent.StateChanged) event;
            log.v("addStateChangeListener " + event.eventType() + " = " + stateChanged.newState);
            switch (stateChanged.newState){
                case IDLE:
                    log.d("StateChange Idle");
                    break;
                case LOADING:
                    log.d("StateChange Loading");
                    break;
                case READY:
                    log.d("StateChange Ready");
                    mPlayerControlsView.setProgressBarVisibility(false);
                    break;
                case BUFFERING:
                    log.e("StateChange Buffering");
                    mPlayerControlsView.setProgressBarVisibility(true);
                    break;
            }

        }
    });

```
