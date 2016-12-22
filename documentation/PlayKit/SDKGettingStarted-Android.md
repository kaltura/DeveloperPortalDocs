---
layout: page
title: Integrating the Playkit SDK in Android Applications
subcat: Android
weight: 291
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)

This article describes the steps required for integrating the Playkit SDK in Android applications.

## Integrate the Plakit SDK into your Application Settings 

1. Clone the SDK  from https://github.com/kaltura/playkit-android and locate it next to your application code. 
2. In the setting.gradle, add the SDK projet settings as follows:
```
include ':playkit', ':playkitdemo'
```
3. In your build.gradle file, add the dependancy for the SDK:

```
 compile project(path: ':playkit')
```
## Create the PKMediaEntry for the OvpMediaProvider

###TBD 

## Creating PKMediaEntry for OTT PhoenixMediaProvider 
### Creat SessionProvider

```
 SessionProvider sessionProvider = new SessionProvider() {
            @Override
            public String baseUrl() {
                return baseUrl;
            }

            @Override
            public void getKs(OnCompletion<String> completion) {
                String ks = getKs();
                completion.onComplete(ks);
            }

            @Override
            public int partnerId() {
                return partnerId();
            }
        };
```

### Create PhoenixMediaProvider

```
  String assetId         = getAssetId();
  String referenceType   = getReferenceType();
  List<String> format    = new ArrayList<>(getFormats());
  String[] formatVarargs = format.toArray(new String[format.size()]); 

  MediaEntryProvider phoenixMediaProvider = new PhoenixMediaProvider().setSessionProvider(sessionProvider).setAssetId(assetId).setReferenceType(referenceType).setFormats(formatVarargs);

  loadMediaProvider(phoenixMediaProvider, converterPlayerConfig, onPlayerReadyListener, context);

```

### Load the Media Provider

In this stage you will get `PKMediaEntry` in the `ResultElement` and you will be able to pass it to the player

```
   private static void loadMediaProvider(MediaEntryProvider mediaEntryProvider, final ConverterPlayerConfig layerConfig,
                                         final Activity context) {
    mediaEntryProvider.load(new OnMediaLoadCompletion() {
			@Override
            public void onComplete(final ResultElement<PKMediaEntry> mediaEntry) {
                context.runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        if (mediaEntry.isSuccess()) {
                            #Initialize the player
                            onMediaLoaded(mediaEntry.getResponse(), playerConfig, context);
                        } else {
                            String error = "failed to fetch media data: " + (response.getError() != null ? response.getError().getMessage() : "");
                        }
                    }
                });
            }
        });
    }
```

### On Media Loaded

```
Build the Config and prepare teh player - see below...
```

## Creating PKMediaEntry for OTT tvpapi 

###Create the Media Source 

```
List<PKMediaSource> mediaSourceList = new ArrayList<>();
PKMediaSource pkMediaSource = new PKMediaSource();
pkMediaSource.setId(<FileId>);
pkMediaSource.setUrl(<Media URL>);
```
### In case of Widevine Media - DRM License is required

```
List<PKDrmParams> pkDrmDataList = new ArrayList<>();
PKDrmParams pkDrmParams = new PKDrmParams(licenseUrl);
pkDrmDataList.add(pkDrmParams);
pkMediaSource.setDrmData(pkDrmDataList);
```

###Create the Media Entry

```
PKMediaEntry mediaEntry = new PKMediaEntry();
mediaEntry.setId(<MediaId>)
mediaSourceList.add(pkMediaSource);
mediaEntry.setSources(mediaSourceList);
```



##Create MediaEntry from MockMediaProvider

### Create JsonObject with your Media Information

```
  JsonObject mediaEntryJson = new JsonObject();
  JsonObject mediaParamsJson = new JsonObject();
  JsonArray sourcesArray = new JsonArray();
  JsonObject sourcesObject = new JsonObject();
    sourcesObject.addProperty("mimeType", getMimeType());
  sourcesObject.addProperty("url", getSourceUrl());
  sourcesArray.add(sourcesObject);
  mediaParamsJson.add("sources",  sourcesArray);
  mediaEntryJson.add(<Entry_Key>, mediaParamsJson);

```
###Example:

####Clear Content
```
{
  "<Entry_Key>": {
    "sources": [
      {
        "mimeType": "application/x-mpegURL",
        "url": "myVideURL.m3u8"
      }
    ]
  }
}
```

#### Protecrted Content

```
{
  "<Entry_Key>": {
    "sources": [
      {
        "mimeType": "application/x-mpegURL",
        "url": "myVideURL.m3u8"
        "drmData": {
          "licenseUri": "<LicenseURL>"
        }
      }
    ]
  }
}


```
MimeTypes

```
    mp4_clear("video/mp4", ".mp4"),
    dash_clear("application/dash+xml", ".mpd"),
    dash_widevine("dash", "application/dash+xml", ".mpd"),
    wvm_widevine("video/wvm", ".wvm"),
    hls_clear("application/x-mpegURL", ".m3u8"),
    hls_fairplay("application/vnd.apple.mpegurl", ".m3u8");
```

###Set The MockMediaProvider:


```
MediaEntryProvider mockMediaProvider = new MockMediaProvider(mediaEntryJson, <Entry_Key>);
```

### Load the Media Provider

In this stage you will get `PKMediaEntry` in the `ResultElement` and you will be able to pass it to the player

```
   private static void loadMediaProvider(MediaEntryProvider mediaEntryProvider, final ConverterPlayerConfig playerConfig,
                                         final Activity context) {
    mediaEntryProvider.load(new OnMediaLoadCompletion() {
			@Override
            public void onComplete(final ResultElement<PKMediaEntry> mediaEntry) {
                context.runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        if (mediaEntry.isSuccess()) {
                            #Initialize the player
                            onMediaLoaded(mediaEntry.getResponse(), playerConfig, context);
                        } else {
                            String error = "failed to fetch media data: " + (response.getError() != null ? response.getError().getMessage() : "");
                        }
                    }
                });
            }
        });
    }
```


#Build the Player Config

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
